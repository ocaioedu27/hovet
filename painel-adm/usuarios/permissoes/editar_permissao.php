<?php 

$stringList = array();

if ( isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
    // $contador = 0;
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
        array_push($stringList, $valor_est);

	}
    // var_dump($stringList);

    $idPermissao_tmp = $stringList[1];

    $idPermissao = $_GET[$idPermissao_tmp];

}

$sql = "SELECT 
            *
        FROM 
            permissoes_usuario
        WHERE 
            permissoes_id = {$idPermissao}";

$result = mysqli_query($conexao,$sql) or die("//editar_permissoes/Select_Geral - Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($result);

?>

<div class="container cadastro_all">
    <div class="cards cadastro_insumo">
        <div class="voltar">
            <h4>Editando Permissão <?=$dados["permissoes_id"]?></h4>
            <a href="index.php?menuop=permissoes" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" action="index.php?menuop=atualizar_permissoes" method="post">

            <div id="dados_permissoes_cad">
                <hr>
                <div class="display-flex-row">

                    <div class="form-group">

                        <div class="display-flex-cl">
                            <label>ID</label>
                            <input type="text" class="form-control largura_um_quarto" name="idPermissao" value="<?=$dados["permissoes_id"]?>" readonly>
                        </div>

                        <div class="display-flex-cl">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="nomePermissao" value="<?=$dados["permissoes_nome"]?>">
                        </div>

                        <div class="display-flex-cl">
                            <label>Descrição</label>
                            <textarea class="form-control" name="descPermissao" rows="3"><?=$dados["permissoes_desc"]?></textarea>
                        </div>

                    </div>

                </div> 
                <hr style="border: none"> 
                <hr> 

            </div>

            <div class="form-group valida_movimentacao">
                <label>Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="valida_dados_insercao_insumos" required>
            </div>

            
            <div class="form-group">
                <input type="submit" value="Atualizar" name="btnEditarPermissao" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>