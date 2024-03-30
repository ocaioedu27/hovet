<?php

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

?>

<div class="container cadastro_all">
    <div class="cards cadastro_usuarios">
        <div class="voltar">
            <h4>Cadastro de Usuário</h4>
            <a href="index.php?menuop=usuarios" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" action="index.php?menuop=inserir_usuario" method="post">
            <div class="form-group">
                <label for="nomeCompletoUsuario">Nome Completo</label>
                <input type="text" class="form-control" name="nomeCompletoUsuario" placeholder="Insira o nome completo..." required>
            </div>

            <div class="form-group valida_movimentacao">
                <div>
                    <label for="primeiroNomeUsuario">Primeiro Nome</label>
                    <input type="text" class="form-control" name="primeiroNomeUsuario" placeholder="Insira o primeiro nome..." required>
                </div>

                <div class="displey-flex-cl">
                    <label for="sobrenomeUsuario">Sobrenome</label>
                    <input type="text" class="form-control" name="sobrenomeUsuario" placeholder="Insira o sobrenome..." required>
                </div>  
            </div>

            <div class="form-group valida_movimentacao">

                <div class="display-flex-cl">
                    <label for="siapeUsuario">SIAPE</label>
                    <input type="text" class="form-control" name="siapeUsuario" maxlength="8" onkeyup="verifica_valor('valor_siape_1', 'msg_alerta_1', 'btn_cad_user', '0')" id="valor_siape_1" placeholder="Informe o SIAPE..." required>
                    <span class="alerta_senhas_iguais" style="display: none;" id="msg_alerta_1">
                        <label>Valor inválido! Por favor, altere para um valor válido!
                            <ion-icon name="alert-circle-outline"></ion-icon>
                        </label>
                    </span>
                </div>

                <div class="display-flex-cl">
                    <label for="mailUsuario">E-mail</label>
                    <input type="email" class="form-control" name="mailUsuario" placeholder="Insira o e-mail..." required>
                </div>

            </div>

            <div class="form-group valida_movimentacao">

                <div class="display-flex-cl">
                    <label for="tipoUsuario">Tipo de usuário</label>
                    <select class="form-control" name="tipoUsuario" required>
                        <?=$strOptions?>
                    </select>
                </div>

                <div class="display-flex-cl">
                    <label>Status</label>
                    <!-- <input type="radio" class="form-control" name="ativo" required> -->
                    <select class="form-control" name="statusUsu" required>
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                </div>

            </div>

            <div class="form-group valida_movimentacao">

                <div class="display-flex-cl">
                    <label for="senhaUsuario">Senha</label>
                    <input type="password" class="form-control" name="senhaUsuario" id="password" onchange="validaPassword()" placeholder="Insira a senha..." required>
                </div>

                <div class="display-flex-cl">
                    <label for="senhaUsuario">Confirme a Senha</label>
                    <input type="password" class="form-control" name="senhaUsuario" id="confirmPassword" onkeyup="validaPassword()" placeholder="Confirme a senha..." required>
                    <span class="alerta_senhas_iguais" style="display: none;" id="alerta_senhas_iguais">
                        <label>Senhas Diferentes!</label>
                        <ion-icon name="alert-circle-outline"></ion-icon>
                    </span>
                </div>

            </div>

            <div class="form-group valida_movimentacao">
                <label>Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="cad_user" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarUsuario" id="btn_cad_user" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>