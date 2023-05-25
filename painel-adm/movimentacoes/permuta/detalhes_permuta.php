<?php

$permutaId = $_GET["permutaId"];

$sql_detalhes_permuta = "SELECT p.permutas_id,
                    p.permutas_qtd_retirado,
                    p.permutas_data,
                    p.permutas_insumos_qtd_cadastrado,
                    p.permutas_validade_retirado,
                    p.permutas_qtd_retirado,
                    p.permutas_insumos_validade_cadastrado,
                    u.usuario_primeiro_nome,
                    e.estoques_nome as nome_estoque_retirado,
                    es.estoques_nome as nome_estoque_cadastrado,
                    ins.insumos_nome as nome_insumo_cadastrado,
                    ins.insumos_descricao as descricao_insumo_cadastrado,
                    i.insumos_nome as nome_insumo_retirado,
                    i.insumos_descricao as descricao_insumo_retirado,
                    inst.instituicoes_razao_social

                FROM permutas p
                
                    INNER JOIN usuarios u
                    ON p.permutas_operador = u.usuario_id
                
                    INNER JOIN deposito d 
                    ON p.permutas_deposito_id = d.deposito_id
                
                    INNER JOIN insumos ins
                    ON p.permutas_insumos_id_cadastrado = ins.insumos_id
                
                    INNER JOIN insumos i
                    ON d.deposito_insumos_id = i.insumos_id
                
                    INNER JOIN estoques e
                    ON p.permutas_estoques_id_retirado = e.estoques_id
                
                    INNER JOIN estoques es
                    ON p.permutas_estoques_id_cadastrado = es.estoques_id

                    INNER JOIN instituicoes inst
                    ON p.permutas_instituicao_id = inst.instituicoes_id
                
                    WHERE permutas_id={$permutaId}";

$result = mysqli_query($conexao,$sql_detalhes_permuta) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($result);

?>

<div class="container cadastro_all">
    <div class="cards permuta">
        <div class="voltar">
            <h3>Detalhes da Operação de Permuta</h3>
            <a href="index.php?menuop=permuta" class="confirmaVolta">
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
                        <input type="text" class="form-control largura_um_terco" value="Permuta" readonly>
                    </div>
                    
                    <div class="display-flex-cl">
                        <label>Quem Realizou</label>
                        <input type="text" class="form-control largura_um_terco" value='<?=$dados["usuario_primeiro_nome"]?>' readonly>

                    </div>

                    <div class="display-flex-cl">
                        <label>Data da transferência</label>
                        <input type="datetime-local" class="form-control" value='<?=$dados["permutas_data"]?>' readonly>
                    </div>

                    <div class="display-flex-cl">
                        <label>Instituição que Permutou</label>
                        <input class="form-control" value='<?=$dados["instituicoes_razao_social"]?>' readonly>
                    </div>
                </div>
            </div>

            <hr>
            <div class="display-flex-cl" id="dados_insumo_permuta_dep">
                <div class="display-flex-row">
                    <div id="permuta_dep">
                        <h4>Item retirado do Depósito</h4>
                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Insumo</label>
                                <input type="text" class="form-control largura_um_terco" value="<?=$dados["nome_insumo_retirado"]?>" readonly>
                            </div>

                            <div class="display-flex-cl">
                                <label>Validade</label>
                                <input type="date" class="form-control largura_um_terco" value="<?=$dados["permutas_validade_retirado"]?>" readonly>
                            </div>
                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Quantidade Permutada</label>
                                <input type="number" class="form-control largura_metade" value="<?=$dados["permutas_qtd_retirado"]?>" required>
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
                                <input type="date" class="form-control largura_um_terco" value="<?=$dados["permutas_insumos_validade_cadastrado"]?>" readonly>
                            </div>
                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Quantidade Inserida</label>
                                <input type="number" class="form-control largura_metade" value="<?=$dados["permutas_insumos_qtd_cadastrado"]?>" required>
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
