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

    $idCategoria = $stringList[1];

    $categoriaId = $_GET[$idCategoria];

}

?>

<div class="container cadastro_all">
    <div class="cards cadastro_insumo">
        <div class="voltar">
            <h4>Criar de Nova Permissão</h4>
            <a href="index.php?menuop=permissoes" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=inserir_permissoes" method="post">

            <div id="dados_permissoes_cad">
                <hr>
                <div class="display-flex-row">
                    <div class="form-group">

                        <div class="display-flex-cl">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="nomePermissao[]" required>
                        </div>

                        <div class="display-flex-cl">
                            <label>Descrição</label>
                            <textarea class="form-control" name="descPermissao[]" rows="3" required></textarea>
                        </div>

                    </div>

                    <div>
                        <button class="btn" type="button" onclick="adicionaCampoCad(10)" style="padding: 0;">+</button>
                    </div>

                </div> 
                <hr style="border: none;"> 

            </div>

            <div class="form-group valida_movimentacao">
                <label for="valida_dados_insercao_insumos">Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="valida_dados_insercao_insumos" required>
            </div>

            
            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnCriarPermissao" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>