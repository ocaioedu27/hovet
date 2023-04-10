<header>
    <h2>Atualizar Insumo do Dispensário</h2>
</header>
<?php
    $idInsumoDispensario = mysqli_real_escape_string($conexao,$_POST["idInsumoDispensario"]);
    $nomeInsumoDispensario = mysqli_real_escape_string($conexao,$_POST["nomeInsumoDispensario"]);
    $tipoInsumoDispensario = mysqli_real_escape_string($conexao,$_POST["tipoInsumoDispensario"]);
    // $tipoInsumoDispensario = $tipoInsumoDispensario[0];
    $tipoInsumoDispensario = strtok($tipoInsumoDispensario, " ");
    $setorInsumoDispensario = mysqli_real_escape_string($conexao,$_POST["setorInsumoDispensario"]);
    // $setorInsumoDispensario = $setorInsumoDispensario[0];
    $setorInsumoDispensario = strtok($setorInsumoDispensario, " ");
    $sql = "UPDATE Dispensario SET 
        nome_insumoNome = '{$nomeInsumoDispensario}',
        tipo_tipoInsumos_ID = {$tipoInsumoDispensario},
        setor_setorID = {$setorInsumoDispensario} 
        WHERE id={$idInsumoDispensario}";
        mysqli_query($conexao, $sql) or die("Erro ao executar a inserção. " . mysqli_error($conexao));

        echo "O Insumo foi atualizado no Dispensário e no sistema com sucesso!";
?>