<?php

    $dados_enviados_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if (!empty($dados_enviados_array['btn_cadastrar'])) {

        foreach ($dados_enviados_array['nomeNovoTipoEstoque'] as $chave_cad_estoque => $valor_cad_estoque) {
            $tipoNovoEstoque = $valor_cad_estoque;

            echo "<br> Chave para o estoque: " . $chave_cad_estoque;
            echo "<br> Tipo: " . $tipoNovoEstoque;
            
            $sql_verifica_se_existe = "SELECT tipo FROM tipos_estoques WHERE tipo='{$nomeNovoEstoque}'";

            $result_check_exist = mysqli_query($conexao, $sql_verifica_se_existe);

            if ($result_check_exist->num_rows > 0) {
                echo "<script language='javascript'>window.alert('Erro - Nome de Estoque JÁ CADASTRADO! Informe um nome ainda não cadastrado para prosseguir!'); </script>";
                echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=cad_tp_estoque';</script>";
            } else {
                echo "seguindo para o insert";

                $sql = "INSERT INTO tipos_estoques (
                    tipo)
                    VALUES(
                        '{$tipoNovoEstoque}'
                    )";

                if(mysqli_query($conexao, $sql)){
                    echo "<script language='javascript'>window.alert('Novo estoque cadastrado com sucesso!!'); </script>";
                    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=tp_estoque';</script>";

                } else{
                    die("//TiposEstoques/cadastro de tipos de estoques - Erro ao cadastrar tipo de estoque: " . mysqli_error($conexao));
                }

            }

        }

    } else {
        echo '//TiposEstoques/Cadastro de tipos de estoques - nenhum formulário enviado';
    }

?>

?>