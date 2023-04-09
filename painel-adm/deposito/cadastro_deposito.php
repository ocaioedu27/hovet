<div class="container cadastro_all">
    <div class="cards cadastro_deposito">
        <div class="voltar">
            <h4>Inserindo no Depósito</h4>
            <a href="index.php?menuop=deposito" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" action="index.php?menuop=inserir_deposito" method="post">
            <div class="form-group">
                <label for="insumoID_Insumodeposito">Nome</label>
                <select class="form-control-sm" name="insumoID_Insumodeposito" required>
                    <?php
                    
                    $sql = "SELECT id, nome FROM insumos";
                    $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                    
                    while($dados = mysqli_fetch_assoc($result)){
                    ?>
					<option><?=$dados["id"]?> - <?=$dados["nome"]?></option>

                    <?php
                        }
                    ?>
				</select>
            </div>
            <div class="form-group">
                <label for="quantidadeInsumodeposito">Quantidade</label>
                <input type="text" class="form-control" name="quantidadeInsumodeposito" required>
            </div>
            <div class="form-group">
                <label for="validadeInsumoDeposito">Validade</label>
                <input type="date" class="form-control" name="validadeInsumodeposito" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarInsumoDeposito" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>