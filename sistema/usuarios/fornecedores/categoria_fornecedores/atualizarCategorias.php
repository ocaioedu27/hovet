
<?php 

    $idCategoria = mysqli_real_escape_string($conexao,$_POST["idCategoria"]);
    $nomeCategoria = mysqli_real_escape_string($conexao,$_POST["nomeCategoria"]);
    $descCategoria = mysqli_real_escape_string($conexao,$_POST["descCategoria"]);
    
    // $tipoInsumo = $tipoInsumo[0];
    // $tipoInsumo = strtok($tipoInsumo, " ");
    echo "<br>id: " . $idCategoria;
    echo "<br>Nome: " . $nomeCategoria;
    echo "<br>Desc: " . $descCategoria;


    $sql = "UPDATE 
                categorias_fornecedores
            SET 
                cf_categoria = '{$nomeCategoria}',
                cf_descricao = '{$descCategoria}'
            WHERE 
                cf_id={$idCategoria}";

    // echo "<br>SQL: " . $sql;

    if(mysqli_query($conexao, $sql)){
        echo "<script language='javascript'>window.alert('Item atualizado com sucesso!'); </script>";
        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=categorias_fornecedores';</script>";
    } else{
        echo "<script language='javascript'>window.alert('Erro ao atualizar!'); </script>";
        echo "<a href=\"/hovet/sistema/index.php?menuop=editar_categoria_fornecedores&id=$id\">Voltar ao formulário de edição</a> <br/>";

        die("//categorias_fornecedores/atualizar_categorias - Erro: " . mysqli_error($conexao));
    }
?>