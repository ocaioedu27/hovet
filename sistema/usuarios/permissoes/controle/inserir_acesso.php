<header>
    <h2>Inserir acesso</h2>
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

        $userId_tmp = $stringList[1];

        $userId = $_GET[$userId_tmp];

        // echo $userId;

    }

    $dados_enviados_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // var_dump($dados_enviados_array);
    
    if (!empty($dados_enviados_array['btnCederPermissoesUser'])) {

        $id_user_to_add_permission = mysqli_real_escape_string($conexao,$_POST["id_user_to_add_permission"]);

        foreach ($dados_enviados_array['nomeAcessoUsuario'] as $chave_ceder_permissao => $valor_ceder_permissao) {

            $idPermissao_tmp = $valor_ceder_permissao;
            $idPermissao = strtok($idPermissao_tmp, " ");

            $sql = "INSERT INTO usuarios_has_permissoes (
                uhp_usuario_id,
                uhp_permissoes_id)
                VALUE(
                    {$id_user_to_add_permission},
                    {$idPermissao}
                )";            

            $execute = mysqli_query($conexao, $sql);

            if($execute){

                echo "<script language='javascript'>window.alert('Permissão cedida com sucesso!'); </script>";
                echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=gerenciar_permissoes_usuario&idUsuario=$userId';</script>";

            } else{
                die("//cadastro de permissao - Erro ao cadastrar permissao: " . mysqli_error($conexao));
            }

        }

    } else {
        echo '//Permissoes/Inserir_permissao - nenhum formulário enviado';
    }

?>