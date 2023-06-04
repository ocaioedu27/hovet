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

    $num_nf_tmp = $stringList[1];
    $num_nf = $_GET[$num_nf_tmp];

    $qualInsumo = $_GET[$stringList[2]];

}

$sql_compras = "SELECT 
                    c.compras_nome,
                    c.compras_num_nf,
                    c.compras_id,
                    c.compras_caminho,
                    c.compras_data_upload,
                    c.compras_qtd_guardada,
                    i.insumos_nome,
                    i.insumos_descricao,
                    u.usuario_primeiro_nome,
                    f.fornecedores_razao_social,
                    d.deposito_validade,
                    es.estoques_nome
                FROM 
                    compras c

                INNER JOIN 
                    usuarios u
                ON 
                    u.usuario_id = c.compras_quem_guardou_id

                INNER JOIN 
                    fornecedores f
                ON 
                    f.fornecedores_id = c.compras_fornecedor_id

                INNER JOIN 
                    deposito d
                ON 
                    d.deposito_id_origem = c.compras_num_nf

                INNER JOIN 
                    estoques es
                ON 
                    d.deposito_estoque_id = es.estoques_id 

                INNER JOIN 
                    insumos i
                ON 
                    d.deposito_insumos_id = i.insumos_id

                WHERE
                    c.compras_num_nf = {$num_nf} and i.insumos_id = {$qualInsumo}";

$result_searchs = mysqli_query($conexao,$sql_compras) or die("//movimentacoes/compras/detalhar_compras/sql_busca_compras - Erro ao realizar a consulta. " . mysqli_error($conexao));
$result_searchs_while = $result_searchs;
// var_dump($result_searchs_while);
$dados_fiscais_compra = mysqli_fetch_assoc($result_searchs);


$teste = "teste";

?>

<div class="container cadastro_all">
    <div class="cards cadastro_deposito">
        <div class="voltar ">
            <h4 class="">Listando Compras do <?=$dados_fiscais_compra['estoques_nome']?></h4>
            <a href="index.php?menuop=compra_por_nf&numNotaFiscal=<?=$dados_fiscais_compra["compras_num_nf"]?>" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        
        <form class="form_cadastro" enctype="multipart/form-data" action="" method="post">
        <!-- <form class="form_cadastro" enctype="multipart/form-data" action="" method="post"> -->

            <div class="dados_fiscais">
                <hr>
                <h3 class="">Dados fiscais</h3>
                <div class="form-group valida_movimentacao">
                    <div class="display-flex-cl">
                        <label>Operação</label>
                        <input type="text" class="form-control largura_um_terco" value="Compra" readonly>
                        </select>
                    </div>
                    
                    <div class="display-flex-cl">
                        <label for="quem_esta_guardando_dep">Quem guardou</label>
                        <input type="text" class="form-control largura_um_terco" name="quem_esta_guardando_dep" value="<?=$dados_fiscais_compra['usuario_primeiro_nome']?>" readonly>
                    </div>

                    <div class="display-flex-cl">
                        <label for="dataCadastroInsumoDeposito">Dia do cadastro</label>
                        <input type="datetime-local" class="form-control" id="data_cadastro_dep" name="dataCadastroInsumoDeposito" value="<?=$dados_fiscais_compra['compras_data_upload']?>" readonly>
                    </div>

                </div>

                <div class="form-group valida_movimentacao">

                    <div class="display-flex-cl" id="num_nota_fiscal_cad_dep">
                        <label>Número da Nota fiscal</label>
                        <input type="text" class="form-control largura_um_terco" name="num_nota_fiscal_cad_dep" id="input_num_nota_fiscal_cad_dep" placeholder="Informe o número..." value="<?=$dados_fiscais_compra['compras_num_nf']?>" readonly>
                    </div>

                    <div class="display-flex-cl" id="nota_fiscal_cad_dep">
                        <label for="nota_fiscal_deposito">Visualizar Nota fiscal</label>
                        <a target="_blank" class="form-control" href="<?=$dados_fiscais_compra['compras_caminho']?>" style="height: auto;"><?=$dados_fiscais_compra["compras_nome"]?></a>
                    </div>

                    <div class="display-flex-cl" id="fornecedor_cad_dep1">
                        <label>Fornecedor</label>
                        <input type="text" class="form-control" name="fornecedor_cad_insumo_dep" value="<?=$dados_fiscais_compra['fornecedores_razao_social']?>" readonly>
                    </div>

                </div>
            </div>

            <div class="" id="dados_insumo_dep">
                <hr>
                <div>
                    <h3 class="">Dados do insumo</h3>

                    <div class="form-group valida_movimentacao">
                        
                        <div class="display-flex-cl">
                            <label>Nome</label>
                            <input type="text" class="form-control largura_um_terco" name="insumoID_Insumodeposito[]" id="insumoID_Insumodeposito1" value="<?=$dados_fiscais_compra['insumos_nome']?>" readonly>
                        </div>

                        <div class="display-flex-cl">
                            <label for="validadeInsumoDeposito[]">Validade</label>
                            <input type="date" class="form-control largura_um_terco" name="validadeInsumodeposito[]" value="<?=$dados_fiscais_compra['deposito_validade']?>" readonly>
                        </div>

                    </div>


                    <div class="form-group valida_movimentacao">
                            
                        <div class="display-flex-cl">
                            <label>Quantidade guardada</label>
                            <input type="number" class="form-control largura_um_terco" name="quantidadeInsumodeposito[]" min="1" value="<?=$dados_fiscais_compra['compras_qtd_guardada']?>" readonly>
                        </div>
                            
                        <div class="display-flex-cl">
                            <label>Depósito de Destino</label>
                            <input type="text" class="form-control largura_um_terco" name="depositoDestinoInsumodeposito[]" value="<?=$dados_fiscais_compra['estoques_nome']?>" readonly>
                        </div>
                    </div>

                    <div class="form-group valida_movimentacao">
                    
                        <div class="display-flex-cl">
                            <label>Descrição</label>
                            <textarea type="text" class="form-control largura_metade" id="descricaoInsumoCadDep1" readonly><?=$dados_fiscais_compra['insumos_descricao']?></textarea>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </form>
    </div>
</div>