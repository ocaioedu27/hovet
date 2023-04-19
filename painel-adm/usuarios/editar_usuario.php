<?php
$idUsuario = $_GET["idUsuario"];

$sql = "SELECT u.usuario_id, u.usuario_nome, u.usuario_mail, t.tipo_usuario_tipo, u.usuario_siape FROM usuarios as u INNER JOIN tipo_usuario as t on u.usuario_tipo_usuario_id = t.tipo_usuario_id WHERE u.usuario_id={$idUsuario}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($result);
?>

<div class="container cadastro_all">
    <div class="cards edita_usuarios">
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
        <form class="form_cadastro" action="index.php?menuop=atualizar_usuario" method="post">
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
                <label for="siapeUsuario">SIAPE</label>
                <input type="text" class="form-control" name="siapeUsuario" value="<?=$dados["siape"]?>" readonly>
            </div>
            <div class="form-group">
                <input type="submit" value="Atualizar" name="btnAtualizarUsuario" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>