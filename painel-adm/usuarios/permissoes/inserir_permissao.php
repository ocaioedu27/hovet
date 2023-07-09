<header>
    <h2>Inserir Insumo</h2>
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

        $idCategoria = $stringList[1];

        $categoriaId = $_GET[$idCategoria];

    }

    $dados_enviados_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if (!empty($dados_enviados_array['btnCriarPermissao'])) {

        foreach ($dados_enviados_array['nomePermissao'] as $chave_cad_permissao => $valor_cad_permissao) {
            $nomePermissao = $valor_cad_permissao;
            $descPermissao = $dados_enviados_array['descPermissao'][$chave_cad_permissao];

            $sql = "INSERT INTO permissoes_usuario (
                permissoes_nome,
                permissoes_desc)
                VALUES(
                    '{$nomePermissao}',
                    '{$descPermissao}'
                )";

            if(mysqli_query($conexao, $sql)){
                echo "<script language='javascript'>window.alert('Permissão criada com sucesso!'); </script>";
                echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=permissoes';</script>";

            } else{
                die("//cadastro de permissao - Erro ao cadastrar permissao: " . mysqli_error($conexao));
            }

        }

    } else {
        echo '//Permissoes/Inserir_permissao - nenhum formulário enviado';
    }

?>