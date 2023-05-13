<header>
    <h2>Inserir Insumo no Depósito</h2>
</header>
<?php

    $dados_enviados_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // var_dump($dados_enviados_array);

    if (!empty($dados_enviados_array['btnAdicionarInsumoDeposito'])) {

        $quem_guardou = mysqli_real_escape_string($conexao,$_POST["quem_esta_guardando_dep"]);
        $quem_guardou = strtok($quem_guardou, " ");
        // echo "<br/> quem guardou: " . $quem_guardou;

        $$num_nota_fiscal = mysqli_real_escape_string($conexao,$_POST["num_nota_fiscal_cad_dep"]);
        // echo "<br/> tipo de operacao: " . $tipo_movimentacao;

        $data_operacao = mysqli_real_escape_string($conexao,$_POST["dataCadastroInsumoDeposito"]);
        echo "</br> Data da operação: " . $data_operacao;
        
        $tipo_movimentacao = mysqli_real_escape_string($conexao,$_POST["tipo_insercao_deposito"]);
        $tipo_movimentacao = strtok($tipo_movimentacao, " ");
        
        $fornecedorCadInsumoDep = mysqli_real_escape_string($conexao,$_POST["fornecedorCadInsumoDep"]);
        $fornecedorCadInsumoDep = strtok($fornecedorCadInsumoDep, " ");
        

        foreach ($dados_enviados_array['insumoID_Insumodeposito'] as $chave_cad_deposito => $valor_cad_deposito) {

            $insumoID_Insumodeposito = $valor_cad_deposito;
            $insumoID_Insumodeposito = strtok($insumoID_Insumodeposito, " ");
            $quantidadeInsumodeposito = $dados_enviados_array['quantidadeInsumodeposito'][$chave_cad_deposito];
            $validadeInsumodeposito = $dados_enviados_array['validadeInsumodeposito'][$chave_cad_deposito];
            $depositoDestinoInsumodeposito = $dados_enviados_array['depositoDestinoInsumodeposito'][$chave_cad_deposito];
            $depositoDestinoInsumodeposito = strtok($depositoDestinoInsumodeposito, " ");
            
            $tem_nota_fiscal = $_FILES['nota_fiscal_deposito'];
            // var_dump($tem_nota_fiscal);

            if ((isset($_FILES['nota_fiscal_deposito'])) && ($tem_nota_fiscal['size'] != 0)) {
                $nota_fiscal_deposito = $_FILES['nota_fiscal_deposito'];
                echo "<br/>";
                // var_dump($nota_fiscal_deposito);
    
                // echo "<br/>pegou a nota fiscal";
    
                if ($nota_fiscal_deposito['error']) {
                    $erro_cad_nota_fiscal = $nota_fiscal_deposito['error'];
                    echo '<br/>//deposito/cad_deposito - erro ao cadastrar a nota fiscal: ' . $erro_cad_nota_fiscal;
                    die("Falha ao enviar nota fiscal");
                }
    
                // echo "<br/>passou da verificacao de erro";
    
                if ($nota_fiscal_deposito['size'] > 16000000) {
                    die("Arquivo muito grande!! Max: 16MB.");
                }
    
                // echo "<br/>passou da verificacao de tamanho";
    
                $pasta_notas_fiscais_deposito = "./estoques/deposito/notas_fiscais/";
    
                // echo "<br/>achou a pasta: $pasta_notas_fiscais_deposito";
    
                $nome_nota_fiscal_deposito = $nota_fiscal_deposito['name'];
    
                // echo "<br/>Achou o nome: $nome_nota_fiscal_deposito";
    
                $novo_nome_nota_fiscal_deposito = uniqid();
                
                // echo "<br/>gerou o novo nome: $novo_nome_nota_fiscal_deposito";
    
                $extensao_nota_fiscal = strtolower(pathinfo($nome_nota_fiscal_deposito, PATHINFO_EXTENSION));
                
                // echo "<br/>coletou a extensao: $extensao_nota_fiscal";
    
                if ($extensao_nota_fiscal != "jpg" && $extensao_nota_fiscal != "png" && $extensao_nota_fiscal != "pdf") {
                    die("Tipo de arquivo não aceito");
                }
    
                $path_nota_fiscal = $pasta_notas_fiscais_deposito . $novo_nome_nota_fiscal_deposito . "." . $extensao_nota_fiscal;

                // echo "<br/>coletou path: $path_nota_fiscal";

                $tmp_name_nf = $nota_fiscal_deposito['tmp_name'];
                // echo "<br/>Fez o upload? $tmp_name_nf";

                // echo "diretorio executado" . $_SERVER['PHP_SELF'] . "<br />";


                $upload_feito = move_uploaded_file($nota_fiscal_deposito['tmp_name'], $path_nota_fiscal);

                // echo "<br/>Fez o upload? $upload_feito";
    
                if ($upload_feito) {

                    // echo "<br> vai pro insert";
                    $sql_salva_db = "INSERT INTO compras 
                                        (compras_nome,
                                        compras_num_nf, 
                                        compras_caminho,
                                        compras_insumos_id,
                                        compras_tipos_movimentacoes_id)
                                        VALUE (
                                        '{$nome_nota_fiscal_deposito}',
                                        '{$num_nota_fiscal}',
                                        '{$path_nota_fiscal}',
                                        {$insumoID_Insumodeposito},
                                        {$tipo_movimentacao}
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
                echo "<br/>Nota fiscal não adicionada";
            }

            $sql = "INSERT INTO deposito (
                deposito_qtd,
                deposito_validade,
                deposito_insumos_id,
                deposito_estoque_id
                )
                VALUES(
                    {$quantidadeInsumodeposito},
                    '{$validadeInsumodeposito}',
                    {$insumoID_Insumodeposito},
                    {$depositoDestinoInsumodeposito}
                )";

            

            if (mysqli_query($conexao, $sql)) { 
                echo "<script language='javascript'>window.alert('Insumo inserido no Depósito com sucesso!!'); </script>";
                echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=deposito';</script>";
                // echo "insumo inserido com sucesso";   
            } else {
                die("//deposito/insere_dep - Erro ao executar a inserção no Depósito. " . mysqli_error($conexao));   
            }

            if ($tipo_movimentacao == 1) {
                $local_origem = "Compra";
            } else {
                $local_origem = "Doação";
            }
    
            $local_destino = "Depósito";
    
            $usuario_id = $quem_guardou;
    
            $insumo_id = $insumoID_Insumodeposito;
            
            atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id, $insumo_id);
        }
    } else {
        echo "error";
    }


?>