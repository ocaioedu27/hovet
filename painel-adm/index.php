<!-- Variavél de notoficações, só mostra notificações se existir valores -->
<?php

$notificacoes = 4;

include("../db/connect.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title>Painel Administrativo</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


    <link rel="stylesheet" href="../css/painel.css">
    <link rel="stylesheet" href="../css/style_personalizado.css">

    <!--REFERENCIA PARA O FAVICON -->

    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../img/favicon/favicon.ico" type="image/x-icon">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>


</head>

<body>

    <?php
        //include_once "../include/header.php";
    ?>
    <nav class="navbar">
        <div class="container navbar-header">
            <a href="index.php?menuop=deposito" class="">
                <img class="float-left" src="../img/logo.png">
            </a>
            <div class="col"></div>
            <div class="menu_op_adm">
                <a href="index.php?menuop=deposito">Deposito</a>
                <a href="index.php?menuop=usuarios">Usuarios</a>
                <a href="index.php?menuop=insumos">Insumos</a>
            </div>
            <div>
                <li class="float-right nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        Administrador - id_usuário
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../index.php">Sair</a>
                    </div>
                </li>
            </div>
        </div>
    </nav>
    <main>
        <?php
            $menuop = (isset($_GET["menuop"]))?$_GET["menuop"]:"deposito";
            switch ($menuop) {
                case 'deposito':
                    include_once("deposito/deposito.php");
                    break;

                case 'cadastro_deposito':
                    include_once("deposito/cadastro_deposito.php");
                    break;

                case 'inserir_deposito':
                    include_once("deposito/inserir_deposito.php");
                    break;

                case 'editar_deposito':
                    include_once("deposito/editar_deposito.php");
                    break;
    
                case 'atualizar_deposito':
                    include_once("deposito/atualizar_deposito.php");
                    break;
                
                case 'usuarios':
                    include_once("usuarios/painel_users.php");
                    break;
                
                case 'cadastro_usuario':
                    include_once("usuarios/cadastro_usuario.php");
                    break;

                case 'inserir_usuario':
                    include_once("usuarios/inserir_usuario.php");
                    break;

                case 'editar_usuario':
                    include_once("usuarios/editar_usuario.php");
                    break;
    
                case 'atualizar_usuario':
                    include_once("usuarios/atualizar_usuario.php");
                    break;
    
                case 'insumos':
                    include_once("insumos/painel_insumos.php");
                    break;
                
                case 'cadastro_insumo':
                    include_once("insumos/cadastro_insumo.php");
                    break;
                
                case 'inserir_insumo':
                    include_once("insumos/inserir_insumo.php");
                    break;
                    
                case 'editar_insumo':
                    include_once("insumos/editar_insumo.php");
                    break;
    
                case 'atualizar_insumo':
                    include_once("insumos/atualizar_insumo.php");
                    break;

                default:
                include_once("../deposito/deposito.php");
                    break;
            }
        ?>
    </main>
</body>

</html>

<!-- 1ª verificação, se existir algo vindo do botão ($_GET(btnbuscarVeterinario), faz uma chamada via script do objeto -->


<?php 
if(isset($_GET['btnbuscarVeterinario'])){?>
<script type="text/javascript">
$('#link-veterinario');
click();
</script>

<?php } ?>