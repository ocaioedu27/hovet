<div class="container">
    <div class="cadastro_body">
        <form class="form_cad astro" action="index.php?menuop=inserir_insumo" method="post">
            <div class="form-group">
                <h3>Cadastro de Insumo</h3>
            </div>
            <div class="form-group">
                <label for="nomeInsumo">Nome</label>
                <input type="text" class="form-control" name="nomeInsumo">
            </div>
            <div class="form-group">
                <label for="unidadeInsumo">Unidade</label>
                <input type="email" class="form-control" name="unidadeInsumo">
            </div>
            <div class="form-group">
                <label for="tipoInsumo">Tipo de Insumo</label>
                <select class="form-control-sm" name="tipoInsumo">
					<option>1</option>
					<option>2</option>
				</select>
                <li>1 - "Medicamento"</li>
                <li>2 - "Materiais de procedimentos médicos"</li>
            </div>
            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarInsumo">
            </div>
        </form>
    </div>
</div>