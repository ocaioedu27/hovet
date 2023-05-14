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


if ($qualEstoque_dep != "") {
    $qualEstoque = $qualEstoque_dep;
    // echo "é dep: " . $qualEstoque;
}

?>

<div class="container cadastro_all">
    <div class="cards cadastro_dispensario">
        <div class="voltar">
            <h4>Movendo itens do Depósito para o Dispensário</h4>
            <a href="index.php?menuop=dispensario&<?=$qualEstoque?>=1" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=inserir_dispensario&<?=$qualEstoque?>" method="post">
            <div class="dados_solicitacao">
                <div class="form-group valida_movimentacao">
                    <div class="display-flex-cl">
                        <?php
                            $sql_mov = "SELECT 
                                tipos_movimentacoes_id,
                                tipos_movimentacoes_movimentacao
                                FROM tipos_movimentacoes
                                WHERE tipos_movimentacoes_movimentacao='Move para o Dispensário'";
                                
                            $resultado_mov = mysqli_query($conexao, $sql_mov) or die("//dispensario/sql_mov - erro ao realiza" . mysqli_error($conexao));

                            $dados_mov = mysqli_fetch_assoc($resultado_mov);
                            
                        ?>
                        <label for="mov_dep_to_disp">Tipo de operação</label>
                        <input type="text" class="form-control largura_um_terco" name="mov_dep_to_disp" value="<?=$dados_mov['tipos_movimentacoes_id']?> - <?=$dados_mov['tipos_movimentacoes_movimentacao']?>" readonly>
                    </div>
                    
                    <div class="display-flex-cl">
                        <label for="solicitante_retira_dispensario">Solicitante</label>
                        <select class="form-control largura_um_terco" name="solicitante_retira_dispensario" required>
                            <?php
                            $sql = "SELECT * FROM usuarios";
                            $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                            
                            while($dados = mysqli_fetch_assoc($result)){
                            ?>
                            <option><?=$dados["usuario_id"]?> - <?=$dados["usuario_primeiro_nome"]?></option>

                            <?php
                                }
                            ?>
                        </select>
                    </div>

                    <div class="display-flex-cl">
                        <label>Data da transferência</label>
                        <input type="date" class="form-control" name="dataTransferDepToDisp" required>
                    </div>
                </div>
            </div>
            
            <div id="dados_insumo_disp">
                <hr>
                <div>
                    <div class="form-group valida_movimentacao">
                        <div class="display-flex-cl">
                            <label>Insumo</label>
                            <input type="text" class="form-control largura_um_terco" name="insumoID_Insumodispensario[]" id="insumoID_Insumodispensario1" onkeyup="searchInput_cadDeposito(this.value, 1, 2)" placeholder="informe o nome do insumo..." required>
                            <span class="ajuste_span" id="resultado_cad_disp_insumos1" style="
    margin: 9.5% auto;"></span>
                        </div>
                        <div class="display-flex-cl">
                            <label for="quantidadeInsumoDisponivelDeposito"> Disponível no Depósito</label>
                            <input type="text" class="form-control largura_um_terco" name="quantidadeInsumoDisponivelDeposito" id="quantidadeInsumoDisponivelDeposito1" readonly>
                        </div>
                            
                        <div class="display-flex-cl">
                            <label>Dispário de Destino</label>
                            <input type="text" class="form-control" name="depositoDestinoInsumodeposito[]" id="depositoDestinoInsumodeposito1" onkeyup="searchInput_cadDeposito(this.value, 1, 5)" required>
                            <span class="ajuste_span" id="resultado_cad_deposito_estoque1" style="margin: 9.5% auto;"></span>
                        </div>

                    </div>
                    <div class="form-group valida_movimentacao">

                        <div class="display-flex-cl">
                            <label for="quantidadeInsumoDispensario">Quantidade Transferida</label>
                            <input type="number" class="form-control" name="quantidadeInsumoDispensario[]" min="1" required>
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
                <input type="submit" value="Cadastrar" name="btnAdicionarInsumoDispensario" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>