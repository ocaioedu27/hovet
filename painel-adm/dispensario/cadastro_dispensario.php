

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
                <select class="form-control-sm" name="depositoID_Insumodispensario" id="depositoID_Insumodispensario" required>
                    <?php
                    
                    $sql = "SELECT
                        dep.deposito_Validade,
                        dep.deposito_Qtd,
                        dep.deposito_id,
                        ins.nome 
                        FROM deposito dep 
                        INNER JOIN insumos ins 
                        ON dep.deposito_InsumosID = ins.id";
                    $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                    
                    while($dados = mysqli_fetch_assoc($result)){
                    ?>
					<option><?=$dados["deposito_id"]?> - <?=$dados["nome"]?></option>

                    <?php
                        }
                    ?>
				</select>
            </div>
            <div class="form-group">
                <label for="quantidadeInsumoDispensario">Quantidade</label>
                <input type="text" class="form-control" name="quantidadeInsumoDispensario" required>
                <label for="quantidadeInsumoDeposito"> Disponível no Depósito<input type="text" class="form-control" name="quantidadeInsumoDeposito" id="auto_complete_DepsQtd" readonly>
                </label>
            </div>
            <div class="form-group">
                <label for="validadeInsumoDeposito">Validade</label>
                <input type="date" class="form-control" name="validadeInsumoDeposito" id="auto_complete_validade" required>
            </div>
            <div class="form-group">
                <label for="localInsumodispensario">Local</label>
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
            </div>
            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarInsumoDispensario" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>