<header>
    <h2>Atualizar Usuário</h2>
</header>
<?php 
    $idFornecedor = mysqli_real_escape_string($conexao,$_POST["idFornecedor"]);

    $razaoSocialFornecedor = mysqli_real_escape_string($conexao,$_POST["razaoSocialFornecedor"]);

    if ($razaoSocialFornecedor == "") {
        $razaoSocialFornecedor = "---";
    }

    $categoriaFornecedor = mysqli_real_escape_string($conexao,$_POST["categoriaFornecedor"]);

    if ($categoriaFornecedor == "") {
        $categoriaFornecedor = "---";
    }

    $logradouroFornecedor = mysqli_real_escape_string($conexao,$_POST["logradouroFornecedor"]);

    if ($logradouroFornecedor == "") {
        $logradouroFornecedor = "---";
    }

    $cepFornecedor = mysqli_real_escape_string($conexao,$_POST["cepFornecedor"]);

    if ($cepFornecedor == "") {
        $cepFornecedor = "---";
    }

    $bairroFornecedor = mysqli_real_escape_string($conexao,$_POST["bairroFornecedor"]);

    if ($bairroFornecedor == "") {
        $bairroFornecedor = "---";
    }

    $numEnderecoFornecedor = mysqli_real_escape_string($conexao,$_POST["numEnderecoFornecedor"]);

    if ($numEnderecoFornecedor == "") {
        $numEnderecoFornecedor = "---";
    }

    $cnpjCpfFornecedor = mysqli_real_escape_string($conexao,$_POST["cnpjCpfFornecedor"]);

    if ($cnpjCpfFornecedor == "") {
        $cnpjCpfFornecedor = "---";
    }

    $emailFornecedor = mysqli_real_escape_string($conexao,$_POST["emailFornecedor"]);

    if ($emailFornecedor == "") {
        $emailFornecedor = "---";
    }

    $foneFacFornecedor = mysqli_real_escape_string($conexao,$_POST["foneFacFornecedor"]);

    if ($foneFacFornecedor == "") {
        $foneFacFornecedor = "---";
    }

    $observacaoFornecedor = mysqli_real_escape_string($conexao,$_POST["observacaoFornecedor"]);

    if ($observacaoFornecedor == "") {
        $observacaoFornecedor = "---";
    }

    $sql = "UPDATE 
                fornecedores 
            SET 
                razao_social = '{$razaoSocialFornecedor}',
                end_logradouro = '{$logradouroFornecedor}',
                end_num = '{$numEnderecoFornecedor}',
                end_bairro = '{$bairroFornecedor}',
                end_cep = '{$cepFornecedor}',
                cpf_cnpj = '{$cnpjCpfFornecedor}',
                end_email = '{$emailFornecedor}',
                end_telefone = '{$foneFacFornecedor}',
                observacao = '{$observacaoFornecedor}'
            WHERE 
                id={$idFornecedor}";

        if(mysqli_query($conexao, $sql)){
    
            echo "<script language='javascript'>window.alert('Dados do fornecedor atualizado com sucesso!'); </script>";
            echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=fornecedores';</script>";
    
        } else{
            echo "<script language='javascript'>window.alert('Erro ao atualizar dados do fornecedor!'); </script>";
            echo " <a href=\"/hovet/sistema/index.php?menuop=editar_fornecedores&idFornecedor=$idFornecedor\">Voltar ao formulário de edição</a> <br/>";
    
            die("Erro: " . mysqli_error($conexao));
        }
?>