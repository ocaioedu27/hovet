<div class="wrapper">
    <div class="form-box login">
        <div class="logo">
            <img src="img/logo.png" alt="HOVET">
        </div>
        <h2>Login</h2>
        <form action="autentica.php" method="post">

            <div class="input-box">
                <span class="icon">
                    <ion-icon name="mail"></ion-icon>
                </span>
                <input type="email" name="e-mail"required>
                <label>E-mail</label>
            </div>

            <div class="input-box">
                <span class="icon">
                    <ion-icon name="lock-closed"></ion-ion>
                </span>
                <input type="password" name="senha"required>
                <label>Senha</label>
            </div>
            
            <div class="remember-forgot">
                <label><input type="checkbox">Lembre de mim</label>
                <a href="#">Esqueceu a senha?</a>
            </div>
            <button class="btn" type="submit" name="btn-login">LOGIN</button>
        </form>
    </div>
</div>