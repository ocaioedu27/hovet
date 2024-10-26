<?php

$origem="";

$sql_insumo = "SELECT id, tipo FROM tipos_estoques";

$rs = mysqli_query($conexao, $sql_insumo) or die("Erro ao realizar a consulta de tipos de estoques: ". mysqli_error($conexao));

if($rs->num_rows > 0){

    $string_options = '<option value="all">Todos os estoques</option>';

    while($dados = mysqli_fetch_assoc($rs)){
        $id = $dados["id"];
        $nome = $dados["tipo"];
        $nome_sem_acentos = retiraAcentos($nome);
        $string_options .= '<option value="'. $nome_sem_acentos .'">'. $id .' - '. $nome. '</option>';
    }

    //echo "<br>" . $string_options;
}

?>

<div class="container cadastro_all">
    <div class="cards cadastro_insumo">
        <div class="voltar">
            <h4>Personalização</h4>
            <a href="index.php?menuop=listar_relatorios" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" action="/hovet/sistema/pdf/relatorio_criticos.php" enctype="multipart/form-data" method="post">

            <div id="">
                <hr>
                <div>
                    <div class="form-group valida_movimentacao">
                        <div class="display-flex-cl">
                            <label>Tipo de estoque</label>
                            <select name="tipo_estoque" class="form-control" required>
                                <?=$string_options?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group valida_movimentacao">
                        <div class="display-flex-cl">
                            <label>Quantidade Crítica</label>
                            <input type="number" class="form-control" min="0" id="valor_qtd_critica" name="valor_qtd_critica" onkeyup="verifica_valor('valor_qtd_critica', 'msg_alerta', 'btn_gerar', '1')" required>
                            <span class="alerta_senhas_iguais" style="display: none;" id="msg_alerta">
                                <label>Valor inválido! Por favor, altere para um valor válido!</label>
                                <ion-icon name="alert-circle-outline"></ion-icon>
                            </span>
                        </div>
                    </div>

                    <div class="form-group valida_movimentacao">
                        <div class="display-flex-cl">
                            <div id="campos_id_movimentacoes">
                                <label>Categoria de Insumo</label>
                                <div class="display-flex-row">
                                    <div class="display-flex-cl">
                                        <input type="text" class="form-control" name="categoria_insumo[]" id="tipos_insumo_1"     onkeyup="searchInput_cadDeposito(this.value, 1, 6)" placeholder="Pesquise..." required>
                                        <span class="ajuste_span" id="resultado_cad_categoria_insumo_1"></span>
                                    </div>
                                    <button class="btn" type="button" onclick="adicionaCampoCad(13, 'categoria_insumo', 'resultado_cad_categoria_insumo_1', 6, 'tipos_insumo_1')" style="padding: 0;">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group valida_movimentacao">
                <label>Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="valida_dados_insercao" required>
            </div>

            
            <div class="form-group" id="confirmaDownload">
                <input type="submit" value="Gerar" name="btn_gerar" id="btn_gerar" class="btn btn_cadastrar">
            </div>
        </form>
    </div>
</div>