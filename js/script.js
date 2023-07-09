
var controle_campo_geral = 1;

function adicionaCampoCad(ondeCadastrou) {

  controle_campo_geral++;

  if (ondeCadastrou == 1) {
    
    let dados_insumo_dep = document.getElementById('dados_insumo_dep');
    dados_insumo_dep.insertAdjacentHTML('beforeend', '<div id="campoCadDeposito'+controle_campo_geral+'"><div class="form-group valida_movimentacao"> <div class="display-flex-cl"><label>Nome</label><input class="form-control" type"text" name="insumoID_Insumodeposito[]" id="insumoID_Insumodeposito'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 1, false)" placeholder="Informe o nome do insumo..." required/><span class="ajuste_span" id="resultado_cad_deposito_insumos'+controle_campo_geral+'" style="margin: 8% auto;"></span></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control" name="validadeInsumodeposito[]" required></div><div class="display-flex-cl"><label>Quantidade Crítica</label><input type="text" class="form-control" id="qtdCriticaInsumoCadDep'+controle_campo_geral+'" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Quantidade guardada</label><input type="number" class="form-control" name="quantidadeInsumodeposito[]" min="1" required></div><div class="display-flex-cl"><label>Depósito de Destino</label><input type="text" class="form-control" name="depositoDestinoInsumodeposito[]" id="depositoDestinoInsumodeposito'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 5)" required><span class="ajuste_span" id="resultado_cad_deposito_estoque'+controle_campo_geral+'" style="margin: 8% auto;"></span></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea type="text" class="form-control largura_metade" id="descricaoInsumoCadDep'+controle_campo_geral+'" readonly></textarea></div><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, 1)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(1)" style="padding: 0;">+</button></div></div>');

  } else if (ondeCadastrou == 2) {
  
    //PARA CADASTRAR INSUMO NO DISPENSARIO

    let dados_insumo_disp = document.getElementById('dados_insumo_disp');
    dados_insumo_disp.insertAdjacentHTML('beforeend', '<div id="campoCadDispensario'+controle_campo_geral+'"><hr><div class="form-group valida_movimentacao"> <div class="display-flex-cl"><label>Insumo</label><input class="form-control largura_um_terco" type"text" name="insumoID_Insumodispensario[]" id="insumoID_Insumodispensario'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 2)" placeholder="Informe o nome do insumo..." required/><span class="ajuste_span" id="resultado_cad_disp_insumos'+controle_campo_geral+'" style="margin: 9.5% auto;"></span></div><div class="display-flex-cl"><label for="quantidadeInsumoDisponivelDeposito"> Disponível no Depósito</label><input type="text" class="form-control largura_um_terco" name="quantidadeInsumoDisponivelDeposito" id="quantidadeInsumoDisponivelDeposito'+controle_campo_geral+'" onchange="verificaValorMaximoExcedido(\'quantidadeMovidaParaDispensario'+controle_campo_geral+'\',\'quantidadeInsumoDisponivelDeposito'+controle_campo_geral+'\',\'alerta_valor_acima_max'+controle_campo_geral+'\',\'btn_mv_insumo_dep_to_disp\')" readonly></div><div class="display-flex-cl"><label>Dispensário de Destino</label><input type="text" class="form-control" name="estoqueDestinoInsumodeposito[]" id="depositoDestinoInsumodeposito'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 5)" required><span class="ajuste_span" id="resultado_cad_deposito_estoque'+controle_campo_geral+'" style="margin: 9.5% auto;"></span></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Quantidade Transferida</label><input type="number" class="form-control" name="quantidadeInsumoDispensario[]" min="1" id="quantidadeMovidaParaDispensario'+controle_campo_geral+'" onkeyup="verificaValorMaximoExcedido(\'quantidadeMovidaParaDispensario'+controle_campo_geral+'\',\'quantidadeInsumoDisponivelDeposito'+controle_campo_geral+'\',\'alerta_valor_acima_max'+controle_campo_geral+'\',\'btn_mv_insumo_dep_to_disp\')" required><span class="alerta_senhas_iguais" style="display: none; margin-top: 2%;" id="alerta_valor_acima_max'+controle_campo_geral+'"><label>Valor acima ou igual do que há disponível!<ion-icon name="alert-circle-outline"></ion-icon></label></span></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control" name="validadeInsumoDeposito[]"  id="validadeInsumoDeposito'+controle_campo_geral+'" readonly></div><div class="display-flex-cl"><label>Local</label><select class="form-control" name="localInsumodispensario[]" id="localInsumodispensario'+controle_campo_geral+'" required><option>1 - Armário</option><option>2 - Estante</option><option>3 - Gaveteiro</option></select></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea type="text" class="form-control largura_metade" id="descricaoInsumoDeposito'+controle_campo_geral+'" readonly></textarea></div><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, 2)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(2)" style="padding: 0;">+</button></div></div>');

  } else if (ondeCadastrou == 3){
    // PARA CADASTRO DE INSUMOS NO DB
    let dados_insumo_cad = document.getElementById('dados_insumos_cad');
    dados_insumo_cad.insertAdjacentHTML('beforeend', '<div id="campoCadInsumo'+controle_campo_geral+'"><hr><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Nome</label><input type="text" class="form-control" name="nomeInsumo[]" required></div><div class="display-flex-cl"><label>Quantidade Crítica</label><input type="number" class="form-control" name="qtdCriticaInsumo[]" min="1" required></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Unidade</label><select class="form-control" name="unidadeInsumo[]" required><option>Caixa</option><option>Pacote</option></select></div><div class="display-flex-cl"><label>Tipo de Insumo</label><input type="text" class="form-control" name="tipoInsumo[]" id="tipos_insumo_'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+',6)" placeholder="Informe o nome da categoria..." required/><span class="ajuste_span" id="resultado_cad_categoria_insumo_'+controle_campo_geral+'" style="margin: 9.2% auto; width: 72%;"></span></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea class="form-control largura_metade" name="descricaoInsumo[]" rows="3" required></textarea></div><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, 3)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(3)" style="padding: 0;">+</button></div></div>');

  } else if (ondeCadastrou == 4){
    // PARA RETIRADA DO INSUMO DO DISPENSARIO

    let dados_insumo_disp = document.getElementById('dados_insumo_disp');
    dados_insumo_disp.insertAdjacentHTML('beforeend', '<div id="campoRetiraInsumoDisp'+controle_campo_geral+'"><hr><div class="form-group valida_movimentacao"><div class="display-flex-cl" style="margin-right: 30px;"><label>Insumo Solicitado</label><input type="text" class="form-control" name="insumo_dispensario_id[]" id="insumo_dispensario_id'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 3)" placeholder="Informe o insumo..." required><span class="ajuste_span" id="resultado_slc_disp_insumos'+controle_campo_geral+'" style="margin: 6.5% auto;"></span></div><div class="display-flex-cl"><label>Quantidade Solicitada</label><input type="number" class="form-control largura_um_terco" name="quantidade_insumo_solic_dispensario[]" id="qtd_solicitada_dispensario'+controle_campo_geral+'" min="1" onkeyup="verificaValorMaximoExcedido(\'qtd_solicitada_dispensario'+controle_campo_geral+'\',\'quantidade_atual_dispensario'+controle_campo_geral+'\',\'alerta_valor_acima_max'+controle_campo_geral+'\',\'btn_slc_insumo_disp\')" required><span class="alerta_senhas_iguais" style="display: none; margin-top: 2%;" id="alerta_valor_acima_max'+controle_campo_geral+'"><label>Valor acima ou igual do que há disponível!<ion-icon name="alert-circle-outline"></ion-icon></label></span></div><div class="display-flex-cl"><label>Validade do Insumo</label><input type="date" class="form-control largura_um_terco" name="validade_insumo_dispensario[]" id="validade_insumo_dispensario'+controle_campo_geral+'" readonly></div><div class="display-flex-cl"><label>Disponível no Dispensário</label><input type="number" class="form-control largura_um_terco" name="quantidade_atual_dispensario[]" id="quantidade_atual_dispensario'+controle_campo_geral+'" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea class="form-control largura_metade" id="descricaoInsumoSclDisp'+controle_campo_geral+'" rows="3" readonly></textarea></div><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, 4)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(4)" style="padding: 0;">+</button></div></div>');

  } else if (ondeCadastrou == 5){
    // PARA PERMUTA DE INSUMO DO DEPÓSITO

    let dados_insumo_permuta_dep = document.getElementById('dados_insumo_permuta_dep');
    dados_insumo_permuta_dep.insertAdjacentHTML('beforeend', '<div id="insumo_permuta_dep'+controle_campo_geral+'"><hr><div class="display-flex-row"><div id="permuta_dep"><h4>Item a ser retirado do Depósito</h4><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Insumo</label><input type="text" class="form-control largura_um_terco" name="insumoID_InsumoPermuta[]" id="permuta_deposito_insumo_id_'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 4)" placeholder="informe o nome do insumo..." required><span class="ajuste_span" id="resultado_permuta_insumos'+controle_campo_geral+'" style="margin: 6.5% auto;"></span></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control largura_um_terco" name="validadeInsumoDeposito[]" id="validadeInsumoDepositoPermuta'+controle_campo_geral+'" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Quantidade Permutada</label><input type="number" class="form-control largura_metade" name="quantidadeInsumoDepositoPermuta[]" min="1" id="quantidade_solicitada_permuta'+controle_campo_geral+'" onkeyup="verificaValorMaximoExcedido(\'quantidade_solicitada_permuta'+controle_campo_geral+'\',\'quantidade_atual_deposito_permuta'+controle_campo_geral+'\',\'alerta_valor_acima_max'+controle_campo_geral
    +'\',\'btn_permuta_insumo_dep\')" required><span class="alerta_senhas_iguais" style="display: none; margin-top: 2%;" id="alerta_valor_acima_max'+controle_campo_geral+'"><label>Valor acima ou igual do que há disponível!<ion-icon name="alert-circle-outline"></ion-icon></label></span></div><div class="display-flex-cl"><label> Disponível no Depósito</label><input type="text" class="form-control largura_metade" name="quantidadeInsumoDisponivelDeposito[]" id="quantidade_atual_deposito_permuta'+controle_campo_geral+'" onchange="verificaValorMaximoExcedido(\'quantidade_solicitada_permuta'+controle_campo_geral+'\',\'quantidade_atual_deposito_permuta'+controle_campo_geral+'\',\'alerta_valor_acima_max'+controle_campo_geral+'\',\'btn_permuta_insumo_dep\')" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição do insumo</label><textarea name="descricaoInsumoDeposito[]" cols="10" rows="2" class="form-control largura_um_terco" id="descricaoInsumoDepositoPermuta'+controle_campo_geral+'" readonly></textarea></div><div class="display-flex-cl"><label>Depósito De Retirada</label><input type="text" class="form-control largura_um_terco" name="depositoRetiradaPermuta[]" id="deposito_origem_insumo_retirado'+controle_campo_geral+'" readonly></div></div></div><div id="permuta_dep"><h4>Item a ser atualizado do Depósito</h4><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Insumo</label><input type="text" class="form-control largura_um_terco" name="insumoID_InsumoCadPermuta[]" id="insumoID_Insumodeposito'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 1,true)" placeholder="informe o nome do insumo..." required><span class="ajuste_span" id="resultado_cad_deposito_insumos'+controle_campo_geral+'" style="margin: 6.5% auto;"></span></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control largura_um_terco" name="validadeInsumoCadPermuta[]" id="validadeInsumoDepositoPermuta'+controle_campo_geral+'" required></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Quantidade Inserida</label><input type="number" class="form-control largura_metade" name="quantidadeInsumoCadPermuta[]" min="1" required></div><div class="display-flex-cl"><label>Depósito de Destino</label><input type="text" class="form-control largura_um_terco" name="depositoDestinoInsumoPermuta[]" id="depositoDestinoInsumodeposito'+controle_campo_geral+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_geral+', 5)" placeholder="Informe o Destino..." required><span class="ajuste_span" id="resultado_cad_deposito_estoque'+controle_campo_geral+'" style="margin: 6.5% auto;"></span></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição do insumo</label><textarea name="descricaoInsumoDeposito" cols="10" rows="2" class="form-control largura_metade" id="descricaoInsumoCadDep'+controle_campo_geral+'" readonly></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, 5)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(5)" style="padding: 0;">+</button></div></div></div></div></div>');

  } else if (ondeCadastrou == 6){
    // PARA CADASTRO DE ESTOQUE
    let dados_estoque_cad = document.getElementById('dados_estoque_cad');
    dados_estoque_cad.insertAdjacentHTML('beforeend', '<div id="campoCadEstoque'+controle_campo_geral+'" class="display-flex-row"><hr><div class="form-group"><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Nome do Novo Estoque</label><input type="text" class="form-control" name="nomeNovoEstoque[]" required></div><div class="display-flex-cl"><label>Tipo do Novo Estoque</label><select class="form-control" name="tipoNovoEstoque[]" required><option>1 - Depósito</option><option>2 - Dispensário</option></select></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição do Estoque</label><textarea name="descricaoNovoEstoque[]" class="form-control" rows="3"></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, 6)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(6)" style="padding: 0;">+</button></div></div></div></div>');

  } else if (ondeCadastrou == 7){
    // PARA CADASTRO DE FORNECEDOR
    let dados_fornecedor_cad = document.getElementById('dados_fornecedor_cad');
    dados_fornecedor_cad.insertAdjacentHTML('beforeend', '<div id="campoCadFornecedor'+controle_campo_geral+'" class="display-flex-row"><div class="form-group"><hr style="border-color: transparent;"><hr><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Nome ou Razão Social</label><input type="text" class="form-control" name="razaoSocialFornecedor[]" placeholder="Informe a Razão Social..." required></div><div class="display-flex-cl"><label>Logradouro</label><input type="text" class="form-control" name="logradouroFornecedor[]" placeholder="Informe o Logradouro..."></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>CNPJ ou CPF</label><input type="text" class="form-control" maxlength="14" name="cnpjCpfFornecedor[]" placeholder="Informe somente números..." min="1" required></div><div class="display-flex-cl"><label>E-mail</label><input type="text" class="form-control" name="emailFornecedor[]" placeholder="Informe o E-mail..."></div><div class="display-flex-cl"><label>Fone ou FAC</label><input type="text" class="form-control" name="foneFacFornecedor[]" placeholder="Informe o contato..." maxlength="14"></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Deseja inserir dados a mais?</label><textarea class="form-control " name="observacaoFornecedor[]" rows="3"></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, 7)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(7)" style="padding: 0;">+</button></div></div></div></div>');

  } else if (ondeCadastrou == 8){
    // PARA CADASTRO DE INSTITUICAO
    let dados_fornecedor_cad = document.getElementById('dados_instituicao_cad');
    dados_fornecedor_cad.insertAdjacentHTML('beforeend', '<div id="campoCadInstituicao'+controle_campo_geral+'" class="display-flex-row"><div class="form-group"><hr style="border-color: transparent;"><hr><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Razão Social</label><input type="text" class="form-control" name="razaoSocialInstituicao[]" placeholder="Informe a Razão Social..." required></div><div class="display-flex-cl"><label>Logradouro</label><input type="text" class="form-control" name="logradouroInstituicao[]" placeholder="Informe o Logradouro..."></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>CNPJ ou CPF</label><input type="text" class="form-control" maxlength="14" name="cnpjCpfInstituicao[]" placeholder="Informe somente números..." min="1" required></div><div class="display-flex-cl"><label>E-mail</label><input type="text" class="form-control" name="emailInstituicao[]" placeholder="Informe o E-mail..."></div><div class="display-flex-cl"><label>Fone ou FAC</label><input type="text" class="form-control" name="foneFacInstituicao[]" placeholder="Informe o contato..." maxlength="14"></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Deseja inserir dados a mais?</label><textarea class="form-control " name="observacaoInstituicao[]" rows="3"></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, 8)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(8)" style="padding: 0;">+</button></div></div></div></div>');

  } else if (ondeCadastrou == 9){
    // PARA CADASTRO DE CATEGORIA DE INSUMO
    let dados_categoria_insumos_cad = document.getElementById('dados_categoria_insumos_cad');
    dados_categoria_insumos_cad.insertAdjacentHTML('beforeend', '<div id="campoCadCategoriaInsumo'+controle_campo_geral+'" class="display-flex-row"><div class="form-group"><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Nome da Nova Categoria</label><input type="text" class="form-control" name="nomeNovaCategoriaInsumo[]" required></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição da Categoria</label><textarea name="descNovaCategoriaInsumo[]" class="form-control" rows="3"></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, 9)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(9)" style="padding: 0;">+</button></div></div></div></div>');

  } else if (ondeCadastrou == 10){
    // PARA CADASTRO DE PERMISSAO DE USUARIO
    let dados_permissoes_cad = document.getElementById('dados_permissoes_cad');
    dados_permissoes_cad.insertAdjacentHTML('beforeend', '<div id="campoCadPermissao'+controle_campo_geral+'" class="display-flex-row"><div class="form-group"><hr><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Nome</label><input type="text" class="form-control" name="nomePermissao[]" required></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea name="descPermissao[]" class="form-control" rows="3"></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="removerCampoCadDeposito('+ controle_campo_geral +', false, 10)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_geral+'" onclick="adicionaCampoCad(10)" style="padding: 0;">+</button></div></div></div></div>');
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
    // para_operacao.remove();
  }else{
    if (cadType == 1) {

      let para_remover_campo_adicional = document.getElementById('campoCadDeposito'+idCampoCad)
      para_remover_campo_adicional.remove();
      
    } else if(cadType == 2){

      let para_remover_campo_adicional = document.getElementById('campoCadDispensario'+idCampoCad)
      para_remover_campo_adicional.remove();

    } else if (cadType == 3) {

      // PARA CAMPOS DE CADASTRO DO INSUMO NO DB
      let para_remover_campo_adicional = document.getElementById('campoCadInsumo'+idCampoCad)
      para_remover_campo_adicional.remove();

    } else if (cadType == 4) {

      // PARA CAMPOS DE SOLICITAÇÃO DE INSUMO DO DISPENSARIO
      let para_remover_campo_adicional = document.getElementById('campoRetiraInsumoDisp'+idCampoCad)
      para_remover_campo_adicional.remove();

    } else if (cadType == 5) {

      // PARA CAMPOS DE PERMUTA DEPOSITO

      let para_remover_campo_adicional = document.getElementById('insumo_permuta_dep'+idCampoCad)
      para_remover_campo_adicional.remove();

    } else if (cadType == 6) {

      // PARA CAMPOS DE CADASTRO DE ESTOQUE

      let para_remover_campo_adicional = document.getElementById('campoCadEstoque'+idCampoCad)
      para_remover_campo_adicional.remove();

    } else if (cadType == 7) {

      // PARA CAMPOS DE CADASTRO DE FORNECEDOR

      let para_remover_campo_adicional = document.getElementById('campoCadFornecedor'+idCampoCad)
      para_remover_campo_adicional.remove();

    } else if (cadType == 8) {

      // PARA CAMPOS DE CADASTRO DE INSTITUICAO

      let para_remover_campo_adicional = document.getElementById('campoCadInstituicao'+idCampoCad)
      para_remover_campo_adicional.remove();

    } else if (cadType == 9) {

      // PARA CAMPOS DE CADASTRO DE NOVA CATEGORIA DE INSUMO

      let para_remover_campo_adicional = document.getElementById('campoCadCategoriaInsumo'+idCampoCad)
      para_remover_campo_adicional.remove();

    } else if (cadType == 10) {

      // PARA CAMPOS DE CADASTRO DE NOVA CATEGORIA DE INSUMO

      let para_remover_campo_adicional = document.getElementById('campoCadPermissao'+idCampoCad)
      para_remover_campo_adicional.remove();
    }
  }
    
}


async function searchInput_cadDeposito(valor_to_search, id_campo_digitado, cadType, ehPermuta) {
  // console.log('//searchInput_cadDisp - o ID do campo digitado é: '+id_campo_digitado);
  if (cadType == 1) { 
    if (valor_to_search.length >= 2) {
      // console.log("//deposito - Pesquisar: " + valor_to_search);

      const dados_cad_deposito = await fetch('./estoques/dispensario/sch_disp_itens_depst.php?cad_deposito_insumos_nome='+ valor_to_search);

      if (dados_cad_deposito) {
        
        const resposta_cad_deposito = await dados_cad_deposito.json();

        console.log(resposta_cad_deposito);

        let valor_get_id_ehPermuta = 1;

        // if (ehPermuta) {
        //   valor_get_id_ehPermuta = 4;
        // } 

        var html_listados = '<ul class="display-flex-cl">';

        if (resposta_cad_deposito['erro']) {

          html_listados += '<li>'+resposta_cad_deposito['msg_error_insumos']+'</li>';
        } else {

          for (let i = 0; i < resposta_cad_deposito['dados_insumos'].length; i++) {

            html_listados += '<div class="display-flex-row">'
            
            html_listados += '<li onclick=\'getInsumoId('+ resposta_cad_deposito['dados_insumos'][i].idInsumo+','+ JSON.stringify(resposta_cad_deposito['dados_insumos'][i].descricaoInsumo)+','+ JSON.stringify(resposta_cad_deposito['dados_insumos'][i].nomeInsumo)+', '+id_campo_digitado+','+ resposta_cad_deposito['dados_insumos'][i].qtdCriticaInsumo+', '+valor_get_id_ehPermuta+', null)\'>'+resposta_cad_deposito['dados_insumos'][i].nomeInsumo +'</li>';

            html_listados += '<li>|</li>';

            html_listados += '<li> '+resposta_cad_deposito['dados_insumos'][i].descricaoInsumo +'</li>';

            html_listados += '</div>'
            
          }
        }

        html_listados += '</ul>';

        // console.log("//cadDep - montou a sugestao");

        resultado_cad_deposito_insumos = document.getElementById('resultado_cad_deposito_insumos'+id_campo_digitado+'');

        resultado_cad_deposito_insumos.innerHTML = html_listados;

      } else {

        console.log('json vazio');
        
      }
    }

  } else if (cadType == 2) {
    // PARA O DISPENSARIO
    if (valor_to_search.length >= 2) {
      // console.log("//dispensario/ - Pesquisar: " + valor_to_search);

      const dados_cad_deposito = await fetch('./estoques/dispensario/sch_disp_itens_depst.php?cad_disp_insumos_nome='+ valor_to_search);
      // console.log('//dispensasrio/ - retornou a pesquisa')

      if (dados_cad_deposito) {
        
        const resposta_cad_deposito = await dados_cad_deposito.json();

        // console.log('//dispensario/dados_cad_deposito = '+ resposta_cad_deposito);

        var html_listados = '<ul class="display-flex-cl">';

        if (resposta_cad_deposito['erro']) {

          html_listados += '<li>'+resposta_cad_deposito['msg_error_insumos_dep']+'</li>';
        } else {

          for (let i = 0; i < resposta_cad_deposito['dados_insumos_deposito'].length; i++) {

            html_listados += '<div class="display-flex-row">'
            
            html_listados += '<li onclick=\'getInsumoId('+ resposta_cad_deposito['dados_insumos_deposito'][i].idInsumoDeposito+','+ JSON.stringify(resposta_cad_deposito['dados_insumos_deposito'][i].descricaoInsumoDeposito)+','+ JSON.stringify(resposta_cad_deposito['dados_insumos_deposito'][i].nomeInsumoDeposito)+', '+id_campo_digitado+','+ resposta_cad_deposito['dados_insumos_deposito'][i].quantidadeInsumoDeposito+', 2,'+ JSON.stringify(resposta_cad_deposito['dados_insumos_deposito'][i].validadeInsumoDeposito)+')\'>'+resposta_cad_deposito['dados_insumos_deposito'][i].nomeInsumoDeposito +'</li>';

            html_listados += '<li>|</li>';

            html_listados += '<li>'+resposta_cad_deposito['dados_insumos_deposito'][i].descricaoInsumoDeposito +'</li>';

            html_listados += '<li>|</li>';

            let validade_bruta = new Date(resposta_cad_deposito['dados_insumos_deposito'][i].validadeInsumoDeposito);
            let validade_ano = validade_bruta.getFullYear();
            let validade_mes = validade_bruta.getMonth();
            let validade_dia = validade_bruta.getDay();

            if (validade_mes<10) {
              validade_mes = '0'+validade_mes+'';
            }

            if (validade_dia<10) {
              validade_dia = '0'+validade_dia+'';
            }

            html_listados += '<li>'+validade_dia+'/'+validade_mes+'/'+validade_ano+'</li>';

            html_listados += '</div>'
            
          }
        }

        html_listados += '</ul>';

        let resultado_cad_deposito_insumos = document.getElementById('resultado_cad_disp_insumos'+id_campo_digitado+'');

        resultado_cad_deposito_insumos.innerHTML = html_listados;

      } else {

        console.log('json vazio');
        
      }
      
    } 
    
  } else if (cadType == 3) {
    // PARA SOLICITAÇÃO DE RETIRADA DO DISPENSÁRIO
    if (valor_to_search.length >= 2) {
      // console.log("//retirada_dispensario/ - Pesquisar: " + valor_to_search);

      const dados_solic_disp = await fetch('./estoques/dispensario/sch_disp_itens_depst.php?request_disp_insumos_nome='+ valor_to_search);
      // console.log('//dispensasrio/ - retornou a pesquisa')

      if (dados_solic_disp) {
        
        const resposta_cad_deposito = await dados_solic_disp.json();

        // console.log('//solicita_dispensario/dados_solic_disp = '+ resposta_cad_deposito);

        var html_listados = '<ul class="display-flex-cl">';

        if (resposta_cad_deposito['erro']) {

          html_listados += '<li>'+resposta_cad_deposito['msg_error_insumos_disp']+'</li>';
        } else {

          for (let i = 0; i < resposta_cad_deposito['dados_insumos_disp'].length; i++) {

            html_listados += '<div class="display-flex-row">'
            
            html_listados += '<li onclick=\'getInsumoId('+ resposta_cad_deposito['dados_insumos_disp'][i].idInsumoDisp+','+ JSON.stringify(resposta_cad_deposito['dados_insumos_disp'][i].descricaoInsumoDisp)+','+ JSON.stringify(resposta_cad_deposito['dados_insumos_disp'][i].nomeInsumoDisp)+', '+id_campo_digitado+','+ resposta_cad_deposito['dados_insumos_disp'][i].qtdDisponivelInsumoDisp+', 3,'+ JSON.stringify(resposta_cad_deposito['dados_insumos_disp'][i].validadeInsumoDisp)+')\'>'+resposta_cad_deposito['dados_insumos_disp'][i].nomeInsumoDisp +'</li>';

            html_listados += '<li>|</li>';

            html_listados += '<li>'+resposta_cad_deposito['dados_insumos_disp'][i].descricaoInsumoDisp +'</li>';

            html_listados += '<li>|</li>';

            let validade_bruta = new Date(resposta_cad_deposito['dados_insumos_disp'][i].validadeInsumoDisp);
            let validade_ano = validade_bruta.getFullYear();
            let validade_mes = validade_bruta.getMonth();
            let validade_dia = validade_bruta.getDay();

            if (validade_mes<10) {
              validade_mes = '0'+validade_mes+'';
            }

            if (validade_dia<10) {
              validade_dia = '0'+validade_dia+'';
            }

            html_listados += '<li>'+validade_dia+'/'+validade_mes+'/'+validade_ano+'</li>';

            html_listados += '</div>'
            
          }
        }

        html_listados += '</ul>';

        let resultado_slc_disp_insumos = document.getElementById('resultado_slc_disp_insumos'+id_campo_digitado+'');

        resultado_slc_disp_insumos.innerHTML = html_listados;

      } else {

        console.log('json vazio');
        
      }
    }

  } else if (cadType == 4) {
    // PARA PERMUTA DEPOSITO

    if (valor_to_search.length >= 2) {
      // console.log("//permutar/ - Pesquisar: " + valor_to_search);

      const dados_permuta_dep = await fetch('./estoques/dispensario/sch_disp_itens_depst.php?cad_disp_insumos_nome='+ valor_to_search);
      // console.log('//permuta/ - retornou a pesquisa')

      if (dados_permuta_dep) {
        
        const resposta_cad_deposito = await dados_permuta_dep.json();

        // console.log('//permuta/dados_permuta_dep = '+ resposta_cad_deposito);

        var html_listados = '<ul class="display-flex-cl">';

        if (resposta_cad_deposito['erro']) {

          html_listados += '<li onclick=\'fechaSpan('+id_campo_digitado+')\'>'+resposta_cad_deposito['msg_error_insumos_dep']+'</li>';
        } else {

          for (let i = 0; i < resposta_cad_deposito['dados_insumos_deposito'].length; i++) {

            html_listados += '<div class="display-flex-row">'
            
            html_listados += '<li onclick=\'getInsumoId('+ resposta_cad_deposito['dados_insumos_deposito'][i].idInsumoDeposito+','+ JSON.stringify(resposta_cad_deposito['dados_insumos_deposito'][i].descricaoInsumoDeposito)+','+ JSON.stringify(resposta_cad_deposito['dados_insumos_deposito'][i].nomeInsumoDeposito)+', '+id_campo_digitado+','+ resposta_cad_deposito['dados_insumos_deposito'][i].quantidadeInsumoDeposito+',4,'+ JSON.stringify(resposta_cad_deposito['dados_insumos_deposito'][i].validadeInsumoDeposito)+','+ resposta_cad_deposito['dados_insumos_deposito'][i].depositoOrigemId+','+ JSON.stringify(resposta_cad_deposito['dados_insumos_deposito'][i].depositoOrigemNome)+')\'>'+resposta_cad_deposito['dados_insumos_deposito'][i].nomeInsumoDeposito +'</li>';
            
            html_listados += '<li>|</li>';

            html_listados += '<li> '+resposta_cad_deposito['dados_insumos_deposito'][i].descricaoInsumoDeposito +'</li>';
            
            html_listados += '<li>|</li>';

            let validade_bruta = new Date(resposta_cad_deposito['dados_insumos_deposito'][i].validadeInsumoDeposito);
            let validade_ano = validade_bruta.getFullYear();
            let validade_mes = validade_bruta.getMonth();
            let validade_dia = validade_bruta.getDay();

            if (validade_mes<10) {
              validade_mes = '0'+validade_mes+'';
            }

            if (validade_dia<10) {
              validade_dia = '0'+validade_dia+'';
            }

            html_listados += '<li>'+validade_dia+'/'+validade_mes+'/'+validade_ano+'</li>';
            
            html_listados += '<li>|</li>';

            html_listados += '<li> '+resposta_cad_deposito['dados_insumos_deposito'][i].depositoOrigemNome +'</li>';

            html_listados += '</div>'
            
          }
        }

        html_listados += '</ul>';

        let resultado_permuta_insumos = document.getElementById('resultado_permuta_insumos'+id_campo_digitado+'');

        resultado_permuta_insumos.innerHTML = html_listados;

      } else {

        console.log('json vazio');
        
      }
    }
  } else if (cadType == 5) {
    // PARA PROCURAR ESTOQUE DESTINO

    if (valor_to_search.length >= 2) {
      console.log("//procura_estoque/ - Pesquisar: " + valor_to_search);

      const dados_estoque_destino = await fetch('./estoques/dispensario/sch_disp_itens_depst.php?cad_deposito_estoque_nome='+ valor_to_search);
      // console.log('//permuta/ - retornou a pesquisa')

      if (dados_estoque_destino) {
        
        const resposta_cad_deposito = await dados_estoque_destino.json();

        console.log('//permuta/dados_permuta_dep = '+ resposta_cad_deposito);

        var html_listados = '<ul class="display-flex-cl">';

        if (resposta_cad_deposito['erro']) {

          html_listados += '<li onclick=\'fechaSpan('+id_campo_digitado+')\'>'+resposta_cad_deposito['msg_error_estoques']+'</li>';
        } else {

          for (let i = 0; i < resposta_cad_deposito['dados_estoques'].length; i++) {

            html_listados += '<div class="display-flex-row">'
            
            html_listados += '<li onclick=\'getInsumoId('+ resposta_cad_deposito['dados_estoques'][i].estoqueId+',"",'+ JSON.stringify(resposta_cad_deposito['dados_estoques'][i].estoqueNome)+', '+id_campo_digitado+',"",5,"")\'>'+resposta_cad_deposito['dados_estoques'][i].estoqueNome +'</li>';

            html_listados += '</div>'
            
          }
        }

        html_listados += '</ul>';

        let resultado_cad_deposito_estoque = document.getElementById('resultado_cad_deposito_estoque'+id_campo_digitado+'');

        resultado_cad_deposito_estoque.innerHTML = html_listados;

      } else {

        console.log('json vazio');
        
      }
    }
  } else if (cadType == 6) {
    // PARA PROCURAR CATEGORIA DE INSUMOS

    if (valor_to_search.length >= 2) {
      console.log("//procura_categoria/ - Pesquisar: " + valor_to_search);

      const dados_categoria = await fetch('./estoques/dispensario/sch_disp_itens_depst.php?cad_cateogia_insumo='+ valor_to_search);
      // console.log('//permuta/ - retornou a pesquisa')

      if (dados_categoria) {
        
        const resposta_cad_categoria = await dados_categoria.json();

        console.log('//permuta/dados_permuta_dep = '+ resposta_cad_categoria);

        var html_listados = '<ul class="display-flex-cl">';

        if (resposta_cad_categoria['erro']) {

          html_listados += '<li onclick=\'fechaSpan("resultado_cad_categoria_insumo_",'+id_campo_digitado+')\'>'+resposta_cad_categoria['msg_error_categorias']+'</li>';
        } else {

          for (let i = 0; i < resposta_cad_categoria['dados_categorias'].length; i++) {

            html_listados += '<div class="display-flex-row">'
            
            html_listados += '<li onclick=\'getInsumoId('+ resposta_cad_categoria['dados_categorias'][i].categoriaId+',"",'+ JSON.stringify(resposta_cad_categoria['dados_categorias'][i].categoria_nome)+', '+id_campo_digitado+',"",6,"")\'>'+resposta_cad_categoria['dados_categorias'][i].categoria_nome +'</li>';
            
            // html_listados += '<li>|</li>';

            // html_listados += '<li> '+resposta_cad_categoria['dados_categorias'][i].categoria_desc +'</li>';

            html_listados += '</div>';
            
          }
        }

        html_listados += '</ul>';

        let resultado_cad_deposito_estoque = document.getElementById('resultado_cad_categoria_insumo_'+id_campo_digitado+'');

        resultado_cad_deposito_estoque.innerHTML = html_listados;

      } else {

        console.log('json vazio');
        
      }
    }
  }
}


function getInsumoId(idInsumo, descricaoInsumo, nomeINsumo, id_campo_digitado, qtdInsumo, cadType, validadeInsumo, estoqueId, estoqueNome) {
  // console.log('//getInsumoId - o ID do campo digitado é: '+id_campo_digitado);

  if (cadType == 1) {
    // PARA O DEPOSITO
    // console.log('//getInsumoId/Deposito - adicionando resultados deposito!');
    // console.log('//getInsumoId/Deposito - insumoID_Insumodeposito'+id_campo_digitado+'')
  
    let input_to_complete = document.getElementById('insumoID_Insumodeposito'+id_campo_digitado+'');
    let textarea_to_complet = document.getElementById('descricaoInsumoCadDep'+id_campo_digitado+'');
    let qtdCriticaInsumo_to_complete = document.getElementById('qtdCriticaInsumoCadDep'+id_campo_digitado+'');
    
    input_to_complete.value = idInsumo+' - '+nomeINsumo;
    textarea_to_complet.value = descricaoInsumo;

    if (qtdCriticaInsumo_to_complete == null) {
      console.log("está vazio")
    }else {
      qtdCriticaInsumo_to_complete.value = qtdInsumo;
    }

    // Para fechar a span
    fechaSpan("resultado_cad_deposito_insumos" , id_campo_digitado)

  } else if (cadType == 2){
    // PARA O DISPENSARIO
    
    let insumoID_Insumodispensario = document.getElementById('insumoID_Insumodispensario'+id_campo_digitado+'');
    let quantidadeInsumoDisponivelDeposito_to_complete = document.getElementById('quantidadeInsumoDisponivelDeposito'+id_campo_digitado+'');
    let descricaoInsumoDeposito_to_complet = document.getElementById('descricaoInsumoDeposito'+id_campo_digitado+'');
    let validadeInsumoDeposito_to_complete = document.getElementById('validadeInsumoDeposito'+id_campo_digitado+'');
    let valor_maximo_to_mov = document.getElementById('quantidadeMovidaParaDispensario'+id_campo_digitado+'');
    
    insumoID_Insumodispensario.value = idInsumo+' - '+nomeINsumo;
    descricaoInsumoDeposito_to_complet.value = descricaoInsumo;
    quantidadeInsumoDisponivelDeposito_to_complete.value = qtdInsumo;
    validadeInsumoDeposito_to_complete.value = validadeInsumo;
    
    let valor_max_tmp = quantidadeInsumoDisponivelDeposito_to_complete.value;
    // console.log(valor_max_tmp)
    valor_maximo_to_mov.setAttribute("max",valor_max_tmp);

    // Para fechar a span
    fechaSpan("resultado_cad_disp_insumos" , id_campo_digitado)

  } else if (cadType == 3){
    // PARA RETIRADA DO DISPENSARIO
    // console.log('//getInsumoId/Dispensário - adicionando resultados Dispensário!')
    
    let insumo_dispensario_id_to_complete = document.getElementById('insumo_dispensario_id'+id_campo_digitado+'');
    let descricaoInsumoSclDisp_to_complet = document.getElementById('descricaoInsumoSclDisp'+id_campo_digitado+'');
    let validade_insumo_dispensario_to_complete = document.getElementById('validade_insumo_dispensario'+id_campo_digitado+'');

    let quantidade_atual_dispensario_to_complete = document.getElementById('quantidade_atual_dispensario'+id_campo_digitado+'');

    let valor_maximo_slc_dispensario = document.getElementById('qtd_solicitada_dispensario'+id_campo_digitado+'');

    insumo_dispensario_id_to_complete.value = idInsumo+' - '+nomeINsumo;
    descricaoInsumoSclDisp_to_complet.value = descricaoInsumo;
    quantidade_atual_dispensario_to_complete.value = qtdInsumo;
    validade_insumo_dispensario_to_complete.value = validadeInsumo;

    // valor_maximo_slc_dispensario.setAttribute = ;
    
    let valor_max_slc_tmp = quantidade_atual_dispensario_to_complete.value;
    // console.log(valor_max_slc_tmp)
    valor_maximo_slc_dispensario.setAttribute("max",valor_max_slc_tmp);

    fechaSpan("resultado_slc_disp_insumos" , id_campo_digitado)

  } else if (cadType == 4){
    // PARA PERMUTA DEPOSITO

    // console.log('//getInsumoId/Deposito/Permuta - adicionando resultados Depósito!')
    
    let permuta_deposito_insumo_id_to_complete = document.getElementById('permuta_deposito_insumo_id_'+id_campo_digitado+'');
    let descricaoInsumoDepositoPermuta_to_complet = document.getElementById('descricaoInsumoDepositoPermuta'+id_campo_digitado+'');
    let validadeInsumoDepositoPermuta_to_complete = document.getElementById('validadeInsumoDepositoPermuta'+id_campo_digitado+'');
    let deposito_origem_insumo_retirado = document.getElementById('deposito_origem_insumo_retirado'+id_campo_digitado+'');

    let valor_maximo_to_mov = document.getElementById('quantidade_solicitada_permuta'+id_campo_digitado+'');
    let quantidade_atual_deposito_permuta_to_complete = document.getElementById('quantidade_atual_deposito_permuta'+id_campo_digitado+'');
    // console.log("//getInsumoId/Deposito/Permuta - deposito_origem_insumo_retirado"+id_campo_digitado+"");

    quantidade_atual_deposito_permuta_to_complete.value = qtdInsumo;
    validadeInsumoDepositoPermuta_to_complete.value = validadeInsumo;

    input_preenchido = permuta_deposito_insumo_id_to_complete;
    permuta_deposito_insumo_id_to_complete.value = idInsumo+' - '+nomeINsumo;
    descricaoInsumoDepositoPermuta_to_complet.value = descricaoInsumo;
    deposito_origem_insumo_retirado.value = estoqueId+' - '+estoqueNome;
    
    let valor_max_tmp = quantidade_atual_deposito_permuta_to_complete.value;
    // console.log(valor_max_tmp)
    valor_maximo_to_mov.setAttribute("max",valor_max_tmp);

    // span_para_fechar.innerHTML = '';
    fechaSpan("resultado_permuta_insumos",id_campo_digitado);


  } else if (cadType == 5){
    // PARA PROCURAR ESTOQUE
    
    let depositoDestinoInsumodeposito_to_complete = document.getElementById('depositoDestinoInsumodeposito'+id_campo_digitado+'');

    depositoDestinoInsumodeposito_to_complete.value = idInsumo+' - '+nomeINsumo;

    // span_para_fechar.innerHTML = '';
    fechaSpan("resultado_cad_deposito_estoque" , id_campo_digitado)

  } else if (cadType == 6){
    // PARA PREENCHER CAD CATEGORIA
    
    let tipos_insumo_to_complete = document.getElementById('tipos_insumo_'+id_campo_digitado+'');

    tipos_insumo_to_complete.value = idInsumo+' - '+nomeINsumo;

    // span_para_fechar.innerHTML = '';
    fechaSpan("resultado_cad_categoria_insumo_" , id_campo_digitado)

  }

}

// Para fechar a span
function fechaSpan(span_to_close,id_campo_digitado) {

  let span_para_fechar = document.getElementById(''+span_to_close+''+id_campo_digitado+'');

  span_para_fechar.innerHTML = '';
  
}

// PARA VERIFICAR SE SENHAS SÃO IGUAIS
function validaPassword() {
  let passwordUser = document.getElementById('password');
  let confirmPasswordUser = document.getElementById('confirmPassword');
  let span_alerta = document.getElementById('alerta_senhas_iguais');
  let btn_cad_user = document.getElementById('btn_cad_user');
  
  if (passwordUser.value != confirmPasswordUser.value) {
    span_alerta.style.display = 'block';
    btn_cad_user.type = 'button';
  } else {
    span_alerta.style.display = 'none';
    btn_cad_user.type = 'submit';
  }
}

function verificaSolicitacao() {
  
  let qualSolicitacaoDisp = document.getElementById('qualSolicitacaoDisp').value;
  qualSolicitacaoDisp = qualSolicitacaoDisp.split(' ')[0];
  
  let vaiOuVem = document.getElementById('vaiOuVem');

  if (qualSolicitacaoDisp==7) {
    // console.log('é requisicao '+qualSolicitacaoDisp);
    vaiOuVem.innerHTML = "Setor de Destino";
  } else {
    // console.log('é devolucao '+qualSolicitacaoDisp);
    vaiOuVem.innerHTML = "Setor de onde estava";
  }
}


//PARA VERIFICAR SE A QUANTIDADE INSERIDA É MAIOR QUE O VALOR MAXIMO
function verificaValorMaximoExcedido(idValorInserido, idValorMaximo, idSpanAlerta, idButton) {

  let valorInserido = document.getElementById(idValorInserido).value;
  let valorMaximo = document.getElementById(idValorMaximo).value;
  let spanAlert = document.getElementById(idSpanAlerta);
  let button = document.getElementById(idButton);

  let comparacao = parseInt(valorInserido) > parseInt(valorMaximo);
  console.log('inseido é maio que o maximo? ' + comparacao);

  if (comparacao) {
    spanAlert.style.display = 'block';

    if (idButton == "operacao_slc_aprova") {
      button.style.display = 'none';
    } else {
      button.type = 'button';
    }

  } else {
    spanAlert.style.display = 'none';

    if (idButton == "operacao_slc_aprova") {
      button.style.display = 'block';
    } else {
      button.type = 'submit';
    }
  }
}


//para restringir perfis
function returnUserSession(userType){
  // console.log(document.getElementById(userType))
  const sessionUserType = document.getElementById(userType).value;

  let operacao_cadastrar_id = null;
  let operacao_retirar = null;
  let listar_notas_fiscais = null;
  let th_operacoes_editar_deletar_id = null;
  let qtd_colunas_tabelas = 0;
  let operacao_slc_aprova = null;
  let operacao_slc_reprova = null;
  let confirma_dados_slc = null;
  let menu_listar = null;

  try {

    operacao_cadastrar_id = document.getElementById('operacao_cadastro');
    
    operacao_retirar = document.getElementById('operacao_retirar');

    // console.log(operacao_cadastrar_id);
    listar_notas_fiscais = document.getElementById('listar_notas_fiscais');

    th_operacoes_editar_deletar_id = document.getElementById('th_operacoes_editar_deletar');

    confirma_dados_slc = document.getElementById('confirma_dados_slc');

    qtd_colunas_tabelas = document.querySelector('#quantidade_linhas_tabelas').value;
  } catch (error) {
    console.log('erro ao tentar pegar a tag pelo id: '+error)
    qtd_colunas_tabelas = 0;
  }

  let i = 0;

  if(sessionUserType!=2 && sessionUserType!=3){
    // console.log("usuario não terá opcoes de cadastro "+ sessionUserType);

    if(operacao_cadastrar_id){
      operacao_cadastrar_id.remove();
    }

    if (operacao_retirar) { 
      // console.log('removendo a opcao de retirar: '+operacao_retirar);     
      operacao_retirar.remove();
    }

    if (th_operacoes_editar_deletar_id) {
      th_operacoes_editar_deletar_id.remove();
    }

    if (listar_notas_fiscais) {
      listar_notas_fiscais.remove();
    }

    if (confirma_dados_slc) {
      confirma_dados_slc.remove();
    }

    // console.log(qtd_colunas_tabelas,i);
    if (qtd_colunas_tabelas != 0) {
      while(i < qtd_colunas_tabelas){
        let td_operacoes_editar_deletar = document.getElementById('td_operacoes_editar_deletar');
        if (td_operacoes_editar_deletar) {
          td_operacoes_editar_deletar.remove();
        }

        operacao_slc_aprova = document.getElementById('operacao_slc_aprova');
        operacao_slc_reprova = document.getElementById('operacao_slc_reprova');

        if (operacao_slc_aprova) {
          operacao_slc_aprova.remove();
        }
        if (operacao_slc_reprova) {
          operacao_slc_reprova.remove();
        }

        menu_listar = document.getElementById('listar');
        if (menu_listar) {
          menu_listar.remove();
        }
        qtd_colunas_tabelas--;
      }
    } else {
      console.log('nada será feito');
    }
  }
   
}

returnUserSession("sessionUserType");