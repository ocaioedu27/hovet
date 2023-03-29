<header>
    <h2>Inserir Insumo</h2>
</header>
<?php 
    
    $nomeInsumo = mysqli_real_escape_string($conexao,$_POST["nomeInsumo"]);
    $unidadeInsumo = mysqli_real_escape_string($conexao,$_POST["unidadeInsumo"]);
    $tipoInsumo = mysqli_real_escape_string($conexao,$_POST["tipoInsumo"]);
    $tipoInsumo = $tipoInsumo[0];
    $sql = "INSERT INTO insumos (
        nome,
        unidade,
        insumo_tipo_ID)
        VALUES(
            '{$nomeInsumo}',
            '{$unidadeInsumo}',
            {$tipoInsumo}
        )";
        if(mysqli_query($conexao, $sql)){
			echo "<script language='javascript'>window.alert('Insumo cadastrado com sucesso!'); </script>";
			echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=insumos';</script>";
        } else{
            die("Erro ao executar a inserção. " . mysqli_error($conexao));
			echo "<script language='javascript'>window.alert('Erro ao cadastrar insumo!'); </script>";
			echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=cadastro_insumo';</script>";
        }

?>