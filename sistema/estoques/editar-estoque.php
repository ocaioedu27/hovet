<?php
$id = $_GET["id"];

$sql = "SELECT 
            e.id,
            e.nome,
            e.descricao,
            t.id as tp_id,
            t.tipo
        FROM
            estoques e
        INNER JOIN 
            tipos_estoques t
        ON
            e.tipos_estoques_id = t.id
        WHERE
            e.id={$id}";

$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($result);

// para coletar os tipos de estoques
$sql_tp_estoques = "SELECT * FROM tipos_estoques";
$resultado_tp_estoques = mysqli_query($conexao,$sql_tp_estoques) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

$dadosTpEstoque = mysqli_fetch_all($resultado_tp_estoques);
$stringTpEstoque = "";
// var_dump($dadosTpEstoque);
for($i = 0; $i < count($dadosTpEstoque); $i++){
    $id = $dadosTpEstoque[$i][0];
    $tipo = $dadosTpEstoque[$i][1];
    $stringTpEstoque .= '<option>'. $id .' - '. $tipo .'</option>';
}



?>

<div class="container cadastro_all">
    <div class="cards cadastro_categoria_insumo">
        <div class="voltar">
            <h4>Editar Estoque</h4>
            <a href="index.php?menuop=estoques" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=atualizar_estoque" method="post">

            <div id="dados_estoque_cad">
                <hr>
                <div class="display-flex-row">
                    <div class="">
                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl" style="width: auto;">
                                <label>ID</label>
                                <input type="text" class="form-control largura_um_quarto" name="idEstoque" value="<?=$dados['id']?>" readonly>
                            </div>
                        </div>

                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="nomeEstoque" value="<?=$dados['nome']?>" placeholder="Informe o nome..." required>
                            </div>

                            <div class="display-flex-cl">
                                <label>Tipo do Estoque</label>
                                <select class="form-control" name="tipoEstoque" required>
                                    <option><?=$dados['tp_id']?> - <?=$dados['tipo']?></option>
                                    <?=$stringTpEstoque?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Descrição</label>
                                <textarea name="descEstoque" class="form-control" rows="3" placeholder="Infome a descrição..." ><?=$dados['descricao']?></textarea>
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