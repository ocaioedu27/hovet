<?php
$idInsumo = $_GET["idInsumo"];

$sql = "SELECT * FROM insumos WHERE id={$idInsumo}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($result);
?>

<div class="container cadastro_all">
    <div class="cards edita_insumo">
        <div class="voltar">
            <h4>Edição de Insumo</h4>
            <a href="index.php?menuop=insumos" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" action="index.php?menuop=atualizar_insumo" method="post">
            <div class="form-group">
                <label for="idInsumo">ID</label>
                <input type="text" class="form-control" name="idInsumo" value="<?=$dados["id"]?>" readonly>
            </div>
            <div class="form-group">
                <label for="nomeInsumo">Nome</label>
                <input type="text" class="form-control" name="nomeInsumo" value="<?=$dados["nome"]?>" required>
            </div>
            <div class="form-group">
                <label for="unidadeInsumo">Unidade do Insumo</label>
                <select class="form-control-sm" name="unidadeInsumo" required>
					<option>Caixa</option>
					<option>Pacote</option>
				</select>
            </div>
            <div class="form-group">
                <label for="tipoInsumo">Tipo de Insumo</label>
                <select class="form-control-sm" name="tipoInsumo" required>
                    <?php
                    
                    $sql_allTipos = "SELECT * FROM tipos_insumos ";
                    $result_allTipos = mysqli_query($conexao,$sql_allTipos) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                    
                    while($tipoInsumo = mysqli_fetch_assoc($result_allTipos)){
                    ?>
					    <option><?=$tipoInsumo["id"]?> - <?=$tipoInsumo["tipo"]?></option>
                    <?php
                        }
                    ?>
				</select>
            </div>
            <div class="form-group">
                <input type="submit" value="Atualizar" name="btnAtualizarInsumo" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>