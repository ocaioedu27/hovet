<header>
    <h2>Inserir contato</h2>
</header>
<?php 
    
    $nomeUsuario = mysqli_real_escape_string($conexao,$_POST["nomeUsuario"]);
    $mailUsuario = mysqli_real_escape_string($conexao,$_POST["mailUsuario"]);
    $tipoUsuario = mysqli_real_escape_string($conexao,$_POST["tipoUsuario"]);
    // $tipoUsuario = $tipoUsuario[0];
    $tipoUsuario = strtok($tipoUsuario, " ");
    $siapeUsuario = mysqli_real_escape_string($conexao,$_POST["siapeUsuario"]);
    $senhaUsuario = mysqli_real_escape_string($conexao,$_POST["senhaUsuario"]);
    $senhaUsuario = password_hash($senhaUsuario, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (
        nome,
        mail,
        tipo_usuario_ID,
        siape,
        senha)
        VALUES(
            '{$nomeUsuario}',
            '{$mailUsuario}',
            {$tipoUsuario},
            '{$siapeUsuario}',
            '{$senhaUsuario}'
        )";

    $eh_login_cadastro = $_POST["login_cadastro"];

    if(mysqli_query($conexao, $sql)){

        echo "<script language='javascript'>window.alert('Usuário inserido com sucesso!'); </script>";

        if ($eh_login_cadastro != null) {    
            echo "<script language='javascript'>window.location='/hovet/index.php?menuop=login';</script>";
        } else {
            echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=usuarios';</script>";
        }

    } else{
        echo "<script language='javascript'>window.alert('Erro ao cadastrar usuário'); </script>";

        if ($eh_login_cadastro != null) {    
            echo " <a href=\"/hovet/index.php?menuop=novo_cadastro_login\">Voltar ao formulário de cadastro</a> <br/>";
        } else {
            echo " <a href=\"/hovet/painel-adm/index.php?menuop=cadastro_usuario\">Voltar ao formulário de cadastro</a> <br/>";
        }

        die("Erro: " . mysqli_error($conexao));
    }
?>