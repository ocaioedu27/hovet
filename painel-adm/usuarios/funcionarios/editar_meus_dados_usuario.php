<?php
// $idUsuario = $_GET["idUsuario"];

$painel = "";

if ($sessionUserType != 2 && $sessionUserType != 3) {
    $painel = "pagina_principal";
} else {
    $painel = "usuarios";
}


$idUsuario = $sessionUserID;

$sql = "SELECT 
            u.usuario_id,
            u.usuario_nome_completo,
            u.usuario_sobrenome,
            u.usuario_primeiro_nome,
            u.usuario_mail,
            t.tipo_usuario_tipo,
            u.usuario_siape 
            FROM usuarios AS u 
            INNER JOIN tipo_usuario AS t 
            ON u.usuario_tipo_usuario_id = t.tipo_usuario_id 
            WHERE u.usuario_id={$idUsuario}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($result);
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
                    <input type="text" class="form-control largura_metade" name="idUsuario" value="<?=$dados["usuario_id"]?>" readonly>
                </div>

                <div class="display-flex-cl">
                    <label for="nomeCompletoUsuario">Nome Completo</label>
                    <input type="text" class="form-control" name="nomeCompletoUsuario" value="<?=$dados["usuario_nome_completo"]?>" required>
                </div>
            </div>
            
            <div class="form-group valida_movimentacao">
                <div class="display-flex-cl">
                    <label for="primeiroNomeUsuario">Primeiro Nome</label>
                    <input type="text" class="form-control largura_metade" name="primeiroNomeUsuario" value="<?=$dados["usuario_primeiro_nome"]?>" required>
                </div>

                <div class="display-flex-cl">
                    <label for="sobrenomeUsuario">Sobrenome</label>
                    <input type="text" class="form-control largura_metade" name="sobrenomeUsuario" value="<?=$dados["usuario_sobrenome"]?>" required>
                </div>  
            </div>

            <div class="form-group valida_movimentacao">

                <div class="display-flex-cl">
                    <label for="tipoUsuario">Tipo de usuário</label>
                    <select class="form-control largura_um_terco" name="tipoUsuario">
                        <?php
                        
                        $sql_allTipos = "SELECT * FROM tipo_usuario WHERE tipo_usuario_id!=2";
                        $result_allTipos = mysqli_query($conexao,$sql_allTipos) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                        
                        while($tipoUsu = mysqli_fetch_assoc($result_allTipos)){
                        ?>
                            <option><?=$tipoUsu["tipo_usuario_id"]?> - <?=$tipoUsu["tipo_usuario_tipo"]?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="display-flex-cl">
                    <label for="">Atualmente: </label>
                    <input type="text" class="form-control" value="<?=$dados["tipo_usuario_tipo"]?>" style="color: red;" readonly>
                </div>
            </div>

            <div class="form-group valida_movimentacao">

                <div class="diplay-flex-cl">
                    <label for="mailUsuario">E-mail</label>
                    <input type="email" class="form-control largura_um_terco" name="mailUsuario" value="<?=$dados["usuario_mail"]?>" required>
                </div>

                <div class="diplay-flex-cl">
                    <label for="siapeUsuario">SIAPE</label>
                    <input type="text" class="form-control" name="siapeUsuario" value="<?=$dados["usuario_siape"]?>" readonly>
                </div>
            </div>

            <div class="form-group valida_movimentacao">
                <a href="index.php?menuop=trocar_senha_usuario&idUsuario=<?=$dados['usuario_id']?>">Trocar a Senha</a>
            </div>

            <div class="form-group valida_movimentacao">

                <div class="diplay-flex-cl">
                    <label>Insira sua senha para confirmar</label>
                    <input type="password" class="form-control largura_um_terco" name="validaSenhaUsuario" required>
                </div>
            </div>

            <div class="form-group">
                <input type="submit" value="Atualizar" name="btnAtualizarUsuario" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>