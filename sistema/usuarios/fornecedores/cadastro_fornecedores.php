<div class="container cadastro_all">
    <div class="cards cadastro_fornecedor">
        <div class="voltar">
            <h4>Cadastro de Fornecedor</h4>
            <a href="index.php?menuop=fornecedores" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=inserir_fornecedores" method="post">

            <div id="dados_fornecedor_cad">
                <div class="display-flex-row">
                    <div>
                        <hr>
                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Nome ou Razão Social</label>
                                <input type="text" class="form-control" name="razaoSocialFornecedor[]" placeholder="Informe a Razão Social..." required>
                            </div>

                            <div class="display-flex-cl">
                                <label>CNPJ ou CPF</label>
                                <input type="text" class="form-control" maxlength="14" name="cnpjCpfFornecedor[]" placeholder="Informe somente números..." min="1" required>
                            </div>

                            <div class="display-flex-cl">
                                <label>Categoria</label>
                                <input type="text" class="form-control" name="categoriaFornecedor[]" id="tipos_fornecedor_1" onkeyup="searchInput_cadDeposito(this.value, 1,9)" placeholder="Busque a categoria..." required/>
                                <span class="ajuste_span" id="resultado_cad_categoria_fornecedor_1" style="margin: 6.7% auto; width: auto;"></span>
                            </div>

                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Logradouro</label>
                                <input type="text" class="form-control" name="logradouroFornecedor[]" placeholder="Informe o Logradouro...">
                            </div>

                            <div class="display-flex-cl">
                                <label>CEP</label>
                                <input type="text" class="form-control" name="cepFornecedor[]" placeholder="Informe o CEP..." maxlength="8">
                            </div>

                            <div class="display-flex-cl">
                                <label>Bairro</label>
                                <input type="text" class="form-control" name="bairroFornecedor[]" placeholder="Informe o Bairro...">
                            </div>

                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Número do Endereço</label>
                                <input type="text" class="form-control" name="numEnderecoFornecedor[]" placeholder="Informe o Número...">
                            </div>

                            <div class="display-flex-cl">
                                <label>E-mail</label>
                                <input type="text" class="form-control" name="emailFornecedor[]" placeholder="Informe o E-mail...">
                            </div>

                            <div class="display-flex-cl">
                                <label>Fone ou FAC</label>
                                <input type="text" class="form-control" name="foneFacFornecedor[]" placeholder="Informe o contato..." maxlength="14">
                            </div>

                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Deseja inserir uma observação?</label>
                                <textarea class="form-control " name="observacaoFornecedor[]" rows="3"></textarea>
                            </div>

                        </div>
                    </div>
                    <div>
                        <button class="btn" type="button" onclick="adicionaCampoCad(7)" style="padding: 0;">+</button>
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