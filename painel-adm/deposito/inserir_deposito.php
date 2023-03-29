<header>
    <h2>Inserir Insumo no Depósito</h2>
</header>
<?php 
    
    $nomeInsumoDeposito = mysqli_real_escape_string($conexao,$_POST["nomeInsumoDeposito"]);
    $quantidadeInsumoDeposito = mysqli_real_escape_string($conexao,$_POST["quantidadeInsumoDeposito"]);
    $tipoInsumoDeposito = mysqli_real_escape_string($conexao,$_POST["tipoInsumoDeposito"]);
    $tipoInsumoDeposito = $tipoInsumoDeposito[0];
    $setorInsumoDeposito = mysqli_real_escape_string($conexao,$_POST["setorInsumoDeposito"]);
    $setorInsumoDeposito = $setorInsumoDeposito[0];
    $validadeInsumoDeposito = mysqli_real_escape_string($conexao,$_POST["validadeInsumoDeposito"]);
    $sql = "INSERT INTO deposito (
        nome,
        quantidade,
        tipo_tipoInsumos_ID,
        setor_setorID,
        validade)
        VALUES(
            '{$nomeInsumoDeposito}',
            '{$quantidadeInsumoDeposito}',
            {$tipoInsumoDeposito},
            {$setorInsumoDeposito},
            '{$validadeInsumoDeposito}'
        )";
        mysqli_query($conexao, $sql) or die("Erro ao executar a inserção. " . mysqli_error($conexao));

        echo "O Insumo foi cadastrado no depósito do sistema com sucesso!";
?>