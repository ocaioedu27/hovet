<header>
    <h2>Atualizar Insumo</h2>
</header>
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
    
        $idPermissao_tmp = $stringList[1];
    
        $idPermissao = $_GET[$idPermissao_tmp];
    
    }

    $idPermissao = mysqli_real_escape_string($conexao,$_POST["idPermissao"]);
    $nomePermissao = mysqli_real_escape_string($conexao,$_POST["nomePermissao"]);
    $descPermissao = mysqli_real_escape_string($conexao,$_POST["descPermissao"]);

    $sql = "UPDATE permissoes_usuario SET 
        permissoes_nome = '{$nomePermissao}',
        permissoes_desc = '{$descPermissao}'

        WHERE permissoes_id={$idPermissao}
        ";
        if(mysqli_query($conexao, $sql)){
			echo "<script language='javascript'>window.alert('Permissão atualizada com sucesso!'); </script>";
			echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=permissoes';</script>";
        } else{
            echo "<script language='javascript'>window.alert('Erro ao atualizar permissão!'); </script>";
    
            die("//permissoes/atualizar_permissao/sql_update - Erro: " . mysqli_error($conexao));
        }
?>