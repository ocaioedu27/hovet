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
            <div class="form-group">
                <label for="depositoID_Insumodispensario">Nome</label>
                <select class="form-control-sm largura_metade" name="depositoID_Insumodispensario" id="" required>
                    <?php
                    
                    $sql = "SELECT
                        dep.deposito_validade,
                        dep.deposito_qtd,
                        dep.deposito_id,
                        ins.insumos_nome 
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
            <div class="form-group valida_movimentacao">
                <label for="quantidadeInsumoDispensario">Quantidade
                    <input type="text" class="form-control" name="quantidadeInsumoDispensario" required>
                </label>

                <label for="validadeInsumoDeposito">Validade
                    <input type="date" class="form-control" name="validadeInsumoDeposito" id="auto_complete_validade" readonly>
                </label>

                <label for="localInsumodispensario" style="
                        display: flex; 
                        flex-direction: column;">Local
                    <select class="form-control-sm" name="localInsumodispensario" id="depositoID_Insumodispensario" required>
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
                </label>
                
            </div>
            <div class="form-group">
                <label for="quantidadeInsumoDeposito"> Disponível no Depósito</label>
                <input type="text" class="form-control largura_metade" name="quantidadeInsumoDeposito" readonly>
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