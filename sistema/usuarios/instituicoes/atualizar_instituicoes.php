<header>
    <h2>Atualizar Usuário</h2>
</header>
<?php 
    $idInsituicao = mysqli_real_escape_string($conexao,$_POST["idInsituicao"]);

    $razaoSocialInsituicao = mysqli_real_escape_string($conexao,$_POST["razaoSocialInsituicao"]);

    if ($razaoSocialInsituicao == "") {
        $razaoSocialInsituicao = "---";
    }

    $logradouroInsituicao = mysqli_real_escape_string($conexao,$_POST["logradouroInsituicao"]);

    if ($logradouroInsituicao == "") {
        $logradouroInsituicao = "---";
    }

    $cnpjCpfInsituicao = mysqli_real_escape_string($conexao,$_POST["cnpjCpfInsituicao"]);

    if ($cnpjCpfInsituicao == "") {
        $cnpjCpfInsituicao = "---";
    }

    $emailInsituicao = mysqli_real_escape_string($conexao,$_POST["emailInsituicao"]);

    if ($emailInsituicao == "") {
        $emailInsituicao = "---";
    }

    $foneFacInsituicao = mysqli_real_escape_string($conexao,$_POST["foneFacInsituicao"]);

    if ($foneFacInsituicao == "") {
        $foneFacInsituicao = "---";
    }

    $observacaoInsituicao = mysqli_real_escape_string($conexao,$_POST["observacaoInsituicao"]);

    if ($observacaoInsituicao == "") {
        $observacaoInsituicao = "---";
    }

    $sql = "UPDATE insituicaoes SET 
        insituicaoes_razao_social = '{$razaoSocialInsituicao}',
        insituicaoes_end_logradouro = '{$logradouroInsituicao}',
        insituicaoes_cpf_cnpj = '{$cnpjCpfInsituicao}',
        insituicaoes_end_email = '{$emailInsituicao}',
        insituicaoes_end_telefone = '{$foneFacInsituicao}',
        insituicaoes_observacao = '{$observacaoInsituicao}'
        WHERE insituicaoes_id={$idInsituicao}";

        if(mysqli_query($conexao, $sql)){
    
            echo "<script language='javascript'>window.alert('Dados do Insituicao atualizado com sucesso!'); </script>";
            echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=Insituicaoes';</script>";
    
        } else{
            echo "<script language='javascript'>window.alert('Erro ao atualizar dados do Insituicao!'); </script>";
            echo " <a href=\"/hovet/sistema/index.php?menuop=editar_insituicaoes&idInsituicao=$idInsituicao\">Voltar ao formulário de edição</a> <br/>";
    
            die("Erro: " . mysqli_error($conexao));
        }
?>