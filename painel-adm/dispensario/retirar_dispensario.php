<div class="container cadastro_all">
    <div class="cards retirar_dispensario">
        <div class="voltar form_retirada">
            <h4>Retirando itens do Dispensário</h4>
            <a href="index.php?menuop=dispensario" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form action="index.php?menuop=atualizar_dispensario" class="form_retirar_dispensario" method="post">

            <div class="form-group requisicao_devolucao valida_movimentacao">
                
                <label for="solicitante_retira_dispensario">Solicitante
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
                </label>

                <label for="operacao_dispensario">Tipo de operação
                    <select class="form-control-sm" name="operacao_dispensario">
                        <option>1 - Requição de Material</option>
                        <option>2 - Devolução de Material</option>
                    </select>
                </label>
                
            </div>

            <div class="form-group valida_movimentacao">

                <div class="display-flex-cl">
                    <label for="setor_destino_retira_dispensario">Setor Destino</label>
                    <select class="form-control-sm largura_um_terco" name="setor_destino_retira_dispensario" id="" required>
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
                    <label for="data_operacao_dispensario">Data</label>
                    <input type="date" class="form-control-sm"  name="data_operacao_dispensario" id="" required>
                </div>
            
            </div>

            <div class="form-group valida_movimentacao">
                
                <div class="display-flex-cl">
                    <label for="dispensario_id">Insumo</label>
                    <select class="form-control-sm largura_um_terco" name="dispensario_id" id="dispensario_id" >
                        <?php
                        $sql = "SELECT
                            disp.dispensario_qtd,
                            ins.insumos_nome,
                            disp.dispensario_id
                            FROM dispensario disp
                            INNER JOIN deposito dep
                            ON disp.dispensario_deposito_id = dep.deposito_id 
                            INNER JOIN insumos ins 
                            ON dep.deposito_insumos_id = ins.insumos_id";
                        $result = mysqli_query($conexao,$sql) or die("//dispensario/retirar_insumo_dispensario - Erro ao realizar a consulta. " . mysqli_error($conexao));
                        
                        while($dados = mysqli_fetch_assoc($result)){
                        ?>
                        <option><?=$dados["dispensario_id"]?> - <?=$dados["insumos_nome"]?></option>

                        <?php
                            }
                        ?>
                    </select>
                </div>

                
                <div class="display-flex-cl">
                    <label for="quantidade_operacao_dispensario">Quantidade</label>
                    <input type="text" class="form-control largura_um_terco" name="quantidade_operacao_dispensario" required>
                </div>

                
                <div class="display-flex-cl">
                    <label for="validade_insumo_dispensario"> Validade do Insumo</label>
                    <input type="text" class="form-control largura_um_terco" name="validade_insumo_dispensario" id="validade_insumo_dispensario" readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="quantidade_atual_dispensario"> Quantidade atual no Dispensário
                    <input type="text" class="form-control largura_um_quarto" name="quantidade_atual_dispensario" id="quantidade_atual_dispensario" readonly>
                </label>
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
    




