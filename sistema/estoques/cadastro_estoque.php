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

            <div id="dados_estoque_cad">
                <hr>
                <div class="display-flex-row">
                    <div class="form-group">

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Nome do Novo Estoque</label>
                                <input type="text" class="form-control" name="nomeNovoEstoque[]" required>
                            </div>

                            <div class="display-flex-cl">
                                <label>Tipo do Novo Estoque</label>
                                <select class="form-control" name="tipoNovoEstoque[]" required>
                                    <option>1 - Depósito</option>
                                    <option>2 - Dispensário</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Descrição do Estoque</label>
                                <textarea name="descricaoNovoEstoque[]" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <button class="btn" type="button" onclick="adicionaCampoCad(6)" style="padding: 0;">+</button>

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