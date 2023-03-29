<?php
$idUsuario = $_GET["idUsuario"];

$sql = "SELECT u.id, u.nome, u.mail, t.tipo, u.cpf FROM usuarios as u INNER JOIN tipo_usuario as t on u.tipo_usuario_ID = t.id WHERE u.id={$idUsuario}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($result);
?>

<div class="container">
    <div class="cadastro_body">
        <div class="voltar">
            <h4>Edição de Usuário</h4>
            <a href="index.php?menuop=usuarios" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cad astro" action="index.php?menuop=atualizar_usuario" method="post">
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
                <select class="form-control-sm" name="tipoUsuario">
                    <?php
                    
                    $sql_allTipos = "SELECT * FROM tipo_usuario WHERE id!=5";
                    $result_allTipos = mysqli_query($conexao,$sql_allTipos) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                    
                    while($tipoUsu = mysqli_fetch_assoc($result_allTipos)){
                    ?>
					    <option><?=$tipoUsu["id"]?> - <?=$tipoUsu["tipo"]?></option>
                    <?php
                        }
                    ?>
				</select>
                <p>
                    <code>Atualmente: <?=$dados["tipo"]?></code>
                </p>
            </div>
            <div class="form-group">
                <label for="cpfUsuario">CPF</label>
                <input type="text" class="form-control" name="cpfUsuario" value="<?=$dados["cpf"]?>" readonly>
            </div>
            <div class="form-group">
                <input type="submit" value="Atualizar" name="btnAtualizarUsuario">
            </div>
        </form>
    </div>
</div>