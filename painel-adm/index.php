<?php

include("../db/connect.php");

include("../db/protect.php");


function atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id, $insumo_id){

    $sql_identifica_movimentacao = "INSERT 
                                        INTO movimentacoes 
                                        (movimentacoes_origem,
                                        movimentacoes_destino,
                                        movimentacoes_tipos_movimentacoes_id,
                                        movimentacoes_usuario_id,
                                        movimentacoes_insumos_id) 
                                        VALUE ('{$local_origem}','{$local_destino}',{$tipo_movimentacao},{$usuario_id},{$insumo_id})";

    if (mysqli_query($conexao, $sql_identifica_movimentacao)) { 
        echo "<script language='javascript'>window.alert('Movimentação registrada com sucesso!!'); </script>";
        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=deposito';</script>";   
    } else {
        die("Erro ao executar a atualização da movimentação. " . mysqli_error($conexao));   
    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title>HOVET</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


    <!-- <link rel="stylesheet" href="../css/painel.css"> -->
    <link rel="stylesheet" href="../css/style_personalizado.css">

    <!--REFERENCIA PARA O FAVICON -->

    <link rel="shortcut icon" href="../img/favicon.jpg" type="image/x-icon">
    <link rel="icon" href="../img/favicon/favicon.jpg" type="image/x-icon">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>


    <script type="text/javascript"></script>


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
                <div class="dropdown">
                    <a href="#">Página principal</a>
                    <div class="dropdown-content dispensario">
                        <ul>
                            <li>
                                <a href="index.php?menuop=pagina_principal">Dashboard</a>
                            </li>
                            <li>
                                <a href="index.php?menuop=listar_notas_fiscais">Listar Notas Fiscais</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="index.php?menuop=deposito">Depósito</a>
                <div class="dropdown">
                    <a href="#">Dispensário</a>
                    <div class="dropdown-content dispensario">
                        <ul>
                            <li>
                                <a href="index.php?menuop=dispensario">Dispensário - Geral</a>
                            </li>
                            <li>
                                <a href="index.php?menuop=painel_armario">Armário</a>
                            </li>
                            <li>
                                <a href="index.php?menuop=painel_gaveteiro">Estante - Gaveteiros</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#">Insumos</a>
                    <div class="dropdown-content">
                        <ul>
                            <li>
                                <a href="index.php?menuop=insumos">Todos os insumos</a>
                            </li>
                            <li>
                                <a href="index.php?menuop=insumos_procedimentos">Material de procedimento</a>
                            </li>
                            <li>
                                <a href="index.php?menuop=insumos_medicamentos">Medicamentos</a>
                            </li>
                            <li>
                                <a href="index.php?menuop=insumos_controlados">Medicamentos controlados</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="index.php?menuop=usuarios">Usuários</a>
                <div class="login_user">
                    <div class="dropdown">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                            <?php echo $_SESSION['usuario_primeiro_nome'];?>
                        </span>
                        <div class="dropdown-content sair">
                            <a href="index.php?menuop=editar_usuario&idUsuario=<?=$_SESSION['usuario_id']?>">Meus dados</a>
                            <a href="../db/logout.php">Sair</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <!-- <section class="menu_lateral">
            <div class="">
                <div class="menu_op menu lateral">
                    <div>
                        <p>teste</p>
                        <ul>
                            <li>teste</li>
                            <li>teste</li>
                            <li>teste</li>
                            <li>teste</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section> -->
        <?php
            $menuop = (isset($_GET["menuop"]))?$_GET["menuop"]:"pagina_principal";
            switch ($menuop) {
                case 'pagina_principal':
                    include_once("home.php");
                    break;

                case 'deposito':
                    include_once("deposito/painel_deposito.php");
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
    
                case 'quantidade_insumos_deposito':
                    include_once("deposito/quantidade_insumos_deposito.php");
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

                case 'insumos_medicamentos':
                    include_once("insumos/insumos_medicamentos.php");
                    break;

                case 'insumos_procedimentos':
                    include_once("insumos/insumos_procedimentos.php");
                    break;

                case 'insumos_controlados':
                    include_once("insumos/insumos_controlados.php");
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

                case 'dispensario':
                    include_once("dispensario/painel_dispensario.php");
                    break;

                case 'cadastro_dispensario':
                    include_once("dispensario/cadastro_dispensario.php");
                    break;

                case 'editar_dispensario':
                    include_once("dispensario/editar_dispensario.php");
                    break;

                case 'excluir_dispensario':
                    include_once("dispensario/excluir_dispensario.php");
                    break;

                case 'atualizar_dispensario':
                    include_once("dispensario/atualizar_dispensario.php");
                    break;

                case 'inserir_dispensario':
                    include_once("dispensario/inserir_dispensario.php");
                    break;

                case 'retirar_dispensario':
                    include_once("dispensario/retirar_dispensario.php");
                    break;
                    
                case 'quantidade_insumos_dispensario':
                    include_once("dispensario/quantidade_insumos_dispensario.php");
                    break;
                    
                case 'painel_armario':
                    include_once("dispensario/armario/painel_armario.php");
                    break;

                case 'painel_gaveteiro':
                    include_once("dispensario/estante/gaveteiro/painel_gaveteiro.php");
                    break;

                case 'pesquisa_deposito':
                    include_once("dispensario/sch_disp_itens_depst.php");
                    break;
                
                case 'relatorio_insumos_deposito_prestes_expirar':
                    include_once("deposito/relatorios_deposito/expira_deposito.php");
                    break;

                case 'relatorio_insumos_deposito_estoque_critico':
                    include_once("");
                    break;

                case 'listar_notas_fiscais':
                    include_once("deposito/relatorios_deposito/listar_notas_fiscais.php");
                    break;
    

                default:
                include_once("home.php");
                    break;
            }
        ?>
    </main>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="../js/autocomplete.js"></script>

    <!-- <script src="../js/jquery-3.6.4.min.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    
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