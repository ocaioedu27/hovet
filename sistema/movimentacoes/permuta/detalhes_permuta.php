<?php

$permutaId = $_GET["permutaId"];

$sql_detalhes_permuta = "SELECT
                    p.data,
                    p.qtd_cadastrado,
                    p.qtd_retirado,
                    p.oid_operacao,
                    u.primeiro_nome,
                    depCad.validade as validade_cadastrado,
                    depRem.validade as validade_retirado,
                    esRem.nome as nome_estoque_retirado,
                    esCad.nome as nome_estoque_cadastrado,
                    inCad.nome as nome_insumo_cadastrado,
                    inCad.descricao as descricao_insumo_cadastrado,
                    inRem.nome as nome_insumo_retirado,
                    inRem.descricao as descricao_insumo_retirado,
                    f.razao_social,
                    tp.movimentacao

                FROM permutas p
                
                    INNER JOIN usuarios u
                    ON p.usuario_id = u.id
                
                    INNER JOIN deposito depCad 
                    ON p.deposito_id_cadastrado = depCad.id
                
                    INNER JOIN insumos inCad
                    ON depCad.insumos_id = inCad.id
                
                    INNER JOIN deposito depRem 
                    ON p.deposito_id_removido = depRem.id
                
                    INNER JOIN insumos inRem
                    ON depCad.insumos_id = inRem.id
                
                    INNER JOIN estoques esRem
                    ON depRem.estoque_id = esRem.id
                
                    INNER JOIN estoques esCad
                    ON depCad.estoque_id = esCad.id

                    INNER JOIN fornecedores f
                    ON p.fornecedor_id = f.id

                    INNER JOIN tipos_movimentacoes tp
                    ON p.tipos_movimentacoes_id = tp.id
                
                    WHERE oid_operacao='{$permutaId}'";


$result = mysqli_query($conexao,$sql_detalhes_permuta) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($result);

?>

<div class="container cadastro_all">
    <div class="cards permuta">
        <div class="voltar">
            <h3>Detalhes da Operação de Permuta</h3>
            <a href="index.php?menuop=permuta_por_oid&idPermuta=<?=$dados["oid_operacao"]?>" class="">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="" method="post">
            <hr>

            <div class="dados_solicitacao">
                <h4>Dados da Movimentação</h4>
                <div class="form-group valida_movimentacao">
                    <div class="display-flex-cl">
                        <label>Tipo de operação</label>
                        <input type="text" class="form-control largura_um_terco" value="<?=$dados['movimentacao']?>" readonly>
                    </div>
                    
                    <div class="display-flex-cl">
                        <label>Quem Realizou</label>
                        <input type="text" class="form-control largura_um_terco" value='<?=$dados["primeiro_nome"]?>' readonly>

                    </div>

                    <div class="display-flex-cl">
                        <label>Data da transferência</label>
                        <input type="datetime-local" class="form-control" value='<?=$dados["data"]?>' readonly>
                    </div>

                    <div class="display-flex-cl">
                        <label>Instituição que Permutou</label>
                        <input class="form-control" value='<?=$dados["razao_social"]?>' readonly>
                    </div>
                </div>
            </div>

            <hr>
            <div class="display-flex-cl" id="dados_insumo_permuta_dep">
                <div class="display-flex-row form-group valida_movimentacao">
                    <div id="permuta_dep">
                        <h4>Item retirado do Depósito</h4>
                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Insumo</label>
                                <input type="text" class="form-control largura_um_terco" value="<?=$dados["nome_insumo_retirado"]?>" readonly>
                            </div>

                            <div class="display-flex-cl">
                                <label>Validade</label>
                                <input type="date" class="form-control largura_um_terco" value="<?=$dados["validade_retirado"]?>" readonly>
                            </div>
                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Quantidade Permutada</label>
                                <input type="number" class="form-control largura_metade" value="<?=$dados["qtd_retirado"]?>" readonly>
                            </div>
                            
                            <div class="display-flex-cl">
                                <label>Depósito De Retirada</label>
                                <input type="text" class="form-control largura_um_terco" value="<?=$dados["nome_estoque_retirado"]?>" readonly>
                            </div>
                        </div>

                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Descrição do insumo</label>
                                <textarea name="descricaoInsumoDeposito" cols="10" rows="2" class="form-control" readonly><?=$dados["descricao_insumo_retirado"]?></textarea>
                            </div>
                        </div>
                    </div>

                    <div id="permuta_dep">
                        <h4>Item cadastrado do Depósito</h4>
                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Insumo</label>
                                <input type="text" class="form-control largura_um_terco" value="<?=$dados["nome_insumo_cadastrado"]?>" readonly>
                            </div>

                            <div class="display-flex-cl">
                                <label>Validade</label>
                                <input type="date" class="form-control largura_um_terco" value="<?=$dados["validade_cadastrado"]?>" readonly>
                            </div>
                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Quantidade Inserida</label>
                                <input type="number" class="form-control largura_metade" value="<?=$dados["qtd_cadastrado"]?>" readonly>
                            </div>
                            
                            <div class="display-flex-cl">
                                <label>Depósito de Destino</label>
                                <input type="text" class="form-control largura_um_terco" value="<?=$dados["nome_estoque_cadastrado"]?>" readonly>
                            </div>
                        </div>
                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label for="descricaoInsumoDeposito">Descrição do insumo</label>
                                <textarea name="descricaoInsumoDeposito" cols="10" rows="2" class="form-control" readonly><?=$dados["descricao_insumo_cadastrado"]?></textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
