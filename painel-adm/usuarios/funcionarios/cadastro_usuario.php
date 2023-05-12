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
                <input type="text" class="form-control" name="nomeCompletoUsuario" required>
            </div>

            <div class="form-group valida_movimentacao">
                <div>
                    <label for="primeiroNomeUsuario">Primeiro Nome</label>
                    <input type="text" class="form-control" name="primeiroNomeUsuario" required>
                </div>

                <div class="displey-flex-cl">
                    <label for="sobrenomeUsuario">Sobrenome</label>
                    <input type="text" class="form-control" name="sobrenomeUsuario" required>
                </div>  
            </div>

            <div class="form-group valida_movimentacao">

                <div class="display-flex-cl">
                    <label for="siapeUsuario">SIAPE</label>
                    <input type="text" class="form-control" name="siapeUsuario" maxlength="8" required>
                </div>

                <div class="display-flex-cl">
                    <label for="mailUsuario">E-mail</label>
                    <input type="email" class="form-control" name="mailUsuario" required>
                </div>

            </div>

            <div class="form-group valida_movimentacao">

                <div class="display-flex-cl">
                    <label for="tipoUsuario">Tipo de usuário</label>
                    <select class="form-control largura_metade" name="tipoUsuario" required>
                        <?php
                        
                        $sql_allTipos = "SELECT * FROM tipo_usuario WHERE tipo_usuario_id!=5 and tipo_usuario_id!=2";
                        $result_allTipos = mysqli_query($conexao,$sql_allTipos) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                        
                        while($tipoUsu = mysqli_fetch_assoc($result_allTipos)){
                        ?>
                        <option><?=$tipoUsu["tipo_usuario_id"]?> - <?=$tipoUsu["tipo_usuario_tipo"]?></option>

                        <?php
                            }
                        ?>
                    </select>
                </div>

            </div>

            <div class="form-group valida_movimentacao">

                <div class="display-flex-cl">
                    <label for="senhaUsuario">Senha</label>
                    <input type="password" class="form-control" name="senhaUsuario" id="password" onchange="validaPassword()" required>
                </div>

                <div class="display-flex-cl">
                    <label for="senhaUsuario">Confirme a Senha</label>
                    <input type="password" class="form-control" name="senhaUsuario" id="confirmPassword" onkeyup="validaPassword()" required>
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