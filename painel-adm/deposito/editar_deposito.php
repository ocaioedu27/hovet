<?php
$idInsumoDeposito = $_GET["idInsumoDeposito"];

$sql = "SELECT 
id,
nome,
quantidade,
tipo_insumoTipo,
setor_Setor,
date_format(validade, '%d/%m/%Y') as validade,
datediff(validade, curdate()) as diasParaVencimento FROM deposito WHERE id={$idInsumoDeposito}";

$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($result);
?>

<div class="container">
    <div class="cadastro_body">
        <form class="form_cadastro" action="index.php?menuop=atualizar_deposito" method="post">
            <div class="form-group">
                <h4>Edição de Insumo no Depósito</h4>
            </div>
            <div class="form-group">
                <label for="idInsumoDeposito">ID</label>
                <input type="text" class="form-control" name="idInsumoDeposito" value="<?=$dados["id"]?>" readonly>
            </div>
            <div class="form-group">
                <label for="nonomeInsumoDepositomeInsumo">Nome</label>
                <input type="text" class="form-control" name="nomeInsumoDeposito" value="<?=$dados["nome"]?>" required>
            </div>
            <div class="form-group">
                <label for="quantidadeInsumoDeposito">Quantidade</label>
                <input type="text" class="form-control" name="quantidadeInsumoDeposito" value="<?=$dados["quantidade"]?>" readonly>
            </div>
            <div class="form-group">
                <label for="tipoInsumoDeposito">Tipo</label>
                <select class="form-control-sm" name="tipoInsumoDeposito" required>
					<option >Medicamentos</option>
					<option >Materiais de procedimentos médicos</option>
				</select>
            </div>
            <div class="form-group">
                <label for="setorInsumoDeposito">Setor</label>
                <select class="form-control-sm" name="setorInsumoDeposito" readonly>
					<option><?=$dados["setor_Setor"]?></option>
				</select>
            </div>
            <div class="form-group">
                <label for="validadeInsumoDeposito">Validade</label>
                <input type="text" class="form-control" name="validadeInsumoDeposito" value="<?=$dados["validade"]?>" readonly>
            </div>
            <div class="form-group">
                <input type="submit" value="Atualizar" name="btnAtualizarInsumoDeposito">
            </div>
        </form>
    </div>
</div>