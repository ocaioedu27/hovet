<!-- Variavél de notoficações, só mostra notificações se existir valores -->
<?php

$notificacoes = 4;

include("../db/connect.php");

include("../db/protect.php");


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
            <div class="logo">
                <a href="index.php?menuop=pagina_principal">
                    <img class="float-left" src="../img/logo_hovet.jpg">
                </a>
            </div>
            <div class="menu_op_adm">
                <a href="index.php?menuop=pagina_principal">Página Principal</a>
                <a href="index.php?menuop=deposito">Deposito</a>
                <div class="dropdown">
                    <a href="index.php?menuop=insumos">Insumos</a>
                    <div class="dropdown-content">
                        <ul>
                            <li>
                                <a href="#">Todos os insumos</a>
                            </li>
                            <li>
                                <a href="#">Material de procedimento</a>
                            </li>
                            <li>
                                <a href="#">Medicamentos</a>
                            </li>
                            <li>
                                <a href="#">Medicamentos controlados</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="index.php?menuop=usuarios">Usuários</a>
                <div class="login_user">
                    <div class="dropdown">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                            <?php echo $_SESSION['nome'];?>
                        </span>
                        <div class="dropdown-content">
                            <a href="../db/logout.php">Sair</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <?php
            $menuop = (isset($_GET["menuop"]))?$_GET["menuop"]:"pagina_principal";
            switch ($menuop) {
                case 'pagina_principal':
                    include_once("home.php");
                    break;

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

                case 'excluir_deposito':
                    include_once("deposito/excluir_deposito.php");
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

                case 'excluir_usuario':
                    include_once("usuarios/excluir_usuario.php");
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

                case 'excluir_insumo':
                    include_once("insumos/excluir_insumo.php");
                    break;

                case 'painel_teste':
                    include_once("../pgs_modelo/painel_teste.php");
                    break;

                default:
                include_once("home.php");
                    break;
            }
        ?>
    </main>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    <script type="text/javascript">
        $('.confirmaEdit').on('click', function(){
            return confirm('O item será editado, deseja editar?');
        });

        $('.confirmaDelete').on('click', function(){
            return confirm('O item será excluído, deseja confirmar?');
        });

        $('.confirmaVolta').on('click', function(){
            return confirm('O formulário será perdido, deseja voltar?');
        });

    </script>

</body>

</html>