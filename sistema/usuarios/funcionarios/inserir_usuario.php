<?php 
    
    $nomeCompletoUsuario = mysqli_real_escape_string($conexao,$_POST["nomeCompletoUsuario"]);
    $primeiroNomeUsuario = mysqli_real_escape_string($conexao,$_POST["primeiroNomeUsuario"]);
    $sobrenomeUsuario = mysqli_real_escape_string($conexao,$_POST["sobrenomeUsuario"]);
    $mailUsuario = mysqli_real_escape_string($conexao,$_POST["mailUsuario"]);
    $tipoUsuario = mysqli_real_escape_string($conexao,$_POST["tipoUsuario"]);
    $tipoUsuario = strtok($tipoUsuario, " ");
    $siapeUsuario = mysqli_real_escape_string($conexao,$_POST["siapeUsuario"]);
    $statusUsu = mysqli_real_escape_string($conexao,$_POST["statusUsu"]);
    $senhaUsuario = mysqli_real_escape_string($conexao,$_POST["senhaUsuario"]);
    $senhaUsuario = password_hash($senhaUsuario, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (
        nome_completo,
        primeiro_nome,
        sobrenome,
        mail,
        tipo_usuario_id,
        siape,
        senha,
        status)
        VALUES(
            '{$nomeCompletoUsuario}',
            '{$primeiroNomeUsuario}',
            '{$sobrenomeUsuario}',
            '{$mailUsuario}',
            {$tipoUsuario},
            {$siapeUsuario},
            '{$senhaUsuario}',
            {$statusUsu}
        )";

    // echo $sql;

    try {
            
        if(mysqli_query($conexao, $sql)){

            echo "<script language='javascript'>window.alert('Usuário inserido com sucesso!'); </script>";
            echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=usuarios';</script>";

        } else{
                die("//usuarios/Cadastro de novo usuário - Erro ao cadastrar novo usuário: " . mysqli_error($conexao));
                echo " <br/><br/><a href=\"/hovet/sistema/index.php?menuop=cadastro_usuario\">Voltar ao formulário de cadastro</a> <br/>";

        }

    } catch (\Throwable $th) {
        echo $th;
    }
?>