<?php

$painel = "";

if ($sessionUserType != 2 && $sessionUserType != 3) {
    $painel = "pagina_principal";
} else {
    $painel = "usuarios";
}

$idUsuario = $_GET["idUsuario"];

$sql = "SELECT 
            usuario_id,
            usuario_nome_completo
            FROM usuarios
            WHERE usuario_id={$idUsuario}";
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
        <form class="form_cadastro" action="index.php?menuop=atualizar_usuario&alterar_senha" method="post">
            <div class="form-group valida_movimentacao">
                <div class="display-flex-cl">
                    <label for="idUsuario">ID</label>
                    <input type="text" class="form-control largura_metade" name="idUsuario" value="<?=$dados["usuario_id"]?>" readonly>
                </div>

                <div class="display-flex-cl">
                    <label for="nomeCompletoUsuario">Nome Completo</label>
                    <input type="text" class="form-control" name="nomeCompletoUsuario" value="<?=$dados["usuario_nome_completo"]?>" readonly>
                </div>
            </div>

            <div class="form-group valida_movimentacao">

                <div class="display-flex-cl">
                    <label for="senhaUsuario">Nova Senha</label>
                    <input type="password" class="form-control" name="senhaUsuarioAtualizada" id="password" onchange="validaPassword()" required>
                </div>

                <div class="display-flex-cl">
                    <label for="senhaUsuario">Confirme a Senha</label>
                    <input type="password" class="form-control" name="senhaUsuarioAtualizada" id="confirmPassword" onkeyup="validaPassword()" required>
                    <span class="alerta_senhas_iguais" style="display: none;" id="alerta_senhas_iguais">
                        <label>Senhas Diferentes!</label>
                        <ion-icon name="alert-circle-outline"></ion-icon>
                    </span>
                </div>

            </div>

            <div class="form-group">

                <div class="form-group valida_movimentacao">

                    <div class="diplay-flex-cl">
                        <label>Insira sua senha antiga para confirmar</label>
                        <input type="password" class="form-control" name="validaSenhaUsuario" required>
                    </div>
                </div>
                <input type="submit" value="Atualizar" name="btnAtualizarUsuario" class="btn_cadastrar" id="btn_cad_user">
            </div>
        </form>
    </div>
</div>