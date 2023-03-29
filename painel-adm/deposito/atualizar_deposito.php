<header>
    <h2>Atualizar Insumo do Depósito</h2>
</header>
<?php
    $idInsumoDeposito = mysqli_real_escape_string($conexao,$_POST["idInsumoDeposito"]);
    $nomeInsumoDeposito = mysqli_real_escape_string($conexao,$_POST["nomeInsumoDeposito"]);
    $tipoInsumoDeposito = mysqli_real_escape_string($conexao,$_POST["tipoInsumoDeposito"]);
    $tipoInsumoDeposito = $tipoInsumoDeposito[0];
    $setorInsumoDeposito = mysqli_real_escape_string($conexao,$_POST["setorInsumoDeposito"]);
    $setorInsumoDeposito = $setorInsumoDeposito[0];
    $sql = "UPDATE deposito SET 
        nome_insumoNome = '{$nomeInsumoDeposito}',
        tipo_tipoInsumos_ID = {$tipoInsumoDeposito},
        setor_setorID = {$setorInsumoDeposito} 
        WHERE id={$idInsumoDeposito}";
        mysqli_query($conexao, $sql) or die("Erro ao executar a inserção. " . mysqli_error($conexao));

        echo "O Insumo foi atualizado no depósito e no sistema com sucesso!";
?>