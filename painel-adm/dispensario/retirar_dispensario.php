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
                <label for="requisicao_retira_dispensario">Requisição de Materiais
                    <input type="checkbox" name="requisicao_retira_dispensario" id="" required>
                </label>

                <label for="devolucao_retira_dispensario">Devolução de Materiais
                    <input type="checkbox" name="devolucao_retira_dispensario" id="" required>
                </label>
                
            </div>

            <div class="form-group">
                <label for="solicitante_retira_dispensario">Solicitante</label>
                <!-- <input type="text" class="form-control" name="solicitante_retira_dispensario" required> -->
                <select class="form-control-sm" name="solicitante_retira_dispensario" id="" required>
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
                <!-- <input type="text" class="form-control" name="setor_destino_retira_dispensario" required> -->
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
                <label for="quantidade_retira_dispensario">Quantidade</label>
                <input type="text" class="form-control" name="quantidade_retira_dispensario" required>
            </div>

            <div class="form-group">
                <label for="descricao_retira_dispensario">Descrição</label>
                <input type="text" class="form-control descricao_retira_dispensario" name="descricao_retira_dispensario" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Retirar" name="btnRetirarInsumoDispensario" class="btn_cadastrar">
            </div>
        </form>
    </div> 
</div>
    




