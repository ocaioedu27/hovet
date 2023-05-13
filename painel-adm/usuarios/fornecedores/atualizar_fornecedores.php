<header>
    <h2>Atualizar Usuário</h2>
</header>
<?php 
    $idFornecedor = mysqli_real_escape_string($conexao,$_POST["idFornecedor"]);

    $razaoSocialFornecedor = mysqli_real_escape_string($conexao,$_POST["razaoSocialFornecedor"]);

    if ($razaoSocialFornecedor == "") {
        $razaoSocialFornecedor = "---";
    }

    $logradouroFornecedor = mysqli_real_escape_string($conexao,$_POST["logradouroFornecedor"]);

    if ($logradouroFornecedor == "") {
        $logradouroFornecedor = "---";
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

    $sql = "UPDATE fornecedores SET 
        fornecedores_razao_social = '{$razaoSocialFornecedor}',
        fornecedores_end_logradouro = '{$logradouroFornecedor}',
        fornecedores_cpf_cnpj = '{$cnpjCpfFornecedor}',
        fornecedores_end_email = '{$emailFornecedor}',
        fornecedores_end_telefone = '{$foneFacFornecedor}',
        fornecedores_observacao = '{$observacaoFornecedor}'
        WHERE fornecedores_id={$idFornecedor}";

        if(mysqli_query($conexao, $sql)){
    
            echo "<script language='javascript'>window.alert('Dados do fornecedor atualizado com sucesso!'); </script>";
            echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=fornecedores';</script>";
    
        } else{
            echo "<script language='javascript'>window.alert('Erro ao atualizar dados do fornecedor!'); </script>";
            echo " <a href=\"/hovet/painel-adm/index.php?menuop=editar_fornecedores&idFornecedor=$idFornecedor\">Voltar ao formulário de edição</a> <br/>";
    
            die("Erro: " . mysqli_error($conexao));
        }
?>