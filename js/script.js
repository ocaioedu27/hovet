// para adicionar campos automaticamente
const list_campos_to_complete_removed = [];
const list_campos_to_complete_result = ['resultado_cad_deposito_insumos1'];

const list_inputs_to_complete_removed = [];
const list_inputs_to_complete_result = ['insumoID_Insumodeposito1'];

const list_resultado_cad_deposito_estoque_removed = [];
const list_resultado_cad_deposito_estoque_result = ['resultado_cad_deposito_estoque1'];

const list_depositoDestinoInsumodeposito_removed = [];
const list_depositoDestinoInsumodeposito_result = ['depositoDestinoInsumodeposito1'];

const list_textarea_to_complete_removed = [];
const list_textarea_to_complete_result = ['descricaoInsumoCadDep1'];

const list_qtd_critica_to_complete_removed = [];
const list_qtd_critica_to_complete_result = ['qtdCriticaInsumoCadDep1'];


// para dispensario
const list_resultado_cad_disp_insumos_removed = [];
const list_resultado_cad_disp_insumos_result = ['resultado_cad_disp_insumos1'];

const list_insumoID_Insumodispensario_removed = [];
const list_insumoID_Insumodispensario_result = ['insumoID_Insumodispensario1'];

const list_validadeInsumoDeposito_removed = [];
const list_validadeInsumoDeposito_result = ['validadeInsumoDeposito1'];

const list_quantidadeInsumoDisponivelDeposito_removed = [];
const list_quantidadeInsumoDisponivelDeposito_result = ['quantidadeInsumoDisponivelDeposito1'];

const list_descricaoInsumoDeposito_removed = [];
const list_descricaoInsumoDeposito_result = ['descricaoInsumoDeposito1'];

// PARA SOLICITA DISPENSARIO
const list_resultado_slc_disp_insumos_removed = [];
const list_resultado_slc_disp_insumos_result = ['resultado_slc_disp_insumos1'];

const list_insumo_dispensario_id_removed = [];
const list_insumo_dispensario_id_result = ['insumo_dispensario_id1'];

const list_quantidade_atual_dispensario_remove = [];
const list_quantidade_atual_dispensario_result = ['quantidade_atual_dispensario1'];

const list_validade_insumo_dispensario_remove = [];
const list_validade_insumo_dispensario_result = ['validade_insumo_dispensario1'];

const list_descricaoInsumoSclDisp_removed = [];
const list_descricaoInsumoSclDisp_result = ['descricaoInsumoSclDisp1'];

// PARA PERMUTA DEPOSITO
const list_resultado_permuta_insumos_removed = [];
const list_resultado_permuta_insumos_result = ['resultado_permuta_insumos1'];

const list_permuta_deposito_insumo_id_removed = [];
const list_permuta_deposito_insumo_id_result = ['permuta_deposito_insumo_id_1'];

const list_quantidade_atual_deposito_permuta_remove = [];
const list_quantidade_atual_deposito_permuta_result = ['quantidade_atual_deposto_permuta1'];

const list_validadeInsumoDepositoPermuta_remove = [];
const list_validadeInsumoDepositoPermuta_result = ['validadeInsumoDepositoPermuta1'];

const list_descricaoInsumoDepositoPermuta_removed = [];
const list_descricaoInsumoDepositoPermuta_result = ['descricaoInsumoDepositoPermuta1'];



var controle_campo_cad_deposito = 1;

function adicionaCampoCad(ondeCadastrou) {

  controle_campo_cad_deposito++;

  if (ondeCadastrou == 1) {
    

    list_campos_to_complete_result.push('resultado_cad_deposito_insumos'+controle_campo_cad_deposito+'');
    
    list_resultado_cad_deposito_estoque_result.push('resultado_cad_deposito_insumos'+controle_campo_cad_deposito+'');

    let dados_insumo_dep = document.getElementById('dados_insumo_dep');
    dados_insumo_dep.insertAdjacentHTML('beforeend', '<div id="campoCadDeposito'+controle_campo_cad_deposito+'"><div class="form-group valida_movimentacao"> <div class="display-flex-cl"><label>Nome</label><input class="form-control" type"text" name="insumoID_Insumodeposito[]" id="insumoID_Insumodeposito'+controle_campo_cad_deposito+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_cad_deposito+', 1, false)" placeholder="Informe o nome do insumo..." required/><span class="ajuste_span" id="resultado_cad_deposito_insumos'+controle_campo_cad_deposito+'" style="margin: 8% auto;"></span></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control" name="validadeInsumodeposito[]" required></div><div class="display-flex-cl"><label>Quantidade Crítica</label><input type="text" class="form-control" id="qtdCriticaInsumoCadDep'+controle_campo_cad_deposito+'" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Quantidade guardada</label><input type="number" class="form-control" name="quantidadeInsumodeposito[]" min="1" required></div><div class="display-flex-cl"><label>Depósito de Destino</label><input type="text" class="form-control" name="depositoDestinoInsumodeposito[]" id="depositoDestinoInsumodeposito'+controle_campo_cad_deposito+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_cad_deposito+', 5)" required><span class="ajuste_span" id="resultado_cad_deposito_estoque'+controle_campo_cad_deposito+'" style="margin: 8% auto;"></span></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea type="text" class="form-control largura_metade" id="descricaoInsumoCadDep'+controle_campo_cad_deposito+'" readonly></textarea></div><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="removerCampoCadDeposito('+ controle_campo_cad_deposito +', false, 1)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="adicionaCampoCad(1)" style="padding: 0;">+</button></div></div>');

  } else if (ondeCadastrou == 2) {
  
    list_resultado_cad_disp_insumos_result.push('resultado_cad_disp_insumos'+controle_campo_cad_deposito+'');

    let dados_insumo_disp = document.getElementById('dados_insumo_disp');
    dados_insumo_disp.insertAdjacentHTML('beforeend', '<div id="campoCadDispensario'+controle_campo_cad_deposito+'"><hr><div class="form-group valida_movimentacao"> <div class="display-flex-cl"><label>Insumo</label><input class="form-control largura_um_terco" type"text" name="insumoID_Insumodispensario[]" id="insumoID_Insumodispensario'+controle_campo_cad_deposito+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_cad_deposito+', 2)" placeholder="Informe o nome do insumo..." required/><span class="ajuste_span" id="resultado_cad_disp_insumos'+controle_campo_cad_deposito+'" style="margin: 9.5% auto;"></span></div><div class="display-flex-cl"><label for="quantidadeInsumoDisponivelDeposito"> Disponível no Depósito</label><input type="text" class="form-control largura_metade" name="quantidadeInsumoDisponivelDeposito" id="quantidadeInsumoDisponivelDeposito'+controle_campo_cad_deposito+'" readonly></div><div class="display-flex-cl"><label>Dispário de Destino</label><input type="text" class="form-control" name="estoqueDestinoInsumodeposito[]" id="depositoDestinoInsumodeposito'+controle_campo_cad_deposito+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_cad_deposito+', 5)" required><span class="ajuste_span" id="resultado_cad_deposito_estoque'+controle_campo_cad_deposito+'" style="margin: 9.5% auto;"></span></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Quantidade Transferida</label><input type="number" class="form-control" name="quantidadeInsumoDispensario[]" min="1" required></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control" name="validadeInsumoDeposito[]"  id="validadeInsumoDeposito'+controle_campo_cad_deposito+'" readonly></div><div class="display-flex-cl"><label>Local</label><select class="form-control" name="localInsumodispensario[]" id="localInsumodispensario'+controle_campo_cad_deposito+'" required><option>1 - Armário</option><option>2 - Estante</option><option>3 - Gaveteiro</option></select></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea type="text" class="form-control largura_metade" id="descricaoInsumoDeposito'+controle_campo_cad_deposito+'" readonly></textarea></div><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="removerCampoCadDeposito('+ controle_campo_cad_deposito +', false, 2)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="adicionaCampoCad(2)" style="padding: 0;">+</button></div></div>');

  } else if (ondeCadastrou == 3){
    // PARA CADASTRO DE INSUMOS NO DB
    let dados_insumo_cad = document.getElementById('dados_insumos_cad');
    dados_insumo_cad.insertAdjacentHTML('beforeend', '<div id="campoCadInsumo'+controle_campo_cad_deposito+'"><hr><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Nome</label><input type="text" class="form-control" name="nomeInsumo[]" required></div><div class="display-flex-cl"><label>Quantidade Crítica</label><input type="number" class="form-control" name="qtdCriticaInsumo[]" min="1" required></div><div class="display-flex-cl"><label>Unidade</label><select class="form-control" name="unidadeInsumo[]" required><option>Caixa</option><option>Pacote</option></select></div><div class="display-flex-cl"><label>Tipo de Insumo</label><select class="form-control" name="tipoInsumo[]" required><option>1 - Medicamentos</option><option>2 - Material de procedimento</option><option>3 - Medicamentos controlados</option></select></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea class="form-control largura_metade" name="descricaoInsumo[]" rows="3" required></textarea></div><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="removerCampoCadDeposito('+ controle_campo_cad_deposito +', false, 3)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="adicionaCampoCad(2)" style="padding: 0;">+</button></div></div>');

  } else if (ondeCadastrou == 4){
    // PARA RETIRADA DO INSUMO DO DISPENSARIO

    list_resultado_slc_disp_insumos_result.push('resultado_slc_disp_insumos'+controle_campo_cad_deposito+'');

    let dados_insumo_disp = document.getElementById('dados_insumo_disp');
    dados_insumo_disp.insertAdjacentHTML('beforeend', '<div id="campoRetiraInsumoDisp'+controle_campo_cad_deposito+'"><hr><div class="form-group valida_movimentacao"><div class="display-flex-cl" style="margin-right: 30px;"><label>Insumo Solicitado</label><input type="text" class="form-control" name="insumo_dispensario_id[]" id="insumo_dispensario_id'+controle_campo_cad_deposito+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_cad_deposito+', 3)" placeholder="Informe o insumo..." required><span class="ajuste_span" id="resultado_slc_disp_insumos'+controle_campo_cad_deposito+'" style="margin: 6.5% auto;"></span></div><div class="display-flex-cl"><label>Quantidade Solicitada</label><input type="number" class="form-control largura_um_terco" name="quantidade_insumo_dispensario[]" min="1" required></div><div class="display-flex-cl"><label>Validade do Insumo</label><input type="date" class="form-control largura_um_terco" name="validade_insumo_dispensario[]" id="validade_insumo_dispensario'+controle_campo_cad_deposito+'" readonly></div><div class="display-flex-cl"><label>Disponível no Dispensário</label><input type="number" class="form-control largura_um_terco" name="quantidade_atual_dispensario[]" id="quantidade_atual_dispensario'+controle_campo_cad_deposito+'" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea class="form-control largura_metade" name="descricaoInsumo[]" id="descricaoInsumoSclDisp'+controle_campo_cad_deposito+'" rows="3" readonly></textarea></div><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="removerCampoCadDeposito('+ controle_campo_cad_deposito +', false, 4)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="adicionaCampoCad(4)" style="padding: 0;">+</button></div></div>');

  } else if (ondeCadastrou == 5){
    // PARA PERMUTA DE INSUMO DO DEPÓSITO

    list_permuta_deposito_insumo_id_result.push('resultado_permuta_insumos'+controle_campo_cad_deposito+'');

    list_inputs_to_complete_result.push('list_inputs_to_complete_result'+controle_campo_cad_deposito+'')
    list_campos_to_complete_result.push('resultado_cad_deposito_insumos'+controle_campo_cad_deposito+'');

    let dados_insumo_permuta_dep = document.getElementById('dados_insumo_permuta_dep');
    dados_insumo_permuta_dep.insertAdjacentHTML('beforeend', '<div id="insumo_permuta_dep'+controle_campo_cad_deposito+'"><hr><div class="display-flex-row"><div id="permuta_dep"><h4>Item a ser retirado do Depósito</h4><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Insumo</label><input type="text" class="form-control largura_um_terco" name="insumoID_InsumoPermuta[]" id="permuta_deposito_insumo_id_'+controle_campo_cad_deposito+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_cad_deposito+', 4)" placeholder="informe o nome do insumo..." required><span class="ajuste_span" id="resultado_permuta_insumos'+controle_campo_cad_deposito+'" style="margin: 6.5% auto;"></span></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control largura_um_terco" name="validadeInsumoDeposito[]" id="validadeInsumoDepositoPermuta'+controle_campo_cad_deposito+'" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Quantidade Permutada</label><input type="number" class="form-control largura_metade" name="quantidadeInsumoDepositoPermuta[]" min="1" required></div><div class="display-flex-cl"><label> Disponível no Depósito</label><input type="text" class="form-control largura_metade" name="quantidadeInsumoDisponivelDeposito" id="quantidade_atual_deposto_permuta'+controle_campo_cad_deposito+'" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição do insumo</label><textarea name="descricaoInsumoDeposito" cols="10" rows="2" class="form-control largura_metade" id="descricaoInsumoDepositoPermuta'+controle_campo_cad_deposito+'" readonly></textarea></div></div></div><div id="permuta_dep"><h4>Item a ser atualizado do Depósito</h4><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Insumo</label><input type="text" class="form-control largura_um_terco" name="insumoID_InsumoPermutaInserido[]" id="insumoID_Insumodeposito'+controle_campo_cad_deposito+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_cad_deposito+', 1,true)" placeholder="informe o nome do insumo..." required><span class="ajuste_span" id="resultado_cad_deposito_insumos'+controle_campo_cad_deposito+'" style="margin: 6.5% auto;"></span></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control largura_um_terco" name="validadeInsumoDeposito[]" id="validadeInsumoDepositoPermuta'+controle_campo_cad_deposito+'" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Quantidade Inserida</label><input type="number" class="form-control largura_metade" name="quantidadeInsumoDepositoInserida[]" min="1" required></div><div class="display-flex-cl"><label>Depósito de Destino</label><input type="text" class="form-control largura_um_terco" name="depositoDestinoInsumoPermuta[]" id="depositoDestinoInsumodeposito'+controle_campo_cad_deposito+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_cad_deposito+', 5)" placeholder="Informe o Destino..." required><span class="ajuste_span" id="resultado_cad_deposito_estoque'+controle_campo_cad_deposito+'" style="margin: 6.5% auto;"></span></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição do insumo</label><textarea name="descricaoInsumoDeposito" cols="10" rows="2" class="form-control largura_metade" id="descricaoInsumoCadDep'+controle_campo_cad_deposito+'" readonly></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="removerCampoCadDeposito('+ controle_campo_cad_deposito +', false, 5)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="adicionaCampoCad(5)" style="padding: 0;">+</button></div></div></div></div></div>');

  } else if (ondeCadastrou == 6){
    // PARA CADASTRO DE ESTOQUE
    let dados_estoque_cad = document.getElementById('dados_estoque_cad');
    dados_estoque_cad.insertAdjacentHTML('beforeend', '<div id="campoCadEstoque'+controle_campo_cad_deposito+'" class="display-flex-row"><hr><div class="form-group"><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Nome do Novo Estoque</label><input type="text" class="form-control" name="nomeNovoEstoque[]" required></div><div class="display-flex-cl"><label>Tipo do Novo Estoque</label><select class="form-control" name="tipoNovoEstoque[]" required><option>1 - Depósito</option><option>2 - Dispensário</option></select></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição do Estoque</label><textarea name="descricaoNovoEstoque[]" class="form-control" rows="3"></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="removerCampoCadDeposito('+ controle_campo_cad_deposito +', false, 6)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="adicionaCampoCad(6)" style="padding: 0;">+</button></div></div></div></div>');

  } else if (ondeCadastrou == 7){
    // PARA CADASTRO DE FORNECEDOR
    let dados_fornecedor_cad = document.getElementById('dados_fornecedor_cad');
    dados_fornecedor_cad.insertAdjacentHTML('beforeend', '<div id="campoCadEstoque'+controle_campo_cad_deposito+'" class="display-flex-row"><div class="form-group"><hr style="border-color: transparent;"><hr><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Razão Social</label><input type="text" class="form-control" name="razaoSocialFornecedor[]" placeholder="Informe a Razão Social..." required></div><div class="display-flex-cl"><label>Logradouro</label><input type="text" class="form-control" name="logradouroFornecedor[]" placeholder="Informe o Logradouro..."></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>CNPJ ou CPF</label><input type="text" class="form-control" maxlength="14" name="cnpjCpfFornecedor[]" placeholder="Informe somente números..." min="1" required></div><div class="display-flex-cl"><label>E-mail</label><input type="text" class="form-control" name="emailFornecedor[]" placeholder="Informe o E-mail..."></div><div class="display-flex-cl"><label>Fone ou FAC</label><input type="text" class="form-control" name="foneFacFornecedor[]" placeholder="Informe o contato..." maxlength="14"></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Deseja inserir dados a mais?</label><textarea class="form-control " name="observacaoFornecedor[]" rows="3"></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="removerCampoCadDeposito('+ controle_campo_cad_deposito +', false, 6)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="adicionaCampoCad(7)" style="padding: 0;">+</button></div></div></div></div>');

  } else if (ondeCadastrou == 8){
    // PARA CADASTRO DE INSTITUICAO
    let dados_fornecedor_cad = document.getElementById('dados_fornecedor_cad');
    dados_fornecedor_cad.insertAdjacentHTML('beforeend', '<div id="campoCadEstoque'+controle_campo_cad_deposito+'" class="display-flex-row"><div class="form-group"><hr style="border-color: transparent;"><hr><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Razão Social</label><input type="text" class="form-control" name="razaoSocialInstituicao[]" placeholder="Informe a Razão Social..." required></div><div class="display-flex-cl"><label>Logradouro</label><input type="text" class="form-control" name="logradouroInstituicao[]" placeholder="Informe o Logradouro..."></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>CNPJ ou CPF</label><input type="text" class="form-control" maxlength="14" name="cnpjCpfInstituicao[]" placeholder="Informe somente números..." min="1" required></div><div class="display-flex-cl"><label>E-mail</label><input type="text" class="form-control" name="emailInstituicao[]" placeholder="Informe o E-mail..."></div><div class="display-flex-cl"><label>Fone ou FAC</label><input type="text" class="form-control" name="foneFacInstituicao[]" placeholder="Informe o contato..." maxlength="14"></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Deseja inserir dados a mais?</label><textarea class="form-control " name="observacaoInstituicao[]" rows="3"></textarea></div></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="removerCampoCadDeposito('+ controle_campo_cad_deposito +', false, 6)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="adicionaCampoCad(7)" style="padding: 0;">+</button></div></div></div></div>');

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
      
      let campo_to_complete_removed = 'resultado_cad_deposito_insumos'+idCampoCad+'';
      list_campos_to_complete_removed.push(campo_to_complete_removed);

      let input_to_complete_removed = 'insumoID_Insumodeposito'+idCampoCad+'';
      list_inputs_to_complete_removed.push(input_to_complete_removed);

      list_resultado_cad_deposito_estoque_removed.push('resultado_cad_deposito_insumos'+idCampoCad+'');

      list_descricaoInsumoDepositoPermuta_removed.push('depositoDestinoInsumodeposito'+idCampoCad+'');

      let textarea_to_complete_removed = 'descricaoInsumoCadDep'+idCampoCad+'';
      list_textarea_to_complete_removed.push(textarea_to_complete_removed);

      let qtdCritica_to_complete_removed = 'qtdCriticaInsumoCadDep'+idCampoCad+'';
      list_qtd_critica_to_complete_removed.push(qtdCritica_to_complete_removed);

      let para_remover_campo_adicional = document.getElementById('campoCadDeposito'+idCampoCad)
      para_remover_campo_adicional.remove();
      
    } else if(cadType == 2){

      let resultado_cad_disp_insumos_removed = 'resultado_cad_disp_insumos'+idCampoCad+'';
      list_resultado_cad_disp_insumos_removed.push(resultado_cad_disp_insumos_removed);

      let insumoID_Insumodispensario_removed = 'insumoID_Insumodispensario'+idCampoCad+'';
      list_insumoID_Insumodispensario_removed.push(insumoID_Insumodispensario_removed);

      let quantidadeInsumoDisponivelDeposito_removed = 'quantidadeInsumoDisponivelDeposito'+idCampoCad+'';
      list_quantidadeInsumoDisponivelDeposito_removed.push(quantidadeInsumoDisponivelDeposito_removed);

      let validadeInsumoDeposito_removed = 'validadeInsumoDeposito'+idCampoCad+'';
      list_validadeInsumoDeposito_removed.push(validadeInsumoDeposito_removed);

      let descricaoInsumoDeposito_removed = 'descricaoInsumoDeposito'+idCampoCad+'';
      list_descricaoInsumoDeposito_removed.push(descricaoInsumoDeposito_removed);

      let para_remover_campo_adicional = document.getElementById('campoCadDispensario'+idCampoCad)
      para_remover_campo_adicional.remove();

    } else if (cadType == 3) {

      // PARA CAMPOS DE CADASTRO DO INSUMO NO DB
      let para_remover_campo_adicional = document.getElementById('campoCadInsumo'+idCampoCad)
      para_remover_campo_adicional.remove();

    } else if (cadType == 4) {

      let resultado_slc_disp_insumos_removed = 'resultado_slc_disp_insumos'+idCampoCad+'';
      list_resultado_slc_disp_insumos_removed.push(resultado_slc_disp_insumos_removed);

      let insumo_dispensario_id_removed = 'insumo_dispensario_id'+idCampoCad+'';
      list_insumo_dispensario_id_removed.push(insumo_dispensario_id_removed);

      // PARA CAMPOS DE SOLICITAÇÃO DE INSUMO DO DISPENSARIO
      let para_remover_campo_adicional = document.getElementById('campoRetiraInsumoDisp'+idCampoCad)
      para_remover_campo_adicional.remove();

    } else if (cadType == 5) {

      // PARA CAMPOS DE PERMUTA DEPOSITO
      
      let campo_to_complete_removed = 'resultado_cad_deposito_insumos'+idCampoCad+'';
      list_campos_to_complete_removed.push(campo_to_complete_removed);

      let input_to_complete_removed = 'insumoID_Insumodeposito'+idCampoCad+'';
      list_inputs_to_complete_removed.push(input_to_complete_removed);

      let resultado_permuta_insumos_removed = 'resultado_permuta_insumos'+idCampoCad+'';
      list_resultado_permuta_insumos_removed.push(resultado_permuta_insumos_removed);

      let permuta_deposito_insumo_id = 'permuta_deposito_insumo_id_'+idCampoCad+'';
      list_permuta_deposito_insumo_id_removed.push(permuta_deposito_insumo_id);

      let para_remover_campo_adicional = document.getElementById('insumo_permuta_dep'+idCampoCad)
      para_remover_campo_adicional.remove();

    } else if (cadType == 6) {

      // PARA CAMPOS DE CADASTRO DE ESTOQUE

      let para_remover_campo_adicional = document.getElementById('campoCadEstoque'+idCampoCad)
      para_remover_campo_adicional.remove();

    } else if (cadType == 7) {

      // PARA CAMPOS DE CADASTRO DE FORNECEDOR

      let para_remover_campo_adicional = document.getElementById('campoCadEstoque'+idCampoCad)
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

        console.log("//cadDep - montou a sugestao");

        resultado_cad_deposito_insumos = document.getElementById('resultado_cad_deposito_insumos'+id_campo_digitado+'');
        console.log("//cadDep - encontrou o campo para resultado na "+resultado_cad_deposito_insumos);

        let campoFoiDeletado = list_campos_to_complete_removed.includes(resultado_cad_deposito_insumos);

        if (campoFoiDeletado || resultado_cad_deposito_insumos==null) {
          console.log('//searchInput_cadDeposito/verifica_delected - o campo foi deletado')
          novo_campo_resultado_cad_deposito_insumos = list_campos_to_complete_result[0];
          resultado_cad_deposito_insumos = document.getElementById(novo_campo_resultado_cad_deposito_insumos);
        } else {

          if (ehPermuta) {
            console.log("//searchInput_cadDeposito/verifica-deleted - é permuta");
          } else {
            console.log("//searchInput_cadDeposito/verifica-deleted - não é permuta");
            let campo_digitado = list_campos_to_complete_result[id_campo_digitado-1];
            console.log("//searchInput_cadDeposito/verifica-deleted - campo digitado é: "+campo_digitado)
            resultado_cad_deposito_insumos = document.getElementById(campo_digitado);
            console.log('//searchInput_cadDeposito/verifica-deleted - o campo existe e é: ' + resultado_cad_deposito_insumos);
          }
        }

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

        let campoFoiDeletado = list_resultado_cad_disp_insumos_removed.includes(resultado_cad_deposito_insumos);

        if (campoFoiDeletado || resultado_cad_deposito_insumos==null) {
          console.log('//searchInput_cadDeposito/verifica_delected - o campo foi deletado')

          novo_campo_resultado_cad_deposito_insumos = list_resultado_cad_disp_insumos_result[0];
          resultado_cad_deposito_insumos = document.getElementById(novo_campo_resultado_cad_deposito_insumos);
        } else {

          let campo_digitado = list_resultado_cad_disp_insumos_result[id_campo_digitado-1];
          resultado_cad_deposito_insumos = document.getElementById(campo_digitado);
          console.log('//searchInput_cadDeposito/dispensario/verifica-deleted - o campo existe e é: ' + resultado_cad_deposito_insumos);
        }

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
      console.log('//dispensasrio/ - retornou a pesquisa')

      if (dados_solic_disp) {
        
        const resposta_cad_deposito = await dados_solic_disp.json();

        console.log('//solicita_dispensario/dados_solic_disp = '+ resposta_cad_deposito);

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

        let resultado_slc_disp_insumos = document.getElementById('resultado_slc_disp_insumos'+controle_campo_cad_deposito+'');

        let campoFoiDeletado = list_resultado_slc_disp_insumos_removed.includes(resultado_slc_disp_insumos);

        if (campoFoiDeletado || resultado_slc_disp_insumos==null) {

          novo_campo_resultado_slc_disp_insumos = list_resultado_slc_disp_insumos_result[0];
          resultado_slc_disp_insumos = document.getElementById(novo_campo_resultado_slc_disp_insumos);
        } else {
          console.log('//solicita_dispensario/campo_existe - num do campo digitado: '+id_campo_digitado)
          let campo_digitado = list_resultado_slc_disp_insumos_result[id_campo_digitado-1];
          console.log('//solicita_dispensario/campo_existe - campo digitado: '+campo_digitado)
          resultado_slc_disp_insumos = document.getElementById(campo_digitado);
        }

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
            
            html_listados += '<li onclick=\'getInsumoId('+ resposta_cad_deposito['dados_insumos_deposito'][i].idInsumoDeposito+','+ JSON.stringify(resposta_cad_deposito['dados_insumos_deposito'][i].descricaoInsumoDeposito)+','+ JSON.stringify(resposta_cad_deposito['dados_insumos_deposito'][i].nomeInsumoDeposito)+', '+id_campo_digitado+','+ resposta_cad_deposito['dados_insumos_deposito'][i].quantidadeInsumoDeposito+',4,'+ JSON.stringify(resposta_cad_deposito['dados_insumos_deposito'][i].validadeInsumoDeposito)+')\'>'+resposta_cad_deposito['dados_insumos_deposito'][i].nomeInsumoDeposito +'</li>';
            
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

            html_listados += '</div>'
            
          }
        }

        html_listados += '</ul>';

        let resultado_permuta_insumos = document.getElementById('resultado_permuta_insumos'+id_campo_digitado+'');

        let campoFoiDeletado = list_resultado_permuta_insumos_removed.includes(resultado_permuta_insumos);

        if (campoFoiDeletado || resultado_permuta_insumos==null) {

          novo_campo_resultado_permuta_insumos = list_resultado_permuta_insumos_result[0];
          resultado_permuta_insumos = document.getElementById(novo_campo_resultado_permuta_insumos);
        } else {
          // console.log('//solicita_dispensario/campo_existe - num do campo digitado: '+id_campo_digitado)
          let campo_digitado = 'resultado_permuta_insumos'+id_campo_digitado+'';
          // console.log('//solicita_dispensario/campo_existe - campo digitado: '+campo_digitado)
          resultado_permuta_insumos = document.getElementById(campo_digitado);
        }

        // console.log('//solicita_dispensario/campo foi setado - campo digitado: '+resultado_permuta_insumos)
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

        let campoFoiDeletado = list_resultado_cad_deposito_estoque_removed.includes(resultado_cad_deposito_estoque);

        if (campoFoiDeletado || resultado_cad_deposito_estoque==null) {

          let novo_campo_resultado_cad_deposito_estoque = list_resultado_cad_deposito_estoque_result[0];
          resultado_cad_deposito_estoque = document.getElementById(novo_campo_resultado_cad_deposito_estoque);
        } else {
          // console.log('//solicita_dispensario/campo_existe - num do campo digitado: '+id_campo_digitado)
          let campo_digitado = 'resultado_cad_deposito_estoque'+id_campo_digitado+'';
          // console.log('//solicita_dispensario/campo_existe - campo digitado: '+campo_digitado)
          resultado_cad_deposito_estoque = document.getElementById(campo_digitado);
        }

        // console.log('//solicita_dispensario/campo foi setado - campo digitado: '+resultado_permuta_insumos)
        resultado_cad_deposito_estoque.innerHTML = html_listados;

      } else {

        console.log('json vazio');
        
      }
    }
  }
}


function getInsumoId(idInsumo, descricaoInsumo, nomeINsumo, id_campo_digitado, qtdInsumo, cadType, validadeInsumo) {
  console.log('//getInsumoId - o ID do campo digitado é: '+id_campo_digitado);

  if (cadType == 1) {
    // PARA O DEPOSITO
    // console.log('//getInsumoId/Deposito - adicionando resultados deposito!');
    // console.log('//getInsumoId/Deposito - insumoID_Insumodeposito'+id_campo_digitado+'')
  
    let input_to_complete = document.getElementById('insumoID_Insumodeposito'+id_campo_digitado+'');
    let textarea_to_complet = document.getElementById('descricaoInsumoCadDep'+controle_campo_cad_deposito+'');
    let qtdCriticaInsumo_to_complete = document.getElementById('qtdCriticaInsumoCadDep'+controle_campo_cad_deposito+'');

    let foi_removido = list_inputs_to_complete_removed.includes(input_to_complete);
    if (foi_removido || input_to_complete == null) {
      console.log('//getInsumoId/ - input removido');
      input_to_complete = document.getElementById(list_inputs_to_complete_result[id_campo_digitado-1]);
      console.log('//getInumoId/ - o imput é: '+input_to_complete)
      textarea_to_complet = document.getElementById(list_textarea_to_complete_result[id_campo_digitado-1]);
      qtdCriticaInsumo_to_complete = document.getElementById(list_qtd_critica_to_complete_result[id_campo_digitado-1]);
      // console.log('//getInsumoId/ a quantiade crítica é '+qtdCriticaInsumo_to_complete.innerHTML);
    } else{
      console.log('//getInumoId/ - editando o campo: '+id_campo_digitado);
      input_to_complete = document.getElementById('insumoID_Insumodeposito'+id_campo_digitado+'');
      textarea_to_complet = document.getElementById('descricaoInsumoCadDep'+id_campo_digitado+'');
      qtdCriticaInsumo_to_complete = document.getElementById('qtdCriticaInsumoCadDep'+id_campo_digitado+'');
      // console.log('//getInsumoId/ a quantiade critica é '+qtdCriticaInsumo_to_complete.innerHTML);
    }
    
    input_to_complete.value = idInsumo+' - '+nomeINsumo;
    textarea_to_complet.value = descricaoInsumo;

    if (qtdCriticaInsumo_to_complete == null) {
      console.log("está vazio")
    }else {
      qtdCriticaInsumo_to_complete.value = qtdInsumo;
    }

    let fechar_span = document.getElementById('insumoID_Insumodeposito'+id_campo_digitado+'');
    if (list_inputs_to_complete_removed.includes(fechar_span) || fechar_span == null) {
      fechar_span = document.getElementById(list_inputs_to_complete_result[id_campo_digitado-1]);
    } else{
      console.log('//getInumoId/ - verificando a span: '+id_campo_digitado);
      fechar_span = document.getElementById(list_inputs_to_complete_result[id_campo_digitado]);
    }

    // const validar_click_span = fechar_span.contains(event.target);
    let span_para_fechar = document.getElementById('resultado_cad_deposito_insumos'+controle_campo_cad_deposito+'');

    if (list_campos_to_complete_removed.includes(span_para_fechar) || span_para_fechar == null) {

      span_para_fechar = document.getElementById(list_campos_to_complete_result[id_campo_digitado-1]);
      console.log('//getInsumoId/fecha_span/foi_excluida - '+span_para_fechar);
    } else{
      console.log('//getInsumoId/fecha_span/esta_ativa - '+id_campo_digitado);
      span_para_fechar = document.getElementById('resultado_cad_deposito_insumos'+id_campo_digitado+'');
    } 


    span_para_fechar.innerHTML = '';

  } else if (cadType == 2){
    // PARA O DISPENSARIO
    console.log('//getInsumoId/Dispensário - adicionando resultados Dispensário!')
    
    let insumoID_Insumodispensario = document.getElementById('insumoID_Insumodispensario'+id_campo_digitado+'');
    let quantidadeInsumoDisponivelDeposito_to_complete = document.getElementById('quantidadeInsumoDisponivelDeposito'+controle_campo_cad_deposito+'');
    let descricaoInsumoDeposito_to_complet = document.getElementById('descricaoInsumoDeposito'+controle_campo_cad_deposito+'');
    let validadeInsumoDeposito_to_complete = document.getElementById('validadeInsumoDeposito'+controle_campo_cad_deposito+'');
    // let quantidadeInsumoDisponivelDeposito_to_complete = '';

    let foi_removido = list_insumoID_Insumodispensario_removed.includes(insumoID_Insumodispensario);

    if (foi_removido || insumoID_Insumodispensario == null) {

      // console.log('//getInsumoId/dispensario - input removido');
      insumoID_Insumodispensario = document.getElementById(list_insumoID_Insumodispensario_result[id_campo_digitado-1]);
      // console.log('//getInumoId/dispensario - o imput é: '+insumoID_Insumodispensario)
      descricaoInsumoDeposito_to_complet = document.getElementById(list_descricaoInsumoDeposito_result[id_campo_digitado-1]);
      quantidadeInsumoDisponivelDeposito_to_complete = document.getElementById(list_quantidadeInsumoDisponivelDeposito_result[id_campo_digitado-1]);
      validadeInsumoDeposito_to_complete = document.getElementById(list_validadeInsumoDeposito_result[id_campo_digitado-1]);
      // console.log('//getInsumoId/dispensario/excluido_vazio a quantiade disponivel no deposito é '+quantidadeInsumoDisponivelDeposito_to_complete.innerHTML);

    } else{

      // console.log('//getInumoId/dispensario - editando o campo: '+id_campo_digitado);
      insumoID_Insumodispensario = document.getElementById('insumoID_Insumodispensario'+id_campo_digitado+'');
      descricaoInsumoDeposito_to_complet = document.getElementById('descricaoInsumoDeposito'+id_campo_digitado+'');
      quantidadeInsumoDisponivelDeposito_to_complete = document.getElementById('quantidadeInsumoDisponivelDeposito'+id_campo_digitado+'');
      validadeInsumoDeposito_to_complete = document.getElementById('validadeInsumoDeposito'+id_campo_digitado+'');
      // console.log('//getInsumoId/dispensario/existe - a quantiade disponivel no deposito é '+quantidadeInsumoDisponivelDeposito_to_complete);
    }
    
    insumoID_Insumodispensario.value = idInsumo+' - '+nomeINsumo;
    descricaoInsumoDeposito_to_complet.value = descricaoInsumo;
    quantidadeInsumoDisponivelDeposito_to_complete.value = qtdInsumo;
    validadeInsumoDeposito_to_complete.value = validadeInsumo;


    // Para fechar a span
    let fechar_span = document.getElementById('insumoID_Insumodispensario'+id_campo_digitado+'');
    if (list_insumoID_Insumodispensario_removed.includes(fechar_span) || fechar_span == null) {
      fechar_span = document.getElementById(list_insumoID_Insumodispensario_result[id_campo_digitado-1]);
    } else{
      console.log('//getInumoId/fecha_span - verificando a span: '+id_campo_digitado);
      fechar_span = document.getElementById(list_descricaoInsumoDeposito_result[id_campo_digitado]);
    }

    // const validar_click_span = fechar_span.contains(event.target);
    let span_para_fechar = document.getElementById('resultado_cad_disp_insumos'+controle_campo_cad_deposito+'');

    if (list_resultado_cad_disp_insumos_removed.includes(span_para_fechar) || span_para_fechar == null) {

      span_para_fechar = document.getElementById(list_resultado_cad_disp_insumos_result[id_campo_digitado-1]);
      console.log('//getInsumoId/fecha_span/foi_excluida - '+span_para_fechar);
    } else{
      console.log('//getInsumoId/fecha_span/esta_ativa - '+id_campo_digitado);
      span_para_fechar = document.getElementById('resultado_cad_disp_insumos'+id_campo_digitado+'');
    } 


    span_para_fechar.innerHTML = '';

  } else if (cadType == 3){
    // PARA RETIRADA DO DISPENSARIO
    console.log('//getInsumoId/Dispensário - adicionando resultados Dispensário!')
    
    let insumo_dispensario_id_to_complete = document.getElementById('insumo_dispensario_id'+controle_campo_cad_deposito+'');
    let descricaoInsumoSclDisp_to_complet = document.getElementById('descricaoInsumoDisp'+controle_campo_cad_deposito+'');
    let validade_insumo_dispensario_to_complete = document.getElementById('validade_insumo_dispensario'+controle_campo_cad_deposito+'');
    // let quantidadeInsumoDisponivelDeposito_to_complete = '';

    let foi_removido = list_insumo_dispensario_id_removed.includes(insumo_dispensario_id_to_complete);

    if (foi_removido || insumo_dispensario_id_to_complete == null) {

      // console.log('//getInsumoId/dispensario - input removido');
      insumo_dispensario_id_to_complete = document.getElementById(list_insumo_dispensario_id_result[id_campo_digitado-1]);
      descricaoInsumoSclDisp_to_complet = document.getElementById(list_descricaoInsumoSclDisp_result[id_campo_digitado-1]);
      quantidade_atual_dispensario_to_complete = document.getElementById(list_quantidade_atual_dispensario_result[id_campo_digitado-1]);
      validade_insumo_dispensario_to_complete = document.getElementById(list_validade_insumo_dispensario_result[id_campo_digitado-1]);

    } else{

      // console.log('//getInumoId/dispensario - editando o campo: '+id_campo_digitado);
      insumo_dispensario_id_to_complete = document.getElementById('insumo_dispensario_id'+id_campo_digitado+'');
      quantidade_atual_dispensario_to_complete = document.getElementById('quantidade_atual_dispensario'+id_campo_digitado+'');
      descricaoInsumoSclDisp_to_complet = document.getElementById('descricaoInsumoSclDisp'+id_campo_digitado+'');
      validade_insumo_dispensario_to_complete = document.getElementById('validade_insumo_dispensario'+id_campo_digitado+'');
    }
    
    insumo_dispensario_id_to_complete.value = idInsumo+' - '+nomeINsumo;
    descricaoInsumoSclDisp_to_complet.value = descricaoInsumo;
    quantidade_atual_dispensario_to_complete.value = qtdInsumo;
    validade_insumo_dispensario_to_complete.value = validadeInsumo;


    // Para fechar a span
    let fechar_span = document.getElementById('insumoID_Insumodispensario'+id_campo_digitado+'');
    if (list_insumoID_Insumodispensario_removed.includes(fechar_span) || fechar_span == null) {
      fechar_span = document.getElementById(list_insumoID_Insumodispensario_result[id_campo_digitado-1]);
    } else{
      // console.log('//getInumoId/fecha_span - verificando a span: '+id_campo_digitado);
      fechar_span = document.getElementById(list_descricaoInsumoDeposito_result[id_campo_digitado]);
    }

    // const validar_click_span = fechar_span.contains(event.target);
    let span_para_fechar = document.getElementById('resultado_slc_disp_insumos'+controle_campo_cad_deposito+'');

    if (list_resultado_slc_disp_insumos_removed.includes(span_para_fechar) || span_para_fechar == null) {

      span_para_fechar = document.getElementById(list_resultado_slc_disp_insumos_result[id_campo_digitado-1]);
      // console.log('//getInsumoId/fecha_span/foi_excluida - '+span_para_fechar);
    } else{
      // console.log('//getInsumoId/fecha_span/esta_ativa - '+id_campo_digitado);
      span_para_fechar = document.getElementById('resultado_slc_disp_insumos'+id_campo_digitado+'');
    } 


    span_para_fechar.innerHTML = '';

  } else if (cadType == 4){
    // PARA PERMUTA DEPOSITO

    // console.log('//getInsumoId/Deposito/Permuta - adicionando resultados Depósito!')
    
    let permuta_deposito_insumo_id_to_complete = document.getElementById('permuta_deposito_insumo_id_'+id_campo_digitado+'');
    let descricaoInsumoDepositoPermuta_to_complet = document.getElementById('descricaoInsumoDepositoPermuta'+controle_campo_cad_deposito+'');
    let validadeInsumoDepositoPermuta_to_complete = document.getElementById('validadeInsumoDepositoPermuta'+controle_campo_cad_deposito+'');
    // let quantidadeInsumoDisponivelDeposito_to_complete = '';

    let foi_removido = list_permuta_deposito_insumo_id_removed.includes(permuta_deposito_insumo_id_to_complete);

    console.log("//getInsumoId/Deposito/Permuta - foi removido? "+foi_removido);
    console.log("//getInsumoId/Deposito/Permuta - permuta_deposito_insumo_id_"+id_campo_digitado+"");

    if (foi_removido || permuta_deposito_insumo_id_to_complete == null) {

      console.log('//getInsumoId/dep/permuta - input removido');
      permuta_deposito_insumo_id_to_complete = document.getElementById(list_permuta_deposito_insumo_id_result[id_campo_digitado-1]);
      descricaoInsumoDepositoPermuta_to_complet = document.getElementById(list_descricaoInsumoDepositoPermuta_result[id_campo_digitado-1]);
      quantidade_atual_deposto_permuta_to_complete = document.getElementById(list_quantidade_atual_deposito_permuta_result[id_campo_digitado-1]);
      validadeInsumoDepositoPermuta_to_complete = document.getElementById(list_validadeInsumoDepositoPermuta_result[id_campo_digitado-1]);

    } else{

      // console.log('//getInumoId/deposito/permuta - editando o campo: '+id_campo_digitado);
      permuta_deposito_insumo_id_to_complete = document.getElementById('permuta_deposito_insumo_id_'+id_campo_digitado+'');
      // console.log('//getInumoId/deposito/permuta - campo para id e nome: '+permuta_deposito_insumo_id_to_complete)
      quantidade_atual_deposto_permuta_to_complete = document.getElementById('quantidade_atual_deposto_permuta'+id_campo_digitado+'');
      descricaoInsumoDepositoPermuta_to_complet = document.getElementById('descricaoInsumoDepositoPermuta'+id_campo_digitado+'');
      validadeInsumoDepositoPermuta_to_complete = document.getElementById('validadeInsumoDepositoPermuta'+id_campo_digitado+'');
    }

    quantidade_atual_deposto_permuta_to_complete.value = qtdInsumo;
    validadeInsumoDepositoPermuta_to_complete.value = validadeInsumo;

    input_preenchido = permuta_deposito_insumo_id_to_complete;
    permuta_deposito_insumo_id_to_complete.value = idInsumo+' - '+nomeINsumo;
    descricaoInsumoDepositoPermuta_to_complet.value = descricaoInsumo;

    // span_para_fechar.innerHTML = '';
    fechaSpan(permuta_deposito_insumo_id_to_complete, "resultado_permuta_insumos",id_campo_digitado, 4);


  } else if (cadType == 5){
    // PARA PROCURAR ESTOQUE

    // console.log('//getInsumoId/Deposito/Permuta - adicionando resultados Depósito!')
    
    let depositoDestinoInsumodeposito_to_complete = document.getElementById('depositoDestinoInsumodeposito'+id_campo_digitado+'');

    let foi_removido = list_depositoDestinoInsumodeposito_removed.includes(depositoDestinoInsumodeposito_to_complete);

    console.log("//getInsumoId/Deposito/procura_estoque - foi removido? "+foi_removido);
    console.log("//getInsumoId/Deposito/procura_estoque - depositoDestinoInsumodeposito"+id_campo_digitado+"");

    if (foi_removido || depositoDestinoInsumodeposito_to_complete == null) {

      console.log('//getInsumoId/dep/procura_estoque - input removido');
      permuta_deposito_insumo_id_to_complete = document.getElementById(list_depositoDestinoInsumodeposito_result[id_campo_digitado-1]);

    } else{

      // console.log('//getInumoId/deposito/permuta - editando o campo: '+id_campo_digitado);
      depositoDestinoInsumodeposito_to_complete = document.getElementById('depositoDestinoInsumodeposito'+id_campo_digitado+'');
      // console.log('//getInumoId/deposito/permuta - campo para id e nome: '+permuta_deposito_insumo_id_to_complete)
    }

    depositoDestinoInsumodeposito_to_complete.value = idInsumo+' - '+nomeINsumo;

    // span_para_fechar.innerHTML = '';
    fechaSpan(depositoDestinoInsumodeposito_to_complete, "resultado_cad_deposito_estoque" , id_campo_digitado,5)


  }

}

// Para fechar a span
function fechaSpan(input_to_check, span_to_close,id_campo_digitado,ondeFechar) {

  let input_preenchido = document.getElementById(''+input_to_check+''+id_campo_digitado+'');
  let span_para_fechar = document.getElementById(''+span_to_close+''+id_campo_digitado+'');

  if (ondeFechar==4) {
    if (list_permuta_deposito_insumo_id_removed.includes(input_preenchido) || input_preenchido == null) {
      input_preenchido = document.getElementById(list_permuta_deposito_insumo_id_result[id_campo_digitado-1]);
    } else{
      console.log('//getInumoId/fecha_span/verifica_conteudo_input - verificando a span: '+id_campo_digitado);
      input_preenchido = document.getElementById(list_descricaoInsumoDepositoPermuta_result[id_campo_digitado]);
    }

    console.log("Passou daqui")

    // const validar_click_span = fechar_span.contains(event.target);

    if (list_resultado_permuta_insumos_removed.includes(span_para_fechar) || span_para_fechar == null) {

      span_para_fechar = document.getElementById(list_resultado_permuta_insumos_result[id_campo_digitado-1]);
      console.log('//getInsumoId/fecha_span/foi_excluida - '+span_para_fechar);
    } else{
      console.log('//getInsumoId/fecha_span/esta_ativa - '+id_campo_digitado);
      span_para_fechar = document.getElementById('resultado_permuta_insumos'+id_campo_digitado+'');
    } 

  } else if (ondeFechar==5){
    // PARA PROCURAR ESTOQUE NO CAD DEPOSITO
    
    if (list_depositoDestinoInsumodeposito_removed.includes(input_preenchido) || input_preenchido == null) {
      input_preenchido = document.getElementById(list_depositoDestinoInsumodeposito_result[id_campo_digitado-1]);
    } else{
      console.log('//getInumoId/fecha_span/verifica_conteudo_input - verificando a span: '+id_campo_digitado);
      input_preenchido = document.getElementById(list_depositoDestinoInsumodeposito_result[id_campo_digitado]);
    }

    console.log("Passou daqui")

    // const validar_click_span = fechar_span.contains(event.target);

    if (list_resultado_cad_deposito_estoque_removed.includes(span_para_fechar) || span_para_fechar == null) {

      span_para_fechar = document.getElementById(list_resultado_cad_deposito_estoque_result[id_campo_digitado-1]);
      console.log('//getInsumoId/fecha_span/foi_excluida - '+span_para_fechar);
    } else{
      console.log('//getInsumoId/fecha_span/esta_ativa - '+id_campo_digitado);
      span_para_fechar = document.getElementById('resultado_cad_deposito_estoque'+id_campo_digitado+'');
    } 

  }

  span_para_fechar.innerHTML = '';
  
}

// PARA VERIFICAR SE SENHAS SÃO IGUAIS
let passwordUser = document.getElementById('password');
let confirmPasswordUser = document.getElementById('confirmPassword');
let span_alerta = document.getElementById('alerta_senhas_iguais');
let btn_cad_user = document.getElementById('btn_cad_user');

function validaPassword() {
  if (passwordUser.value != confirmPasswordUser.value) {
    span_alerta.style.display = 'block';
    btn_cad_user.type = 'button';
  } else {
    span_alerta.style.display = 'none';
    btn_cad_user.type = 'submit';
  }
}


//para restringir perfis
var sessionUserType = document.querySelector('#sessionUserType').value;
function returnUserSession(sessionUserType){

  let operacao_cadastrar_id = null;
  let operacao_retirar = null;
  let listar_notas_fiscais = null;
  let th_operacoes_editar_deletar_id = null;
  let qtd_colunas_tabelas = 0;

  try {

    operacao_cadastrar_id = document.getElementById('operacao_cadastro');
    
    operacao_retirar = document.getElementById('operacao_retirar');

    // console.log(operacao_cadastrar_id);
    listar_notas_fiscais = document.getElementById('listar_notas_fiscais');

    th_operacoes_editar_deletar_id = document.getElementById('th_operacoes_editar_deletar');

    qtd_colunas_tabelas = document.querySelector('#quantidade_linhas_tabelas').value;
  } catch (error) {
    qtd_colunas_tabelas = 0;
  }

  let i = 0;

  if(sessionUserType!=5 && sessionUserType!=3){
    // console.log("usuario não terá opcoes de cadastro "+ sessionUserType);

    if(operacao_cadastrar_id){
      operacao_cadastrar_id.remove();
    }
    if (operacao_retirar) {      
      operacao_retirar.remove();
    }
    if (th_operacoes_editar_deletar_id) {
      th_operacoes_editar_deletar_id.remove();
    }
    if (listar_notas_fiscais) {
      listar_notas_fiscais.remove();
    }

    if (qtd_colunas_tabelas != 0) {
      while(i < qtd_colunas_tabelas){
        qtd_colunas_tabelas--;
        let td_operacoes_editar_deletar = document.getElementById('td_operacoes_editar_deletar');
        td_operacoes_editar_deletar.remove();
      }
    } else {
      console.log('nada será feito');
    }
  }
   
}

returnUserSession(sessionUserType)