<div class="container cadastro_all">
    <div class="cards cadastro_categoria_insumo">
        <div class="voltar">
            <h4>Nova de Categoria de Insumos</h4>
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
                <div class="display-flex-row">
                    <div class="form-group">
                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label for="nomeInsumo">Nome da Categoria</label>
                                <input type="text" class="form-control" name="nomeInsumoCategoria[]" required>
                            </div>
                        </div>

                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Descrição</label>
                                <textarea class="form-control" name="descricaoInsumo[]" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>

                    <button class="btn" type="button" onclick="adicionaCampoCad(3)" style="padding: 0;">+</button>

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