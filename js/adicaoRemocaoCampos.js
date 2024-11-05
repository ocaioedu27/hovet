var controle_campo_geral = 1;

function adicionaCampoCad(ondeCadastrou, name_input_tag=null,id_tag_span=null, id_para_search=null,id_input_tag=null, listas=null, tagOrigem=null, tagParaAdicionar=null) {

    controle_campo_geral++;
  
    if (ondeCadastrou == 1) {
      // Cadastro no depósito
      let dados_insumo_dep = document.getElementById('dados_insumo_dep');
      dados_insumo_dep.insertAdjacentHTML('beforeend', '<div id="campoCadDeposito'+controle_campo_geral+'"><div class="form-group valida_movimentacao"> <div class="display-flex-cl"><label>Nome</label><input class="form-control" type"text" name="insumoID_Insumodeposito[]" id="insumoID_Insumodeposito'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 1, false)" placeholder="Pesquuise pelo nome do insumo..." required/><span class="ajuste_span" id="resultado_cad_deposito_insumos'+controle_campo_geral+'"></span></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control" name="validadeInsumodeposito[]" required></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Quantidade guardada</label><input type="number" class="form-control" name="quantidadeInsumodeposito[]" min="1" placeholder="Informe a quantidade..." onkeyup="verifica_valor(\'qtd_guardada_'+controle_campo_geral+'\', \'msg_alerta_qtd_guardada_'+controle_campo_geral+'\', \'btn_cadastrar\', \'0\')" id="qtd_guardada_'+controle_campo_geral+'" required><span class="alerta_senhas_iguais" style="display: none;" id="msg_alerta_qtd_guardada_'+controle_campo_geral+'"><label>Valor inválido! Por favor, altere para um valor válido!</label><ion-icon name="alert-circle-outline"></ion-icon></span></div><div class="display-flex-cl"><label>Depósito de Destino</label><input type="text" class="form-control" name="depositoDestinoInsumodeposito[]" id="estoqueDestino'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 5, \'deposito\')" placeholder="Informe o depósito..." required><span class="ajuste_span" id="resultado_cad_deposito_estoque'+controle_campo_geral+'"></span></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea type="text" class="form-control largura_metade" id="descricaoInsumoCadDep'+controle_campo_geral+'" readonly></textarea></div><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'campoCadDeposito\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(1)" style="padding: 0;">+</button></div></div>');
  
    } else if (ondeCadastrou == 2) {
    
      //PARA CADASTRAR INSUMO NO DISPENSARIO
  
      let dados_insumo_disp = document.getElementById('dados_insumo_disp');
      dados_insumo_disp.insertAdjacentHTML('beforeend', '<div id="campoCadDispensario'+controle_campo_geral+'"><hr><div class="form-group valida_movimentacao"> <div class="display-flex-cl"><label>Insumo</label><input class="form-control" type"text" name="insumoID_Insumodispensario[]" id="insumoID_Insumodispensario'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 2)" placeholder="Procure pelo nome do insumo..." required/><span class="ajuste_span" id="resultado_cad_disp_insumos'+controle_campo_geral+'"></span></div><div class="display-flex-cl"><label for="quantidadeInsumoDisponivelDeposito"> Disponível no Depósito</label><input type="text" class="form-control largura_um_terco" name="quantidadeInsumoDisponivelDeposito" id="quantidadeInsumoDisponivelDeposito'+controle_campo_geral+'" onchange="verificaValorMaximoExcedido(\'quantidadeMovidaParaDispensario'+controle_campo_geral+'\',\'quantidadeInsumoDisponivelDeposito'+controle_campo_geral+'\',\'alerta_valor_acima_max'+controle_campo_geral+'\',\'btn_mv_insumo_dep_to_disp\')" readonly></div><div class="display-flex-cl"><label>Dispensário de Destino</label><input type="text" class="form-control" name="dispensarioDestino[]" id="estoqueDestino'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 5, \'dispensario\')" placeholder="Informe o dispensário..." required><span class="ajuste_span" id="resultado_cad_deposito_estoque'+controle_campo_geral+'"></span></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Quantidade Transferida</label><input type="number" class="form-control" name="quantidadeInsumoDispensario[]" min="1" id="quantidadeMovidaParaDispensario'+controle_campo_geral+'" onkeyup="verificaValorMaximoExcedido(\'quantidadeMovidaParaDispensario'+controle_campo_geral+'\',\'quantidadeInsumoDisponivelDeposito'+controle_campo_geral+'\',\'alerta_valor_acima_max'+controle_campo_geral+'\',\'btn_mv_insumo_dep_to_disp\')" placeholder="Informe a quantidade..." required><span class="alerta_senhas_iguais" style="display: none; margin-top: 2%;" id="alerta_valor_acima_max'+controle_campo_geral+'"><label>Valor acima ou igual do que há disponível!<ion-icon name="alert-circle-outline"></ion-icon></label></span></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control" name="validadeInsumoDeposito[]"  id="validadeInsumoDeposito'+controle_campo_geral+'" readonly></div><div class="display-flex-cl"><label>Local</label><select class="form-control" name="localInsumodispensario[]" id="localInsumodispensario'+controle_campo_geral+'" required><option>1 - Armário</option><option>2 - Estante</option><option>3 - Gaveteiro</option></select></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea type="text" class="form-control largura_metade" id="descricaoInsumoDeposito'+controle_campo_geral+'" readonly></textarea></div><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'campoCadDispensario\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(2)" style="padding: 0;">+</button></div></div>');
  
    } else if (ondeCadastrou == 3){
      // PARA CADASTRO DE INSUMOS NO DB
      let dados_insumo_cad = document.getElementById('dados_insumos_cad');
      dados_insumo_cad.insertAdjacentHTML('beforeend', '<div id="campoCadInsumo'+controle_campo_geral+'"><hr><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Nome</label><input type="text" class="form-control" name="nomeInsumo[]" placeholder="Informe o nome..." required></div><div class="display-flex-cl"><label>Quantidade Crítica</label><input type="number" class="form-control" name="qtdCriticaInsumo[]" min="1" onkeyup="verifica_valor(\'valor_qtd_'+controle_campo_geral+'\', \'msg_alerta_'+controle_campo_geral+'\', \'btn_cadastrar\', \'0\')" id="valor_qtd_'+controle_campo_geral+'" placeholder="Informe a quantidade crítica..." required><span class="alerta_senhas_iguais" style="display: none;" id="msg_alerta_'+controle_campo_geral+'"><label>Valor inválido! Por favor, altere para um valor válido! <ion-icon name="alert-circle-outline"></ion-icon></label></span></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Unidade</label><select class="form-control" name="unidadeInsumo[]" required><option>Caixa</option><option>Pacote</option></select></div><div class="display-flex-cl"><label>Tipo de Insumo</label><input type="text" class="form-control" name="tipoInsumo[]" id="tipos_insumo_'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+',6)" placeholder="Informe o nome da categoria..." required/><span class="ajuste_span" id="resultado_cad_categoria_insumo_'+controle_campo_geral+'"></span></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea class="form-control" name="descricaoInsumo[]" rows="3" required></textarea></div><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'campoCadInsumo\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(3)" style="padding: 0;">+</button></div></div>');
  
    } else if (ondeCadastrou == 4){
      // PARA RETIRADA DO INSUMO DO DISPENSARIO
  
      let dados_insumo_disp = document.getElementById('dados_insumo_disp');
      dados_insumo_disp.insertAdjacentHTML('beforeend', '<div id="campoRetiraInsumoDisp'+controle_campo_geral+'"><hr><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Insumo Solicitado</label><input type="text" class="form-control" name="insumo_dispensario_id[]" id="insumo_dispensario_id'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 3)" placeholder="Procure pelo nome do insumo..." required><span class="ajuste_span" id="resultado_slc_disp_insumos'+controle_campo_geral+'"></span></div><div class="display-flex-cl"><label>Quantidade Solicitada</label><input type="number" class="form-control largura_um_terco" name="quantidade_insumo_solic_dispensario[]" id="qtd_solicitada_dispensario'+controle_campo_geral+'" min="1" onkeyup="verificaValorMaximoExcedido(\'qtd_solicitada_dispensario'+controle_campo_geral+'\',\'quantidade_atual_dispensario'+controle_campo_geral+'\',\'alerta_valor_acima_max'+controle_campo_geral+'\',\'btn_slc_insumo_disp\', \'label_to_alert_'+controle_campo_geral+'\')" placeholder="Informe a quantidade..." required><span class="alerta_senhas_iguais" style="display: none; margin-top: 2%;" id="alerta_valor_acima_max'+controle_campo_geral+'"><label id="label_to_alert_'+controle_campo_geral+'">Valor inválido!!<ion-icon name="alert-circle-outline"></ion-icon></label></span></div><div class="display-flex-cl"><label>Validade do Insumo</label><input type="date" class="form-control largura_um_terco" name="validade_insumo_dispensario[]" id="validade_insumo_dispensario'+controle_campo_geral+'" readonly></div><div class="display-flex-cl"><label>Disponível no Dispensário</label><input type="number" class="form-control largura_um_terco" name="quantidade_atual_dispensario[]" id="quantidade_atual_dispensario'+controle_campo_geral+'" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea class="form-control largura_metade" id="descricaoInsumoSclDisp'+controle_campo_geral+'" rows="3" readonly></textarea></div><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'campoRetiraInsumoDisp\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(4)" style="padding: 0;">+</button></div></div>');
  
    } else if (ondeCadastrou == 5){
      // PARA PERMUTA DE INSUMO DO DEPÓSITO
  
      let dados_insumo_permuta_dep = document.getElementById('dados_insumo_permuta_dep');
      dados_insumo_permuta_dep.insertAdjacentHTML('beforeend', '<div id="insumo_permuta_dep'+controle_campo_geral+'"><hr><div class="display-flex-row form-group valida_movimentacao"><div id="permuta_dep"><h4>Item a ser retirado do Depósito</h4><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Insumo</label><input type="text" class="form-control largura_um_terco" name="insumoID_InsumoPermuta[]" id="permuta_deposito_insumo_id_'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 4)" placeholder="informe o nome do insumo..." required><span class="ajuste_span" id="resultado_permuta_insumos'+controle_campo_geral+'" ></span></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control largura_um_terco" name="validadeInsumoDeposito[]" id="validadeInsumoDepositoPermuta'+controle_campo_geral+'" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Quantidade Permutada</label><input type="number" class="form-control largura_metade" name="quantidadeInsumoDepositoPermuta[]" min="1" id="quantidade_solicitada_permuta'+controle_campo_geral+'" onkeyup="verificaValorMaximoExcedido(\'quantidade_solicitada_permuta'+controle_campo_geral+'\',\'quantidade_atual_deposito_permuta'+controle_campo_geral+'\',\'alerta_valor_acima_max'+controle_campo_geral+'\',\'btn_permuta_insumo_dep\')" required><span class="alerta_senhas_iguais" style="display: none; margin-top: 2%;" id="alerta_valor_acima_max'+controle_campo_geral+'"><label>Valor acima ou igual do que há disponível!<ion-icon name="alert-circle-outline"></ion-icon></label></span></div><div class="display-flex-cl"><label> Disponível no Depósito</label><input type="text" class="form-control largura_metade" name="quantidadeInsumoDisponivelDeposito[]" id="quantidade_atual_deposito_permuta'+controle_campo_geral+'" onchange="verificaValorMaximoExcedido(\'quantidade_solicitada_permuta'+controle_campo_geral+'\',\'quantidade_atual_deposito_permuta'+controle_campo_geral+'\',\'alerta_valor_acima_max'+controle_campo_geral+'\',\'btn_permuta_insumo_dep\',\'label_mesage_to_insert_'+controle_campo_geral+'\')" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição do insumo</label><textarea name="descricaoInsumoDeposito[]" cols="10" rows="2" class="form-control largura_um_terco" id="descricaoInsumoDepositoPermuta'+controle_campo_geral+'" readonly></textarea></div><div class="display-flex-cl"><label>Depósito De Retirada</label><input type="text" class="form-control largura_um_terco" name="depositoRetiradaPermuta[]" id="deposito_origem_insumo_retirado'+controle_campo_geral+'" readonly></div></div></div><div id="permuta_dep"><h4>Item a ser atualizado do Depósito</h4><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Insumo</label><input type="text" class="form-control largura_um_terco" name="insumoID_InsumoCadPermuta[]" id="insumoID_Insumodeposito'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 1,true)" placeholder="informe o nome do insumo..." required><span class="ajuste_span" id="resultado_cad_deposito_insumos'+controle_campo_geral+'"></span></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control largura_um_terco" name="validadeInsumoCadPermuta[]" id="validadeInsumoDepositoPermuta'+controle_campo_geral+'" required></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Quantidade Inserida</label><input type="number" class="form-control largura_metade" name="quantidadeInsumoCadPermuta[]" min="1" onkeyup="verifica_valor(\'valor_qtd_'+controle_campo_geral+'\', \'msg_alerta_'+controle_campo_geral+'\', \'btn_cadastrar\', \'0\')" id="valor_qtd_'+controle_campo_geral+'"  required><span class="alerta_senhas_iguais" style="display: none;" id="msg_alerta_'+controle_campo_geral+'"><label>Valor inválido! Por favor, altere para um valor válido! <ion-icon name="alert-circle-outline"></ion-icon></label></span></div><div class="display-flex-cl"><label>Depósito de Destino</label><input type="text" class="form-control largura_um_terco" name="depositoDestinoInsumoPermuta[]" id="estoqueDestino'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 5, \'deposito\')" placeholder="Informe o Destino..." required><span class="ajuste_span" id="resultado_cad_deposito_estoque'+controle_campo_geral+'"></span></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição do insumo</label><textarea name="descricaoInsumoDeposito" cols="10" rows="2" class="form-control largura_metade" id="descricaoInsumoCadDep'+controle_campo_geral+'" readonly></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'insumo_permuta_dep\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(5)" style="padding: 0;">+</button></div></div></div></div></div>');
  
    } else if (ondeCadastrou == 6){
      // PARA CADASTRO DE ESTOQUE
      let dados_estoque_cad = document.getElementById('dados_estoque_cad');
      dados_estoque_cad.insertAdjacentHTML('beforeend', '<div id="campoCadEstoque'+controle_campo_geral+'" class="display-flex-row"><hr><div class="form-group"><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Nome do Novo Estoque</label><input type="text" class="form-control" name="nomeNovoEstoque[]" required></div><div class="display-flex-cl"><label>Tipo do Novo Estoque</label><select class="form-control" name="tipoNovoEstoque[]" id="destino'+controle_campo_geral+'" required></select></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição do Estoque</label><textarea name="descricaoNovoEstoque[]" class="form-control" rows="3"></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'campoCadEstoque\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(6, null, null, null, null, null, \'origem1\',\'destino\')" style="padding: 0;">+</button></div></div></div></div>');
  
    } else if (ondeCadastrou == 7){
      // PARA CADASTRO DE FORNECEDOR
      let dados_fornecedor_cad = document.getElementById('dados_fornecedor_cad');
      dados_fornecedor_cad.insertAdjacentHTML('beforeend', '<div id="campoCadFornecedor'+controle_campo_geral+'" class="display-flex-row"><div class="form-group"><hr style="border-color: transparent;"><hr><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Nome ou Razão Social</label><input type="text" class="form-control" name="razaoSocialFornecedor[]" placeholder="Informe a Razão Social..." required></div><div class="display-flex-cl"><label>CNPJ ou CPF</label><input type="text" class="form-control" maxlength="14" name="cnpjCpfFornecedor[]" placeholder="Informe somente números..." min="1" required></div><div class="display-flex-cl"><label>Categoria</label><input type="text" class="form-control" name="categoriaFornecedor[]" id="tipos_fornecedor_'+ controle_campo_geral +'" onkeyup="searchInput_cadDeposito(this.value,'+controle_campo_geral+',9)" placeholder="Busque a categoria..." required/><span class="ajuste_span" id="resultado_cad_categoria_fornecedor_'+ controle_campo_geral +'"></span></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Logradouro</label><input type="text" class="form-control" name="logradouroFornecedor[]" placeholder="Informe o Logradouro..."></div><div class="display-flex-cl"><label>CEP</label><input type="text" class="form-control" name="cepFornecedor[]" placeholder="Informe o CEP..." maxlength="8"></div><div class="display-flex-cl"><label>Bairro</label><input type="text" class="form-control" name="bairroFornecedor[]" placeholder="Informe o Bairro..."></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Número do Endereço</label><input type="text" class="form-control" name="numEnderecoFornecedor[]" placeholder="Informe o Número..." maxlength="14"></div><div class="display-flex-cl"><label>E-mail</label><input type="text" class="form-control" name="emailFornecedor[]" placeholder="Informe o E-mail..."></div><div class="display-flex-cl"><label>Fone ou FAC</label><input type="text" class="form-control" name="foneFacFornecedor[]" placeholder="Informe o contato..." maxlength="14"></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Deseja inserir dados a mais?</label><textarea class="form-control " name="observacaoFornecedor[]" rows="3"></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'campoCadFornecedor\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(7)" style="padding: 0;">+</button></div></div></div></div>');
  
    } else if (ondeCadastrou == 8){
      // PARA CADASTRO DE INSTITUICAO
      let dados_fornecedor_cad = document.getElementById('dados_instituicao_cad');
      dados_fornecedor_cad.insertAdjacentHTML('beforeend', '<div id="campoCadInstituicao'+controle_campo_geral+'" class="display-flex-row"><div class="form-group"><hr style="border-color: transparent;"><hr><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Razão Social</label><input type="text" class="form-control" name="razaoSocialInstituicao[]" placeholder="Informe a Razão Social..." required></div><div class="display-flex-cl"><label>CNPJ ou CPF</label><input type="text" class="form-control" maxlength="14" name="cnpjCpfInstituicao[]" placeholder="Informe somente números..." min="1" required></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Logradouro</label><input type="text" class="form-control" name="logradouroInstituicao[]" placeholder="Informe o Logradouro..."></div><div class="display-flex-cl"><label>CEP</label><input type="text" class="form-control" name="cepInstituicao[]" placeholder="Informe o CEP..."></div><div class="display-flex-cl"><label>Bairro</label><input type="text" class="form-control" name="bairroInstituicao[]" placeholder="Informe o Bairro..."></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Número do Endereço</label><input type="text" class="form-control" name="numEnderecoInstituicao[]" placeholder="Informe o Número..."></div><div class="display-flex-cl"><label>E-mail</label><input type="text" class="form-control" name="emailInstituicao[]" placeholder="Informe o E-mail..."></div><div class="display-flex-cl"><label>Fone ou FAC</label><input type="text" class="form-control" name="foneFacInstituicao[]" placeholder="Informe o contato..." maxlength="14"></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Deseja inserir dados a mais?</label><textarea class="form-control " name="observacaoInstituicao[]" rows="3"></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'campoCadInstituicao\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(8)" style="padding: 0;">+</button></div></div></div></div>');
  
    } else if (ondeCadastrou == 9){
      // PARA CADASTRO DE CATEGORIA DE INSUMO
      let dados_categoria_insumos_cad = document.getElementById('dados_categoria_insumos_cad');
      dados_categoria_insumos_cad.insertAdjacentHTML('beforeend', '<div id="campoCadCategoriaInsumo'+controle_campo_geral+'" class="display-flex-row"><div class="form-group"><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Nome da Nova Categoria</label><input type="text" class="form-control" name="nomeNovaCategoriaInsumo[]" required></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição da Categoria</label><textarea name="descNovaCategoriaInsumo[]" class="form-control" rows="3"></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'campoCadCategoriaInsumo\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(9)" style="padding: 0;">+</button></div></div></div></div>');
  
    } else if (ondeCadastrou == 10){
      // PARA CADASTRO DE PERMISSAO DE USUARIO
      let dados_permissoes_cad = document.getElementById('dados_permissoes_cad');
      dados_permissoes_cad.insertAdjacentHTML('beforeend', '<div id="campoCadPermissao'+controle_campo_geral+'" class="display-flex-row"><div class="form-group"><hr><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Nome</label><input type="text" class="form-control" name="nomePermissao[]" required></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea name="descPermissao[]" class="form-control" rows="3"></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'campoCadPermissao\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(10)" style="padding: 0;">+</button></div></div></div></div>');
  
    } else if (ondeCadastrou == 11){
      // PARA CONCEDER PERMISSOES AO USUÁRIO
      let dados_acesso_usuario = document.getElementById('dados_acesso_usuario');
      let id_user_to_add_permission = document.getElementById('id_user_to_add_permission').value;
      dados_acesso_usuario.insertAdjacentHTML('beforeend', '<div id="campoCedePermissao'+controle_campo_geral+'" class="display-flex-row"><div class="form-group"><hr><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Nome da Permissão</label><input type="text" class="form-control" name="nomeAcessoUsuario[]" id="nomeAcessoUsuario'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 7, '+ id_user_to_add_permission +')" required><span class="ajuste_span" id="resultado_ceder_permissao'+controle_campo_geral+'"></span></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Categoria da Permissão</label><textarea name="descAcessoUsuario[]" class="form-control" rows="3" id="descAcessoUsuario'+controle_campo_geral+'" readonly></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'campoCedePermissao\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(11)" style="padding: 0;">+</button></div></div></div></div>');
  
    } else if (ondeCadastrou == 12){
      // PARA SELECIONAR O TIPO DE MOVIMENTAÇÃO - PADRÂO
      let campos_id_movimentacoes = document.getElementById('campos_id_movimentacoes');
      campos_id_movimentacoes.insertAdjacentHTML('beforeend', '<div class="display-flex-row" id="campo_tipo_mov_'+controle_campo_geral+'" style="margin-top: 10px;"><div class="display-flex-cl"><input type="text" class="form-control" name="tipo_movimentacao[]" id="tipo_movimentacao_'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 8)" placeholder="Informe o valor..." required><span class="ajuste_span" id="sugestao_resultado_span_'+controle_campo_geral+'"></span></div><div class="display-flex-row"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'campo_tipo_mov_\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(12)" style="padding: 0;">+</button></div></div>');

    } else if (ondeCadastrou == 13){
      // PARA SELECIONAR O TIPO DE MOVIMENTAÇÃO
      let id_do_input = id_input_tag.substring(0,id_input_tag.length - 1);
      let id_do_span = id_tag_span.substring(0,id_tag_span.length - 1);
      let campos_id_movimentacoes = document.getElementById('campos_id_movimentacoes');
      campos_id_movimentacoes.insertAdjacentHTML('beforeend', '<div class="display-flex-row" id="campo_tipo_mov_'+controle_campo_geral+'" style="margin-top: 10px;"><div class="display-flex-cl"><input type="text" class="form-control" name="'+name_input_tag+'[]" id="'+id_do_input+''+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', '+id_para_search+')" placeholder="Pesquise..." required><span class="ajuste_span" id="'+ id_do_span +''+controle_campo_geral+'"></span></div><div class="display-flex-row"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'campo_tipo_mov_\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(13,\''+name_input_tag+'\',\''+id_do_span+''+controle_campo_geral+'\', '+id_para_search+', \''+id_do_input+''+controle_campo_geral+'\')" style="padding: 0;">+</button></div></div>');
  
    } else if (ondeCadastrou == 14){

      // PARA CADASTRO DE CATEGORIA DE FORNECEDORES
      let dados_categoria_insumos_cad = document.getElementById('dados_categoria_fornecedores_cad');
      dados_categoria_insumos_cad.insertAdjacentHTML('beforeend', '<div id="campoCadCategoriaFornecedor'+controle_campo_geral+'" class="display-flex-row"><div class="form-group"><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Nome da Nova Categoria</label><input type="text" class="form-control" name="nomeNovaCategoria[]" placeholder="Infome o nome..." required></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição da Categoria</label><textarea name="descNovaCategoria[]" class="form-control" rows="3" placeholder="Infome a descrição ..."></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'campoCadCategoriaFornecedor\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(14)" style="padding: 0;">+</button></div></div></div></div>');
  
    } else if (ondeCadastrou == 15){
      // PARA CADASTRO DE TIPO DE ESTOQUE
      let dados_estoque_cad = document.getElementById('dados_tipo_estoque_cad');
      dados_estoque_cad.insertAdjacentHTML('beforeend', '<div id="campoCadTpEstoque'+controle_campo_geral+'" class="display-flex-row"><div class="form-group"><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Nome do Novo Estoque</label><input type="text" class="form-control" name="nomeNovoTipoEstoque[]" required></div><div class="display-flex-row"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'campoCadTpEstoque\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(15, null, null, null, null, '+listas+')" style="padding: 0;">+</button></div></div></div></div>');
  
    } else if (ondeCadastrou == 16){
      // PARA CADASTRO DE INSUMOS NA FARMÁCIA
      let dados_cad_farm = document.getElementById('dados_cad_farm');
      dados_cad_farm.insertAdjacentHTML('beforeend', '<div id="campoCadFarm'+controle_campo_geral+'"><hr><div class="form-group valida_movimentacao"> <div class="display-flex-cl"><label>Insumo</label><input class="form-control" type"text" name="insumoID_Insumodispensario[]" id="insumoID_Insumodispensario'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 2)" placeholder="Procure pelo nome do insumo..." required/><span class="ajuste_span" id="resultado_cad_disp_insumos'+controle_campo_geral+'"></span></div><div class="display-flex-cl"><label for="quantidadeInsumoDisponivelDeposito"> Disponível no Depósito</label><input type="text" class="form-control largura_um_terco" name="quantidadeInsumoDisponivelDeposito" id="quantidadeInsumoDisponivelDeposito'+controle_campo_geral+'" onchange="verificaValorMaximoExcedido(\'quantidadeMovidaParaDispensario'+controle_campo_geral+'\',\'quantidadeInsumoDisponivelDeposito'+controle_campo_geral+'\',\'alerta_valor_acima_max'+controle_campo_geral+'\',\'btn_mv_insumo_dep_to_disp\')" readonly></div><div class="display-flex-cl" id="estoquesDestino'+controle_campo_geral+'"><label>Estoque Destino</label></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Quantidade Transferida</label><input type="number" class="form-control" name="quantidadeInsumoDispensario[]" min="1" id="quantidadeMovidaParaDispensario'+controle_campo_geral+'" onkeyup="verificaValorMaximoExcedido(\'quantidadeMovidaParaDispensario'+controle_campo_geral+'\',\'quantidadeInsumoDisponivelDeposito'+controle_campo_geral+'\',\'alerta_valor_acima_max'+controle_campo_geral+'\',\'btn_mv_insumo_dep_to_disp\')" placeholder="Informe a quantidade..." required><span class="alerta_senhas_iguais" style="display: none; margin-top: 2%;" id="alerta_valor_acima_max'+controle_campo_geral+'"><label>Valor acima ou igual do que há disponível!<ion-icon name="alert-circle-outline"></ion-icon></label></span></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control" name="validadeInsumoDeposito[]"  id="validadeInsumoDeposito'+controle_campo_geral+'" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea type="text" class="form-control largura_metade" id="descricaoInsumoDeposito'+controle_campo_geral+'" readonly></textarea></div><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'campoCadFarm\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(16, null, null, null, null, null, \'estoquesDestino1\',\'estoquesDestino\')" style="padding: 0;">+</button></div></div>');
  
    } else if (ondeCadastrou == 17){
      // PARA DOACOES DE INSUMOS
      let dados_doar_farm = document.getElementById('dados_doar_farm');
      dados_doar_farm.insertAdjacentHTML('beforeend', '<div id="campoCadFarm'+controle_campo_geral+'"><hr><div class="form-group valida_movimentacao"> <div class="display-flex-cl"><label>Insumo</label><input class="form-control" type"text" name="insumoID_Insumodispensario[]" id="insumoID_Insumodispensario'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 2)" placeholder="Procure pelo nome do insumo..." required/><span class="ajuste_span" id="resultado_cad_disp_insumos'+controle_campo_geral+'"></span></div><div class="display-flex-cl"><label for="quantidadeInsumoDisponivelDeposito"> Disponível na Farmácia</label><input type="text" class="form-control" name="quantidadeInsumoDisponivelDeposito" id="quantidadeInsumoDisponivelDeposito'+controle_campo_geral+'" onchange="verificaValorMaximoExcedido(\'quantidadeMovidaParaDispensario'+controle_campo_geral+'\',\'quantidadeInsumoDisponivelDeposito'+controle_campo_geral+'\',\'alerta_valor_acima_max'+controle_campo_geral+'\',\'btn_mv_insumo_dep_to_disp\')" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Quantidade a ser doada</label><input type="number" class="form-control" name="quantidadeInsumoDispensario[]" min="1" id="quantidadeMovidaParaDispensario'+controle_campo_geral+'" onkeyup="verificaValorMaximoExcedido(\'quantidadeMovidaParaDispensario'+controle_campo_geral+'\',\'quantidadeInsumoDisponivelDeposito'+controle_campo_geral+'\',\'alerta_valor_acima_max'+controle_campo_geral+'\',\'btn_mv_insumo_dep_to_disp\')" placeholder="Informe a quantidade..." required><span class="alerta_senhas_iguais" style="display: none; margin-top: 2%;" id="alerta_valor_acima_max'+controle_campo_geral+'"><label>Valor acima ou igual do que há disponível!<ion-icon name="alert-circle-outline"></ion-icon></label></span></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control" name="validadeInsumoDeposito[]"  id="validadeInsumoDeposito'+controle_campo_geral+'" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea type="text" class="form-control largura_metade" id="descricaoInsumoDeposito'+controle_campo_geral+'" readonly></textarea></div><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, \'campoCadFarm\')" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(17)" style="padding: 0;">+</button></div></div>');
  
    }

    if(tagOrigem != null && tagParaAdicionar != null){
      tagParaAdicionar = tagParaAdicionar + controle_campo_geral
      defineOptions(tagOrigem, tagParaAdicionar)

    }
  }




function removerCampoCadDeposito(idCampoCad, ehOperacao, cadType) {
  if(ehOperacao){
    let tipo_operacao_cad_dep = document.getElementById('tipo_operacao_cad_dep').value;

    let num_nota_fiscal_cad_dep = document.getElementById('num_nota_fiscal_cad_dep');
    let nota_fiscal_cad_dep = document.getElementById('nota_fiscal_cad_dep');
    let data_cadastro_dep = document.getElementById('data_cadastro_dep');
    let fornecedor_cad_dep = document.getElementById('fornecedorCadInsumoDep');
    let input_num_nota_fiscal_cad_dep = document.getElementById('input_num_nota_fiscal_cad_dep');
    let input_nota_fiscal_cad_dep = document.getElementById('input_nota_fiscal_cad_dep');
    // console.log('//removerCampoCadDeposito/ehOperacao - valor do tipo de operacao: '+tipo_operacao_cad_dep);
    tipo_operacao_cad_dep = tipo_operacao_cad_dep.split(' ')[0];
    // console.log("valor da operacao "+tipo_operacao_cad_dep);

    if (tipo_operacao_cad_dep==3) {
    
      num_nota_fiscal_cad_dep.style.display = 'none';
      nota_fiscal_cad_dep.style.display = 'none';
      input_num_nota_fiscal_cad_dep.removeAttribute("required");
      input_nota_fiscal_cad_dep.removeAttribute("required");
      data_cadastro_dep.classList.add('largura_um_terco');
      fornecedor_cad_dep.classList.add('largura_metade');
    
    } else {
    
      num_nota_fiscal_cad_dep.style.display = 'flex';
      nota_fiscal_cad_dep.style.display = 'flex';
      input_num_nota_fiscal_cad_dep.setAttribute("required", "required");
      input_nota_fiscal_cad_dep.setAttribute("required", "required");
      data_cadastro_dep.classList.remove('largura_um_terco');
      fornecedor_cad_dep.classList.remove('largura_metade');
    
    }

  }else{

    let para_remover_campo_adicional = document.getElementById(""+cadType+""+idCampoCad+"");
    para_remover_campo_adicional.remove();

  }
    
}

function defineOptions(idTagOriginal, idNovaTag) {
  console.log("Tags definidas: " + idTagOriginal + " e " + idNovaTag)
  const selectHtml = document.getElementById(idTagOriginal).outerHTML;

  // Adiciona o HTML do select no novo local
  document.getElementById(idNovaTag).innerHTML += selectHtml;
}