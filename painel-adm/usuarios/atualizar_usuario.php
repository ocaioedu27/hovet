<header>
    <h2>Atualizar Usuário</h2>
</header>
<?php 
    $idUsuario = mysqli_real_escape_string($conexao,$_POST["idUsuario"]);
    $nomeUsuario = mysqli_real_escape_string($conexao,$_POST["nomeUsuario"]);
    $mailUsuario = mysqli_real_escape_string($conexao,$_POST["mailUsuario"]);
    $tipoUsuario = mysqli_real_escape_string($conexao,$_POST["tipoUsuario"]);
    // $tipoUsuario = $tipoUsuario[0];
    $tipoUsuario = strtok($tipoUsuario, " ");
    $siapeUsuario = mysqli_real_escape_string($conexao,$_POST["siapeUsuario"]);
    $sql = "UPDATE usuarios SET 
        nome = '{$nomeUsuario}',
        mail = '{$mailUsuario}',
        tipo_usuario_ID = {$tipoUsuario},
        siap = '{$siapeUsuario}'
        WHERE id={$idUsuario}
        ";

        if(mysqli_query($conexao, $sql)){
    
            echo "<script language='javascript'>window.alert('Usuário atualizado com sucesso!'); </script>";
            echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=usuarios';</script>";
    
        } else{
            echo "<script language='javascript'>window.alert('Erro ao atualizar usuário!'); </script>";
            echo " <a href=\"/hovet/painel-adm/index.php?menuop=cadastro_usuario\">Voltar ao formulário de edição</a> <br/>";
    
            die("Erro: " . mysqli_error($conexao));
        }
?>