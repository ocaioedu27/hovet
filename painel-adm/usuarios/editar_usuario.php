<?php
$idUsuario = $_GET["idUsuario"];

$sql = "SELECT * FROM usuarios WHERE id={$idUsuario}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($result);
?>

<div class="container">
    <div class="cadastro_body">
        <form class="form_cad astro" action="index.php?menuop=atualizar_usuario" method="post">
            <div class="form-group">
                <h3>Edição de Usuário</h3>
            </div>
            <div class="form-group">
                <label for="idUsuario">ID</label>
                <input type="text" class="form-control" name="idUsuario" value="<?=$dados["id"]?>" readonly>
            </div>
            <div class="form-group">
                <label for="nomeUsuario">Nome</label>
                <input type="text" class="form-control" name="nomeUsuario" value="<?=$dados["nome"]?>" required>
            </div>
            <div class="form-group">
                <label for="mailUsuario">E-mail</label>
                <input type="email" class="form-control" name="mailUsuario" value="<?=$dados["mail"]?>" required>
            </div>
            <div class="form-group">
                <label for="tipoUsuario">Tipo de usuário</label>
                <input type="text" class="form-control" name="tipoUsuario" value="<?=$dados["tipo_usuario"]?>" required>
            </div>
            <div class="form-group">
                <label for="cpfUsuario">CPF</label>
                <input type="text" class="form-control" name="cpfUsuario" value="<?=$dados["cpf"]?>" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Atualizar" name="btnAtualizarUsuario">
            </div>
        </form>
    </div>
</div>