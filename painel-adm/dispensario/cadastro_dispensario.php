<div class="container cadastro_all">
    <div class="cards cadastro_dispensario">
        <div class="voltar">
            <h4>Movendo itens do Depósto para o Dispensário</h4>
            <a href="index.php?menuop=dispensario" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" action="index.php?menuop=inserir_dispensario" method="post">
            <div class="form-group valida_movimentacao">
                <div class="display-flex-cl">
                    <?php
                        $sql_mov = "SELECT 
                            tipos_movimentacoes_id,
                            tipos_movimentacoes_movimentacao
                            FROM tipos_movimentacoes
                            WHERE tipos_movimentacoes_movimentacao='Move para o Dispensário'";
                            
                        $resultado_mov = mysqli_query($conexao, $sql_mov) or die("//dispensario/sql_mov - erro ao realiza" . mysqli_error($conexao));

                        $dados_mov = mysqli_fetch_assoc($resultado_mov);
                        
                    ?>
                    <label for="mov_dep_to_disp">Tipo de operação</label>
                    <input type="text" class="form-control largura_um_terco" name="mov_dep_to_disp" value="<?=$dados_mov['tipos_movimentacoes_id']?> - <?=$dados_mov['tipos_movimentacoes_movimentacao']?>" readonly>
                </div>
                
                <div class="display-flex-cl">
                    <label for="solicitante_retira_dispensario">Quem está movimentando</label>
                    <select class="form-control largura_metade" name="solicitante_retira_dispensario" required>
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
                    <label for="depositoID_Insumodispensario">Insumo</label>
                    <select class="form-control largura_metade" name="depositoID_Insumodispensario" id="" required>
                        <?php
                        
                        $sql = "SELECT
                            dep.deposito_validade,
                            dep.deposito_qtd,
                            dep.deposito_id,
                            ins.insumos_nome,
                            ins.insumos_id 
                            FROM deposito dep 
                            INNER JOIN insumos ins 
                            ON dep.deposito_insumos_id = ins.insumos_id";
                        $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                        
                        while($dados = mysqli_fetch_assoc($result)){
                        ?>
                        <option><?=$dados["deposito_id"]?> - <?=$dados["insumos_nome"]?></option>

                        <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="display-flex-cl">
                    <label for="descricaoInsumoDeposito">Descrição do insumo</label>
                    <textarea name="descricaoInsumoDeposito" cols="10" rows="2" class="form-control" readonly></textarea>
                    <!-- <input type="text" class="form-control" name="descricaoInsumoDeposito" readonly> -->
                </div>
            </div>
            <div class="form-group valida_movimentacao">

                <div class="display-flex-cl">
                    <label for="quantidadeInsumoDispensario">Quantidade</label>
                    <input type="text" class="form-control" name="quantidadeInsumoDispensario" required>
                </div>

                <div class="display-flex-cl">
                    <label for="validadeInsumoDeposito">Validade</label>
                    <input type="date" class="form-control" name="validadeInsumoDeposito" id="auto_complete_validade" readonly>
                </div>

                <div class="display-flex-cl">
                    <label for="localInsumodispensario">Local</label>
                    <select class="form-control" name="localInsumodispensario" id="depositoID_Insumodispensario" required>
                        <?php
                        $sql = "SELECT * FROM local_dispensario";
                        $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                        
                        while($dados = mysqli_fetch_assoc($result)){
                        ?>
                        <option><?=$dados["local_id"]?> - <?=$dados["local_nome"]?></option>

                        <?php
                            }
                        ?>
                    </select>
                </div>
                
            </div>
            <div class="form-group valida_movimentacao">
                <div class="display-flex-cl">
                    <label for="quantidadeInsumoDeposito"> Disponível no Depósito</label>
                    <input type="text" class="form-control largura_um_quarto" name="quantidadeInsumoDeposito" readonly>
                </div>
            </div>
            <div class="form-group">
            </div>

            <div class="form-group valida_movimentacao">
                <label for="movimentacao_deposito_to_dispensario">Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="movimentacao_deposito_to_dispensario" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarInsumoDispensario" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>