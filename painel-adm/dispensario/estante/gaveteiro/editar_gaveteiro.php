<?php
$idInsumoDispensario = $_GET["idInsumoDispensario"];

$sql = "SELECT * FROM Dispensario WHERE id={$idInsumoDispensario}";

$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($result);
?>

<div class="container">
    <div class="cadastro_body">
        <div class="voltar">
            <h4>Cadastro de Insumo no Dispensário</h4>
            <a href="index.php?menuop=Dispensario" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" action="index.php?menuop=atualizar_Dispensario" method="post">
            <div class="form-group">
                <h4>Edição de Insumo no Depósito</h4>
            </div>
            <div class="form-group">
                <label for="idInsumoDispensario">ID</label>
                <input type="text" class="form-control" name="idInsumoDispensario" value="<?=$dados["id"]?>" readonly>
            </div>
            <div class="form-group">
                <label for="nonomeInsumoDispensariomeInsumo">Nome</label>
                <input type="text" class="form-control" name="nomeInsumoDispensario" value="<?=$dados["nome"]?>" required>
            </div>
            <div class="form-group">
                <label for="quantidadeInsumoDispensario">Quantidade</label>
                <input type="text" class="form-control" name="quantidadeInsumoDispensario" value="<?=$dados["quantidade"]?>" readonly>
            </div>
            <div class="form-group">
                <label for="tipoInsumoDispensario">Tipo</label>
                <select class="form-control-sm" name="tipoInsumoDispensario" required>
					<option >Medicamentos</option>
					<option >Materiais de procedimentos médicos</option>
				</select>
            </div>
            <div class="form-group">
                <label for="setorInsumoDispensario">Setor</label>
                <select class="form-control-sm" name="setorInsumoDispensario" readonly>
					<option><?=$dados["setor_Setor"]?></option>
				</select>
            </div>
            <div class="form-group">
                <label for="validadeInsumoDispensario">Validade</label>
                <input type="text" class="form-control" name="validadeInsumoDispensario" value="<?=$dados["validade"]?>" readonly>
            </div>
            <div class="form-group">
                <input type="submit" value="Atualizar" name="btnAtualizarInsumoDispensario">
            </div>
        </form>
    </div>
</div>