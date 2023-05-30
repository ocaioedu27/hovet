<?php

include_once("../db/connect.php");

include_once("../db/protect.php");

include_once("../pgs_modelo/caracteres_sem_acento.php");

$sessionUserID = $_SESSION['usuario_id'];

$sessionUserType = $_SESSION['usuario_tipo_usuario_id'];

$qtd_linhas_tabelas = 0;

$qualEstoque = "";

// echo $qualEstoque;

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


if ($sessionUserType!=2 && $sessionUserType!=3) {
    // echo "minhas_solicitacoes";
    $painel_slc = "minhas_solicitacoes";
    $complemento_slc = "Minhas ";
    $painel_tmp = "Disp";
}else{
    $painel_slc = "solicitacoes";
    $complemento_slc = "";
    $painel_tmp = "D";
}

$painel = $painel_tmp; 

// echo "<script language='javascript'>window.alert('COMPLETAR A PARTE DE TROCA DE SENHA!!!COMPLETAR A PARTE DE TROCA DE SENHA!!!COMPLETAR A PARTE DE TROCA DE SENHA!!!COMPLETAR A PARTE DE TROCA DE SENHA!!!'); </script>";

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

    <!-- <link rel="shortcut icon" href="../img/favicon.jpg" type="image/x-icon"> -->
    <link rel="shortcut icon" href="../img/favicon/logo_hovet.ico" type="image/x-icon">

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
            <div class="display-flex-row">
                <div class="menu_op_adm">
                    <div class="dropdown">
                        <a href="#">Opções do Sistema</a>
                        <div class="dropdown-content" style="width: auto;">
                            <ul>
                                <li>
                                    <a href="index.php?menuop=pagina_principal">Página Principal</a>
                                </li>
                                <li>
                                    <a href="index.php?menuop=dashboard" id="listar">Dashboard</a>
                                </li>
                                <li>
                                    <a href="index.php?menuop=listar_relatorios" id="listar">Relatorios</a>
                                </li>

                                <li>
                                    <input type="hidden" id="" value="<?=$qtd_linhas_tabelas=8?>">
                                </li>
                                <li>
                                    <a href="index.php?menuop=<?=$painel_slc?>&Pendente" id=""><?=$complemento_slc?>Solicitações</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="#">Movimentações</a>
                        <div class="dropdown-content" style="width: auto;">
                            <ul>
                                <li>
                                    <a href="index.php?menuop=listar_movimentacoes" id="listar">Todas as Movimentações</a>
                                </li>
                                <li>
                                    <a href="index.php?menuop=compra" id="listar">Compras</a>
                                </li>
                                <li>
                                    <a href="index.php?menuop=doacao" id="listar">Doações</a>
                                </li>
                                <li>
                                    <a href="index.php?menuop=permuta" id="listar">Permutas</a>
                                </li>
                                <li>
                                    <input type="hidden" id="" value="<?=$qtd_linhas_tabelas=8?>">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="#">Estoques</a>
                        <div class="dropdown-content">
                            <ul>
                                <li>
                                    <a href="index.php?menuop=estoques&geral">Todos os Estoques</a>
                                </li>
                                <?php
                                    $sql = "SELECT * FROM estoques WHERE estoques_nome LIKE '{$painel}%' ORDER BY estoques_nome ASC";
                                    $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                    
                                    while($dados = mysqli_fetch_assoc($rs)){
                                        $estoqueNomeReal = $dados['estoques_nome_real'];
                                        $tipoEstoque = substr($estoqueNomeReal, 0, -1);
        
                                ?>
                                <li>
                                    <a href="index.php?menuop=<?=$tipoEstoque?>_resumo&<?=$estoqueNomeReal?>=1"><?=$dados['estoques_nome']?></a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="dropdown" id="listar">
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
                    <div class="dropdown" id="listar">
                        <a href="#">Usuários</a>
                        <div class="dropdown-content">
                            <ul>
                                <li>
                                    <a href="index.php?menuop=usuarios">Todos os Usuários</a>
                                </li>
                                <li>
                                    <a href="index.php?menuop=fornecedores">Fornecedores</a>
                                </li>
                                <li>
                                    <a href="index.php?menuop=instituicoes">Instituições</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="login_user">
                    <div class="dropdown">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                            <?php echo $_SESSION['usuario_primeiro_nome'];?>
                        </span>
                        <div class="dropdown-content sair">
                            <ul>
                                <li>
                                    <input type="hidden" id="sessionUserType" value="<?=$sessionUserType?>">
                                </li>
                                <li>
                                    <a href="index.php?menuop=minhas_solicitacoes&Pendente=1">Minhas Solicitações</a>
                                </li>
                                <li>
                                    <a href="index.php?menuop=editar_usuario&idUsuario=<?=$_SESSION['usuario_id']?>">Meus dados</a>
                                </li>
                                <li>
                                    <a href="../db/logout.php">Sair</a>
                                </li>
                            </ul>
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

                case 'dashboard':
                    include_once("dashboard.php");
                    break;


                case 'estoques':
                    include_once('estoques/painel_estoques.php');
                    break;
                    
                case 'cadastro_estoque':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once('estoques/cadastro_estoque.php');
                        break;
                    }
                
                case 'inserir_estoque':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once('estoques/inserir_estoque.php');
                        break;
                    }

                case 'deposito':
                    include_once("estoques/deposito/painel_deposito.php");
                    break;

                case 'deposito_resumo':
                    include_once("estoques/deposito/painel_deposito_resumido.php");
                    break;

                case 'cadastro_deposito':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("estoques/deposito/cadastro_deposito.php");
                        break;
                    }

                case 'inserir_deposito':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("estoques/deposito/inserir_deposito.php");
                        break;
                    }

                case 'editar_deposito':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once("estoques/deposito/editar_deposito.php");
                        break;
                    }

                case 'excluir_deposito':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once("estoques/deposito/excluir_deposito.php");
                        break;
                    }
    
                case 'atualizar_deposito':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once("estoques/deposito/atualizar_deposito.php");
                        break;
                    }
                
                case 'usuarios':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        include_once("usuarios/funcionarios/painel_users.php");
                        break;
                    }
                
                case 'cadastro_usuario':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once("usuarios/funcionarios/cadastro_usuario.php");
                        break;
    
                    }

                case 'inserir_usuario':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("usuarios/funcionarios/inserir_usuario.php");
                        break;
                    }
                    
                case 'editar_usuario':
                    include_once("usuarios/funcionarios/editar_usuario.php");
                    break;

                case 'trocar_senha_usuario':
                    include_once("usuarios/funcionarios/trocar_senha_usuario.php");
                    break;
    
                case 'atualizar_usuario':
                    include_once("usuarios/funcionarios/atualizar_usuario.php");
                    break;

                case 'excluir_usuario':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once("usuarios/funcionarios/excluir_usuario.php");
                        break;
                    }

                case 'fornecedores':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once("usuarios/fornecedores/painel_fornecedores.php");
                        break;
                    }
                
                case 'cadastro_fornecedores':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once("usuarios/fornecedores/cadastro_fornecedores.php");
                        break;
                    }

                case 'inserir_fornecedores':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("usuarios/fornecedores/inserir_fornecedores.php");
                        break;
                    }

                case 'editar_fornecedores':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once("usuarios/fornecedores/editar_fornecedores.php");
                        break;
                    }
    
                case 'atualizar_fornecedores':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("usuarios/fornecedores/atualizar_fornecedores.php");
                        break;
                    }

                case 'excluir_fornecedores':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("usuarios/fornecedores/excluir_fornecedores.php");
                        break;
                    }

                case 'instituicoes':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once("usuarios/instituicoes/painel_instituicoes.php");
                        break;
                    }
                
                case 'cadastro_instituicoes':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("usuarios/instituicoes/cadastro_instituicoes.php");
                        break;
                    }

                case 'inserir_instituicoes':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once("usuarios/instituicoes/inserir_instituicoes.php");
                        break;
                    }

                case 'editar_instituicoes':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once("usuarios/instituicoes/editar_instituicoes.php");
                        break;
                    }
    
                case 'atualizar_instituicoes':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once("usuarios/instituicoes/atualizar_instituicoes.php");
                        break;
                    }

                case 'excluir_instituicoes':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("usuarios/instituicoes/excluir_instituicoes.php");
                        break;
                    }
    
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
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("insumos/cadastro_insumo.php");
                        break;
                    }
                    
                case 'cadastro_categoria_insumo':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once("insumos/categorias_insumos/cadastro_categoria_insumos.php");
                        break;
                    }
                
                case 'inserir_insumo':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once("insumos/inserir_insumo.php");
                        break;
                    }
                    
                case 'editar_insumo':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("insumos/editar_insumo.php");
                        break;
                    }

                case 'atualizar_insumo':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("insumos/atualizar_insumo.php");
                        break;
                    }

                case 'excluir_insumo':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once("insumos/excluir_insumo.php");
                        break;
    
                    }

                case 'dispensario':
                    include_once("estoques/dispensario/painel_dispensario.php");
                    break;

                case 'dispensario_resumo':
                    include_once("estoques/dispensario/painel_dispensario_resumido.php");
                    break;

                case 'cadastro_dispensario':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("estoques/dispensario/cadastro_dispensario.php");
                        break;
                    }

                case 'editar_dispensario':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("estoques/dispensario/editar_dispensario.php");
                        break;
                    }

                case 'excluir_dispensario':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("estoques/dispensario/excluir_dispensario.php");
                        break;
                    }

                case 'atualizar_dispensario':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("estoques/dispensario/atualizar_dispensario.php");
                        break;
                    }

                case 'inserir_dispensario':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("estoques/dispensario/inserir_dispensario.php");
                        break;
                    }

                case 'solicitacoes':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("estoques/dispensario/solicitacoes/painel_solicitacoes.php");
                        break;
                    }

                case 'minhas_solicitacoes':
                    include_once("estoques/dispensario/solicitacoes/painel_minhas_solicitacoes.php");
                    break;

                case 'solicitar_dispensario':
                    include_once("estoques/dispensario/solicitacoes/solicitar_dispensario.php");
                    break;

                case 'salva_solicitacao_dispensario':
                    include_once("estoques/dispensario/solicitacoes/salva_solicitacao_dispensario.php");
                    break;

                case 'atualiza_solicitacao':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("estoques/dispensario/solicitacoes/atualiza_solicitacoes.php");
                        break;
                    }

                case 'detalhes_solicitacao':
                    include_once("estoques/dispensario/solicitacoes/detalhes_solicitacao.php");
                    break;
                    
                case 'painel_armario':
                    include_once("estoques/dispensario/armario/painel_armario.php");
                    break;

                case 'painel_gaveteiro':
                    include_once("estoques/dispensario/estante/gaveteiro/painel_gaveteiro.php");
                    break;

                case 'pesquisa_deposito':
                    include_once("estoques/dispensario/sch_disp_itens_depst.php");
                    break;
                
                case 'listar_movimentacoes':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("./movimentacoes/painel_movimentacoes.php");
                        break;
                    }
                    
                case 'listar_relatorios':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("./pdf/painel_relatorios.php");
                        break;
                    }
                
                case 'relatorio_insumos_deposito_prestes_expirar':
                    include_once("");
                    break;

                case 'relatorio_insumos_deposito_estoque_critico':
                    include_once("");
                    break;

                case 'compra':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("movimentacoes/listar_compras.php");
                        break;
                    }

                case 'doacao':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("movimentacoes/listar_doacoes.php");
                        break;
                    }

                case 'permuta':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {
                        
                        include_once("movimentacoes/permuta/listar_permutas.php");
                        break;
                    }

                case 'permutar_deposito':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("estoques/deposito/permutar_deposito.php");
                        break;   
                    }   

                case 'detalhar_permuta':
                    if ($sessionUserType!=2 && $sessionUserType!=3) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=pagina_principal'</script>";

                    } else {

                        include_once("movimentacoes/permuta/detalhes_permuta.php");
                        break; 
                    }

                default:
                include_once("home.php");
                    break;
            }
        ?>
        <?php 
        
        echo '<input type="hidden" id="quantidade_linhas_tabelas" value="'.$qtd_linhas_tabelas.'">';
        
        echo '<input type="hidden" id="sessionUserType" value="'. $sessionUserType . '">';

        ?>

    </main>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="../js/autocomplete.js"></script>
    
    <script type="text/javascript" src="../js/script.js"></script>


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

        $('.confirmaOperacao').on('click', function(){
            return confirm('Confirme a operação, clique em OK');
        });

    </script>

</body>

</html>