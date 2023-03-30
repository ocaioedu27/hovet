<div class="container cadastro_all">
    <div class="cards cadastro_deposito">
        <div class="voltar">
            <h4>Cadastro no Depósito</h4>
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
                <label for="nomeInsumoDeposito">Nome</label>
                <select class="form-control-sm" name="nomeInsumoDeposito" required>
                    <?php
                    
                    $sql = "SELECT nome FROM insumos";
                    $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                    
                    while($dados = mysqli_fetch_assoc($result)){
                    ?>
					<option><?=$dados["nome"]?></option>

                    <?php
                        }
                    ?>
				</select>
            </div>
            <div class="form-group">
                <label for="quantidadeInsumoDeposito">Quantidade</label>
                <input type="text" class="form-control" name="quantidadeInsumoDeposito" required>
            </div>
            <div class="form-group">
                <label for="tipoInsumoDeposito">Tipo de Insumo</label>
                <select class="form-control-sm" name="tipoInsumoDeposito" required>
                    <?php
                    
                    $sql_alltipos = "SELECT * FROM tipos_insumos";
                    $result_alltipos = mysqli_query($conexao,$sql_alltipos) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                    
                    while($tiposInsu = mysqli_fetch_assoc($result_alltipos)){
                    ?>
					<option><?=$tiposInsu["id"]?> - <?=$tiposInsu["tipo"]?></option>

                    <?php
                        }
                    ?>
				</select>
            </div>
            <div class="form-group">
                <label for="setorInsumoDeposito">Setor</label>
                <select class="form-control-sm" name="setorInsumoDeposito" required>
                    <?php
                    
                    $sql_allSetores = "SELECT * FROM setores";
                    $result_allSetores = mysqli_query($conexao,$sql_allSetores) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                    
                    while($setor = mysqli_fetch_assoc($result_allSetores)){
                    ?>
					<option><?=$setor["id"]?> - <?=$setor["setor"]?></option>

                    <?php
                        }
                    ?>
				</select>
            </div>
            <div class="form-group">
                <label for="validadeInsumoDeposito">Validade</label>
                <input type="date" class="form-control" name="validadeInsumoDeposito" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarInsumoDeposito" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>