<div class="container cadastro_all">
    <div class="cards cadastro_deposito">
        <div class="voltar ">
            <h4 class="">Inserindo no Depósito</h4>
            <a href="index.php?menuop=deposito" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=inserir_deposito" method="post">
        <!-- <form class="form_cadastro" enctype="multipart/form-data" action="" method="post"> -->

            <div class="dados_fiscais">
                <hr>
                <h3 class="">Dados fiscais</h3>
                <div class="form-group valida_movimentacao">
                    <div class="display-flex-cl">
                        <label for="tipo_insercao_deposito">Operação</label>
                        <select class="form-control-sm largura_metade" name="tipo_insercao_deposito" required>
                            <?php
                            
                            $sql = "SELECT * FROM tipos_movimentacoes WHERE tipos_movimentacoes_movimentacao = 'Compra' or tipos_movimentacoes_movimentacao = 'Doacao'";
                            $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                            
                            while($dados = mysqli_fetch_assoc($result)){
                            ?>
                            <option><?=$dados["tipos_movimentacoes_id"]?> - <?=$dados["tipos_movimentacoes_movimentacao"]?></option>

                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="display-flex-cl">
                        <label for="solicitante_retira_dispensario">Quem está guardando</label>
                        <select class="form-control-sm largura_um_terco" name="solicitante_retira_dispensario" required>
                            <?php
                            $sql = "SELECT * FROM usuarios";
                            $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                            
                            while($dados = mysqli_fetch_assoc($result)){
                            ?>
                            <option><?=$dados["usuario_id"]?> - <?=$dados["usuario_primeiro_nome"]?></option>

                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group valida_movimentacao">
                    <div class="display-flex-cl">
                        <label for="nota_fiscal_deposito">Nota fiscal</label>
                        <input type="file" class="form-control" name="nota_fiscal_deposito">
                    </div>

                    <div class="display-flex-cl">
                        <label for="dataCadastroInsumoDeposito">Dia do cadastro</label>
                        <input type="date" class="form-control largura_um_terco" name="dataCadastroInsumoDeposito" required>
                    </div>
                </div>
            </div>

            <div id="dados_insumo">
                <hr>
                <h3 class="">Dados do insumo</h3>
                <div class="form-group valida_movimentacao">
                    
                    <div class="display-flex-cl">
                        <label>Nome</label>
                        <select class="form-control" name="insumoID_Insumodeposito[]" required>
                            <?php
                            
                            $sql = "SELECT insumos_id, insumos_nome FROM insumos";
                            $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                            
                            while($dados = mysqli_fetch_assoc($result)){
                            ?>
                            <option><?=$dados["insumos_id"]?> - <?=$dados["insumos_nome"]?></option>

                            <?php
                                }
                            ?>
                        </select>
                    </div>
                        
                    <div class="display-flex-cl">
                        <label>Quantidade</label>
                        <input type="text" class="form-control" name="quantidadeInsumodeposito[]" required>
                    </div>

                    <div class="display-flex-cl">
                        <label for="validadeInsumoDeposito[]">Validade</label>
                        <input type="date" class="form-control" name="validadeInsumodeposito[]" required>
                    </div>
                
                    <div class="display-flex-cl">
                        <label>Descrição</label>
                        <input type="text" class="form-control" readonly>
                    </div>
                    
                    <button class="btn" type="button" onclick="adicionaCampoCadDeposito()" style="padding: 0;">+</button>

                </div>
            </div>
            
            <hr>
            <div class="form-group valida_movimentacao">
                <label for="valida_dados_insercao_deposito">Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="valida_dados_insercao_deposito" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarInsumoDeposito" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>