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

            if (mysqli_query($conexao, $sql)) { 
                echo "<script language='javascript'>window.alert('Insumo inserido no Depósito com sucesso!!'); </script>";
                // echo "insumo inserido com sucesso";   
            } else {
                die("//deposito/insere_dep - Erro ao executar a inserção no Depósito. " . mysqli_error($conexao));   
            }

            $sqlGetDepId = "SELECT d.deposito_id, i.nome as insumo_nome FROM deposito d INNER JOIN insumos i ON d.insumos_id = i.id WHERE id_origem = '$origem_id'";
            $rGetDepId = mysqli_query($conexao, $sqlGetDepId);
            $dadosGetId = mysqli_fetch_assoc($rGetDepId);
            $dep_id = $dadosGetId['deposito_id'];
            $insumo_nome = $dadosGetId['insumo_nome'];
            
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
                                        {$dep_id}
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
                    {$dep_id}
                )";


                if (mysqli_query($conexao, $sql_doacao)) { 
                    echo "<script language='javascript'>window.alert('Doação registrada com sucesso!!'); </script>";
                    // echo "insumo inserido com sucesso";   
                } else {
                    die("//deposito/registra_doacao - Erro ao executar a inserção na tablea de doações. " . mysqli_error($conexao));   
                }
            }


            echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=deposito_resumo&" . $qualEstoque . "=1';</script>";
    
            $local_destino = "Depósito " . $qualEstoque[-1];
    
            $usuario_id_nome = $sessionUserID . ' - ' . $userFirstName;
            
            atualiza_movimentacao($conexao, $tipo_movimentacao, $origem_item, $local_destino, $usuario_id_nome, $insumo_nome);

        }

    } else {
        echo "error";
    }


?>