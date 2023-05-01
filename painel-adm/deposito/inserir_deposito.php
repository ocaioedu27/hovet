<header>
    <h2>Inserir Insumo no Depósito</h2>
</header>
<?php

    $dados_enviados_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // var_dump($dados_enviados_array);

    if (!empty($dados_enviados_array['btnAdicionarInsumoDeposito'])) {

        $quem_guardou = mysqli_real_escape_string($conexao,$_POST["solicitante_retira_dispensario"]);
        echo "<br/> quem guardou: " . $quem_guardou;

        $tipo_movimentacao = mysqli_real_escape_string($conexao,$_POST["tipo_insercao_deposito"]);
        echo "<br/> tipo de operacao: " . $tipo_movimentacao;

        $data_operacao = mysqli_real_escape_string($conexao,$_POST["dataCadastroInsumoDeposito"]);
        echo "</br> Data da operação: " . $data_operacao;

        if (isset($_FILES['nota_fiscal_deposito'])) {
            $nota_fiscal_deposito = $_FILES['nota_fiscal_deposito'];
            echo "<br/>";
            var_dump($nota_fiscal_deposito);
        } else{
            echo "<br/>Nota fiscal não adicionada";
        }

        foreach ($dados_enviados_array['insumoID_Insumodeposito'] as $chave_cad_deposito => $valor_cad_deposito) {

            $insumoID_Insumodeposito = $valor_cad_deposito;
            $insumoID_Insumodeposito = strtok($insumoID_Insumodeposito, " ");
            $quantidadeInsumodeposito = $dados_enviados_array['quantidadeInsumodeposito'][$chave_cad_deposito];
            $validadeInsumodeposito = $dados_enviados_array['validadeInsumodeposito'][$chave_cad_deposito];
            echo "<br/>Chave para o insumo: $chave_cad_deposito";
            echo "<br/>Id do insumo: $insumoID_Insumodeposito";
            echo "<br/>Quantidade: $quantidadeInsumodeposito";
            echo "<br/>Validade: $validadeInsumodeposito";
            echo "<hr>";

            // $sql = "INSERT INTO deposito (
            //     deposito_qtd,
            //     deposito_validade,
            //     deposito_insumos_id)
            //     VALUES(
            //         {$quantidadeInsumodeposito},
            //         '{$validadeInsumodeposito}',
            //         {$insumoID_Insumodeposito}
            //     )";

            

            // if (mysqli_query($conexao, $sql)) { 
            //     echo "<script language='javascript'>window.alert('Insumo inserido no Depósito com sucesso!!'); </script>";
            //     echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=deposito';</script>";
            //     // echo "insumo inserido com sucesso";   
            // } else {
            //     die("Erro ao executar a inserção no Depósito. " . mysqli_error($conexao));   
            // }
        }
    } else {
        echo "error";
    }
    

    // $insumoID_Insumodeposito = mysqli_real_escape_string($conexao,$_POST["insumoID_Insumodeposito"]);
    // $insumoID_Insumodeposito = strtok($insumoID_Insumodeposito, " ");

    // if (isset($_FILES['nota_fiscal_deposito'])) {
    //     $nota_fiscal_deposito = $_FILES['nota_fiscal_deposito'];

    //     // var_dump($nota_fiscal_deposito);

    //     // echo "<br/>pegou a nota fiscal";

    //     if ($nota_fiscal_deposito['error']) {
    //         die("Falha ao enviar nota fiscal");
    //     }

    //     // echo "<br/>passou da verificacao de erro";

    //     if ($nota_fiscal_deposito['size'] > 16000000) {
    //         die("Arquivo muito grande!! Max: 16MB.");
    //     }

    //     // echo "<br/>passou da verificacao de tamanho";

    //     $pasta_notas_fiscais_deposito = "./deposito/notas_fiscais/";

    //     // echo "<br/>achou a pasta: $pasta_notas_fiscais_deposito";

    //     $nome_nota_fiscal_deposito = $nota_fiscal_deposito['name'];

    //     // echo "<br/>Achou o nome: $nome_nota_fiscal_deposito";

    //     $novo_nome_nota_fiscal_deposito = uniqid();
        
    //     // echo "<br/>gerou o novo nome: $novo_nome_nota_fiscal_deposito";

    //     $extensao_nota_fiscal = strtolower(pathinfo($nome_nota_fiscal_deposito, PATHINFO_EXTENSION));
        
    //     // echo "<br/>coletou a extensao: $extensao_nota_fiscal";

    //     if ($extensao_nota_fiscal != "jpg" && $extensao_nota_fiscal != "png" && $extensao_nota_fiscal != "pdf") {
    //         die("Tipo de arquivo não aceito");
    //     }

    //     $path_nota_fical = $pasta_notas_fiscais_deposito . $novo_nome_nota_fiscal_deposito . "." . $extensao_nota_fiscal;
        
    //     $upload_feito = move_uploaded_file($nota_fiscal_deposito['tmp_name'], $path_nota_fical);

    //     if ($upload_feito) {
    //         $sql_salva_db = "INSERT INTO notas_fiscais 
    //                             (notas_fiscais_nome, 
    //                             notas_fiscais_caminho,
    //                             notas_fiscais_insumos_id)
    //                             VALUE (
    //                             '{$nome_nota_fiscal_deposito}',
    //                             '{$path_nota_fical}',
    //                             {$insumoID_Insumodeposito}
    //                             )";

    //         $inseriu_no_banco = mysqli_query($conexao,$sql_salva_db);
    //         if($inseriu_no_banco){
    //             echo "<script language='javascript'>window.alert('Nota fiscal salva no banco de dados!!'); </script>";
    //         }
    //         else{
    //             die("//deposito/quarda_nota_fisca/inserir_db/ erro ao realizar a inserção: " . mysqli_error($conexao));
    //         }
    //     } else {
    //         echo "<script language='javascript'>window.alert('Nota fiscal não foi salva!!'); </script>";
    //     }
    // }

    // $quantidadeInsumodeposito = mysqli_real_escape_string($conexao,$_POST["quantidadeInsumodeposito"]);
    // $validadeInsumodeposito = mysqli_real_escape_string($conexao,$_POST["validadeInsumodeposito"]);
    // // $insumoID_Insumodeposito = mysqli_real_escape_string($conexao,$_POST["insumoID_Insumodeposito"]);
    // // $insumoID_Insumodeposito = strtok($insumoID_Insumodeposito, " ");
    // $sql = "INSERT INTO deposito (
    //     deposito_qtd,
    //     deposito_validade,
    //     deposito_insumos_id)
    //     VALUES(
    //         {$quantidadeInsumodeposito},
    //         '{$validadeInsumodeposito}',
    //         {$insumoID_Insumodeposito}
    //     )";

    //     if (mysqli_query($conexao, $sql)) { 
    //         echo "<script language='javascript'>window.alert('Insumo inserido no Depósito com sucesso!!'); </script>";
    //         echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=deposito';</script>";   
    //     } else {
    //         die("Erro ao executar a inserção no Depósito. " . mysqli_error($conexao));   
    //     }

    
    // $tipo_movimentacao = mysqli_real_escape_string($conexao,$_POST["tipo_insercao_deposito"]);
    // $tipo_movimentacao = strtok($tipo_movimentacao, " ");

    // $local_origem = "$tipo_movimentacao";

    // $local_destino = "Depósito";

    // $usuario_id = $_SESSION['usuario_id'];

    // $insumo_id = $insumoID_Insumodeposito;
    
    // atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id, $insumo_id);

?>