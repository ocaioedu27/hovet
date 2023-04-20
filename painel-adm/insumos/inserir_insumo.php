<header>
    <h2>Inserir Insumo</h2>
</header>
<?php 
    
    $nomeInsumo = mysqli_real_escape_string($conexao,$_POST["nomeInsumo"]);
    $unidadeInsumo = mysqli_real_escape_string($conexao,$_POST["unidadeInsumo"]);
    $tipoInsumo = mysqli_real_escape_string($conexao,$_POST["tipoInsumo"]);
    $tipoInsumo = strtok($tipoInsumo, " ");
    // $tipoInsumo = $tipoInsumo[0];
    $sql = "INSERT INTO insumos (
        insumos_nome,
        insumos_unidade,
        insumos_tipo_insumos_id)
        VALUES(
            '{$nomeInsumo}',
            '{$unidadeInsumo}',
            {$tipoInsumo}
        )";

    if(mysqli_query($conexao, $sql)){
        echo "<script language='javascript'>window.alert('Insumo cadastrado com sucesso!'); </script>";
        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=insumos';</script>";

    } else{
        die("//cadastro de insumos - Erro ao cadastrar insumo: " . mysqli_error($conexao));
    }

?>