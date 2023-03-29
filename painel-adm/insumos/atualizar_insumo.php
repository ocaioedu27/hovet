<header>
    <h2>Atualizar Insumo</h2>
</header>
<?php 
    $idInsumo = mysqli_real_escape_string($conexao,$_POST["idInsumo"]);
    $nomeInsumo = mysqli_real_escape_string($conexao,$_POST["nomeInsumo"]);
    $unidadeInsumo = mysqli_real_escape_string($conexao,$_POST["unidadeInsumo"]);
    $tipoInsumo = mysqli_real_escape_string($conexao,$_POST["tipoInsumo"]);
    $tipoInsumo = $tipoInsumo[0];
    $sql = "UPDATE insumos SET 
        nome = '{$nomeInsumo}',
        unidade = '{$unidadeInsumo}',
        insumo_tipo_ID = {$tipoInsumo}
        WHERE id={$idInsumo}
        ";
        if(mysqli_query($conexao, $sql)){
			echo "<script language='javascript'>window.alert('Insumo atualizado com sucesso!'); </script>";
			echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=insumos';</script>";
        } else{
            die("Erro ao executar a inserção. " . mysqli_error($conexao));
			echo "<script language='javascript'>window.alert('Erro ao atualizar insumo!'); </script>";
			echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=cadastro_insumo';</script>";
        }
?>