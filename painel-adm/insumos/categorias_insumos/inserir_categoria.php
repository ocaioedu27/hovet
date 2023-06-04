<header>
    <h2>Inserir Insumo</h2>
</header>
<?php 

    $dados_enviados_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if (!empty($dados_enviados_array['btnAdicionarCategoriaInsumo'])) {

        foreach ($dados_enviados_array['nomeNovaCategoriaInsumo'] as $chave_cad_categoria => $valor_cad_categoria) {
            $nomeNovaCategoriaInsumo = $valor_cad_categoria;
            $descNovaCategoriaInsumo = $dados_enviados_array['descNovaCategoriaInsumo'][$chave_cad_categoria];

            echo "<br> Chave para a categoria: " . $chave_cad_categoria;
            echo "<br> Nome da nova categoria: " . $nomeNovaCategoriaInsumo;
            echo "<br> Descrição: " . $descNovaCategoriaInsumo;

            $sql_verifica_se_existe = "SELECT * FROM tipos_insumos WHERE tipos_insumos_tipo='{$nomeNovaCategoriaInsumo}'";

            $result_check_exist = mysqli_query($conexao, $sql_verifica_se_existe);

            if ($result_check_exist->num_rows > 0) {
                echo "<script language='javascript'>window.alert('Erro - Nome de Estoque JÁ CADASTRADO! Informe um nome ainda não cadastrado para prosseguir!'); </script>";
                echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=cadastro_categoria_insumo';</script>";
            } else {
                // echo "seguindo para o insert";

                $sql = "INSERT INTO tipos_insumos (
                    tipos_insumos_tipo,
                    tipos_insumos_descricao)
                    VALUES(
                        '{$nomeNovaCategoriaInsumo}',
                        '{$descNovaCategoriaInsumo}'
                    )";

                if(mysqli_query($conexao, $sql)){
                    echo "<script language='javascript'>window.alert('Nova categoria cadastrada com sucesso!!'); </script>";
                    echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=categorias_insumos';</script>";

                } else{
                    die("//cadastro_categorias/sql_insert - Erro ao cadastrar categoria de insumos: " . mysqli_error($conexao));
                }

            }

        }

    } else {
        echo '//Insumos/cad_categoria - nenhum formulário enviado';
    }

?>