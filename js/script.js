// para adicionar campos automaticamente
const list_campos_to_complete_removed = [];
const list_campos_to_complete_result = ['resultado_cad_deposito_insumos1'];

const list_inputs_to_complete_removed = [];
const list_inputs_to_complete_result = ['insumoID_Insumodeposito1'];

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

var controle_campo_cad_deposito = 1;
function adicionaCampoCad(ondeCadastrou) {

  controle_campo_cad_deposito++;

  if (ondeCadastrou == 1) {
    

    list_campos_to_complete_result.push('resultado_cad_deposito_insumos'+controle_campo_cad_deposito+'');

    let dados_insumo_dep = document.getElementById('dados_insumo_dep');
    dados_insumo_dep.insertAdjacentHTML('beforeend', '<div id="campoCadDeposito'+controle_campo_cad_deposito+'"><div class="form-group valida_movimentacao"> <div class="display-flex-cl"><label>Nome</label><input class="form-control" type"text" name="insumoID_Insumodeposito[]" id="insumoID_Insumodeposito'+controle_campo_cad_deposito+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_cad_deposito+', 1)" placeholder="Informe o nome do insumo..." required/><span class="ajuste_span" id="resultado_cad_deposito_insumos'+controle_campo_cad_deposito+'"></span></div><div class="display-flex-cl"><label>Quantidade guardada</label><input type="number" class="form-control" name="quantidadeInsumodeposito[]" min="1" required></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control" name="validadeInsumodeposito[]" required></div><div class="display-flex-cl"><label>Quantidade Crítica</label><input type="text" class="form-control" id="qtdCriticaInsumoCadDep'+controle_campo_cad_deposito+'" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea type="text" class="form-control largura_metade" id="descricaoInsumoCadDep'+controle_campo_cad_deposito+'" readonly></textarea></div><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="removerCampoCadDeposito('+ controle_campo_cad_deposito +', false, 1)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="adicionaCampoCad(1)" style="padding: 0;">+</button></div></div>');

  } else if (ondeCadastrou == 2) {
  
    list_resultado_cad_disp_insumos_result.push('resultado_cad_disp_insumos'+controle_campo_cad_deposito+'');

    let dados_insumo_disp = document.getElementById('dados_insumo_disp');
    dados_insumo_disp.insertAdjacentHTML('beforeend', '<div id="campoCadDispensario'+controle_campo_cad_deposito+'"><hr><div class="form-group valida_movimentacao"> <div class="display-flex-cl"><label>Insumo</label><input class="form-control largura_um_terco" type"text" name="insumoID_Insumodispensario[]" id="insumoID_Insumodispensario'+controle_campo_cad_deposito+'" onkeyup="searchInput_cadDeposito(this.value, '+controle_campo_cad_deposito+', 2)" placeholder="Informe o nome do insumo..." required/><span class="ajuste_span" id="resultado_cad_disp_insumos'+controle_campo_cad_deposito+'" style="margin: 9.5% auto;"></span></div><div class="display-flex-cl"><label for="quantidadeInsumoDisponivelDeposito"> Disponível no Depósito</label><input type="text" class="form-control largura_metade" name="quantidadeInsumoDisponivelDeposito" id="quantidadeInsumoDisponivelDeposito'+controle_campo_cad_deposito+'" readonly></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Quantidade Transferida</label><input type="number" class="form-control" name="quantidadeInsumoDispensario[]" min="1" required></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control" name="validadeInsumoDeposito[]"  id="validadeInsumoDeposito'+controle_campo_cad_deposito+'" readonly></div><div class="display-flex-cl"><label>Local</label><select class="form-control" name="localInsumodispensario[]" id="localInsumodispensario'+controle_campo_cad_deposito+'" required><option>1 - Armário</option><option>2 - Estante</option><option>3 - Gaveteiro</option></select></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea type="text" class="form-control largura_metade" id="descricaoInsumoDeposito'+controle_campo_cad_deposito+'" readonly></textarea></div><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="removerCampoCadDeposito('+ controle_campo_cad_deposito +', false, 2)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="adicionaCampoCad(2)" style="padding: 0;">+</button></div></div>');

  } else if (ondeCadastrou == 3){
    // PARA CADASTRO DE INSUMOS NO DB
    let dados_insumo_cad = document.getElementById('dados_insumos_cad');
    dados_insumo_cad.insertAdjacentHTML('beforeend', '<div id="campoCadInsumo'+controle_campo_cad_deposito+'"><hr><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Nome</label><input type="text" class="form-control" name="nomeInsumo[]" required></div><div class="display-flex-cl"><label>Quantidade Crítica</label><input type="number" class="form-control" name="qtdCriticaInsumo[]" min="1" required></div><div class="display-flex-cl"><label>Unidade</label><select class="form-control" name="unidadeInsumo[]" required><option>Caixa</option><option>Pacote</option></select></div><div class="display-flex-cl"><label>Tipo de Insumo</label><select class="form-control" name="tipoInsumo[]" required><option>1 - Medicamentos</option><option>2 - Material de procedimento</option><option>3 - Medicamentos controlados</option></select></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea class="form-control largura_metade" name="descricaoInsumo[]" rows="3" required></textarea></div><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="removerCampoCadDeposito('+ controle_campo_cad_deposito +', false, 3)" style="padding: 0;">-</button><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="adicionaCampoCad(2)" style="padding: 0;">+</button></div></div>');

  }
}

function removerCampoCadDeposito(idCampoCad, ehOperacao, cadType) {
  if(ehOperacao){
    let tipo_operacao_cad_dep = document.getElementById('tipo_operacao_cad_dep').value;

    let nota_fiscal_cad_dep = document.getElementById('nota_fiscal_cad_dep');
    let data_cadastro_dep = document.getElementById('data_cadastro_dep');
    // console.log('//removerCampoCadDeposito/ehOperacao - valor do tipo de operacao: '+tipo_operacao_cad_dep);
    tipo_operacao_cad_dep = tipo_operacao_cad_dep.split(' ')[0];
    if (tipo_operacao_cad_dep==3) {
      nota_fiscal_cad_dep.style.display = 'none';
      data_cadastro_dep.classList.add('largura_um_quarto');
    } else {
      nota_fiscal_cad_dep.style.display = 'flex';
      data_cadastro_dep.classList.remove('largura_um_quarto')
    }
    // para_operacao.remove();
  }else{
    if (cadType == 1) {
      
      let campo_to_complete_removed = 'resultado_cad_deposito_insumos'+idCampoCad+'';
      list_campos_to_complete_removed.push(campo_to_complete_removed);

      let input_to_complete_removed = 'insumoID_Insumodeposito'+idCampoCad+'';
      list_inputs_to_complete_removed.push(input_to_complete_removed);

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
    }
  }
    
}


async function searchInput_cadDeposito(valor_to_search, id_campo_digitado, cadType) {
  // console.log('//searchInput_cadDisp - o ID do campo digitado é: '+id_campo_digitado);
  if (cadType == 1) { 
    if (valor_to_search.length >= 2) {
      // console.log("//deposito - Pesquisar: " + valor_to_search);

      const dados_cad_deposito = await fetch('./dispensario/sch_disp_itens_depst.php?cad_deposito_insumos_nome='+ valor_to_search);

      if (dados_cad_deposito) {
        
        const resposta_cad_deposito = await dados_cad_deposito.json();

        console.log(resposta_cad_deposito);

        var html_listados = '<ul class="display-flex-cl">';

        if (resposta_cad_deposito['erro']) {

          html_listados += '<li>'+resposta_cad_deposito['msg_error_insumos']+'</li>';
        } else {

          for (let i = 0; i < resposta_cad_deposito['dados_insumos'].length; i++) {

            html_listados += '<div class="display-flex-row">'
            
            html_listados += '<li style="margin-right: 10px;" onclick=\'getInsumoId('+ resposta_cad_deposito['dados_insumos'][i].idInsumo+','+ JSON.stringify(resposta_cad_deposito['dados_insumos'][i].descricaoInsumo)+','+ JSON.stringify(resposta_cad_deposito['dados_insumos'][i].nomeInsumo)+', '+id_campo_digitado+','+ resposta_cad_deposito['dados_insumos'][i].qtdCriticaInsumo+', 1, null)\'>'+resposta_cad_deposito['dados_insumos'][i].nomeInsumo +' -</li>';

            html_listados += '<li> '+resposta_cad_deposito['dados_insumos'][i].descricaoInsumo +'</li>';

            html_listados += '</div>'
            
          }
        }

        html_listados += '</ul>';

        let resultado_cad_deposito_insumos = document.getElementById('resultado_cad_deposito_insumos'+controle_campo_cad_deposito+'');

        let campo_deve_preencher = '';

        for (let index = 0; index < list_campos_to_complete_removed.length; index++) {
          const element = list_campos_to_complete_removed[index];
          
          console.log("//searchInput_cadDeposito - campos que foram removidos: "+element);
          
        }

        let campoFoiDeletado = list_campos_to_complete_removed.includes(resultado_cad_deposito_insumos);

        if (campoFoiDeletado || resultado_cad_deposito_insumos==null) {
          // console.log('//searchInput_cadDeposito/verifica_delected - o campo foi deletado')

          novo_campo_resultado_cad_deposito_insumos = list_campos_to_complete_result[0];
          resultado_cad_deposito_insumos = document.getElementById(novo_campo_resultado_cad_deposito_insumos);
          resultado_cad_deposito_insumos.innerHTML = html_listados;
        } else {

          let campo_digitado = list_campos_to_complete_result[id_campo_digitado-1];
          resultado_cad_deposito_insumos = document.getElementById(campo_digitado);
          resultado_cad_deposito_insumos.innerHTML = html_listados;
          // console.log('//searchInput_cadDeposito/verifica-deleted - o campo existe e é: ' + resultado_cad_deposito_insumos);
        }

        // resultado_cad_deposito_insumos.innerHTML = html_listados;

      } else {

        console.log('json vazio');
        
      }
    }

  } else if (cadType == 2) {
    // PARA O DISPENSARIO
    if (valor_to_search.length >= 2) {
      // console.log("//dispensario/ - Pesquisar: " + valor_to_search);

      const dados_cad_deposito = await fetch('./dispensario/sch_disp_itens_depst.php?cad_disp_insumos_nome='+ valor_to_search);
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
            
            html_listados += '<li style="margin-right: 10px;" onclick=\'getInsumoId('+ resposta_cad_deposito['dados_insumos_deposito'][i].idInsumoDeposito+','+ JSON.stringify(resposta_cad_deposito['dados_insumos_deposito'][i].descricaoInsumoDeposito)+','+ JSON.stringify(resposta_cad_deposito['dados_insumos_deposito'][i].nomeInsumoDeposito)+', '+id_campo_digitado+','+ resposta_cad_deposito['dados_insumos_deposito'][i].quantidadeInsumoDeposito+', 2,'+ JSON.stringify(resposta_cad_deposito['dados_insumos_deposito'][i].validadeInsumoDeposito)+')\'>'+resposta_cad_deposito['dados_insumos_deposito'][i].nomeInsumoDeposito +' -</li>';

            html_listados += '<li> '+resposta_cad_deposito['dados_insumos_deposito'][i].descricaoInsumoDeposito +'</li>';

            html_listados += '</div>'
            
          }
        }

        html_listados += '</ul>';

        let resultado_cad_deposito_insumos = document.getElementById('resultado_cad_disp_insumos'+controle_campo_cad_deposito+'');

        let campo_deve_preencher = '';

        for (let index = 0; index < list_resultado_cad_disp_insumos_removed.length; index++) {
          const element = list_resultado_cad_disp_insumos_removed[index];
          
          console.log("//searchInput_cadDeposito - campos que foram removidos: "+element);
          
        }

        let campoFoiDeletado = list_resultado_cad_disp_insumos_removed.includes(resultado_cad_deposito_insumos);

        if (campoFoiDeletado || resultado_cad_deposito_insumos==null) {
          // console.log('//searchInput_cadDeposito/verifica_delected - o campo foi deletado')

          novo_campo_resultado_cad_deposito_insumos = list_resultado_cad_disp_insumos_result[0];
          resultado_cad_deposito_insumos = document.getElementById(novo_campo_resultado_cad_deposito_insumos);
          resultado_cad_deposito_insumos.innerHTML = html_listados;
        } else {

          let campo_digitado = list_resultado_cad_disp_insumos_result[id_campo_digitado-1];
          resultado_cad_deposito_insumos = document.getElementById(campo_digitado);
          resultado_cad_deposito_insumos.innerHTML = html_listados;
          // console.log('//searchInput_cadDeposito/dispensario/verifica-deleted - o campo existe e é: ' + resultado_cad_deposito_insumos);
        }

        // resultado_cad_deposito_insumos.innerHTML = html_listados;

      } else {

        console.log('json vazio');
        
      }
    }
  }
}


function getInsumoId(idInsumo, descricaoInsumo, nomeINsumo, id_campo_digitado, qtdCriticaInsumo, cadType, validadeInsumo) {
  console.log('//getInsumoId - o ID do campo digitado é: '+id_campo_digitado);

  if (cadType == 1) {
    // PARA O DEPOSITO
    console.log('//getInsumoId/Deposito - adicionando resultados deposito!');
  
    let input_to_complete = document.getElementById('insumoID_Insumodeposito'+controle_campo_cad_deposito+'');
    let textarea_to_complet = document.getElementById('descricaoInsumoCadDep'+controle_campo_cad_deposito+'');
    let qtdCriticaInsumo_to_complete = document.getElementById('qtdCriticaInsumoCadDep'+controle_campo_cad_deposito+'');

    let foi_removido = list_inputs_to_complete_removed.includes(input_to_complete);
    if (foi_removido || input_to_complete == null) {
      console.log('//getInsumoId/ - input removido');
      input_to_complete = document.getElementById(list_inputs_to_complete_result[id_campo_digitado-1]);
      console.log('//getInumoId/ - o imput é: '+input_to_complete)
      textarea_to_complet = document.getElementById(list_textarea_to_complete_result[id_campo_digitado-1]);
      qtdCriticaInsumo_to_complete = document.getElementById(list_qtd_critica_to_complete_result[id_campo_digitado-1]);
      console.log('//getInsumoId/ a quantiade crítica é '+qtdCriticaInsumo_to_complete.innerHTML);
    } else{
      console.log('//getInumoId/ - editando o campo: '+id_campo_digitado);
      input_to_complete = document.getElementById('insumoID_Insumodeposito'+id_campo_digitado+'');
      textarea_to_complet = document.getElementById('descricaoInsumoCadDep'+id_campo_digitado+'');
      qtdCriticaInsumo_to_complete = document.getElementById('qtdCriticaInsumoCadDep'+id_campo_digitado+'');
      // console.log('//getInsumoId/ a quantiade critica é '+qtdCriticaInsumo_to_complete.innerHTML);
    }
    
    input_to_complete.value = idInsumo+' - '+nomeINsumo;
    textarea_to_complet.value = descricaoInsumo;
    qtdCriticaInsumo_to_complete.value = qtdCriticaInsumo;

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
    
    let insumoID_Insumodispensario = document.getElementById('insumoID_Insumodispensario'+controle_campo_cad_deposito+'');
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
    quantidadeInsumoDisponivelDeposito_to_complete.value = qtdCriticaInsumo;
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