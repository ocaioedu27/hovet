<div class="container cadastro_all">
    <div class="cards permuta">
        <div class="voltar">
            <h3>Permutando itens do Depósito</h3>
            <a href="index.php?menuop=deposito" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=atualizar_deposito" method="post">
            <hr>

            <div class="dados_solicitacao">
                <h4>Dados da Movimentação</h4>
                <div class="form-group valida_movimentacao">
                    <div class="display-flex-cl">
                        <?php
                            $sql_mov = "SELECT 
                                tipos_movimentacoes_id,
                                tipos_movimentacoes_movimentacao
                                FROM tipos_movimentacoes
                                WHERE tipos_movimentacoes_movimentacao='Permuta'";
                                
                            $resultado_mov = mysqli_query($conexao, $sql_mov) or die("//permuta/sql_mov - erro ao realiza" . mysqli_error($conexao));

                            $dados_mov = mysqli_fetch_assoc($resultado_mov);
                            
                        ?>
                        <label for="mov_dep_to_disp">Tipo de operação</label>
                        <input type="text" class="form-control largura_um_terco" name="mov_dep_to_disp" value="<?=$dados_mov['tipos_movimentacoes_id']?> - <?=$dados_mov['tipos_movimentacoes_movimentacao']?>" readonly>
                    </div>
                    
                    <div class="display-flex-cl">
                        <label for="solicitante_retira_dispensario">Quem está realizando</label>
                        <select class="form-control largura_um_terco" name="solicitante_retira_dispensario" required>
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

                    <div class="display-flex-cl">
                        <label>Data da transferência</label>
                        <input type="date" class="form-control" name="dataTransferDepToDisp" required>
                    </div>
                </div>
            </div>

            <hr>
            <div class="display-flex-cl" id="dados_insumo_permuta_dep">
                <div class="display-flex-row">
                    <div id="permuta_dep">
                        <h4>Item a ser retirado do Depósito</h4>
                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Insumo</label>
                                <input type="text" class="form-control largura_um_terco" name="insumoID_InsumoPermuta[]" id="permuta_deposito_insumo_id_1" onkeyup="searchInput_cadDeposito(this.value, 1, 4)" placeholder="informe o nome do insumo..." required>
                                <span class="ajuste_span" id="resultado_permuta_insumos1" style="margin: 9.5% auto;"></span>
                            </div>

                            <div class="display-flex-cl">
                                <label>Validade</label>
                                <input type="date" class="form-control largura_um_terco" name="validadeInsumoDeposito[]" id="validadeInsumoDepositoPermuta1" readonly>
                            </div>
                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Quantidade Permutada</label>
                                <input type="number" class="form-control largura_metade" name="quantidadeInsumoDepositoPermuta[]" min="1" required>
                            </div>
                            
                            <div class="display-flex-cl">
                                <label> Disponível no Depósito</label>
                                <input type="text" class="form-control largura_metade" name="quantidadeInsumoDisponivelDeposito" id="quantidade_atual_deposto_permuta1" readonly>
                            </div>
                        </div>

                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Descrição do insumo</label>
                                <textarea name="descricaoInsumoDeposito" cols="10" rows="2" class="form-control largura_metade" id="descricaoInsumoDepositoPermuta1" readonly></textarea>
                            </div>
                        </div>
                    </div>

                    <div id="permuta_dep">
                        <h4>Item a ser atualizado do Depósito</h4>
                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Insumo</label>
                                <input type="text" class="form-control largura_um_terco" name="insumoID_InsumoPermuta[]" id="permuta_deposito_insumo_id_2" onkeyup="searchInput_cadDeposito(this.value, 2, 4)" placeholder="informe o nome do insumo..." required>
                                <span class="ajuste_span" id="resultado_permuta_insumos2" style="margin: 9.5% auto;"></span>
                            </div>

                            <div class="display-flex-cl">
                                <label for="validadeInsumoDeposito">Validade</label>
                                <input type="date" class="form-control largura_um_terco" name="validadeInsumoDeposito[]" id="validadeInsumoDepositoPermuta2" required>
                            </div>
                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Quantidade Inserida</label>
                                <input type="number" class="form-control largura_metade" name="quantidadeInsumoDepositoPermuta[]" min="1" required>
                            </div>
                            
                            <div class="display-flex-cl">
                                <label> Disponível no Depósito</label>
                                <input type="text" class="form-control largura_metade" name="quantidadeInsumoDisponivelDeposito" id="quantidade_atual_deposto_permuta2" >
                            </div>
                        </div>
                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label for="descricaoInsumoDeposito">Descrição do insumo</label>
                                <textarea name="descricaoInsumoDeposito" cols="10" rows="2" class="form-control largura_metade" id="descricaoInsumoDepositoPermuta2" readonly></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group valida_movimentacao">

                        <button class="btn" type="button" onclick="adicionaCampoCad(5)" style="padding: 0;">+</button>

                    </div>

                </div>
            </div>
            

            <div class="form-group valida_movimentacao">
                <label for="movimentacao_deposito_to_dispensario">Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="movimentacao_deposito_to_dispensario" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Permutar" name="btnAdicionarInsumoDispensario" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>
