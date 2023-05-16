<div class="container cadastro_all">
    <div class="cards cadastro_fornecedor">
        <div class="voltar">
            <h4>Cadastro de Instituição</h4>
            <a href="index.php?menuop=instituicoes" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=inserir_instituicoes" method="post">

            <div id="dados_instituicao_cad">
                <hr>
                <div class="display-flex-row">
                    <div>
                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Razão Social</label>
                                <input type="text" class="form-control" name="razaoSocialInstituicao[]" placeholder="Informe a Razão Social..." required>
                            </div>

                            <div class="display-flex-cl">
                                <label>Logradouro</label>
                                <input type="text" class="form-control" name="logradouroInstituicao[]" placeholder="Informe o Logradouro...">
                            </div>

                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>CNPJ ou CPF</label>
                                <input type="text" class="form-control" maxlength="14" name="cnpjCpfInstituicao[]" placeholder="Informe somente números..." min="1" required>
                            </div>

                            <div class="display-flex-cl">
                                <label>E-mail</label>
                                <input type="text" class="form-control" name="emailInstituicao[]" placeholder="Informe o E-mail...">
                            </div>

                            <div class="display-flex-cl">
                                <label>Fone ou FAC</label>
                                <input type="text" class="form-control" name="foneFacInstituicao[]" placeholder="Informe o contato..." maxlength="14">
                            </div>

                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Deseja inserir uma observação?</label>
                                <textarea class="form-control " name="observacaoInstituicao[]" rows="3"></textarea>
                            </div>

                        </div>
                    </div>
                    <div>
                        <button class="btn" type="button" onclick="adicionaCampoCad(8)" style="padding: 0;">+</button>
                    </div>


                </div>
            </div>


            <div class="form-group valida_movimentacao">
                <label>Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="valida_dados_insercao_fornecedor" required>
            </div>

            
            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarFornecedor" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>