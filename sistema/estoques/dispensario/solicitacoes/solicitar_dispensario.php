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
    <div class="cards retirar_dispensario">
        <div class="voltar form_retirada">
            <h4>Solicitando itens do Dispensário</h4>
            <a href="index.php?menuop=dispensario_resumo&<?=$qualEstoque?>=1" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form action="index.php?menuop=salva_solicitacao_dispensario&<?=$qualEstoque?>" enctype="multipart/form-data" class="form_retirar_dispensario" method="post">
            
            <div class="dados_solicitante">
                <hr>
                <h3>Dados da solicitação</h3>
                
                <div class="form-group valida_movimentacao">

                    <div class="display-flex-cl">
                        <?php
                        $sql = "SELECT * FROM usuarios WHERE usuario_id={$sessionUserID}";
                        $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

                        $dados = mysqli_fetch_assoc($result);
                        ?>

                        <label>Solicitante</label>
                        <input type="text" class="form-control largura_metade" name="solicitante_insumo_dispensario" value="<?=$dados['usuario_id']?> - <?=$dados['usuario_primeiro_nome']?>" readonly>
                    </div>
                        
                    <div class="display-flex-cl">
                        <label>Tipo de operação</label>
                        <select class="form-control" name="operacao_dispensario" id="qualSolicitacaoDisp" onclick="verificaSolicitacao()" required>
                            <?php
                            $sql = "SELECT tipos_movimentacoes_id,tipos_movimentacoes_movimentacao FROM tipos_movimentacoes WHERE tipos_movimentacoes_descricao LIKE 'Quando alguém solicita%' ";
                            $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                            
                            while($dados = mysqli_fetch_assoc($result)){
                            ?>
                            <option><?=$dados["tipos_movimentacoes_id"]?> - <?=$dados["tipos_movimentacoes_movimentacao"]?></option>

                            <?php
                                }
                            ?>
                        </select>
                    </div>

                </div>

                <div class="form-group valida_movimentacao">

                    <div class="display-flex-cl">
                        <label id="vaiOuVem">Setor</label>
                        <select class="form-control largura_metade" name="setor_destino_solicitacao_dispensario" id="" required>
                            <?php
                            $sql = "SELECT * FROM setores";
                            $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                            
                            while($dados = mysqli_fetch_assoc($result)){
                            ?>
                            <option><?=$dados["setores_id"]?> - <?=$dados["setores_setor"]?></option>

                            <?php
                                }
                            ?>
                        </select>
                    </div>

                    <div class="display-flex-cl">
                        <label for="data_operacao_dispensario">Data e horário da solicitação</label>
                        <input type="datetime-local" class="form-control largura_um_terco"  name="data_operacao_dispensario" id="" required>
                    </div>

                    <div class="display-flex-cl">
                        
                        <?php
                        $sql = "SELECT estoques_id,estoques_nome FROM estoques WHERE estoques_nome_real='{$qualEstoque}'";
                        $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

                        $dados = mysqli_fetch_assoc($result);
                        ?>

                        <label>Dispensário da Solicitação</label>
                        <input type="text" class="form-control largura_metade" name="tipo_dispensario" value="<?=$dados['estoques_id']?> - <?=$dados['estoques_nome']?>" readonly>
                    </div>

                </div>
                <hr style="border: 0;">
            </div>
            
            <div id="dados_insumo_disp">
                <hr>
                <div>
                    <h3 class="">Dados do insumo</h3>
                    <div class="form-group valida_movimentacao">
                    
                        <div class="display-flex-cl" style="margin-right: 30px;">
                            <label>Insumo Solicitado</label>
                            <input type="text" class="form-control" name="insumo_dispensario_id[]" id="insumo_dispensario_id1" onkeyup="searchInput_cadDeposito(this.value, 1, 3)"  placeholder="Informe o insumo..." required>
                            <span class="ajuste_span" id="resultado_slc_disp_insumos1" style="margin: 6.5% auto;"></span>
                        </div>
             
                        <div class="display-flex-cl">
                            <label>Quantidade Solicitada</label>
                            <input type="number" class="form-control largura_um_terco" name="quantidade_insumo_solic_dispensario[]" id="qtd_solicitada_dispensario1" min="1" onkeyup="verificaValorMaximoExcedido('qtd_solicitada_dispensario1','quantidade_atual_dispensario1','alerta_valor_acima_max1','btn_slc_insumo_disp')" required>
                            <span class="alerta_senhas_iguais" style="display: none; margin-top: 2%;" id="alerta_valor_acima_max1">
                                <label>Valor acima ou igual do que há disponível!<ion-icon name="alert-circle-outline"></ion-icon></label>
                            </span>
                        </div>

                        <div class="display-flex-cl">
                            <label for="validade_insumo_dispensario">Validade do Insumo</label>
                            <input type="date" class="form-control largura_um_terco" name="validade_insumo_dispensario[]" id="validade_insumo_dispensario1" readonly>
                        </div>

                        <div class="display-flex-cl">
                            <label for="quantidade_atual_dispensario">Disponível no Dispensário</label>
                            <input type="number" class="form-control largura_um_terco" name="quantidade_atual_dispensario[]" id="quantidade_atual_dispensario1" onchange="verificaValorMaximoExcedido('qtd_solicitada_dispensario1','quantidade_atual_dispensario1','alerta_valor_acima_max1','btn_slc_insumo_disp')" readonly>
                        </div>
                    </div>

                    <div class="form-group valida_movimentacao">

                        <div class="display-flex-cl">
                            <label>Descrição</label>
                            <textarea type="text" class="form-control largura_metade" id="descricaoInsumoSclDisp1" readonly></textarea>
                        </div>

                        <button class="btn" type="button" onclick="adicionaCampoCad(4)" style="padding: 0;">+</button>
                    </div>
                    <hr style="border: 0;">
                </div>
            </div>
            <hr>


            <div class="form-group valida_movimentacao">
                <div class="display-flex-cl">
                    <label for="justifica_requisicao">Justificativa</label>
                    <textarea name="justifica_requisicao" cols="25" rows="4" class="form-control" required></textarea>
                </div>
            </div>

            
            <div class="form-group valida_movimentacao">
                <label for="movimentacao_dispensasrio_to_setor">Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="movimentacao_dispensasrio_to_setor" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Enviar Solicitação" name="btnSolicitarInsumoDispensario" class="btn_cadastrar" id="btn_slc_insumo_disp">
            </div>
        </form>
    </div> 
</div>
    




