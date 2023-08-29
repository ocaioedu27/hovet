<header>
    <h2>Inserir Insumo</h2>
</header>
<?php 

    $dados_enviados_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if (!empty($dados_enviados_array['btnAdicionarEstoque'])) {

        foreach ($dados_enviados_array['nomeNovoEstoque'] as $chave_cad_estoque => $valor_cad_estoque) {
            $nomeNovoEstoque = $valor_cad_estoque;
            $tipoNovoEstoque = $dados_enviados_array['tipoNovoEstoque'][$chave_cad_estoque];
            $tipoNovoEstoque = strtok($tipoNovoEstoque," ");
            $descricaoNovoEstoque = $dados_enviados_array['descricaoNovoEstoque'][$chave_cad_estoque];

            $nome_real_estoque_bruto = $nomeNovoEstoque;
            $nome_real_estoque_tmp = retiraAcentos($nome_real_estoque_bruto);
            $nome_real_estoque = str_replace(' ','',$nome_real_estoque_tmp);

            echo "<br> Chave para o estoque: " . $chave_cad_estoque;
            echo "<br> Nome do novo estoque: " . $nomeNovoEstoque;
            echo "<br> Tipo: " . $tipoNovoEstoque;
            echo "<br> Descrição: " . $descricaoNovoEstoque;
            echo "<br> Nome real: " . $nome_real_estoque;

            $sql_verifica_se_existe = "SELECT * FROM estoques WHERE estoques_nome='{$nomeNovoEstoque}' or estoques_nome_real='{$nome_real_estoque}'";

            $result_check_exist = mysqli_query($conexao, $sql_verifica_se_existe);

            if ($result_check_exist->num_rows > 0) {
                echo "<script language='javascript'>window.alert('Erro - Nome de Estoque JÁ CADASTRADO! Informe um nome ainda não cadastrado para prosseguir!'); </script>";
                echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=cadastro_estoque';</script>";
            } else {
                // echo "seguindo para o insert";

                $sql = "INSERT INTO estoques (
                    estoques_nome,
                    estoques_nome_real,
                    estoques_tipos_estoques_id,
                    estoques_descricao)
                    VALUES(
                        '{$nomeNovoEstoque}',
                        '{$nome_real_estoque}',
                        {$tipoNovoEstoque},
                        '{$descricaoNovoEstoque}'
                    )";

                if(mysqli_query($conexao, $sql)){
                    echo "<script language='javascript'>window.alert('Novo estoque cadastrado com sucesso!!'); </script>";
                    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=estoques';</script>";

                } else{
                    die("//cadastro de insumos - Erro ao cadastrar insumo: " . mysqli_error($conexao));
                }

            }

        }

    } else {
        echo '//Insumos/CadInsumos - nenhum formulário enviado';
    }

?>