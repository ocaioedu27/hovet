<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HOVET</title>

    <meta charset="utf-8">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">

    <!--REFERENCIA PARA O FAVICON -->

    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">

</head>

<body>
    <div class="wrapper">
        <div class="login-form">
            <div class="logo">
                <img src="img/logo.png" alt="HOVET">
            </div>
            <form action="" method="post">
                <h2 class="text-center">ENTRE NO SISTEMA
                </h2>

                <div class="form-group">
                    <input class="form-control" type="email" name="usuario" placeholder="Insira seu e-mail..." required>
                </div>

                <div class="form-group">
                    <input class="form-control" type="password" name="senha" placeholder="Insira seu senha..." required>
                    <div class="recuperar_senha">
                        <a href="#" class="float-right">Recuperar Senha</a>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn=primary btn-lg btn-block" type="submit" name="btn-login"> LOGIN</button>
                </div>

                <div class="clearfix">
                    <label class="float-left checkbox-inline" style="display: flex; align-items: center">
                        <input type="checkbox">Lembrar-me</label>
                </div>

            </form>
        </div>
    </div>
</body>

</html>