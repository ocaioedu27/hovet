<?php
$id = $_GET["id"];

$sql = "SELECT 
            cf_id,
            cf_categoria,
            cf_descricao
        FROM
            categorias_fornecedores
        WHERE
            cf_id={$id}";

$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($result);
?>

<div class="container cadastro_all">
    <div class="cards cadastro_categoria_insumo">
        <div class="voltar">
            <h4>Edição de Categoria</h4>
            <a href="index.php?menuop=categorias_fornecedores" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=atualizar_categoria_fornecedor" method="post">

            <div id="dados_categoria_fornecedores_cad">
                <hr>
                <div class="display-flex-row">
                    <div class="">

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl" style="width: auto;">
                                <label>ID</label>
                                <input type="text" class="form-control" name="idCategoria" value="<?=$dados['cf_id']?>" readonly>
                            </div>

                            <div class="display-flex-cl">
                                <label>Categoria</label>
                                <input type="text" class="form-control" name="nomeCategoria" placeholder="Infome o nome..." value="<?=$dados['cf_categoria']?>" required>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="display-flex-cl">
                                <label>Descrição da Categoria</label>
                                <textarea class="form-control" name="descCategoria" rows="3" placeholder="Infome a descrição..." ><?=$dados['cf_descricao']?></textarea>
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
                <input type="submit" value="Atualizar" name="btnAtualizar" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>