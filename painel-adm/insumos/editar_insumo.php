<?php
$idInsumo = $_GET["idInsumo"];

$sql = "SELECT * FROM insumos WHERE insumos_id={$idInsumo}";
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

            <div class="form-group valida_movimentacao">

                <div class="display-flex-cl">
                    <label>ID</label>
                    <input type="text" class="form-control" name="idInsumo" value="<?=$dados["insumos_id"]?>" readonly>
                </div>

                <div class="display-flex-cl">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="nomeInsumo" value="<?=$dados["insumos_nome"]?>" required>
                </div>

                <div class="display-flex-cl">
                    <label>Quantidade Crítica</label>
                    <input type="number" class="form-control" name="qtdCriticaInsumo" value="<?=$dados["insumos_qtd_critica"]?>" required>
                </div>

            </div>

            <div class="form-group valida_movimentacao">

                <div class="display-flex-cl">
                    <label>Tipo de Insumo</label>
                    <select class="form-control" name="tipoInsumo" required>
                        <?php
                        
                        $sql_allTipos = "SELECT * FROM tipos_insumos ";
                        $result_allTipos = mysqli_query($conexao,$sql_allTipos) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                        
                        while($tipoInsumo = mysqli_fetch_assoc($result_allTipos)){
                        ?>
                            <option><?=$tipoInsumo["tipos_insumos_id"]?> - <?=$tipoInsumo["tipos_insumos_tipo"]?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="display-flex-cl">
                    <label>Unidade</label>
                    <select name="unidadeInsumo" class="form-control" id="" required>
                        <option>Caixa</option>
                        <option>Pacote</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="display-flex-cl">
                    <label>Descrição</label>
                    <textarea class="form-control" name="descricaoInsumo" rows="3" required><?=$dados["insumos_descricao"]?></textarea>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="Atualizar" name="btnAtualizarInsumo" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>