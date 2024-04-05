
<?php 

    $stringList = array();

    if ( isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
        // Cria variáveis dinamicamente
        // $contador = 0;
        foreach ( $_GET as $chave => $valor ) {
            $valor_tmp = $chave;
            $position = strpos($valor_tmp, "menuop");
            $valor_est = strstr($valor_tmp,$position);
            array_push($stringList, $valor_est);

        }
        // var_dump($stringList);

        $idCategoria = $stringList[1];

        $categoriaId = $_GET[$idCategoria];

    }

    $idInsumo = mysqli_real_escape_string($conexao,$_POST["idInsumo"]);
    $nomeInsumo = mysqli_real_escape_string($conexao,$_POST["nomeInsumo"]);
    $unidadeInsumo = mysqli_real_escape_string($conexao,$_POST["unidadeInsumo"]);
    $descricaoInsumo = mysqli_real_escape_string($conexao,$_POST["descricaoInsumo"]);
    $qtdCriticaInsumo = mysqli_real_escape_string($conexao,$_POST["qtdCriticaInsumo"]);
    $tipoInsumo = mysqli_real_escape_string($conexao,$_POST["tipoInsumo"]);
    // $tipoInsumo = $tipoInsumo[0];
    $tipoInsumo = strtok($tipoInsumo, " ");

    $sql = "UPDATE insumos SET 
        nome = '{$nomeInsumo}',
        unidade = '{$unidadeInsumo}',
        descricao = '{$descricaoInsumo}',
        qtd_critica = {$qtdCriticaInsumo},
        tipo_insumos_id = {$tipoInsumo}
        WHERE id={$idInsumo}
        ";
        if(mysqli_query($conexao, $sql)){
			echo "<script language='javascript'>window.alert('Insumo atualizado com sucesso!'); </script>";
			echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=insumos&categoriaInsumoId=$categoriaId';</script>";
        } else{
            echo "<script language='javascript'>window.alert('Erro ao atualizar insumo!'); </script>";
            echo " <a href=\"/hovet/sistema/index.php?menuop=editar_insumo&categoriaInsumoId=$categoriaId&idInsumo=$idInsumo\">Voltar ao formulário de edição</a> <br/>";
    
            die("//insumos/atualizar_insumos/ - Erro: " . mysqli_error($conexao));
        }
?>