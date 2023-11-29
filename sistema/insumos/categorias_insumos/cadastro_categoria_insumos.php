<div class="container cadastro_all">
    <div class="cards cadastro_categoria_insumo">
        <div class="voltar">
            <h4>Cadastro de Nova Categoria</h4>
            <a href="index.php?menuop=categorias_insumos" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=inserir_categoria" method="post">

            <div id="dados_categoria_insumos_cad">
                <hr>
                <div class="display-flex-row">
                    <div class="form-group">

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Nome da Nova Categoria</label>
                                <input type="text" class="form-control" name="nomeNovaCategoriaInsumo[]" placeholder="Infome o nome..." required>
                            </div>

                        </div>

                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Descrição da Categoria</label>
                                <textarea name="descNovaCategoriaInsumo[]" class="form-control" rows="3" placeholder="Infome a descrição..." ></textarea>
                            </div>
                        </div>
                    </div>

                    <button class="btn" type="button" onclick="adicionaCampoCad(9)" style="padding: 0;">+</button>

                </div> 

            </div>

            <div class="form-group valida_movimentacao">
                <label>Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="valida_dados_insercao_categoria" required>
            </div>

            
            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarCategoriaInsumo" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>