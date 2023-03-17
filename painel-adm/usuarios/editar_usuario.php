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
                <select class="form-control-sm" name="tipoUsuario">
                    <?php
                    
                    $sql_allTipos = "SELECT * FROM tipo_usuario WHERE id!=5";
                    $result_allTipos = mysqli_query($conexao,$sql_allTipos) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                    
                    while($tipoUsu = mysqli_fetch_assoc($result_allTipos)){
                    ?>
					    <option>
                            <?=$tipos_usuarios = $tipoUsu["tipo"];?>
                        </option>
                    <?php
                        }
                    ?>
				</select>
                <p>Atualmente: <?=$dados["tipo_usuario_Tipo"]?></p>
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