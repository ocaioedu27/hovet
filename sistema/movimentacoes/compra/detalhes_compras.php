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
                    c.nome_nf,
                    c.num_nf,
                    c.id,
                    c.caminho,
                    c.data_upload,
                    c.qtd_guardada,
                    i.nome as insumos_nome,
                    i.descricao,
                    u.primeiro_nome,
                    f.razao_social,
                    d.validade,
                    es.nome as estoques_nome
                FROM 
                    compras c

                INNER JOIN 
                    usuarios u
                ON 
                    u.id = c.usuario_id

                INNER JOIN 
                    fornecedores f
                ON 
                    f.id = c.fornecedor_id

                INNER JOIN 
                    deposito d
                ON 
                    d.id_origem = c.num_nf

                INNER JOIN 
                    estoques es
                ON 
                    d.estoque_id = es.id 

                INNER JOIN 
                    insumos i
                ON 
                    d.insumos_id = i.id

                WHERE
                    c.num_nf = {$num_nf} and i.id = {$qualInsumo}";

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
            <a href="index.php?menuop=compra_por_nf&numNotaFiscal=<?=$dados_fiscais_compra["num_nf"]?>" class="confirmaVolta">
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
                        <input type="text" class="form-control largura_um_terco" name="quem_esta_guardando_dep" value="<?=$dados_fiscais_compra['primeiro_nome']?>" readonly>
                    </div>

                    <div class="display-flex-cl">
                        <label for="dataCadastroInsumoDeposito">Dia do cadastro</label>
                        <input type="datetime-local" class="form-control" id="data_cadastro_dep" name="dataCadastroInsumoDeposito" value="<?=$dados_fiscais_compra['data_upload']?>" readonly>
                    </div>

                </div>

                <div class="form-group valida_movimentacao">

                    <div class="display-flex-cl" id="num_nota_fiscal_cad_dep">
                        <label>Número da Nota fiscal</label>
                        <input type="text" class="form-control largura_um_terco" name="num_nota_fiscal_cad_dep" id="input_num_nota_fiscal_cad_dep" placeholder="Informe o número..." value="<?=$dados_fiscais_compra['num_nf']?>" readonly>
                    </div>

                    <div class="display-flex-cl" id="nota_fiscal_cad_dep">
                        <label for="nota_fiscal_deposito">Visualizar Nota fiscal</label>
                        <a target="_blank" class="form-control" href="<?=$dados_fiscais_compra['caminho']?>" style="height: auto;"><?=$dados_fiscais_compra["nome_nf"]?></a>
                    </div>

                    <div class="display-flex-cl" id="fornecedor_cad_dep1">
                        <label>Fornecedor</label>
                        <input type="text" class="form-control" name="fornecedor_cad_insumo_dep" value="<?=$dados_fiscais_compra['razao_social']?>" readonly>
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
                            <input type="date" class="form-control largura_um_terco" name="validadeInsumodeposito[]" value="<?=$dados_fiscais_compra['validade']?>" readonly>
                        </div>

                    </div>


                    <div class="form-group valida_movimentacao">
                            
                        <div class="display-flex-cl">
                            <label>Quantidade guardada</label>
                            <input type="number" class="form-control largura_um_terco" name="quantidadeInsumodeposito[]" min="1" value="<?=$dados_fiscais_compra['qtd_guardada']?>" readonly>
                        </div>
                            
                        <div class="display-flex-cl">
                            <label>Depósito de Destino</label>
                            <input type="text" class="form-control largura_um_terco" name="depositoDestinoInsumodeposito[]" value="<?=$dados_fiscais_compra['estoques_nome']?>" readonly>
                        </div>
                    </div>

                    <div class="form-group valida_movimentacao">
                    
                        <div class="display-flex-cl">
                            <label>Descrição</label>
                            <textarea type="text" class="form-control largura_metade" id="descricaoInsumoCadDep1" readonly><?=$dados_fiscais_compra['descricao']?></textarea>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </form>
    </div>
</div>