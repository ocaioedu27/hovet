<?php
//$idInsumo = $_GET["idInsumo"];

$sql = "SELECT * FROM (SELECT nome,insumo_tipo FROM insumos) ims";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
//$dados = mysqli_fetch_assoc($result);
?>

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
					<option >1</option>
					<option >2</option>
				</select>
                <li>1 - "Medicamento"</li>
                <li>2 - "Materiais de procedimentos médicos"</li>
            </div>
            <div class="form-group">
                <label for="setorInsumoDeposito">Setor</label>
                <select class="form-control-sm" name="setorInsumoDeposito" required>
					<option>Setor 1</option>
					<option>Setor 2</option>
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