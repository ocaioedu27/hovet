<?php

// echo __DIR__;

include_once("../db/connect.php");

include_once("../db/protect.php");

include_once("../pgs_modelo/caracteres_sem_acento.php");

include_once("../pgs_modelo/permissoes_usuarios.php");

$sessionUserID = $_SESSION['usuario_id'];

$sessionUserType = $_SESSION['usuario_tipo_usuario_id'];

$qtd_linhas_tabelas = 0;

$qualEstoque = "";

// echo "<br>!!!!!!!!!! \CRIAR AS OPCOES PARA CADA TIPO DE PERMISSAO !!!!!!!!!!<br><br> CADASTRAR, EDITAR, DELETAR, VISUALIZAR, ETC, O QUE FOR DE NECESSARIO<br>";

// echo "<br>!!!!!!!!!! AJUSTAR O BUILD SQL DO SISTEMA !!!!!!!!!!<br><br>";

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
        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=deposito';</script>";   
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
    $painel_slc = "pre_solicitacoes";
    $complemento_slc = "";
    $painel_tmp = "D";
}

$painel = $painel_tmp; 

$teste_array = array(
    "cp_nome" => "Sistema Controller",
    "permissoes_nome" => "Cadastrar"
);

$array_permissoes_opcoes_sistema = [9,10,11,12,19,20,21,22,23];

$array_tipos_estoquista_adm_diretor = [2,3,5];
$array_tipos_estoquista_adm = [2,3];
$array_tipos_adm_diretor = [3,5];
$array_permissoes_user = [];

if ($sessionUserType == 2) {
    
    $array_permissoes_user = $array_tipos_estoquista_adm_diretor;

} else {
    
    $array_permissoes_user = [$sessionUserType];

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


    <link rel="stylesheet" href="../css/style_personalizado.css">

    <!--REFERENCIA PARA O FAVICON -->

    <link rel="shortcut icon" href="../img/favicon/logo_hovet.ico" type="image/x-icon">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

</head>

<body>
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
                                <!-- <li>
                                    <a href="index.php?menuop=permissoes" id="listar">Gerênciar Permissões</a>
                                </li> -->
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
                                    <a href="index.php?menuop=minhas_solicitacoes&Pendente" id="">Minhas Solicitações</a>
                                </li>
                                <li>
                                    <a href="index.php?menuop=solicitacoes_resumo&Pendente" id="listar">Solicitações</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="dropdown" id="listar">
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
                        <a href="#">Tipos de Insumos</a>
                        <div class="dropdown-content">
                            <ul>
                                <li>
                                    <a href="index.php?menuop=categorias_insumos">Todas as Categorias de Insumos</a>
                                </li>
                                <li>
                                    <a href="index.php?menuop=insumos">Todos os Insumos</a>
                                </li>
                                <?php
                                    $sql = "SELECT * FROM tipos_insumos ORDER BY tipos_insumos_tipo ASC";
                                    $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                    
                                    while($dados = mysqli_fetch_assoc($rs)){
        
                                ?>
                                <li>
                                    <a href="index.php?menuop=insumos&categoriaInsumoId=<?=$dados['tipos_insumos_id']?>"><?=$dados['tipos_insumos_tipo']?></a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div id="listar">
                        <a href="index.php?menuop=usuarios">Usuários</a>
                    </div>
                    <div class="dropdown" id="listar">
                        <a href="#">Tipos de Fornecedores</a>
                        <div class="dropdown-content">
                            <ul>
                                <li>
                                    <a href="index.php?menuop=categorias_fornecedores">Todas as Categorias de Fornecedores</a>
                                </li>
                                <li>
                                    <a href="index.php?menuop=fornecedores">Todos os Fornecedores</a>
                                </li>
                                <?php
                                    $sql = "SELECT * FROM categorias_fornecedores ORDER BY cf_categoria ASC";
                                    $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                    
                                    while($dados = mysqli_fetch_assoc($rs)){
        
                                ?>
                                <li>
                                    <a href="index.php?menuop=fornecedores&fornecedores_ctg_id=<?=$dados['cf_id']?>"><?=$dados['cf_categoria']?></a>
                                </li>
                                <?php
                                    }
                                ?>
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
                        <div class="dropdown-content sair no-margin">
                            <ul>
                                <li>
                                    <input type="hidden" id="sessionUserType" value="<?=$sessionUserType?>">
                                </li>
                                <li>
                                    <a href="index.php?menuop=minhas_solicitacoes&Pendente=1">Minhas Solicitações</a>
                                </li>
                                <li>
                                    <a href="index.php?menuop=meus_dados_usuario">Meus dados</a>
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
        <?php
            $menuop = (isset($_GET["menuop"]))?$_GET["menuop"]:"pagina_principal";
            switch ($menuop) {
                case 'pagina_principal':
                    if (!$sessionUserType) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar o Sistema!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/sem_acesso_ao_sistema.php'</script>";
                        # code...
                    } else{

                        include_once("home.php");
                        break;
                    }

                case 'dashboard':

                    if (!$sessionUserType) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";
                        # code...
                    } else{

                        include_once("dashboard.php");
                        break;
                    }

                case 'estoques':

                    if (!$sessionUserType) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/painel_estoques.php");
                        break;
                    }


                case 'acesso_bloqueado':
                    include_once('./sem_acesso_ao_sistema.php');
                    break;
                    
                case 'cadastro_estoque':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/cadastro_estoque.php");
                        break;
                    }
                
                case 'inserir_estoque':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/inserir_estoque.php");
                        break;
                    }

                case 'deposito':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/deposito/painel_deposito.php");
                        break;
                    }

                case 'deposito_resumo':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/deposito/painel_deposito_resumido.php");
                        break;
                    }

                case 'cadastro_deposito':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/deposito/cadastro_deposito.php");
                        break;
                    }

                case 'inserir_deposito':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/deposito/inserir_deposito.php");
                        break;
                    }

                case 'editar_deposito':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/deposito/editar_deposito.php");
                        break;
                    }

                case 'excluir_deposito':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/deposito/excluir_deposito.php");
                        break;
                    }
    
                case 'atualizar_deposito':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/deposito/atualizar_deposito.php");
                        break;
                    }
                
                case 'usuarios':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/funcionarios/painel_users.php");
                        break;
                    }
                
                case 'cadastro_usuario':

                    if ($sessionUserType != 2) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/funcionarios/cadastro_usuario.php");
                        break;
                    }

                case 'inserir_usuario':

                    if ($sessionUserType != 2) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/funcionarios/inserir_usuario.php");
                        break;
                    }
                    
                case 'meus_dados_usuario':

                    if (!$sessionUserType) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/funcionarios/editar_meus_dados_usuario.php");
                        break;
                    }
                    
                case 'editar_usuario':

                    if ($sessionUserType != 2) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/funcionarios/editar_usuario.php");
                        break;
                    }

                case 'trocar_senha_usuario':

                    if (!$sessionUserType) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/funcionarios/trocar_senha_usuario.php");
                        break;
                    }
    
                case 'atualizar_usuario':

                    if ($sessionUserType != 2) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/funcionarios/atualizar_usuario.php");
                        break;
                    }

                case 'excluir_usuario':

                    if ($sessionUserType != 2) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/funcionarios/excluir_usuario.php");
                        break;
                    }

                case 'fornecedores':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/fornecedores/painel_fornecedores.php");
                        break;
                    }
                
                case 'cadastro_fornecedores':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/fornecedores/cadastro_fornecedores.php");
                        break;
                    }

                case 'inserir_fornecedores':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/fornecedores/inserir_fornecedores.php");
                        break;
                    }

                case 'editar_fornecedor':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/fornecedores/editar_fornecedores.php");
                        break;
                    }
    
                case 'atualizar_fornecedor':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/fornecedores/atualizar_fornecedores.php");
                        break;
                    }

                case 'excluir_fornecedor':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/fornecedores/excluir_fornecedores.php");
                        break;
                    }

                case 'instituicoes':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/instituicoes/painel_instituicoes.php");
                        break;
                    }
                
                case 'cadastro_instituicoes':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/instituicoes/cadastro_instituicoes.php");
                        break;
                    }

                case 'inserir_instituicoes':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/instituicoes/inserir_instituicoes.php");
                        break;
                    }

                case 'editar_instituicoes':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/instituicoes/editar_instituicoes.php");
                        break;
                    }
    
                case 'atualizar_instituicoes':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/instituicoes/atualizar_instituicoes.php");
                        break;
                    }

                case 'excluir_instituicoes':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/instituicoes/excluir_instituicoes.php");
                        break;
                    }

                case 'categorias_insumos':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("insumos/categorias_insumos/painel_categorias.php");
                        break;
                    }

                case 'editar_categoria_insumos':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("insumos/categorias_insumos/editarCategoriaInsumos.php");
                        break;
                    }

                case 'excluir_categoria_insumos':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("insumos/categorias_insumos/excluirCategoriaInsumos.php");
                        break;
                    }

                case 'atualizar_categoria_insumos':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("insumos/categorias_insumos/atualizarCategoriaInsumos.php");
                        break;
                    }

                case 'inserir_categoria':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("insumos/categorias_insumos/inserir_categoria.php");
                        break;
                    }

                case 'insumos':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("insumos/painel_insumos.php");
                        break;
                    }   
                
                case 'cadastro_insumo':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("insumos/cadastro_insumo.php");
                        break;
                    }  
                    
                case 'cadastro_categoria_insumo':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("insumos/categorias_insumos/cadastro_categoria_insumos.php");
                        break;
                    }
                
                case 'inserir_insumo':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("insumos/inserir_insumo.php");
                        break;
                    }
                    
                case 'editar_insumo':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("insumos/editar_insumo.php");
                        break;
                    }

                case 'atualizar_insumo':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("insumos/atualizar_insumo.php");
                        break;
                    }

                case 'excluir_insumo':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("insumos/excluir_insumo.php");
                        break;
                    }

                case 'dispensario':

                    if (!$sessionUserType) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/dispensario/painel_dispensario.php");
                        break;
                    }

                case 'dispensario_resumo':

                    if (!$sessionUserType) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/dispensario/painel_dispensario_resumido.php");
                        break;
                    }

                case 'cadastro_dispensario':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/dispensario/cadastro_dispensario.php");
                        break;
                    }

                case 'editar_dispensario':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/dispensario/editar_dispensario.php");
                        break;
                    }

                case 'excluir_dispensario':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/dispensario/excluir_dispensario.php");
                        break;
                    }

                case 'atualizar_dispensario':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/dispensario/atualizar_dispensario.php");
                        break;
                    }

                case 'inserir_dispensario':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/dispensario/inserir_dispensario.php");
                        break;
                    }

                case 'solicitacoes_resumo':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/dispensario/solicitacoes/solicitacoes_resumo.php");
                        break;
                    }
                    
                case 'pre_solicitacoes':

                    if (!$sessionUserType) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/dispensario/solicitacoes/pre_slc/painel_pre_solicitacoes.php");
                        break;
                    }

                case 'minhas_solicitacoes':

                    if (!$sessionUserType) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/dispensario/solicitacoes/painel_minhas_solicitacoes.php");
                        break;
                    }

                case 'solicitar_dispensario':

                    if (!$sessionUserType) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/dispensario/solicitacoes/solicitar_dispensario.php");
                        break;
                    }

                case 'salva_solicitacao_dispensario':

                    if (!$sessionUserType) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/dispensario/solicitacoes/salva_solicitacao_dispensario.php");
                        break;
                    }

                case 'atualiza_pre_solicitacao':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/dispensario/solicitacoes/pre_slc/atualiza_pre_solicitacoes.php");
                        break;
                    }

                case 'detalhes_pre_solicitacao':

                    if (!$sessionUserType) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/dispensario/solicitacoes/pre_slc/detalhes_pre_solicitacao.php");
                        break;
                    }

                case 'detalhes_solicitacao':

                    if (!$sessionUserType) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/dispensario/solicitacoes/detalhes_solicitacao.php");
                        break;
                    }

                case 'pesquisa_deposito':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/dispensario/sch_disp_itens_depst.php");
                        break;
                    }
                
                case 'listar_movimentacoes':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("./movimentacoes/painel_movimentacoes.php");
                        break;
                    }
                    
                case 'listar_relatorios':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("./pdf/painel_relatorios.php");
                        break;
                    }
                    
                case 'personalizar_relatorios':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("./pdf/personalizar/painel_personalizar.php");
                        break;
                    }
                    
                case 'relatorio_expirados':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("./pdf/relatorio_validade.php");
                        break;
                    }

                case 'compra':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("movimentacoes/compra/listar_compras_resumo.php");
                        break;
                    }

                case 'compra_por_nf':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("movimentacoes/compra/listar_compras_by_nf.php");
                        break;
                    }

                case 'compra_detalhes':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("movimentacoes/compra/detalhes_compras.php");
                        break;
                    }

                case 'doacao':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("movimentacoes/doacao/listar_doacoes_resumo.php");
                        break;
                    }

                case 'doacao_por_oid':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("movimentacoes/doacao/listar_doacoes_by_uid.php");
                        break;
                    }

                case 'doacao_detalhes':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("movimentacoes/doacao/detalhes_doacao.php");
                        break;
                    }

                case 'permuta':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("movimentacoes/permuta/listar_permutas_resumo.php");
                        break;
                    }

                case 'permuta_por_oid':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("movimentacoes/permuta/listar_permutas_by_oid.php");
                        break;
                    }

                case 'permutar_deposito':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("estoques/deposito/permutar_deposito.php");
                        break;
                    } 

                case 'detalhar_permuta':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("movimentacoes/permuta/detalhes_permuta.php");
                        break;
                    }

                case 'permissoes':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/permissoes/painel_permissoes.php");
                        break;
                    }

                case 'cadastrar_permissoes':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/permissoes/cadastro_permissao.php");
                        break;
                    }

                case 'inserir_permissoes':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/permissoes/inserir_permissao.php");
                        break;
                    }

                case 'editar_permissoes':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/permissoes/editar_permissao.php");
                        break;
                    }

                case 'atualizar_permissoes':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/permissoes/atualizar_permissao.php");
                        break;
                    }

                case 'excluir_permissoes':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/permissoes/excluir_permissao.php");
                        break;
                    }

                case 'gerenciar_permissoes_usuario':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/permissoes/gerenciar_permissoes_usuario.php");
                        break;
                    }

                case 'remover_permissao':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/permissoes/controle/remove_permissao.php");
                        break;
                    }

                case 'conceder_permissao':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/permissoes/controle/conceder_permissao.php");
                        break;
                    }

                case 'inserir_acesso':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/permissoes/controle/inserir_acesso.php");
                        break;
                    }

                case 'categorias_fornecedores':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/fornecedores/categoria_fornecedores/painelCategorias.php");
                        break;
                    }

                case 'cadastroCategoriaFornecedor':

                    if (!has_permission($array_permissoes_user, $array_tipos_adm_diretor)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/fornecedores/categoria_fornecedores/cadastroCategoriaFornecedor.php");
                        break;
                    }

                case 'inserir_categoria_fornecedor':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/fornecedores/categoria_fornecedores/inserirCategoria.php");
                        break;
                    }

                case 'editar_categoria_fornecedores':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/fornecedores/categoria_fornecedores/editarCategoria.php");
                        break;
                    }

                case 'atualizar_categoria_fornecedor':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/fornecedores/categoria_fornecedores/atualizarCategorias.php");
                        break;
                    }

                case 'excluir_categoria_fornecedor':

                    if (!has_permission($array_permissoes_user, $array_tipos_estoquista_adm)) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("usuarios/fornecedores/categoria_fornecedores/excluirCategoria.php");
                        break;
                    }

                default:

                    if (!$sessionUserType) {

                        echo "<script language='javascript'>window.alert('Você não tem permissão para acessar está página!!'); </script>";
                        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=pagina_principal'</script>";

                    } else{

                        include_once("home.php");
                        break;
                    }
            }
        ?>
        <?php 
        
        echo '<input type="hidden" id="quantidade_linhas_tabelas" value="'.$qtd_linhas_tabelas.'">';
        
        echo '<input type="hidden" id="sessionUserType" value="'. $sessionUserType . '">';


        // $qtd_linhas_tabelas = count($array_permissoes_gerais);
        // $tem_permissoes = "teste";
        // echo has_permission($array_permissoes_user,$array_permissoes_opcoes_sistema);

        if (!has_permission($array_permissoes_user,$array_tipos_estoquista_adm_diretor)) {
            // $painel = "pagina_principal";
            $tem_permissoes = "false";
            // echo "Não tem permissões" . $tem_permissoes;

        } else {

            $tem_permissoes = "true";
            // echo "TESTE" . $tem_permissoes;
        }

        $tamanho_lista_permissoes_gerais = count($array_permissoes_opcoes_sistema);

        echo '<input type="hidden" id="tem_permissoes" value="'. $tem_permissoes .', ' . $tamanho_lista_permissoes_gerais . '">';


        ?>

    </main>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="../js/autocomplete.js"></script>
    
    <script type="text/javascript" src="../js/script.js"></script>
    <script type="text/javascript" src="../js/hasPermissions.js"></script>
    <script type="text/javascript" src="../js/adicaoRemocaoCampos.js"></script>
    <script type="text/javascript" src="../js/searchInputs.js"></script>


    <!-- <script src="../js/jquery-3.6.4.min.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    
    <script type="text/javascript">
        $('.confirmaEdit').on('click', function(){
            return confirm('O item será editado, deseja editar?');
        });

        $('.confirmaDownload').on('click', function(){
            return confirm('Deseja baixar o arquivo?');
        });

        $('.confirmaDelete').on('click', function(){
            return confirm('O item será excluído, deseja confirmar?');
        });

        $('.confirmaPermissions').on('click', function(){
            return confirm('Gerênciar permissões do usuário, deseja continuar?');
        });

        $('.confirmaVolta').on('click', function(){
            return confirm('O formulário será perdido, deseja voltar?');
        });

        $('.confirmaOperacao').on('click', function(){
            return confirm('Confirme a operação, clique em OK');
        });

        $('.confirmaQtdSolicitada').on('click', function(){
            return confirm('A quantidade solicitada será totalmente atendida?');
        });

    </script>

</body>

</html>