<header>
    <h2>Atualizar Usuário</h2>
</header>
<?php 
    $idUsuario = mysqli_real_escape_string($conexao,$_POST["idUsuario"]);
    $nomeUsuario = mysqli_real_escape_string($conexao,$_POST["nomeUsuario"]);
    $mailUsuario = mysqli_real_escape_string($conexao,$_POST["mailUsuario"]);
    $tipoUsuario = mysqli_real_escape_string($conexao,$_POST["tipoUsuario"]);
    $cpfUsuario = mysqli_real_escape_string($conexao,$_POST["cpfUsuario"]);
    $sql = "UPDATE usuarios SET 
        nome = '{$nomeUsuario}',
        mail = '{$mailUsuario}',
        tipo_usuario = '{$tipoUsuario}',
        cpf = '{$cpfUsuario}'
        WHERE id={$idUsuario}
        ";
        mysqli_query($conexao, $sql) or die("Erro ao executar a inserção. " . mysqli_error($conexao));

        echo "O Usuário foi atualizado no sistema com sucesso!";
?>