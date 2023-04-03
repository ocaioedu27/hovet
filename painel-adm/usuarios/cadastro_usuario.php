<div class="container cadastro_all">
    <div class="cards cadastro_usuarios">
        <div class="voltar">
            <h4>Cadastro de Usuário</h4>
            <a href="index.php?menuop=usuarios" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" action="index.php?menuop=inserir_usuario" method="post">
            <div class="form-group">
                <label for="nomeUsuario">Nome Completo</label>
                <input type="text" class="form-control" name="nomeUsuario" required>
            </div>
            <div class="form-group">
                <label for="mailUsuario">E-mail</label>
                <input type="email" class="form-control" name="mailUsuario" required>
            </div>
            <div class="form-group">
                <label for="tipoUsuario">Tipo de usuário</label>
                <select class="form-control-sm" name="tipoUsuario" required>
                    <?php
                    
                    $sql_allTipos = "SELECT * FROM tipo_usuario";
                    $result_allTipos = mysqli_query($conexao,$sql_allTipos) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                    
                    while($tipoUsu = mysqli_fetch_assoc($result_allTipos)){
                    ?>
					<option><?=$tipoUsu["id"]?> - <?=$tipoUsu["tipo"]?></option>

                    <?php
                        }
                    ?>
				</select>
            </div>
            <div class="form-group">
                <label for="siapeUsuario">SIAPE</label>
                <input type="text" class="form-control" name="siapeUsuario" required>
            </div>
            <div class="form-group">
                    <label for="senhaUsuario">Senha</label>
                    <input type="password" class="form-control" name="senhaUsuario" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarUsuario" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>