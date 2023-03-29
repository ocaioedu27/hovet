<div class="wrapper active">
    <div class="form-box register">
        <div class="logo">
            <img src="img/logo.png" alt="HOVET">
        </div>
        <h2>Realizando Cadastro</h2>
        <form action="index.php?menuop=inserir_usuario" method="post">

            <!--<div class="input-box">
                <span class="icon">
                    <ion-icon name="person-circle-outline"></ion-icon>
                </span>
                <input type="text" name="primeiro_nome_usuario" required>
                <label for="primeiro_nome">Primeiro nome</label>
            </div>

            <div class="input-box">
                <span class="icon">
                    <ion-icon name="person-circle-outline"></ion-icon>
                </span>
                <input type="text" name="sobrenome" required>
                <label for="sobrenome">Sobrenome</label>
            </div>

            <div class="input-box">
                <span class="icon">
                    <ion-icon name="person-circle-outline"></ion-icon>
                </span>
                <input type="text" name="nome_completo" required>
                <label for="nome_completo">Nome Completo</label>
            </div>-->

            <div class="input-box">
                <span class="icon">
                    <ion-icon name="person-circle-outline"></ion-icon>
                </span>
                <input type="text" name="nomeUsuario" required>
                <label for="nomeUsuario">Nome completo</label>
            </div>

            <div class="input-box">
                <span class="icon">
                    <ion-icon name="mail"></ion-icon>
                </span>
                <input type="email" name="mailUsuario" required>
                <label for="mailUsuario">E-mail</label>
            </div>

            <div class="input-box">
                <label for="tipoUsuario">Tipo de usuário</label>
                <select class="select_cadastro_novo" name="tipoUsuario" required>
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

            <div class="input-box">
                <span class="icon">
                    <ion-icon name=""></ion-icon>
                </span>
                <input type="text" name="cpfUsuario" required>
                <label for="cpfUsuario">CPF</label>
            </div>

            <div class="input-box">
                <span class="icon">
                    <ion-icon name="lock-closed">
                        </ion-ion>
                </span>
                <input type="password" name="senhaUsuario" required>
                <label for="senhaUsuario">Senha</label>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox" required>Estou de acordo com os termos e condições</label>
            </div>
            <button class="btn" type="submit" name="btn-cadastrar">Cadastrar</button>
            <div class="login-register">
                <p>Já possui cadastro?
                    <a href="index.php" class="login-link">Logar</a>
                </p>
            </div>
        </form>
    </div>
</div>