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

// procurar pelos tipos de estoque
$origem = "farma";
$sql_insumo = "SELECT 
                    e.id,
                    e.nome
                FROM 
                    estoques e
                INNER JOIN 
                    tipos_estoques tp
                ON
                    e.tipos_estoques_id = tp.id
                WHERE
                    e.nome LIKE '%{$cad_deposito_estoque_nome}%' and tp.tipo LIKE '%$origem%'";

$rs = mysqli_query($conexao, $sql_insumo) or die("Erro ao realizar a consulta de tipos de estoques: ". mysqli_error($conexao));

if($rs->num_rows > 0){

    $string_options = "";

    while($dados = mysqli_fetch_assoc($rs)){
        $id = $dados["id"];
        $nome = $dados["nome"];

        $string_options .= "<option>". $id ." - ". $nome. "</option>";
    }

    //echo "<br>" . $string_options;
}

?>

<div class="container cadastro_all">
    <div class="cards cadastro_dispensario">
        <div class="voltar">
            <h4>Doar insumos da Farmácia</h4>
            <a href="index.php?menuop=<?=$tipoEstoque?>_resumo&<?=$qualEstoque?>=1" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=att_farm&<?=$qualEstoque?>" method="post">
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
                                WHERE movimentacao='Doar insumos da Farmácia'";
                                
                            $resultado_mov = mysqli_query($conexao, $sql_mov) or die("//dispensario/sql_mov - erro ao realiza" . mysqli_error($conexao));

                            $dados_mov = mysqli_fetch_assoc($resultado_mov);
                            
                        ?>
                        <label >Tipo de operação</label>
                        <input type="text" class="form-control" name="doar_farmacia" value="<?=$dados_mov['id']?> - <?=$dados_mov['movimentacao']?>" readonly>
                    </div>
                    
                    <div class="display-flex-cl">
                        <?php
                        $sql = "SELECT * FROM usuarios WHERE id={$sessionUserID}";
                        $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                        
                        $dados_user = mysqli_fetch_assoc($result)
                        ?>
                        <label>Solicitante</label>
                        <input type="text" class="form-control largura_um_terco" name="solicitante_retira_dispensario" value="<?=$dados_user['id']?> - <?=$dados_user['primeiro_nome']?>" readonly>
                    </div>

                    <div class="display-flex-cl">
                        <label>Data da transferência</label>
                        <input type="date" class="form-control" name="dataTransferDepToDisp" required>
                    </div>
                </div>
            </div>
            
            <div id="dados_doar_farm">
                <hr>
                <h3 class="">Dados do Insumo</h3>
                <div>
                    <div class="form-group valida_movimentacao">
                        <div class="display-flex-cl">
                            <label>Insumo</label>
                            <input type="text" class="form-control" name="insumoID_Insumodispensario[]" id="insumoID_Insumodispensario1" onkeyup="searchInput_cadDeposito(this.value, 1, 10)" placeholder="Procure pelo nome do insumo..." required>
                            <span class="ajuste_span" id="resultado_cad_disp_insumos1"></span>
                        </div>
                        <div class="display-flex-cl">
                            <label for="quantidadeInsumoDisponivelDeposito">Disponível na Farmácia</label>
                            <input type="text" class="form-control" name="quantidadeInsumoDisponivelDeposito" id="quantidadeInsumoDisponivelDeposito1" onchange="verificaValorMaximoExcedido('quantidadeMovidaParaDispensario1','quantidadeInsumoDisponivelDeposito1','alerta_valor_acima_max1','btn_cad')" readonly>
                        </div>

                    </div>
                    <div class="form-group valida_movimentacao">

                        <div class="display-flex-cl">
                            <label for="quantidadeInsumoDispensario">Quantidade a ser doada</label>
                            <input type="number" class="form-control" name="quantidadeInsumoDispensario[]" min="1" id="quantidadeMovidaParaDispensario1" onkeyup="verificaValorMaximoExcedido('quantidadeMovidaParaDispensario1','quantidadeInsumoDisponivelDeposito1','alerta_valor_acima_max1','btn_cad', 'label_mesage_to_insert_1')" placeholder="Informe a quantidade..." required>
                            <span class="alerta_senhas_iguais" style="display: none; margin-top: 2%;" id="alerta_valor_acima_max1">
                                <label id="label_mesage_to_insert_1">Valor acima ou igual do que há disponível!<ion-icon name="alert-circle-outline"></ion-icon></label>
                            </span>
                        </div>

                        <div class="display-flex-cl">
                            <label for="validadeInsumoDeposito">Validade</label>
                            <input type="date" class="form-control" name="validadeInsumoDeposito[]" id="validadeInsumoDeposito1" readonly>
                        </div>
                        
                    </div>
                    <div class="form-group valida_movimentacao">
                        <div class="display-flex-cl">
                            <label for="descricaoInsumoDeposito">Descrição do insumo</label>
                            <textarea name="descricaoInsumoDeposito" cols="10" rows="2" class="form-control largura_metade" id="descricaoInsumoDeposito1" readonly></textarea>
                        </div>

                        <button class="btn" type="button" onclick="adicionaCampoCad(17)" style="padding: 0;">+</button>
                    </div>
                </div>
            </div>

            <div class="form-group valida_movimentacao">
                <label for="movimentacao_deposito_to_dispensario">Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="movimentacao_deposito_to_dispensario" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btn_cad" class="btn_cadastrar" id="btn_cad">
            </div>
        </form>
    </div>
</div>