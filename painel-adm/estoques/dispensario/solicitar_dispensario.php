<div class="container cadastro_all">
    <div class="cards retirar_dispensario">
        <div class="voltar form_retirada">
            <h4>Solicitando itens do Dispensário</h4>
            <a href="index.php?menuop=dispensario" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form action="index.php?menuop=atualizar_dispensario" class="form_retirar_dispensario" method="post">
            
            <div class="dados_solicitante">
                <hr>
                <h3>Dados da solicitação</h3>
                
                <div class="form-group valida_movimentacao">

                    <div class="display-flex-cl">
                        <label for="solicitante_retira_dispensario">Solicitante</label>
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
                        
                    <div class="display-flex-cl">
                        <label for="operacao_dispensario">Tipo de operação</label>
                        <select class="form-control" name="operacao_dispensario">
                            <option>1 - Requição de Material</option>
                            <option>2 - Devolução de Material</option>
                        </select>
                    </div>

                    </div>

                    <div class="form-group valida_movimentacao">

                    <div class="display-flex-cl">
                        <label for="setor_destino_retira_dispensario">Setor Destino</label>
                        <select class="form-control largura_metade" name="setor_destino_retira_dispensario" id="" required>
                            <?php
                            $sql = "SELECT * FROM setores";
                            $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                            
                            while($dados = mysqli_fetch_assoc($result)){
                            ?>
                            <option><?=$dados["setores_id"]?> - <?=$dados["setores_setor"]?></option>

                            <?php
                                }
                            ?>
                        </select>
                    </div>

                    <div class="display-flex-cl">
                        <label for="data_operacao_dispensario">Data e horário da solicitação</label>
                        <input type="datetime-local" class="form-control"  name="data_operacao_dispensario" id="" required>
                    </div>

                </div>
                <hr style="border: 0;">
            </div>
            
            <div id="dados_insumo_disp">
                <hr>
                <div>
                    <h3 class="">Dados do insumo</h3>
                    <div class="form-group valida_movimentacao">
                    
                        <div class="display-flex-cl" style="margin-right: 30px;">
                            <label>Insumo Solicitado</label>
                            <input type="text" class="form-control" name="insumo_dispensario_id[]" id="insumo_dispensario_id1" onkeyup="searchInput_cadDeposito(this.value, 1, 3)"  placeholder="Informe o insumo..." required>
                            <span class="ajuste_span" id="resultado_slc_disp_insumos1" style="margin: 6.5% auto;"></span>
                        </div>
             
                        <div class="display-flex-cl">
                            <label>Quantidade Solicitada</label>
                            <input type="number" class="form-control largura_um_terco" name="quantidade_insumo_dispensario[]" min="1" required>
                        </div>

                        <div class="display-flex-cl">
                            <label for="validade_insumo_dispensario">Validade do Insumo</label>
                            <input type="date" class="form-control largura_um_terco" name="validade_insumo_dispensario[]" id="validade_insumo_dispensario1" readonly>
                        </div>

                        <div class="display-flex-cl">
                            <label for="quantidade_atual_dispensario">Disponível no Dispensário</label>
                            <input type="number" class="form-control largura_um_terco" name="quantidade_atual_dispensario[]" id="quantidade_atual_dispensario1" readonly>
                        </div>
                    </div>

                    <div class="form-group valida_movimentacao">

                        <div class="display-flex-cl">
                            <label>Descrição</label>
                            <textarea type="text" class="form-control largura_metade" id="descricaoInsumoSclDisp1" readonly></textarea>
                        </div>

                        <button class="btn" type="button" onclick="adicionaCampoCad(4)" style="padding: 0;">+</button>
                    </div>
                    <hr style="border: 0;">
                </div>
            </div>
            <hr>


            <div class="form-group valida_movimentacao">
                <div class="display-flex-cl">
                    <label for="justifica_requisicao">Justificativa</label>
                    <textarea name="justifica_requisicao" cols="25" rows="4" class="form-control"></textarea required>
                </div>
            </div>

            
            <div class="form-group valida_movimentacao">
                <label for="movimentacao_dispensasrio_to_setor">Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="movimentacao_dispensasrio_to_setor" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Retirar" name="btnRetirarInsumoDispensario" class="btn_cadastrar">
            </div>
        </form>
    </div> 
</div>
    




