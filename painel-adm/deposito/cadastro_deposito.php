<div class="container">
    <div class="cadastro_body">
        <form class="form_cadastro" action="index.php?menuop=inserir_deposito" method="post">
            <div class="form-group">
                <h4>Cadastro de Insumo no Depósito</h4>
            </div>
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
					<option >Medicamentos</option>
					<option >Materiais de procedimentos médicos</option>
				</select>
            </div>
            <div class="form-group">
                <label for="setorInsumoDeposito">Setor</label>
                <select class="form-control-sm" name="setorInsumoDeposito" required>
                    <?php
                    
                    $sql_allSetores = "SELECT setor FROM setores";
                    $result_allSetores = mysqli_query($conexao,$sql_allSetores) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                    
                    while($setor = mysqli_fetch_assoc($result_allSetores)){
                    ?>
					<option><?=$setor["setor"]?></option>

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
                <input type="submit" value="Cadastrar" name="btnAdicionarInsumoDeposito">
            </div>
        </form>
    </div>
</div>