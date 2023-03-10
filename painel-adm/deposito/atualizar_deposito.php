<header>
    <h2>Atualizar Insumo do Depósito</h2>
</header>
<?php
    $idInsumoDeposito = mysqli_real_escape_string($conexao,$_POST["idInsumoDeposito"]);
    $nomeInsumoDeposito = mysqli_real_escape_string($conexao,$_POST["nomeInsumoDeposito"]);
    $quantidadeInsumoDeposito = mysqli_real_escape_string($conexao,$_POST["quantidadeInsumoDeposito"]);
    $tipoInsumoDeposito = mysqli_real_escape_string($conexao,$_POST["tipoInsumoDeposito"]);
    $setorInsumoDeposito = mysqli_real_escape_string($conexao,$_POST["setorInsumoDeposito"]);
    $sql = "UPDATE deposito SET 
        nome_insumoNome = '{$nomeInsumoDeposito}',
        quantidade = {$quantidadeInsumoDeposito},
        tipo_insumoTipo = '{$tipoInsumoDeposito}',
        setor = '{$setorInsumoDeposito}' 
        WHERE id={$idInsumoDeposito}";
        mysqli_query($conexao, $sql) or die("Erro ao executar a inserção. " . mysqli_error($conexao));

        echo "O Insumo foi atualizado no depósito e no sistema com sucesso!";
?>