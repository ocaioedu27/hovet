<header>
    <h2>Inserir Instituições</h2>
</header>
<?php 

    $dados_enviados_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if (!empty($dados_enviados_array['btnAdicionarInstituicoes'])) {

        foreach ($dados_enviados_array['razaoSocialInstituicoes'] as $chave_cad_Instituicoes => $valor_cad_Instituicoes) {
            $razaoSocialInstituicoes = $valor_cad_Instituicoes;
            $logradouroInstituicoes = $dados_enviados_array['logradouroInstituicoes'][$chave_cad_Instituicoes];
            $cnpjCpfInstituicoes = $dados_enviados_array['cnpjCpfInstituicoes'][$chave_cad_Instituicoes];
            $emailInstituicoes = $dados_enviados_array['emailInstituicoes'][$chave_cad_Instituicoes];
            $foneFacInstituicoes = $dados_enviados_array['foneFacInstituicoes'][$chave_cad_Instituicoes];
            $bairroInstituicoes = $dados_enviados_array['bairroInstituicoes'][$chave_cad_Instituicoes];
            $cepInstituicoes = $dados_enviados_array['cepInstituicoes'][$chave_cad_Instituicoes];
            $numEnderecoInstituicoes = $dados_enviados_array['numEnderecoInstituicoes'][$chave_cad_Instituicoes];
            $observacaoInstituicoes = $dados_enviados_array['observacaoInstituicoes'][$chave_cad_Instituicoes];

            $sql = "INSERT INTO instituicoes (
                instituicoes_razao_social,
                instituicoes_cpf_cnpj,
                instituicoes_end_logradouro,
                instituicoes_end_num,
                instituicoes_end_bairro,
                instituicoes_end_cep,
                instituicoes_end_email,
                instituicoes_end_telefone,
                instituicoes_observacao)
                VALUES(
                    '{$razaoSocialInstituicoes}',
                    '{$cnpjCpfInstituicoes}',
                    '{$logradouroInstituicoes}',
                    '{$numEnderecoInstituicoes}',
                    '{$bairroInstituicoes}',
                    '{$cepInstituicoes}',
                    '{$emailInstituicoes}',
                    '{$foneFacInstituicoes}',
                    '{$observacaoInstituicoes}'
                )";

            if(mysqli_query($conexao, $sql)){
                echo "<script language='javascript'>window.alert('Instituição " . $razaoSocialInstituicoes . " cadastrado(a) com sucesso!'); </script>";
                echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=instituicoes';</script>";

            } else{
                die("//cadastro de Instituicoeses - Erro ao cadastrar Instituicoes(es): " . mysqli_error($conexao));
            }

        }

    } else {
        echo '//Cad_Instituicoes/ - nenhum formulário enviado';
    }

?>