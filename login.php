<div class="wrapper">
    <div class="form-box login">
        <div class="logo">
            <img src="img/logo_hovet.jpg" alt="HOVET">
        </div>
        <h2>Login</h2>
        <form action="" method="POST">

            <div class="input-box">
                <span class="icon">
                    <ion-icon name="mail"></ion-icon>
                </span>
                <input type="email" name="mail" required>
                <label>E-mail</label>
            </div>

            <div class="input-box">
                <span class="icon">
                    <ion-icon name="lock-closed">
                        </ion-ion>
                </span>
                <input type="password" name="senha" required>
                <label>Senha</label>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox">Lembre de mim</label>
                <a href="#">Esqueceu a senha?</a>
            </div>
            <button class="btn" type="submit" name="btn-login">LOGIN</button>
            <div class="login-register">
                <p>Não tem acesso?
                    <a href="index.php?menuop=novo_cadastro_login" class="register-link">Realizar Cadastro</a>
                </p>
            </div>
        </form>
    </div>
</div>