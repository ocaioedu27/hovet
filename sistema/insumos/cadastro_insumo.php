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
            <h4>Cadastro de Insumo</h4>
            <a href="index.php?menuop=insumos&categoriaInsumoId=<?=$categoriaId?>" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=inserir_insumo&categoriaInsumoId=<?=$categoriaId?>" method="post">

            <div id="dados_insumos_cad">
                <hr>
                <div>
                    <div class="form-group valida_movimentacao">

                        <div class="display-flex-cl">
                            <label for="nomeInsumo">Nome</label>
                            <input type="text" class="form-control" name="nomeInsumo[]" placeholder="Informe o nome..." required>
                        </div>

                        <div class="display-flex-cl">
                            <label>Quantidade Crítica</label>
                            <input type="number" class="form-control" name="qtdCriticaInsumo[]" min="1" onkeyup="verifica_valor('valor_qtd_1', 'msg_alerta_1', 'btn_cadastrar', '0')" id="valor_qtd_1" placeholder="Informe a quantidade crítica..." required>
                            <span class="alerta_senhas_iguais" style="display: none;" id="msg_alerta_1">
                                <label>
                                        Valor inválido! Por favor, altere para um valor válido!
                                        <ion-icon name="alert-circle-outline"></ion-icon>
                                </label>
                            </span>
                        </div>

                    </div>

                    <div class="form-group valida_movimentacao">

                        <div class="display-flex-cl">    
                            <label>Unidade</label>
                            <select class="form-control" name="unidadeInsumo[]" required>
                                <option>Caixa</option>
                                <option>Pacote</option>
                            </select>
                        </div>

                        <div class="display-flex-cl">
                            <label>Tipo de Insumo</label>
                            <input type="text" class="form-control" name="tipoInsumo[]" id="tipos_insumo_1" onkeyup="searchInput_cadDeposito(this.value, 1,6)" placeholder="Informe o nome da categoria..." required/>
                            <span class="ajuste_span" id="resultado_cad_categoria_insumo_1" style="margin: 9.2% auto; width: auto;"></span>
                        </div>

                    </div>

                    <div class="form-group valida_movimentacao">

                        <div class="display-flex-cl">
                            <label>Descrição</label>
                            <textarea class="form-control largura_metade" name="descricaoInsumo[]" rows="3" required></textarea>
                        </div>

                        <button class="btn" type="button" onclick="adicionaCampoCad(3)" style="padding: 0;">+</button>

                    </div>

                </div> 

            </div>

            <div class="form-group valida_movimentacao">
                <label for="valida_dados_insercao_insumos">Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="valida_dados_insercao_insumos" required>
            </div>

            
            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarInsumo" class="btn_cadastrar" id="btn_cadastrar">
            </div>
        </form>
    </div>
</div>