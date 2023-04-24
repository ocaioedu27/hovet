<header>
    <h2>Inserir Insumo no Depósito</h2>
</header>
<?php

    if (isset($_FILES['nota_fiscal_deposito'])) {
        $nota_fiscal_deposito = $_FILES['nota_fiscal_deposito'];

        // var_dump($nota_fiscal_deposito);

        // echo "<br/>pegou a nota fiscal";

        if ($nota_fiscal_deposito['error']) {
            die("Falha ao enviar nota fiscal");
        }

        // echo "<br/>passou da verificacao de erro";

        if ($nota_fiscal_deposito['size'] > 2097152) {
            die("Arquivo muito grande!! Max: 2MB.");
        }

        // echo "<br/>passou da verificacao de tamanho";

        $pasta_notas_fiscais_deposito = "/home/caio/www/hovet/painel-adm/deposito/notas_fiscais/";

        // echo "<br/>achou a pasta: $pasta_notas_fiscais_deposito";

        $nome_nota_fiscal_deposito = $nota_fiscal_deposito['name'];

        // echo "<br/>Achou o nome: $nome_nota_fiscal_deposito";

        $novo_nome_nota_fiscal_deposito = uniqid();
        
        // echo "<br/>gerou o novo nome: $novo_nome_nota_fiscal_deposito";

        $extensao_nota_fiscal = strtolower(pathinfo($nome_nota_fiscal_deposito, PATHINFO_EXTENSION));
        
        // echo "<br/>coletou a extensao: $extensao_nota_fiscal";

        if ($extensao_nota_fiscal != "jpg" && $extensao_nota_fiscal != "png") {
            die("Tipo de arquivo não aceito");
        }

        $path_nota_fical = $pasta_notas_fiscais_deposito . $novo_nome_nota_fiscal_deposito . "." . $extensao_nota_fiscal;
        
        $upload_feito = move_uploaded_file($nota_fiscal_deposito['tmp_name'], $path_nota_fical);

        if ($upload_feito) { 
            echo "<script language='javascript'>window.alert('Nota fiscal enviada com sucesso!!'); </script>";
        } else {
            echo "<script language='javascript'>window.alert('Nota fiscal não foi salva!!'); </script>";
        }
    }

    $quantidadeInsumodeposito = mysqli_real_escape_string($conexao,$_POST["quantidadeInsumodeposito"]);
    $validadeInsumodeposito = mysqli_real_escape_string($conexao,$_POST["validadeInsumodeposito"]);
    $insumoID_Insumodeposito = mysqli_real_escape_string($conexao,$_POST["insumoID_Insumodeposito"]);
    $insumoID_Insumodeposito = strtok($insumoID_Insumodeposito, " ");
    $sql = "INSERT INTO deposito (
        deposito_qtd,
        deposito_validade,
        deposito_insumos_id)
        VALUES(
            {$quantidadeInsumodeposito},
            '{$validadeInsumodeposito}',
            {$insumoID_Insumodeposito}
        )";

        if (mysqli_query($conexao, $sql)) { 
            echo "<script language='javascript'>window.alert('Insumo inserido no Depósito com sucesso!!'); </script>";
            echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=deposito';</script>";   
        } else {
            die("Erro ao executar a inserção no Depósito. " . mysqli_error($conexao));   
        }

    
    $tipo_movimentacao = mysqli_real_escape_string($conexao,$_POST["tipo_insercao_deposito"]);
    $tipo_movimentacao = strtok($tipo_movimentacao, " ");

    $local_origem = "$tipo_movimentacao";

    $local_destino = "Depósito";

    $usuario_id = $_SESSION['usuario_id'];

    $insumo_id = $insumoID_Insumodeposito;
    
    atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id, $insumo_id);

?>