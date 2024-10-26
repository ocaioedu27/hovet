<?php
$id = $_GET["id"];

$sql = "SELECT 
            id,
            tipo
        FROM
            tipos_estoques
        WHERE
            id={$id}";

$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

$dadosTpEstoque = mysqli_fetch_assoc($result);

?>

<div class="container cadastro_all">
    <div class="cards cadastro_insumo">
        <div class="voltar">
            <h4>Cadastro de Novo Tipo de Estoque</h4>
            <a href="index.php?menuop=tp_estoque" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=att_tp_estoque" method="post">
            <div id="dados_tipo_estoque_cad">
                <hr>
                <div class="display-flex-row">
                    <div class="form-group">
                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>ID</label>
                                <input type="text" class="form-control largura_um_quarto" name="id" value="<?=$dadosTpEstoque['id']?>" readonly>
                            </div>
                        </div>
                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Nome do Tipo de Estoque</label>
                                <input type="text" class="form-control" name="tipo" value="<?=$dadosTpEstoque['tipo']?>" required>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="form-group valida_movimentacao">
                <label>Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="valida_dados_insercao_estoque" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Editar" name="btn_editar" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>