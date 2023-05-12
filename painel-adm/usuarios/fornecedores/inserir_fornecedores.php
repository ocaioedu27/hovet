<header>
    <h2>Inserir contato</h2>
</header>
<?php 
    
    $nomeCompletoUsuario = mysqli_real_escape_string($conexao,$_POST["nomeCompletoUsuario"]);
    $primeiroNomeUsuario = mysqli_real_escape_string($conexao,$_POST["primeiroNomeUsuario"]);
    $sobrenomeUsuario = mysqli_real_escape_string($conexao,$_POST["sobrenomeUsuario"]);
    $mailUsuario = mysqli_real_escape_string($conexao,$_POST["mailUsuario"]);
    $tipoUsuario = mysqli_real_escape_string($conexao,$_POST["tipoUsuario"]);
    $tipoUsuario = strtok($tipoUsuario, " ");
    $siapeUsuario = mysqli_real_escape_string($conexao,$_POST["siapeUsuario"]);
    $senhaUsuario = mysqli_real_escape_string($conexao,$_POST["senhaUsuario"]);
    $senhaUsuario = password_hash($senhaUsuario, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (
        usuario_nome_completo,
        usuario_primeiro_nome,
        usuario_sobrenome,
        usuario_mail,
        usuario_tipo_usuario_id,
        usuario_siape,
        usuario_senha)
        VALUES(
            '{$nomeCompletoUsuario}',
            '{$primeiroNomeUsuario}',
            '{$sobrenomeUsuario}',
            '{$mailUsuario}',
            {$tipoUsuario},
            '{$siapeUsuario}',
            '{$senhaUsuario}'
        )";

    if(mysqli_query($conexao, $sql)){

        echo "<script language='javascript'>window.alert('Usuário inserido com sucesso!'); </script>";
        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=usuarios';</script>";

    } else{
            die("//usuarios/Cadastro de novo usuário - Erro ao cadastrar novo usuário: " . mysqli_error($conexao));
            echo " <br/><br/><a href=\"/hovet/painel-adm/index.php?menuop=cadastro_usuario\">Voltar ao formulário de cadastro</a> <br/>";

    }
?>