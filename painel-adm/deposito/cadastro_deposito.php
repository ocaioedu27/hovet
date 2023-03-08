<div class="container">
    <div class="cadastro_body">
        <form class="form_cad astro" action="index.php?menuop=inserir_deposito" method="post">
            <div class="form-group">
                <h3>Cadastro de Insumo no Depósito</h3>
            </div>
            <div class="form-group">
                <label for="nomeInsumoDeposito">Nome</label>
                <input type="text" class="form-control" name="nomeInsumoDeposito" required>
            </div>
            <div class="form-group">
                <label for="quantidadeInsumoDeposito">Quantidade</label>
                <input type="text" class="form-control" name="quantidadeInsumoDeposito" required>
            </div>
            <div class="form-group">
                <label for="tipoInsumo">Tipo de Insumo</label>
                <select class="form-control-sm" name="tipoInsumo" required>
					<option>1</option>
					<option>2</option>
				</select>
                <li>1 - "Medicamento"</li>
                <li>2 - "Materiais de procedimentos médicos"</li>
            </div>
            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarInsumoDeposito">
            </div>
        </form>
    </div>
</div>