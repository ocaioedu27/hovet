<header>
    <h2>Inserir contato</h2>
</header>
<?php 
    
    $nomeUsuario = mysqli_real_escape_string($conexao,$_POST["nomeUsuario"]);
    $mailUsuario = mysqli_real_escape_string($conexao,$_POST["mailUsuario"]);
    $tipoUsuario = mysqli_real_escape_string($conexao,$_POST["tipoUsuario"]);
    $tipoUsuario = $tipoUsuario[0];
    $cpfUsuario = mysqli_real_escape_string($conexao,$_POST["cpfUsuario"]);
    $senhaUsuario = mysqli_real_escape_string($conexao,$_POST["senhaUsuario"]);
    $senhaUsuario = password_hash($senhaUsuario, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (
        nome,
        mail,
        tipo_usuario_ID,
        cpf,
        senha)
        VALUES(
            '{$nomeUsuario}',
            '{$mailUsuario}',
            {$tipoUsuario},
            '{$cpfUsuario}',
            '{$senhaUsuario}'
        )";
    mysqli_query($conexao, $sql) or die("Erro ao executar a inserção. " . mysqli_error($conexao));

    echo "O usuário foi cadastrado no sistema com sucesso!";
?>