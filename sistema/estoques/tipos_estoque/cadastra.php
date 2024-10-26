<div class="container cadastro_all">
    <div class="cards cadastro_insumo">
        <div class="voltar">
            <h4>Cadastro de Novo Tipo de Estoque</h4>
            <a href="index.php?menuop=tp_estoque" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=insert_tp_estoque" method="post">
            <div id="dados_tipo_estoque_cad">
                <hr>
                <div class="display-flex-row">
                    <div class="form-group">
                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Nome do Novo Tipo de Estoque</label>
                                <input type="text" class="form-control" name="nomeNovoTipoEstoque[]" required>
                            </div>
                        </div>
                    </div>
                    <button class="btn" type="button" onclick="adicionaCampoCad(15)" style="padding: 0;">+</button>
                </div> 
            </div>
            <div class="form-group valida_movimentacao">
                <label>Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="valida_dados_insercao_estoque" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btn_cadastrar" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>