<?php

include("db/connect.php");

include("db/autentica.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <meta charset="utf-8">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">

    <!--REFERENCIA PARA O FAVICON -->
    <link rel="shortcut icon" href="./img/favicon/logo_hovet.ico" type="image/x-icon">

</head>

<body>
    
    <div class="logo_fundo">
        <main>
            <?php
                $menuop = (isset($_GET["menuop"]))?$_GET["menuop"]:"login";
                switch ($menuop) {
                    case 'login':
                        include_once("login.php");
                        break;

                    default:
                        include_once("login.php");
                        break;
                    }
            ?>
        </main>
    </div>
    <script src="js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>