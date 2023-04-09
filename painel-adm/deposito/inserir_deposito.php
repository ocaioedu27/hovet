<header>
    <h2>Inserir Insumo no Depósito</h2>
</header>
<?php 
    $quantidadeInsumodeposito = mysqli_real_escape_string($conexao,$_POST["quantidadeInsumodeposito"]);
    $validadeInsumodeposito = mysqli_real_escape_string($conexao,$_POST["validadeInsumodeposito"]);
    $insumoID_Insumodeposito = mysqli_real_escape_string($conexao,$_POST["insumoID_Insumodeposito"]);
    $insumoID_Insumodeposito = $insumoID_Insumodeposito[0];
    $sql = "INSERT INTO deposito (
        deposito_Qtd,
        deposito_Validade,
        deposito_InsumosID)
        VALUES(
            {$quantidadeInsumodeposito},
            '{$validadeInsumodeposito}',
            {$insumoID_Insumodeposito}
        )";
        mysqli_query($conexao, $sql) or die("Erro ao executar a inserção. " . mysqli_error($conexao));

        echo "O Insumo foi cadastrado no Depósito do sistema com sucesso!";
?>