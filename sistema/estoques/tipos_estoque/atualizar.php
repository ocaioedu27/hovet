
<?php 

    $idCategoria = mysqli_real_escape_string($conexao,$_POST["id"]);
    $nomeCategoria = mysqli_real_escape_string($conexao,$_POST["tipo"]);
    
    echo "<br>id: " . $idCategoria;
    echo "<br>Nome: " . $nomeCategoria;

    $sql = "UPDATE 
                tipos_estoques
            SET 
                tipo = '{$nomeCategoria}'
            WHERE 
                id={$idCategoria}";


    if(mysqli_query($conexao, $sql)){
        echo "<script language='javascript'>window.alert('Item atualizado com sucesso!'); </script>";
        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=tp_estoque';</script>";
    } else{
        echo "<script language='javascript'>window.alert('Erro ao atualizar!'); </script>";
        echo "<a href=\"/hovet/sistema/index.php?menuop=edit_tp_estoque&id=$id\">Voltar ao formulário de edição</a> <br/>";

        die("//categorias_insumos/atualizar_categorias - Erro: " . mysqli_error($conexao));
    }
?>