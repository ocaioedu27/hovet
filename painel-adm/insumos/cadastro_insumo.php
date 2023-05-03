<div class="container cadastro_all">
    <div class="cards cadastro_insumo">
        <div class="voltar">
            <h4>Cadastro de Insumo</h4>
            <a href="index.php?menuop=insumos" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=inserir_insumo" method="post">

            <div id="dados_insumos_cad">
                <hr>
                <div>
                    <div class="form-group valida_movimentacao">

                        <div class="display-flex-cl">
                            <label for="nomeInsumo">Nome</label>
                            <input type="text" class="form-control" name="nomeInsumo[]" required>
                        </div>

                        <div class="display-flex-cl">
                            <label>Quantidade Crítica</label>
                            <input type="number" class="form-control" name="qtdCriticaInsumo[]" min="1" required>
                        </div>

                        <div class="display-flex-cl">    
                            <label>Unidade</label>
                            <select class="form-control" name="unidadeInsumo[]" required>
                                <option>Caixa</option>
                                <option>Pacote</option>
                            </select>
                        </div>

                        <div class="display-flex-cl">
                            <label>Tipo de Insumo</label>
                            <select class="form-control" name="tipoInsumo[]" required>
                                <option>1 - Medicamentos</option>
                                <option>2 - Material de procedimento</option>
                                <option>3 - Medicamentos controlados</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group valida_movimentacao">

                        <div class="display-flex-cl">
                            <label>Descrição</label>
                            <textarea class="form-control largura_metade" name="descricaoInsumo[]" rows="3" required></textarea>
                        </div>

                        <button class="btn" type="button" onclick="adicionaCampoCad(3)" style="padding: 0;">+</button>

                    </div>

                </div> 

            </div>

            <div class="form-group valida_movimentacao">
                <label for="valida_dados_insercao_insumos">Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="valida_dados_insercao_insumos" required>
            </div>

            
            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarInsumo" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>