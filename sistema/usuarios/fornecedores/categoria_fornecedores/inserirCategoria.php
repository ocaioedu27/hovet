<header>
    <h2>Inserir Nova Categoria</h2>
</header>
<?php 

    $dados_enviados_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if (!empty($dados_enviados_array['btnCadastrar'])) {

        foreach ($dados_enviados_array['nomeNovaCategoria'] as $chave_cad_categoria => $valor_cad_categoria) {
            $nomeNovaCategoria = $valor_cad_categoria;
            $descNovaCategoria = $dados_enviados_array['nomeNovaCategoria'][$chave_cad_categoria];

            echo "<br> Chave para a categoria: " . $chave_cad_categoria;
            echo "<br> Nome da nova categoria: " . $nomeNovaCategoria;
            echo "<br> Descrição: " . $descNovaCategoria;

            $sql_verifica_se_existe = "SELECT * FROM categorias_fornecedores WHERE categoria='{$nomeNovaCategoria}'";

            $result_check_exist = mysqli_query($conexao, $sql_verifica_se_existe);

            if ($result_check_exist->num_rows > 0) {
                echo "<script language='javascript'>window.alert('Erro - Categoria JÁ CADASTRADA! Informe um nome ainda não cadastrado para prosseguir!'); </script>";
                echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=cadastroCategoriaFornecedor';</script>";
            } else {
                echo "seguindo para o insert";

                $sql = "INSERT INTO categorias_fornecedores (
                    categoria,
                    descricao)
                    VALUES(
                        '{$nomeNovaCategoria}',
                        '{$descNovaCategoria}'
                    )";

                if(mysqli_query($conexao, $sql)){
                    echo "<script language='javascript'>window.alert('Nova categoria cadastrada com sucesso!!'); </script>";
                    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=categorias_fornecedores';</script>";

                } else{
                    die("//cadastro_categorias/sql_insert - Erro ao cadastrar categoria: " . mysqli_error($conexao));
                }

            }

        }

    } else {
        echo '//Insumos/cad_categoria - nenhum formulário enviado';
    }

?>