<div class="container cadastro_all">
    <div class="cards cadastro_deposito">
        <div class="voltar ">
            <h4 class="">Inserindo no Depósito</h4>
            <a href="index.php?menuop=deposito" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=inserir_deposito" method="post">
        <!-- <form class="form_cadastro" enctype="multipart/form-data" action="" method="post"> -->

            <div class="dados_fiscais">
                <hr>
                <h3 class="">Dados fiscais</h3>
                <div class="form-group valida_movimentacao">
                    <div class="display-flex-cl">
                        <label>Operação</label>
                        <select class="form-control largura_um_terco" name="tipo_insercao_deposito" id="tipo_operacao_cad_dep" onclick="removerCampoCadDeposito(null, true, null)" required>
                            <?php
                            
                            $sql = "SELECT * FROM tipos_movimentacoes WHERE tipos_movimentacoes_movimentacao = 'Compra' or tipos_movimentacoes_movimentacao = 'Doacao'";
                            $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                            
                            while($dados = mysqli_fetch_assoc($result)){
                            ?>
                            <option><?=$dados["tipos_movimentacoes_id"]?> - <?=$dados["tipos_movimentacoes_movimentacao"]?></option>

                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="display-flex-cl">
                        <?php
                        $sql = "SELECT * FROM usuarios WHERE usuario_id={$sessionUserID}";
                        $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

                        $dados = mysqli_fetch_assoc($result)
                        ?>

                        <label for="quem_esta_guardando_dep">Quem está guardando</label>
                        <input type="text" class="form-control largura_um_terco" name="quem_esta_guardando_dep"       value="<?=$dados['usuario_id']?> - <?=$dados['usuario_primeiro_nome']?>" readonly>
                    </div>

                    <div class="display-flex-cl">
                        <label for="dataCadastroInsumoDeposito">Dia do cadastro</label>
                        <input type="datetime-local" class="form-control" id="data_cadastro_dep" name="dataCadastroInsumoDeposito" required>
                    </div>

                </div>

                <div class="form-group valida_movimentacao">

                    <div class="display-flex-cl" id="nota_fiscal_cad_dep">
                        <label for="nota_fiscal_deposito">Nota fiscal</label>
                        <input type="file" class="form-control" name="nota_fiscal_deposito">
                    </div>

                    <div class="display-flex-cl" id="fornecedor_cad_dep1">
                        <label>Fornecedor</label>
                        <select class="form-control" name="fornecedorCadInsumoDep" required>
                            <?php
                            $sql = "SELECT * FROM fornecedores";
                            $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                            
                            while($dados = mysqli_fetch_assoc($result)){
                            ?>
                            <option><?=$dados["fornecedores_id"]?> - <?=$dados["fornecedores_razao_social"]?></option>

                            <?php
                                }
                            ?>
                        </select>
                        <!-- <input type="text" class="form-control" name="fornecedor_cad_insumo_dep"> -->
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
                            <input type="text" class="form-control" name="insumoID_Insumodeposito[]" id="insumoID_Insumodeposito1" onkeyup="searchInput_cadDeposito(this.value, 1, 1)" placeholder="Informe o nome do insumo..." required/>
                            <span class="ajuste_span" id="resultado_cad_deposito_insumos1" style="margin: 8% auto;"></span>
                        </div>

                        <div class="display-flex-cl">
                            <label for="validadeInsumoDeposito[]">Validade</label>
                            <input type="date" class="form-control" name="validadeInsumodeposito[]" required>
                        </div>
                    
                        <div class="display-flex-cl">
                            <label>Quantidade Crítica</label>
                            <input type="text" class="form-control" id="qtdCriticaInsumoCadDep1" readonly>
                        </div>

                    </div>


                    <div class="form-group valida_movimentacao">
                            
                        <div class="display-flex-cl">
                            <label>Quantidade guardada</label>
                            <input type="number" class="form-control" name="quantidadeInsumodeposito[]" min="1" required>
                        </div>
                            
                        <div class="display-flex-cl">
                            <label>Depósito de Destino</label>
                            <input type="text" class="form-control" name="depositoDestinoInsumodeposito[]" id="depositoDestinoInsumodeposito1" onkeyup="searchInput_cadDeposito(this.value, 1, 5)" required>
                            <span class="ajuste_span" id="resultado_cad_deposito_estoque1" style="margin: 8% auto;"></span>
                        </div>
                    </div>

                    <div class="form-group valida_movimentacao">
                    
                        <div class="display-flex-cl">
                            <label>Descrição</label>
                            <textarea type="text" class="form-control largura_metade" id="descricaoInsumoCadDep1" readonly></textarea>
                        </div>
                    
                        <button class="btn" type="button" onclick="adicionaCampoCad(1)" style="padding: 0;">+</button>
                    </div>
                </div>
            </div>
            
            <hr>
            <div class="form-group valida_movimentacao">
                <label for="valida_dados_insercao_deposito">Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="valida_dados_insercao_deposito" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarInsumoDeposito" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>