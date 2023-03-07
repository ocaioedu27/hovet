<header>
    <h2>Inserir Insumo</h2>
</header>
<?php 
    
    $nomeInsumo = mysqli_real_escape_string($conexao,$_POST["nomeInsumo"]);
    $unidadeInsumo = mysqli_real_escape_string($conexao,$_POST["unidadeInsumo"]);
    $tipoInsumo = mysqli_real_escape_string($conexao,$_POST["tipoInsumo"]);
    $sql = "INSERT INTO insumos (
        nome,
        unidade,
        insumo_tipo)
        VALUES(
            '{$nomeInsumo}',
            '{$unidadeInsumo}',
            '{$tipoInsumo}'
        )";
        mysqli_query($conexao, $sql) or die("Erro ao executar a inserção. " . mysqli_error($conexao));

        echo "O Insumo foi cadastrado no sistema com sucesso!";
?>