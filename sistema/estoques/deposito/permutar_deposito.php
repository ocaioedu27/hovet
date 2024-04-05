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
    <div class="cards permuta">
        <div class="voltar">
            <h4>Permutando itens do Depósito <?=$qualEstoque[-1]?></h4>
            <a href="index.php?menuop=deposito_resumo&<?=$qualEstoque?>=1" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=atualizar_deposito&<?=$qualEstoque?>" method="post">
            <hr>

            <div class="dados_solicitacao">
                <h4>Dados da Movimentação</h4>
                <div class="form-group valida_movimentacao">
                    <div class="display-flex-cl">
                        <?php
                            $sql_mov = "SELECT 
                                id,
                                movimentacao
                                FROM tipos_movimentacoes
                                WHERE movimentacao='Permuta'";
                                
                            $resultado_mov = mysqli_query($conexao, $sql_mov) or die("//permuta/sql_mov - erro ao realiza" . mysqli_error($conexao));

                            $dados_mov = mysqli_fetch_assoc($resultado_mov);
                            
                        ?>
                        <label>Tipo de operação</label>
                        <input type="text" class="form-control largura_um_terco" name="movimentacao_permuta_deposito" value="<?=$dados_mov['id']?> - <?=$dados_mov['movimentacao']?>" readonly>
                    </div>
                    
                    <div class="display-flex-cl">
                        <label>Quem está realizando</label>
                            <?php
                            $sql = "SELECT * FROM usuarios WHERE id={$_SESSION['usuario_id']}";
                            $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                            
                            $dados = mysqli_fetch_assoc($result);
                            ?>
                        <input type="text" class="form-control largura_um_terco" name="quemRealizouPermutaDep" value='<?=$dados["id"]?> - <?=$dados["primeiro_nome"]?>' readonly>

                    </div>

                    <div class="display-flex-cl">
                        <label>Data da transferência</label>
                        <input type="datetime-local" class="form-control" name="dataTransferPermutaDep" required>
                    </div>

                    <div class="display-flex-cl">
                        <label>Institução a Permutar</label>
                        <select class="form-control" name="instituicaoPermutaDep" id="instituicaoPermutaDep" required>
                            <?php
                            $sql = "SELECT id ,razao_social FROM fornecedores WHERE ctg_fornecedores_id=2";
                            $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                            
                            while($dados = mysqli_fetch_assoc($result)){
                            ?>
                            <option><?=$dados["id"]?> - <?=$dados["razao_social"]?></option>

                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <hr>
            <div class="display-flex-cl" id="dados_insumo_permuta_dep">
                <h3>Dados dos Insumos</h3>
                <div class="display-flex-row">
                    <div id="permuta_dep">
                        <h4>Item a ser retirado do Depósito</h4>
                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Insumo</label>
                                <input type="text" class="form-control largura_um_terco" name="insumoID_InsumoPermuta[]" id="permuta_deposito_insumo_id_1" onkeyup="searchInput_cadDeposito(this.value, 1, 4)" placeholder="informe o nome do insumo..." required>
                                <span class="ajuste_span" id="resultado_permuta_insumos1"></span>
                            </div>

                            <div class="display-flex-cl">
                                <label>Validade</label>
                                <input type="date" class="form-control largura_um_terco" name="validadeInsumoDeposito[]" id="validadeInsumoDepositoPermuta1" readonly>
                            </div>
                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Quantidade Permutada</label>
                                <input type="number" class="form-control largura_metade" name="quantidadeInsumoDepositoPermuta[]" min="1" id="quantidade_solicitada_permuta1" onkeyup="verificaValorMaximoExcedido('quantidade_solicitada_permuta1','quantidade_atual_deposito_permuta1','alerta_valor_acima_max1','btn_permuta_insumo_dep', 'label_mesage_to_insert_1')" required>
                                <span class="alerta_senhas_iguais" style="display: none; margin-top: 2%;" id="alerta_valor_acima_max1">
                                    <label id="label_mesage_to_insert_1">Valor inválido!!!<ion-icon name="alert-circle-outline"></ion-icon></label>
                                </span>
                            </div>
                            
                            <div class="display-flex-cl">
                                <label>Disponível no Depósito</label>
                                <input type="text" class="form-control largura_metade" name="quantidadeInsumoDisponivelDeposito[]" id="quantidade_atual_deposito_permuta1" onchange="verificaValorMaximoExcedido('quantidade_solicitada_permuta1','quantidade_atual_deposito_permuta1','alerta_valor_acima_max1','btn_permuta_insumo_dep')" readonly>
                            </div>
                        </div>

                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Descrição do insumo</label>
                                <textarea name="descricaoInsumoDeposito[]" cols="10" rows="2" class="form-control largura_um_terco" id="descricaoInsumoDepositoPermuta1" readonly></textarea>
                            </div>
                            
                            <div class="display-flex-cl">
                                <label>Depósito De Retirada</label>
                                <input type="text" class="form-control largura_um_terco" name="depositoRetiradaPermuta[]" id="deposito_origem_insumo_retirado1" readonly>
                            </div>
                        </div>
                    </div>

                    <div id="permuta_dep">
                        <h4>Item a ser cadastrado no Depósito</h4>
                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Insumo</label>
                                <input type="text" class="form-control largura_um_terco" name="insumoID_InsumoCadPermuta[]" id="insumoID_Insumodeposito1" onkeyup="searchInput_cadDeposito(this.value, 1, 1)" placeholder="informe o nome do insumo..." required>
                                <span class="ajuste_span" id="resultado_cad_deposito_insumos1"></span>
                            </div>

                            <div class="display-flex-cl">
                                <label>Validade</label>
                                <input type="date" class="form-control largura_um_terco" name="validadeInsumoCadPermuta[]" id="" required>
                            </div>
                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Quantidade Inserida</label>
                                <input type="number" class="form-control largura_metade" name="quantidadeInsumoCadPermuta[]" min="1"  onkeyup="verifica_valor('qtd_guardada_1', 'msg_alerta_qtd_guardada_1', 'btn_cadastrar', '0')" id="qtd_guardada_1" required>
                                <span class="alerta_senhas_iguais" style="display: none;" id="msg_alerta_qtd_guardada_1">
                                    <label>
                                            Valor inválido! Por favor, altere para um valor válido!
                                            <ion-icon name="alert-circle-outline"></ion-icon>
                                    </label>
                                </span>
                            </div>
                            
                            <div class="display-flex-cl">
                                <label>Depósito de Destino</label>
                                <input type="text" class="form-control largura_um_terco" name="depositoDestinoInsumoPermuta[]" id="estoqueDestino1" onkeyup="searchInput_cadDeposito(this.value, 1, 5, 'deposito')" placeholder="Informe o Destino..." required>
                            <span class="ajuste_span" id="resultado_cad_deposito_estoque1"></span>
                            </div>
                        </div>
                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Descrição do insumo</label>
                                <textarea name="descricaoInsumoDeposito" cols="10" rows="2" class="form-control largura_metade" id="descricaoInsumoCadDep1" readonly></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group valida_movimentacao">

                        <button class="btn" type="button" onclick="adicionaCampoCad(5)" style="padding: 0;">+</button>

                    </div>

                </div>
            </div>
            

            <div class="form-group valida_movimentacao">
                <label for="movimentacao_deposito_to_dispensario">Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="movimentacao_deposito_to_dispensario" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Permutar" name="btnPermutaInsumoDeposito" id="btn_permuta_insumo_dep" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>
