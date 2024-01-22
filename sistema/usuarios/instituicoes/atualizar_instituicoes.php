<header>
    <h2>Atualizar Usuário</h2>
</header>
<?php 
    $idInstituicao = mysqli_real_escape_string($conexao,$_POST["idInstituicao"]);

    $razaoSocialInstituicao = mysqli_real_escape_string($conexao,$_POST["razaoSocialInstituicao"]);

    if ($razaoSocialInstituicao == "") {
        $razaoSocialInstituicao = "---";
    }

    $logradouroInstituicao = mysqli_real_escape_string($conexao,$_POST["logradouroInstituicao"]);

    if ($logradouroInstituicao == "") {
        $logradouroInstituicao = "---";
    }

    $cepInstituicao = mysqli_real_escape_string($conexao,$_POST["cepInstituicao"]);

    if ($cepInstituicao == "") {
        $cepInstituicao = "---";
    }

    $numEnderecoInstituicao = mysqli_real_escape_string($conexao,$_POST["numEnderecoInstituicao"]);

    if ($numEnderecoInstituicao == "") {
        $numEnderecoInstituicao = "---";
    }

    $bairroInstituicao = mysqli_real_escape_string($conexao,$_POST["bairroInstituicao"]);

    if ($bairroInstituicao == "") {
        $bairroInstituicao = "---";
    }

    $cnpjCpfInstituicao = mysqli_real_escape_string($conexao,$_POST["cnpjCpfInstituicao"]);

    if ($cnpjCpfInstituicao == "") {
        $cnpjCpfInstituicao = "---";
    }

    $emailInstituicao = mysqli_real_escape_string($conexao,$_POST["emailInstituicao"]);

    if ($emailInstituicao == "") {
        $emailInstituicao = "---";
    }

    $foneFacInstituicao = mysqli_real_escape_string($conexao,$_POST["foneFacInstituicao"]);

    if ($foneFacInstituicao == "") {
        $foneFacInstituicao = "---";
    }

    $observacaoInstituicao = mysqli_real_escape_string($conexao,$_POST["observacaoInstituicao"]);

    if ($observacaoInstituicao == "") {
        $observacaoInstituicao = "---";
    }

    $sql = "UPDATE instituicoes SET 
        instituicoes_razao_social = '{$razaoSocialInstituicao}',
        instituicoes_end_logradouro = '{$logradouroInstituicao}',
        instituicoes_end_num = '{$numEnderecoInstituicao}',
        instituicoes_end_bairro = '{$bairroInstituicao}',
        instituicoes_end_cep = '{$cepInstituicao}',
        instituicoes_cpf_cnpj = '{$cnpjCpfInstituicao}',
        instituicoes_end_email = '{$emailInstituicao}',
        instituicoes_end_telefone = '{$foneFacInstituicao}',
        instituicoes_observacao = '{$observacaoInstituicao}'
        WHERE instituicoes_id={$idInstituicao}";

    if(mysqli_query($conexao, $sql)){

        echo "<script language='javascript'>window.alert('Dados de " . $razaoSocialInstituicao . " atualizados com sucesso!'); </script>";
        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=instituicoes';</script>";

    } else{
        echo "<script language='javascript'>window.alert('Erro ao atualizar dados de " . $razaoSocialInstituicao . "!'); </script>";
        echo " <a href=\"/hovet/sistema/index.php?menuop=editar_instituicoes&idInstituicao=$idInstituicao\">Voltar ao formulário de edição</a> <br/>";

        die("Erro: " . mysqli_error($conexao));
    }
?>