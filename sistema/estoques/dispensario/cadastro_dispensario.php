<?php


if (   isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
		// $$chave = $valor;
        // print_r($valor_est);
	}
}

$qualEstoque_dep = $valor_est;
$dep = 'dep';


if ($qualEstoque_dep != "") {
    $qualEstoque = $qualEstoque_dep;
    if (strpos($qualEstoque, $dep)) {
        $tipoEstoque = substr($qualEstoque, 0, -1);
    } else{
        $tipoEstoque = substr($qualEstoque, 0, -1);
    }
    // echo "é dep: " . $qualEstoque;
}


$tipoEstoque = $tipoEstoque;

?>

<div class="container cadastro_all">
    <div class="cards cadastro_dispensario">
        <div class="voltar">
            <h4>Abastecendo Dispensário</h4>
            <a href="index.php?menuop=<?=$tipoEstoque?>_resumo&<?=$qualEstoque?>=1" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=inserir_dispensario&<?=$qualEstoque?>" method="post">
            <div class="dados_solicitacao">
                <hr>
                <h3 class="">Dados de Auditoria</h3>
                <div class="form-group valida_movimentacao">
                    <div class="display-flex-cl">
                        <?php
                            $sql_mov = "SELECT 
                                id,
                                movimentacao
                                FROM tipos_movimentacoes
                                WHERE movimentacao='Move para o Dispensário'";
                                
                            $resultado_mov = mysqli_query($conexao, $sql_mov) or die("//dispensario/sql_mov - erro ao realiza" . mysqli_error($conexao));

                            $dados_mov = mysqli_fetch_assoc($resultado_mov);
                            
                        ?>
                        <label for="mov_dep_to_disp">Tipo de operação</label>
                        <input type="text" class="form-control largura_um_terco" name="mov_dep_to_disp" value="<?=$dados_mov['id']?> - <?=$dados_mov['movimentacao']?>" readonly>
                    </div>
                    
                    <div class="display-flex-cl">
                        <?php
                        $sql = "SELECT * FROM usuarios WHERE id={$sessionUserID}";
                        $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                        
                        $dados_user = mysqli_fetch_assoc($result)
                        ?>
                        <label for="solicitante_retira_dispensario">Solicitante</label>
                        <input type="text" class="form-control largura_um_terco" name="solicitante_retira_dispensario" value="<?=$dados_user['id']?> - <?=$dados_user['primeiro_nome']?>" readonly>
                    </div>

                    <div class="display-flex-cl">
                        <label>Data da transferência</label>
                        <input type="date" class="form-control" name="dataTransferDepToDisp" required>
                    </div>
                </div>
            </div>
            
            <div id="dados_insumo_disp">
                <hr>
                <h3 class="">Dados do Insumo</h3>
                <div>
                    <div class="form-group valida_movimentacao">
                        <div class="display-flex-cl">
                            <label>Insumo</label>
                            <input type="text" class="form-control" name="insumoID_Insumodispensario[]" id="insumoID_Insumodispensario1" onkeyup="searchInput_cadDeposito(this.value, 1, 2)" placeholder="Procure pelo nome do insumo..." required>
                            <span class="ajuste_span" id="resultado_cad_disp_insumos1"></span>
                        </div>
                        <div class="display-flex-cl">
                            <label for="quantidadeInsumoDisponivelDeposito">Disponível no Depósito</label>
                            <input type="text" class="form-control largura_um_terco" name="quantidadeInsumoDisponivelDeposito" id="quantidadeInsumoDisponivelDeposito1" onchange="verificaValorMaximoExcedido('quantidadeMovidaParaDispensario1','quantidadeInsumoDisponivelDeposito1','alerta_valor_acima_max1','btn_mv_insumo_dep_to_disp')" readonly>
                        </div>
                            
                        <div class="display-flex-cl">
                            <label>Dispensário de Destino</label>
                            <input type="text" class="form-control" name="dispensarioDestino[]" id="estoqueDestino1" onkeyup="searchInput_cadDeposito(this.value, 1, 5,'dispensario')" placeholder="Informe o dispensário..." required>
                            <span class="ajuste_span" id="resultado_cad_deposito_estoque1"></span>
                        </div>

                    </div>
                    <div class="form-group valida_movimentacao">

                        <div class="display-flex-cl">
                            <label for="quantidadeInsumoDispensario">Quantidade Transferida</label>
                            <input type="number" class="form-control" name="quantidadeInsumoDispensario[]" min="1" id="quantidadeMovidaParaDispensario1" onkeyup="verificaValorMaximoExcedido('quantidadeMovidaParaDispensario1','quantidadeInsumoDisponivelDeposito1','alerta_valor_acima_max1','btn_mv_insumo_dep_to_disp', 'label_mesage_to_insert_1')" placeholder="Informe a quantidade..." required>
                            <span class="alerta_senhas_iguais" style="display: none; margin-top: 2%;" id="alerta_valor_acima_max1">
                                <label id="label_mesage_to_insert_1">Valor acima ou igual do que há disponível!<ion-icon name="alert-circle-outline"></ion-icon></label>
                            </span>
                        </div>

                        <div class="display-flex-cl">
                            <label for="validadeInsumoDeposito">Validade</label>
                            <input type="date" class="form-control" name="validadeInsumoDeposito[]" id="validadeInsumoDeposito1" readonly>
                        </div>

                        <div class="display-flex-cl">
                            <label for="localInsumodispensario">Local</label>
                            <select class="form-control" name="localInsumodispensario[]" id="localInsumodispensario1" required>
                                <option>1 - Armário</option>
                                <option>2 - Estante</option>
                                <option>3 - Gaveteiro</option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="form-group valida_movimentacao">
                        <div class="display-flex-cl">
                            <label for="descricaoInsumoDeposito">Descrição do insumo</label>
                            <textarea name="descricaoInsumoDeposito" cols="10" rows="2" class="form-control largura_metade" id="descricaoInsumoDeposito1" readonly></textarea>
                        </div>

                        <button class="btn" type="button" onclick="adicionaCampoCad(2)" style="padding: 0;">+</button>
                    </div>
                </div>
            </div>

            <div class="form-group valida_movimentacao">
                <label for="movimentacao_deposito_to_dispensario">Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="movimentacao_deposito_to_dispensario" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarInsumoDispensario" class="btn_cadastrar" id="btn_mv_insumo_dep_to_disp">
            </div>
        </form>
    </div>
</div>