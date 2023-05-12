<header>
    <h2>Atualizar Usuário</h2>
</header>
<?php 
    $idUsuario = mysqli_real_escape_string($conexao,$_POST["idUsuario"]);
    $nomeCompletoUsuario = mysqli_real_escape_string($conexao,$_POST["nomeCompletoUsuario"]);
    $primeiroNomeUsuario = mysqli_real_escape_string($conexao,$_POST["primeiroNomeUsuario"]);
    $sobrenomeUsuario = mysqli_real_escape_string($conexao,$_POST["sobrenomeUsuario"]);
    $mailUsuario = mysqli_real_escape_string($conexao,$_POST["mailUsuario"]);
    $tipoUsuario = mysqli_real_escape_string($conexao,$_POST["tipoUsuario"]);
    // $tipoUsuario = $tipoUsuario[0];
    $tipoUsuario = strtok($tipoUsuario, " ");
    $siapeUsuario = mysqli_real_escape_string($conexao,$_POST["siapeUsuario"]);
    $sql = "UPDATE usuarios SET 
        usuario_nome_completo = '{$nomeCompletoUsuario}',
        usuario_primeiro_nome = '{$primeiroNomeUsuario}',
        usuario_sobrenome = '{$sobrenomeUsuario}',
        usuario_mail = '{$mailUsuario}',
        usuario_tipo_usuario_id = {$tipoUsuario},
        usuario_siape = '{$siapeUsuario}'
        WHERE usuario_id={$idUsuario}
        ";

        if(mysqli_query($conexao, $sql)){
    
            echo "<script language='javascript'>window.alert('Usuário atualizado com sucesso!'); </script>";
            echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=usuarios';</script>";
    
        } else{
            echo "<script language='javascript'>window.alert('Erro ao atualizar usuário!'); </script>";
            echo " <a href=\"/hovet/painel-adm/index.php?menuop=editar_usuario&idUsuario=$idUsuario\">Voltar ao formulário de edição</a> <br/>";
    
            die("Erro: " . mysqli_error($conexao));
        }
?>