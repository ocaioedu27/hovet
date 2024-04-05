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

    $oid_operacao_tmp = $stringList[1];
    $oid_operacao = $_GET[$oid_operacao_tmp];

    $qualInsumo = $_GET[$stringList[2]];

}

$sql_compras = "SELECT 
                    d.oid_operacao,
                    d.data_operacao,
                    d.qtd_doada,
                    f.razao_social,
                    i.id,
                    i.nome as insumos_nome,
                    i.descricao,
                    e.nome as estoques_nome,
                    dep.validade,
                    u.primeiro_nome
                FROM 
                    doacoes d

                INNER JOIN 
                    usuarios u
                ON 
                    u.id = d.usuario_id

                INNER JOIN 
                    fornecedores f
                ON 
                    f.id = d.fornecedor_id

                INNER JOIN 
                    deposito dep
                ON 
                    dep.id_origem = d.oid_operacao

                INNER JOIN 
                    insumos i
                ON 
                    dep.insumos_id = i.id

                INNER JOIN 
                    estoques e
                ON 
                    dep.estoque_id = e.id

                WHERE
                    d.oid_operacao = '{$oid_operacao}' and i.id = {$qualInsumo}";

$result_searchs = mysqli_query($conexao,$sql_compras) or die("//movimentacoes/compras/detalhar_compras/sql_busca_compras - Erro ao realizar a consulta. " . mysqli_error($conexao));
$result_searchs_while = $result_searchs;
// var_dump($result_searchs_while);
$dados_fiscais_doacao = mysqli_fetch_assoc($result_searchs);


$teste = "teste";

?>

<div class="container cadastro_all">
    <div class="cards cadastro_deposito">
        <div class="voltar ">
            <h4 class="">Listando Doações do <?=$dados_fiscais_doacao['estoques_nome']?></h4>
            <a href="index.php?menuop=doacao_por_oid&doacao_por_oid=<?=$dados_fiscais_doacao["oid_operacao"]?>" class="confirmaVolta">
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
                        <input type="text" class="form-control largura_um_terco" value="Doação" readonly>
                        </select>
                    </div>
                    
                    <div class="display-flex-cl">
                        <label for="quem_esta_guardando_dep">Quem guardou</label>
                        <input type="text" class="form-control largura_um_terco" name="quem_esta_guardando_dep" value="<?=$dados_fiscais_doacao['primeiro_nome']?>" readonly>
                    </div>

                    <div class="display-flex-cl">
                        <label for="dataCadastroInsumoDeposito">Dia do cadastro</label>
                        <input type="datetime-local" class="form-control" id="data_cadastro_dep" name="dataCadastroInsumoDeposito" value="<?=$dados_fiscais_doacao['data_operacao']?>" readonly>
                    </div>

                </div>

                <div class="form-group valida_movimentacao">

                    <div class="display-flex-cl" id="fornecedor_cad_dep1">
                        <label>Fornecedor</label>
                        <input type="text" class="form-control largura_metade" name="fornecedor_cad_insumo_dep" value="<?=$dados_fiscais_doacao['razao_social']?>" readonly>
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
                            <input type="text" class="form-control largura_um_terco" name="insumoID_Insumodeposito[]" id="insumoID_Insumodeposito1" value="<?=$dados_fiscais_doacao['insumos_nome']?>" readonly>
                        </div>

                        <div class="display-flex-cl">
                            <label for="validadeInsumoDeposito[]">Validade</label>
                            <input type="date" class="form-control largura_um_terco" name="validadeInsumodeposito[]" value="<?=$dados_fiscais_doacao['validade']?>" readonly>
                        </div>

                    </div>


                    <div class="form-group valida_movimentacao">
                            
                        <div class="display-flex-cl">
                            <label>Quantidade guardada</label>
                            <input type="number" class="form-control largura_um_terco" name="quantidadeInsumodeposito[]" min="1" value="<?=$dados_fiscais_doacao['qtd_doada']?>" readonly>
                        </div>
                            
                        <div class="display-flex-cl">
                            <label>Depósito de Destino</label>
                            <input type="text" class="form-control largura_um_terco" name="depositoDestinoInsumodeposito[]" value="<?=$dados_fiscais_doacao['estoques_nome']?>" readonly>
                        </div>
                    </div>

                    <div class="form-group valida_movimentacao">
                    
                        <div class="display-flex-cl">
                            <label>Descrição</label>
                            <textarea type="text" class="form-control largura_metade" id="descricaoInsumoCadDep1" readonly><?=$dados_fiscais_doacao['descricao']?></textarea>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </form>
    </div>
</div>