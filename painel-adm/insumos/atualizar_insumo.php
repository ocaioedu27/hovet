<header>
    <h2>Atualizar Insumo</h2>
</header>
<?php 
    $idInsumo = mysqli_real_escape_string($conexao,$_POST["idInsumo"]);
    $nomeInsumo = mysqli_real_escape_string($conexao,$_POST["nomeInsumo"]);
    $unidadeInsumo = mysqli_real_escape_string($conexao,$_POST["unidadeInsumo"]);
    $descricaoInsumo = mysqli_real_escape_string($conexao,$_POST["descricaoInsumo"]);
    $tipoInsumo = mysqli_real_escape_string($conexao,$_POST["tipoInsumo"]);
    // $tipoInsumo = $tipoInsumo[0];
    $tipoInsumo = strtok($tipoInsumo, " ");

    $sql = "UPDATE insumos SET 
        insumos_nome = '{$nomeInsumo}',
        insumos_unidade = '{$unidadeInsumo}',
        insumos_descricao = '{$descricaoInsumo}',
        insumos_tipo_insumos_id = {$tipoInsumo}
        WHERE insumos_id={$idInsumo}
        ";
        if(mysqli_query($conexao, $sql)){
			echo "<script language='javascript'>window.alert('Insumo atualizado com sucesso!'); </script>";
			echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=insumos';</script>";
        } else{
            echo "<script language='javascript'>window.alert('Erro ao atualizar insumo!'); </script>";
            echo " <a href=\"/hovet/painel-adm/index.php?menuop=editar_usuario\">Voltar ao formulário de edição</a> <br/>";
    
            die("//insumos/atualizar_insumos/ - Erro: " . mysqli_error($conexao));
        }
?>