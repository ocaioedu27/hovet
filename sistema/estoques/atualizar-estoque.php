
<?php 

    $idCategoria = mysqli_real_escape_string($conexao,$_POST["idEstoque"]);
    $nomeCategoria = mysqli_real_escape_string($conexao,$_POST["nomeEstoque"]);
    $tipoEstoque = mysqli_real_escape_string($conexao,$_POST["tipoEstoque"]); 
    $tipoEstoque = strtok($tipoEstoque, " ");
    $descCategoria = mysqli_real_escape_string($conexao,$_POST["descEstoque"]);
    
    // $tipoInsumo = $tipoInsumo[0];
    // $tipoInsumo = strtok($tipoInsumo, " ");
    echo "<br>id: " . $idCategoria;
    echo "<br>Nome: " . $nomeCategoria;
    echo "<br>Tipo: " . $tipoEstoque;
    echo "<br>Desc: " . $descCategoria;

    // exit;

    $sql = "UPDATE 
                estoques
            SET 
                estoques_nome = '{$nomeCategoria}',
                estoques_tipos_estoques_id = {$tipoEstoque},
                estoques_descricao = '{$descCategoria}'
            WHERE 
                estoques_id={$idCategoria}";

    // echo "<br>SQL: " . $sql;

    if(mysqli_query($conexao, $sql)){
        echo "<script language='javascript'>window.alert('Item atualizado com sucesso!'); </script>";
        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=estoques';</script>";
    } else{
        echo "<script language='javascript'>window.alert('Erro ao atualizar!'); </script>";
        echo "<a href=\"/hovet/sistema/index.php?menuop=editar_estoque&id=$id\">Voltar ao formulário de edição</a> <br/>";

        die("//categorias_insumos/atualizar_categorias - Erro: " . mysqli_error($conexao));
    }
?>