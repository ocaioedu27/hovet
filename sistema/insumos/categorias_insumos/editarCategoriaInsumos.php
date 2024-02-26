<?php
$id = $_GET["id"];

$sql = "SELECT 
            tipos_insumos_id,
            tipos_insumos_tipo,
            tipos_insumos_descricao
        FROM
            tipos_insumos
        WHERE
            tipos_insumos_id={$id}";

$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($result);

?>

<div class="container cadastro_all">
    <div class="cards cadastro_categoria_insumo">
        <div class="voltar">
            <h4>Editar Categoria</h4>
            <a href="index.php?menuop=categorias_insumos" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=atualizar_categoria_insumos" method="post">

            <div id="dados_categoria_insumos_cad">
                <hr>
                <div class="display-flex-row">
                    <div class="">

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl" style="width: auto;">
                                <label>ID</label>
                                <input type="text" class="form-control" name="idCategoriaInsumo" value="<?=$dados['tipos_insumos_id']?>" readonly>
                            </div>

                            <div class="display-flex-cl">
                                <label>Nome da Nova Categoria</label>
                                <input type="text" class="form-control" name="nomeCategoriaInsumo" value="<?=$dados['tipos_insumos_tipo']?>"  placeholder="Infome o nome..." required>
                            </div>

                        </div>

                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Descrição da Categoria</label>
                                <textarea name="descCategoriaInsumo" class="form-control" rows="3" placeholder="Infome a descrição..." ><?=$dados['tipos_insumos_descricao']?></textarea>
                            </div>
                        </div>
                    </div>

                </div> 

            </div>

            <div class="form-group valida_movimentacao">
                <label>Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="valida_dados_insercao_categoria" required>
            </div>

            
            <div class="form-group">
                <input type="submit" value="Atualizar" name="btnEditar" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>