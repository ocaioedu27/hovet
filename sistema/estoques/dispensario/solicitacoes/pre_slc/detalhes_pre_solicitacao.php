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

    $solicitacaoOid_tmp = $stringList[1];
    $solicitacaoOid = $_GET[$solicitacaoOid_tmp];
    $qualPainel = $stringList[2];
    $idSolicitacao = $stringList[3];

    // echo "slc geral ou pessoal? $qualPainel<br/>Id da slc $_GET[$idSolicitacao]";

}

$painel = $qualPainel;

if ($painel == "geral") {
    $painel = "pre_solicitacoes";
} elseif ($painel == "pessoal") {
    $painel = "minhas_solicitacoes";
}

$solicitacoesId = "";
if (isset($_GET[$idSolicitacao])) {
    $solicitacoesId = $_GET["idSolicitacao"];
}else {
    echo "<script language='javascript'>window.alert('//Verifica-id - O ID da solicitação não foi definido!! Retornando para a página de solicitações'); </script>";
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=solicitacoes';</script>";
}

$sql_detalhes_slc = "SELECT
                        s.pre_slc_id,
                        s.pre_slc_qtd_solicitada,
                        s.pre_slc_data,
                        s.pre_slc_justificativa,
                        u.usuario_id,
                        u.usuario_primeiro_nome,
                        i.insumos_nome,
                        i.insumos_descricao,
                        st.setores_setor,
                        st.setores_id,
                        stt.status_slc_status,
                        es.estoques_id,
                        es.estoques_nome,
                        tp.tipos_movimentacoes_movimentacao,
                        tp.tipos_movimentacoes_id,
                        d.dispensario_id,
                        d.dispensario_validade,
                        d.dispensario_qtd

                    FROM pre_solicitacoes s

                        INNER JOIN usuarios u
                        ON s.pre_slc_solicitante = u.usuario_id

                        INNER JOIN dispensario d
                        ON s.pre_slc_dispensario_id = d.dispensario_id

                        INNER JOIN insumos i
                        ON d.dispensario_insumos_id = i.insumos_id 

                        INNER JOIN setores st
                        ON s.pre_slc_setor_destino = st.setores_id

                        INNER JOIN status_slc stt
                        ON s.pre_slc_status_slc_id = stt.status_slc_id

                        INNER JOIN estoques es
                        ON s.pre_slc_dips_solicitado = es.estoques_id

                        INNER JOIN tipos_movimentacoes tp
                        ON tp.tipos_movimentacoes_id = s.pre_slc_tp_movimentacoes_id
                    
                    WHERE pre_slc_id={$solicitacoesId}";

$result = mysqli_query($conexao,$sql_detalhes_slc) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($result);

$qtd_linhas_tabelas = 2;

echo '<input type="hidden" id="quantidade_linhas_tabelas" value="'.$qtd_linhas_tabelas.'">';
?>

<div class="container cadastro_all">
    <div class="cards retirar_dispensario">
        <div class="voltar form_retirada">
            <h4>Detalhes da Solicitação</h4>
            <a href="index.php?menuop=<?=$painel?>&idSolicitacao=<?=$solicitacaoOid?>&Pendente" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <div class="form_retirar_dispensario">
            
            <div class="dados_solicitante">
                <hr>
                <h3>Dados da solicitação</h3>
                
                <div class="form-group valida_movimentacao">

                    <div class="display-flex-cl">
                        <label>Solicitante</label>
                        <input type="text" class="form-control largura_metade" name="solicitante_insumo_dispensario" value="<?=$dados['usuario_id']?> - <?=$dados['usuario_primeiro_nome']?>" readonly>
                    </div>
                        
                    <div class="display-flex-cl">
                        <label>Tipo de operação</label>
                        <input type="text" class="form-control" name="operacao_dispensario" id="qualSolicitacaoDisp" onclick="verificaSolicitacao()" value="<?=$dados["tipos_movimentacoes_id"]?> - <?=$dados["tipos_movimentacoes_movimentacao"]?>" readonly>
                    </div>

                </div>

                <div class="form-group valida_movimentacao">

                    <div class="display-flex-cl">
                        <label id="vaiOuVem">Setor</label>
                        <input type="text" class="form-control largura_metade" name="setor_destino_solicitacao_dispensario" id="" value="<?=$dados["setores_id"]?> - <?=$dados["setores_setor"]?>" readonly>
                    </div>

                    <div class="display-flex-cl">
                        <label>Data e horário da solicitação</label>
                        <input type="datetime-local" class="form-control largura_um_terco"  name="data_operacao_dispensario" id="" value="<?=$dados['pre_slc_data']?>" readonly>
                    </div>

                    <div class="display-flex-cl">

                        <label>Dispensário da Solicitação</label>
                        <input type="text" class="form-control largura_metade" name="tipo_dispensario" value="<?=$dados['estoques_id']?> - <?=$dados['estoques_nome']?>" readonly>
                    </div>

                </div>
                <hr style="border: 0;">
            </div>

            <form class="form_cadastro" action="index.php?menuop=atualiza_pre_solicitacao&idSolicitacao=<?=$solicitacoesId?>" method="post">
            
                <div id="dados_insumo_disp">
                    <hr>
                    <div>
                        <h3 class="">Dados do insumo</h3>
                        <div class="form-group valida_movimentacao">
                        
                            <div class="display-flex-cl" style="margin-right: 30px;">
                                <label>Insumo Solicitado</label>
                                <input type="text" class="form-control" name="insumo_dispensario_id[]" id="insumo_dispensario_id1" value="<?=$dados['dispensario_id']?> - <?=$dados['insumos_nome']?>" readonly>
                            </div>
                
                            <div class="display-flex-cl">
                                <label>Quantidade Solicitada</label>
                                <input type="number" class="form-control largura_um_terco" name="quantidade_insumo_solic_dispensario[]" id="qtd_solicitada_dispensario1" min="1" value="<?=$dados['pre_slc_qtd_solicitada']?>"  onchange="verificaValorMaximoExcedido('qtd_atendida_dispensario1','qtd_solicitada_dispensario1','alerta_valor_acima_max1','operacao_slc_aprova')" readonly>
                            </div>

                            <div class="display-flex-cl">
                                <label>Validade do Insumo</label>
                                <input type="date" class="form-control largura_um_terco" name="validade_insumo_dispensario[]" id="validade_insumo_dispensario1" value="<?=$dados['dispensario_validade']?>" readonly>
                            </div>

                            <div class="display-flex-cl">
                                <label>Disponível no Dispensário</label>
                                <input type="number" class="form-control largura_um_terco" name="quantidade_atual_dispensario[]" id="quantidade_atual_dispensario1" value="<?=$dados['dispensario_qtd']?>" readonly>
                            </div>
                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Descrição</label>
                                <textarea type="text" class="form-control" id="descricaoInsumoSclDisp1" readonly><?=$dados['insumos_descricao']?></textarea>
                            </div>
                            <div class="display-flex-cl" id="operacao_slc_aprova">
                                <label>Quantidade atendida</label>
                                <input type="number" class="form-control largura_um_quarto" name="quantidade_atendida_insumo_solic_dispensario" id="qtd_atendida_dispensario1" min="0" max="<?=$dados['pre_slc_qtd_solicitada']?>" value="<?=$dados['pre_slc_qtd_solicitada']?>" onkeyup="verificaValorMaximoExcedido('qtd_atendida_dispensario1','qtd_solicitada_dispensario1','alerta_valor_acima_max1','operacao_slc_aprova')">
                                <span class="alerta_senhas_iguais" style="display: none; margin-top: 2%;" id="alerta_valor_acima_max1">
                                    <label>Valor acima do que foi solicitado!<ion-icon name="alert-circle-outline"></ion-icon></label>
                                </span>
                            </div>
                        </div>
                        <hr style="border: 0;">
                    </div>
                </div>
                <hr>


                <div class="form-group valida_movimentacao">
                    <div class="display-flex-cl">
                        <label>Justificativa</label>
                        <textarea name="justifica_requisicao" cols="25" rows="4" class="form-control" readonly><?=$dados['pre_slc_justificativa']?></textarea>
                    </div>
                </div>
                    
                <div class="form-group valida_movimentacao" style="justify-content: center;">
                    <div class="" id="operacao_slc_aprova">
                        <!-- <button class="btn" style="color: green;">Aprovar</button> -->
                        <input type="submit" value="Aprovar" name="btnAprovaSlc" class="btn btn_cadastrar confirmaOperacao" style="color: green; width: 100%;">
                    </div>
                    <div class="" id="operacao_slc_reprova">
                        <!-- <button class="btn" style="color: red;">Recusar</button> -->
                        <input type="submit" value="Recusar" name="btnReprovaSlc" class="btn btn_cadastrar confirmaOperacao" style="color: red; width: 100%;">
                    </div>
                </div>
            </form>
        </div>
    </div> 
</div>


