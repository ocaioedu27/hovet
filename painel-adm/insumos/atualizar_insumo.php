<header>
    <h2>Atualizar Insumo</h2>
</header>
<?php 
    $idInsumo = mysqli_real_escape_string($conexao,$_POST["idInsumo"]);
    $nomeInsumo = mysqli_real_escape_string($conexao,$_POST["nomeInsumo"]);
    $unidadeInsumo = mysqli_real_escape_string($conexao,$_POST["unidadeInsumo"]);
    $tipoInsumo = mysqli_real_escape_string($conexao,$_POST["tipoInsumo"]);
    $sql = "UPDATE insumos SET 
        nome = '{$nomeInsumo}',
        unidade = '{$unidadeInsumo}',
        insumo_tipo = {$tipoInsumo}
        WHERE id={$idInsumo}
        ";
    mysqli_query($conexao, $sql) or die("Erro ao executar a inserção. " . mysqli_error($conexao));

    echo "O Insumo foi atualizado no sistema com sucesso!";


    header('Location: index.php?menuop=insumos');
?>