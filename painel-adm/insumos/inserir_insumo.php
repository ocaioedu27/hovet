<header>
    <h2>Inserir Insumo</h2>
</header>
<?php 
    
    $nomeInsumo = mysqli_real_escape_string($conexao,$_POST["nomeInsumo"]);
    $unidadeInsumo = mysqli_real_escape_string($conexao,$_POST["unidadeInsumo"]);
    $descricaoInsumo = mysqli_real_escape_string($conexao,$_POST["descricaoInsumo"]);
    $qtdCriticaInsumo = mysqli_real_escape_string($conexao,$_POST["qtdCriticaInsumo"]);
    $tipoInsumo = mysqli_real_escape_string($conexao,$_POST["tipoInsumo"]);
    $tipoInsumo = strtok($tipoInsumo, " ");
    // $tipoInsumo = $tipoInsumo[0];
    $sql = "INSERT INTO insumos (
        insumos_nome,
        insumos_unidade,
        insumos_descricao,
        insumos_qtd_critica,
        insumos_tipo_insumos_id)
        VALUES(
            '{$nomeInsumo}',
            '{$unidadeInsumo}',
            '{$descricaoInsumo}',
            {$qtdCriticaInsumo},
            {$tipoInsumo}
        )";

    if(mysqli_query($conexao, $sql)){
        echo "<script language='javascript'>window.alert('Insumo cadastrado com sucesso!'); </script>";
        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=insumos';</script>";

    } else{
        die("//cadastro de insumos - Erro ao cadastrar insumo: " . mysqli_error($conexao));
    }

?>