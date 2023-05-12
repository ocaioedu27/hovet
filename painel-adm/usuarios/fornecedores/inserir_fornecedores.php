<header>
    <h2>Inserir Fornecedor</h2>
</header>
<?php 

    $dados_enviados_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if (!empty($dados_enviados_array['btnAdicionarFornecedor'])) {

        foreach ($dados_enviados_array['razaoSocialFornecedor'] as $chave_cad_fornecedor => $valor_cad_fornecedor) {
            $razaoSocialFornecedor = $valor_cad_fornecedor;
            $logradouroFornecedor = $dados_enviados_array['logradouroFornecedor'][$chave_cad_fornecedor];
            $cnpjCpfFornecedor = $dados_enviados_array['cnpjCpfFornecedor'][$chave_cad_fornecedor];
            $emailFornecedor = $dados_enviados_array['emailFornecedor'][$chave_cad_fornecedor];
            $foneFacFornecedor = $dados_enviados_array['foneFacFornecedor'][$chave_cad_fornecedor];
            $observacaoFornecedor = $dados_enviados_array['observacaoFornecedor'][$chave_cad_fornecedor];

            echo '<br> Chave para o fornecedor: ' . $chave_cad_fornecedor;
            echo '<br> Razão Social: ' . $razaoSocialFornecedor;
            echo '<br> Logradouro: ' . $logradouroFornecedor;
            echo '<br> CNPJ ou CPF: ' . $cnpjCpfFornecedor;
            echo '<br> E-mail: ' . $emailFornecedor;
            echo '<br> Fone ou FAC: ' . $foneFacFornecedor;
            echo '<br> Observações: ' . $observacaoFornecedor;

            $sql = "INSERT INTO fornecedores (
                fornecedores_razao_social,
                fornecedores_cpf_cnpj,
                fornecedores_rg,
                fornecedores_end_logradouro,
                fornecedores_end_num,
                fornecedores_end_bairro,
                fornecedores_end_cep,
                fornecedores_end_email,
                fornecedores_end_telefone,
                fornecedores_end_obserevacao)
                VALUES(
                    '{$razaoSocialFornecedor}',
                    '{$cnpjCpfFornecedor}',
                    '',
                    '{$logradouroFornecedor}',
                    '',
                    '',
                    '',
                    '{$emailFornecedor}',
                    '{$foneFacFornecedor}',
                    '{$observacaoFornecedor}'
                )";

            if(mysqli_query($conexao, $sql)){
                echo "<script language='javascript'>window.alert('Fornecedor cadastrado com sucesso!'); </script>";
                echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=fornecedores';</script>";

            } else{
                die("//cadastro de fornecedores - Erro ao cadastrar fornecedor(es): " . mysqli_error($conexao));
            }

        }

    } else {
        echo '//Cad_fornecedor/ - nenhum formulário enviado';
    }

?>