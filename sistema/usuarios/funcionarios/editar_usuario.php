<?php
// $idUsuario = $_GET["idUsuario"];

$painel = "";

if ($sessionUserType != 2 && $sessionUserType != 3) {
    $painel = "pagina_principal";
} else {
    $painel = "usuarios";
}


if (isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
		// $$chave = $valor;
        // print_r($valor_est);
	}

    $usuarioId = $valor_est;
}

$idUsuario = "";
if (strlen($_GET[$usuarioId])) {
    $idUsuario = $_GET[$usuarioId];
}else {
    echo "<script language='javascript'>window.alert('//Verifica-id - O ID não foi definido!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=". $painel."';</script>";
}


// Verifica os usuários                        
$sql_verifica_se_existe = "";

$sqlBuscaDiretor = "SELECT 
                    id
                FROM 
                    usuarios 
                WHERE 
                    tipo_usuario_id=5";
            
$r = mysqli_query($conexao,$sqlBuscaDiretor) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
// echo $r->num_rows;

$sqlTipoUsuarios = 'SELECT * FROM tipo_usuario WHERE id!=2';
if($r->num_rows == 1){
    $sqlTipoUsuarios .= ' and id!=5';
}

// echo $sqlTipoUsuarios;

$tipos_usu= mysqli_query($conexao,$sqlTipoUsuarios) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
$tiposUsu = mysqli_fetch_all($tipos_usu);
// var_dump($tiposUsu);
$strOptions;
foreach($tiposUsu as $tipoUsu){
    $id = $tipoUsu[0];
    $tipo = $tipoUsu[1];
    $strOptions .= '<option>'. $id .' - '. $tipo .'</option>';

}

$sql = "SELECT 
            u.id,
            u.nome_completo,
            u.sobrenome,
            u.primeiro_nome,
            u.mail,
            u.status,
            t.tipo,
            t.id as tipo_usuario_id,
            u.siape 
        FROM 
            usuarios AS u 
        INNER JOIN 
            tipo_usuario AS t 
        ON
            u.tipo_usuario_id = t.id 
        WHERE 
            u.id={$idUsuario}";

$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($result);

$statusUsuBool = $dados['status'];
$statusUsu = $statusUsuBool ? 'Ativo':'Inativo';

?>

<div class="container cadastro_all">
    <div class="cards edita_usuarios">
        <div class="voltar">
            <h4>Dados do Usuário</h4>
            <a href="index.php?menuop=<?=$painel?>" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" action="index.php?menuop=atualizar_usuario&atualizar_dados_usuario" method="post">

            <div class="form-group valida_movimentacao">
                <div class="display-flex-cl">
                    <label for="idUsuario">ID</label>
                    <input type="text" class="form-control largura_um_quarto" name="idUsuario" value="<?=$dados["id"]?>" readonly>
                </div>
            </div>

            <div class="form-group valida_movimentacao">

                <div class="display-flex-cl">
                    <label for="nomeCompletoUsuario">Nome Completo</label>
                    <input type="text" class="form-control" name="nomeCompletoUsuario" value="<?=$dados["nome_completo"]?>" required>
                </div>
                
                <div class="display-flex-cl">
                    <label for="idUsuario">Status</label>
                    <select class="form-control" name="statusUsu">
                        <option value="<?=$statusUsuBool?>"><?=$statusUsu?></option>
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group valida_movimentacao">
                <div class="display-flex-cl">
                    <label for="primeiroNomeUsuario">Primeiro Nome</label>
                    <input type="text" class="form-control" name="primeiroNomeUsuario" value="<?=$dados["primeiro_nome"]?>" required>
                </div>

                <div class="display-flex-cl">
                    <label for="sobrenomeUsuario">Sobrenome</label>
                    <input type="text" class="form-control" name="sobrenomeUsuario" value="<?=$dados["sobrenome"]?>" required>
                </div>  
            </div>

            <div class="form-group valida_movimentacao">

                <div class="display-flex-cl">
                    <label for="tipoUsuario">Tipo de usuário</label>
                    <select class="form-control" name="tipoUsuario">
                        <option value="<?=$dados['tipo_usuario_id']?>"><?=$dados["tipo"]?></option>
                         <?=$strOptions?>
                    </select>
                </div>

                <div class="display-flex-cl">
                    <label for="">Atualmente: </label>
                    <input type="text" class="form-control" value="<?=$dados["tipo"]?>" style="color: red;" readonly>
                </div>
            </div>

            <div class="form-group valida_movimentacao">

                <div class="diplay-flex-cl">
                    <label for="mailUsuario">E-mail</label>
                    <input type="email" class="form-control" name="mailUsuario" value="<?=$dados["mail"]?>" required>
                </div>

                <div class="diplay-flex-cl">
                    <label for="siapeUsuario">SIAPE</label>
                    <input type="text" class="form-control" name="siapeUsuario" maxlength="8" onkeyup="verifica_valor('valor_siape_1', 'msg_alerta_1', 'btn_cad_user', '0')" id="valor_siape_1" value="<?=$dados["siape"]?>" placeholder="Informe o SIAPE..." required>
                    <span class="alerta_senhas_iguais" style="display: none;" id="msg_alerta_1">
                        <label>Valor inválido! Por favor, altere para um valor válido!
                            <ion-icon name="alert-circle-outline"></ion-icon>
                        </label>
                    </span>
                </div>
            </div>

            <div class="form-group valida_movimentacao">
                <a href="index.php?menuop=trocar_senha_usuario&idUsuario=<?=$dados['id']?>">Trocar a Senha</a>
            </div>

            <div class="d-flex justify-content-center">

                <div class="d-flex flex-column justify-content-center">
                    <label style="text-align: center;">Insira sua senha para confirmar</label>
                    <input type="password" class="form-control" name="validaSenhaUsuario" required>
                </div>
            </div>

            <div class="form-group">
                <input type="submit" value="Atualizar" name="btnAtualizarUsuario" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>