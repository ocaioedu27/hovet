<header>
    <h2>Inserir Insumo no Depósito</h2>
</header>
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

            $insumoID_Insumodeposito = $valor_cad_deposito;
            $insumoID_Insumodeposito = strtok($insumoID_Insumodeposito, " ");
            $quantidadeInsumodeposito = $dados_enviados_array['quantidadeInsumodeposito'][$chave_cad_deposito];
            $validadeInsumodeposito = $dados_enviados_array['validadeInsumodeposito'][$chave_cad_deposito];
            $depositoDestinoInsumodeposito = $dados_enviados_array['depositoDestinoInsumodeposito'][$chave_cad_deposito];
            $depositoDestinoInsumodeposito = strtok($depositoDestinoInsumodeposito, " ");
            
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
                                        (compras_nome,
                                        compras_num_nf, 
                                        compras_caminho,
                                        compras_qtd_guardada,
                                        compras_quem_guardou_id,
                                        compras_tipos_movimentacoes_id,
                                        compras_fornecedor_id)
                                        VALUE (
                                        '{$nome_nota_fiscal_deposito}',
                                        '{$num_nota_fiscal}',
                                        '{$path_nota_fiscal}',
                                        {$quantidadeInsumodeposito},
                                        {$quem_guardou},
                                        {$tipo_movimentacao},
                                        {$fornecedorCadInsumoDep}
                                        )";
    
                    $inseriu_no_banco = mysqli_query($conexao,$sql_salva_db);
                    if($inseriu_no_banco){
                        echo "<script language='javascript'>window.alert('Nota fiscal salva na base de dados!!'); </script>";
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
                    doacoes_qtd_doada,
                    doacoes_oid_operacao,
                    doacoes_tipos_movimentacoes_id,
                    doacoes_quem_guardou_id,
                    doacoes_insumos_id,
                    doacoes_fornecedor_id,
                    doacoes_estoque_id
                )
                VALUES (
                    {$quantidadeInsumodeposito},
                    '{$origem_id}',
                    {$tipo_movimentacao},
                    {$quem_guardou},
                    {$insumoID_Insumodeposito},
                    {$fornecedorCadInsumoDep},
                    {$depositoDestinoInsumodeposito}
                )";


                if (mysqli_query($conexao, $sql_doacao)) { 
                    echo "<script language='javascript'>window.alert('Doação registrada com sucesso!!'); </script>";
                    // echo "insumo inserido com sucesso";   
                } else {
                    die("//deposito/registra_doacao - Erro ao executar a inserção na tablea de doações. " . mysqli_error($conexao));   
                }
            }

            // var_dump($tem_nota_fiscal);

            $sql = "INSERT INTO deposito (
                deposito_qtd,
                deposito_validade,
                deposito_origem_item,
                deposito_id_origem,
                deposito_insumos_id,
                deposito_estoque_id
                )
                VALUES(
                    {$quantidadeInsumodeposito},
                    '{$validadeInsumodeposito}',
                    '{$origem_item}',
                    '{$origem_id}',
                    {$insumoID_Insumodeposito},
                    {$depositoDestinoInsumodeposito}
                )";

            if (mysqli_query($conexao, $sql)) { 
                echo "<script language='javascript'>window.alert('Insumo inserido no Depósito com sucesso!!'); </script>";
                echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=deposito_resumo&" . $qualEstoque . "=1';</script>";
                // echo "insumo inserido com sucesso";   
            } else {
                die("//deposito/insere_dep - Erro ao executar a inserção no Depósito. " . mysqli_error($conexao));   
            }


            if ($tipo_movimentacao == 1) {
                $local_origem = "Compra";
            } else {
                $local_origem = "Doação";
            }
    
            $local_destino = "Depósito " . $qualEstoque[-1];
    
            $usuario_id = $quem_guardou;
    
            $insumo_id = $insumoID_Insumodeposito;
            
            atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id, $insumo_id);
        }
    } else {
        echo "error";
    }


?>