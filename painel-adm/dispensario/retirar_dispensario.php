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
        <form action="" class="form_retirar_dispensario">

            <div class="form-group requisicao_devolucao">
                <label for="operacao_retira_dispensario">Tipo de operação</label>
                <select class="form-control-sm" name="operacao_retira_dispensario">
                    <option>Requição de Material</option>
                    <option>Devolução de Material</option>
                </select>
                
            </div>

            <div class="form-group">
                <label for="solicitante_retira_dispensario">Solicitante</label>
                <select class="form-control-sm" name="solicitante_retira_dispensario" required>
                    <?php
                    $sql = "SELECT * FROM usuarios";
                    $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                    
                    while($dados = mysqli_fetch_assoc($result)){
                    ?>
					<option><?=$dados["usuario_id"]?> - <?=$dados["usuario_nome"]?></option>

                    <?php
                        }
                    ?>
				</select>
            </div>

            <div class="form-group">
                <label for="setor_destino_retira_dispensario">Setor Destino</label>
                <select class="form-control-sm" name="setor_destino_retira_dispensario" id="" required>
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

            <div class="form-group">
                <label for="data_retira_dispensario">Data
                    <input type="date" class="form-control"  name="data_retira_dispensario" id="" required>
                </label>
            </div>

            <div class="form-group">
                <label for="dispensario_id">Informe o insumo</label>
                <select name="dispensario_id" id="dispensario_id" >
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

            <div class="form-group">
                <label for="quantidade_retira_dispensario">Quantidade</label>
                <input type="text" class="form-control" name="quantidade_retira_dispensario" required>
            </div>

            <div class="form-group">
                <label for="quantidade_atual_dispensario"> Disponível no Dispensário
                    <input type="text" class="form-control" name="quantidade_atual_dispensario" id="quantidade_atual_dispensario" readonly>
                </label>
            </div>

            <div class="form-group">
                <input type="submit" value="Retirar" name="btnRetirarInsumoDispensario" class="btn_cadastrar">
            </div>
        </form>
    </div> 
</div>
    




