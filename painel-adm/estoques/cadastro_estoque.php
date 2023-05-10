<div class="container cadastro_all">
    <div class="cards cadastro_estoque">
        <div class="voltar">
            <h4>Cadastro de Novo Estoque</h4>
            <a href="index.php?menuop=estoques" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=inserir_estoque" method="post">

            <div id="dados_insumos_cad">
                <hr>
                <div>
                    <div class="form-group valida_movimentacao">

                        <div class="display-flex-cl">
                            <label>Nome do Novo Estoque</label>
                            <input type="text" class="form-control" name="nomeNovoEstoque[]" required>
                        </div>


                        <div class="display-flex-cl">
                            <label>Tipo do Novo Estoque</label>
                            <select class="form-control" name="tipoNovoEstoque[]" required>
                                <option>Depósito</option>
                                <option>Dispensário</option>
                            </select>
                        </div>

                        <div class="display-flex-cl largura_um_quarto">

                            <button class="btn" type="button" onclick="adicionaCampoCad(3)" style="padding: 0;">+</button>

                        </div>

                    </div>

                </div> 

            </div>

            <div class="form-group valida_movimentacao">
                <label>Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="valida_dados_insercao_estoque" required>
            </div>

            
            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarEstoque" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>