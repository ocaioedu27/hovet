
<?php 

    $idCategoria = mysqli_real_escape_string($conexao,$_POST["idCategoriaInsumo"]);
    $nomeCategoria = mysqli_real_escape_string($conexao,$_POST["nomeCategoriaInsumo"]);
    $descCategoria = mysqli_real_escape_string($conexao,$_POST["descCategoriaInsumo"]);
    
    // $tipoInsumo = $tipoInsumo[0];
    // $tipoInsumo = strtok($tipoInsumo, " ");
    echo "<br>id: " . $idCategoria;
    echo "<br>Nome: " . $nomeCategoria;
    echo "<br>Desc: " . $descCategoria;


    $sql = "UPDATE 
                tipos_insumos
            SET 
                tipos_insumos_tipo = '{$nomeCategoria}',
                tipos_insumos_descricao = '{$descCategoria}'
            WHERE 
                tipos_insumos_id={$idCategoria}";

    // echo "<br>SQL: " . $sql;

    if(mysqli_query($conexao, $sql)){
        echo "<script language='javascript'>window.alert('Item atualizado com sucesso!'); </script>";
        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=categorias_insumos';</script>";
    } else{
        echo "<script language='javascript'>window.alert('Erro ao atualizar!'); </script>";
        echo "<a href=\"/hovet/sistema/index.php?menuop=editar_categoria_insumos&id=$id\">Voltar ao formulário de edição</a> <br/>";

        die("//categorias_insumos/atualizar_categorias - Erro: " . mysqli_error($conexao));
    }
?>