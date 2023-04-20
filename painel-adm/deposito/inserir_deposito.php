<header>
    <h2>Inserir Insumo no Depósito</h2>
</header>
<?php 
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
?>