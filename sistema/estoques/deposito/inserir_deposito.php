<?php

    if (   isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
        // Cria variáveis dinamicamente
        foreach ( $_GET as $chave => $valor ) {
            $valor_tmp = $chave;
            $position = strpos($valor_tmp, "menuop");
            $valor_est = strstr($valor_tmp,$position);
            // $$chave = $valor;
            // print_r($valor_est);
        }
    }

    $qualEstoque_dep = $valor_est;


    if ($qualEstoque_dep != "") {
        $qualEstoque = $qualEstoque_dep;
        // echo "é dep: " . $qualEstoque;
    }

    $dados_enviados_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $msg_insumo_inserido = "Cadastro realizado com sucesso! Insumo ";
    $msg_compra = " Compra registrada com sucesso! Insumo ";
    $msg_doacao = " Doação registrada com sucesso! Insumo ";
    $msg_mov = " Movimentação registrada com sucesso! Insumo ";
    $msg_final = "";

    // var_dump($dados_enviados_array);

    if (!empty($dados_enviados_array['btnAdicionarInsumoDeposito'])) {

        $quem_guardou = mysqli_real_escape_string($conexao,$_POST["quem_esta_guardando_dep"]);
        $quem_guardou = strtok($quem_guardou, " ");
        // echo "<br/> quem guardou: " . $quem_guardou;

        $num_nota_fiscal = mysqli_real_escape_string($conexao,$_POST["num_nota_fiscal_cad_dep"]);

        // echo "<br/> tipo de operacao: " . $num_nota_fiscal;

        $data_operacao = mysqli_real_escape_string($conexao,$_POST["dataCadastroInsumoDeposito"]);
        // echo "</br> Data da operação: " . $data_operacao;
        
        $tipo_movimentacao_bruto = mysqli_real_escape_string($conexao,$_POST["tipo_insercao_deposito"]);
        $tipo_movimentacao = strtok($tipo_movimentacao_bruto, " ");
        
        $fornecedorCadInsumoDep = mysqli_real_escape_string($conexao,$_POST["fornecedorCadInsumoDep"]);
        $fornecedorCadInsumoDep = strtok($fornecedorCadInsumoDep, " ");

        $origem_item = "";

        if ($tipo_movimentacao == 1) {
            $origem_item = "Compra";
            $origem_id = $num_nota_fiscal;
        } else {
            $origem_item = "Doação";
            $origem_id = uniqid();
        }

        foreach ($dados_enviados_array['insumoID_Insumodeposito'] as $chave_cad_deposito => $valor_cad_deposito) {

            $insumoID_Insumodeposito_id_nome = $valor_cad_deposito;
            $insumoID_Insumodeposito = strtok($insumoID_Insumodeposito_id_nome, " ");
            $quantidadeInsumodeposito = $dados_enviados_array['quantidadeInsumodeposito'][$chave_cad_deposito];
            $validadeInsumodeposito = $dados_enviados_array['validadeInsumodeposito'][$chave_cad_deposito];
            $depositoDestinoInsumodeposito_completo = $dados_enviados_array['depositoDestinoInsumodeposito'][$chave_cad_deposito];
            $depositoDestinoInsumodeposito = strtok($depositoDestinoInsumodeposito_completo, " ");

            // var_dump($tem_nota_fiscal);

            $sql = "INSERT INTO deposito (
                qtd,
                validade,
                origem_item,
                id_origem,
                insumos_id,
                estoque_id
                )
                VALUES(
                    {$quantidadeInsumodeposito},
                    '{$validadeInsumodeposito}',
                    '{$origem_item}',
                    '{$origem_id}',
                    {$insumoID_Insumodeposito},
                    {$depositoDestinoInsumodeposito}
                )";

            $partes_nome_insumo = explode(' - ',$insumoID_Insumodeposito_id_nome);
            $nome_insumo = $partes_nome_insumo[1];

            try {

                $inserir_inusmo_no_banco = mysqli_query($conexao, $sql);
                
                if ($inserir_inusmo_no_banco) {
                    $id_insumo_inserido = mysqli_insert_id($conexao);
                    $msg_final .= '\n\n' . $msg_insumo_inserido ."". $nome_insumo;

                } else {
                    die("//deposito/insere_dep - Erro ao executar a inserção no Depósito. " . mysqli_error($conexao));   
                }   
            } catch (\Throwable $th) {
                echo "//deposito/insere_dep - Erro: " . $th;
            }
            
            $tem_nota_fiscal = $_FILES['nota_fiscal_deposito'];

            if ((isset($_FILES['nota_fiscal_deposito'])) && ($tem_nota_fiscal['size'] != 0)) {
                $nota_fiscal_deposito = $_FILES['nota_fiscal_deposito'];
    
                if ($nota_fiscal_deposito['error']) {
                    $erro_cad_nota_fiscal = $nota_fiscal_deposito['error'];
                    echo '<br/>//deposito/cad_deposito - erro ao cadastrar a nota fiscal: ' . $erro_cad_nota_fiscal;
                    die("Falha ao enviar nota fiscal");
                }
    
                if ($nota_fiscal_deposito['size'] > 16000000) {
                    die("Arquivo muito grande!! Max: 16MB.");
                }
    
                $pasta_notas_fiscais_deposito = "./estoques/deposito/notas_fiscais/";
    
                $nome_nota_fiscal_deposito = $nota_fiscal_deposito['name'];
    
                $novo_nome_nota_fiscal_deposito = uniqid();
    
                $extensao_nota_fiscal = strtolower(pathinfo($nome_nota_fiscal_deposito, PATHINFO_EXTENSION));
    
                if ($extensao_nota_fiscal != "jpg" && $extensao_nota_fiscal != "png" && $extensao_nota_fiscal != "pdf") {
                    die("Tipo de arquivo não aceito");
                }
    
                $path_nota_fiscal = $pasta_notas_fiscais_deposito . $novo_nome_nota_fiscal_deposito . "." . $extensao_nota_fiscal;

                $tmp_name_nf = $nota_fiscal_deposito['tmp_name'];

                $upload_feito = move_uploaded_file($nota_fiscal_deposito['tmp_name'], $path_nota_fiscal);
    
                if ($upload_feito) {

                    // echo "<br> vai pro insert";
                    $sql_salva_db = "INSERT INTO compras 
                                        (nome_nf,
                                        num_nf, 
                                        caminho,
                                        qtd_guardada,
                                        usuario_id,
                                        tipos_movimentacoes_id,
                                        fornecedor_id,
                                        deposito_id)
                                    VALUE (
                                        '{$nome_nota_fiscal_deposito}',
                                        '{$num_nota_fiscal}',
                                        '{$path_nota_fiscal}',
                                        {$quantidadeInsumodeposito},
                                        {$quem_guardou},
                                        {$tipo_movimentacao},
                                        {$fornecedorCadInsumoDep},
                                        {$id_insumo_inserido}
                                    )";
        
                    $inseriu_no_banco = mysqli_query($conexao,$sql_salva_db);
                    if($inseriu_no_banco){
                        $msg_final .= $msg_compra . $nome_insumo;
                    }
                    else{
                        die("//deposito/quarda_nota_fisca/inserir_db/ erro ao realizar a inserção: " . mysqli_error($conexao));
                    }

                } else {
                    echo "<script language='javascript'>window.alert('Nota fiscal não foi salva na base de dados!!'); </script>";
                }
    
            } else{
                // echo "<br/>é doação";
                $sql_doacao = "INSERT INTO doacoes (
                    qtd_doada,
                    oid_operacao,
                    tipos_movimentacoes_id,
                    usuario_id,
                    fornecedor_id,
                    deposito_id
                )
                VALUES (
                    {$quantidadeInsumodeposito},
                    '{$origem_id}',
                    {$tipo_movimentacao},
                    {$quem_guardou},
                    {$fornecedorCadInsumoDep},
                    {$id_insumo_inserido}
                )";


                if (mysqli_query($conexao, $sql_doacao)) { 
                    $msg_final .= $msg_doacao . $nome_insumo;
                } else {
                    die("//deposito/registra_doacao - Erro ao executar a inserção na tablea de doações. " . mysqli_error($conexao));   
                }
            }

            $partes_nome_estoque = explode(' - ',$depositoDestinoInsumodeposito_completo);
            $local_destino = $partes_nome_estoque[1];
    
            $usuario_id_nome = $sessionUserID . ' - ' . $userFirstName;
            
            if (atualiza_movimentacao($conexao, $tipo_movimentacao, $origem_item, $local_destino, $usuario_id_nome, $nome_insumo)){
                $msg_final .= $msg_mov . $nome_insumo;
            }

        }

        echo '<script language="javascript">window.alert("'.$msg_final.'")</script>';
        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=deposito_resumo&" . $qualEstoque . "=1';</script>";


    } else {
        echo "error";
    }


?>