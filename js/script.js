var controle_campo_geral = 1;

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
    
    let estoqueDestino_to_complete = document.getElementById('estoqueDestino'+id_campo_digitado+'');

    estoqueDestino_to_complete.value = idInsumo+' - '+nomeINsumo;

    // span_para_fechar.innerHTML = '';
    fechaSpan("resultado_cad_deposito_estoque" , id_campo_digitado)

  } else if (cadType == 6){
    // PARA PREENCHER CAD CATEGORIA
    
    let tipos_insumo_to_complete = document.getElementById('tipos_insumo_'+id_campo_digitado+'');

    tipos_insumo_to_complete.value = idInsumo+' - '+nomeINsumo;

    // span_para_fechar.innerHTML = '';
    fechaSpan("resultado_cad_categoria_insumo_" , id_campo_digitado)

  } else if (cadType == 7){
    // PARA PREENCHER CEDER PERMISSAO

    // console.log("preenchendo campo")

    let botao = document.getElementById('btnCederPermissoesUser');
    // let campo_to_verify = document.getElementById('nomeAcessoUsuario'+  +'').value;
    let nome_permissao_to_complete = document.getElementById('nomeAcessoUsuario'+id_campo_digitado+'');
    let desc_permissao_to_complete = document.getElementById('descAcessoUsuario'+id_campo_digitado+'');

    let id_plus_name_tmp = ''+idInsumo+' - '+nomeINsumo+'';
    let id_plus_name = '';

    nome_permissao_to_complete.value = id_plus_name_tmp;
    desc_permissao_to_complete.value = descricaoInsumo;

    // span_para_fechar.innerHTML = '';
    fechaSpan("resultado_ceder_permissao" , id_campo_digitado)

  } else if (cadType == 8){
    //para preencher o tipo de movimentação    
    let tipo_movimentacao_to_complete = document.getElementById('tipo_movimentacao_'+id_campo_digitado+'');

    tipo_movimentacao_to_complete.value = idInsumo+' - '+nomeINsumo;

    // span_para_fechar.innerHTML = '';
    fechaSpan("sugestao_resultado_span_" , id_campo_digitado)

  } else if (cadType == 9){
    // PARA PREENCHER CAD CATEGORIA
    
    let input_to_complete = document.getElementById('tipos_fornecedor_'+id_campo_digitado+'');

    input_to_complete.value = idInsumo+' - '+nomeINsumo;

    // span_para_fechar.innerHTML = '';
    fechaSpan("resultado_cad_categoria_fornecedor_" , id_campo_digitado)

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
function verificaValorMaximoExcedido(idValorInserido, idValorMaximo, idSpanAlerta, idButton, id_label_title,id_slc = null) {

  let valorInserido = document.getElementById(idValorInserido).value;
  let valorMaximo = document.getElementById(idValorMaximo).value;
  let spanAlert = document.getElementById(idSpanAlerta);
  let label_title = document.getElementById(id_label_title);
  let button = document.getElementById(idButton);
  // let tipo_slc = document.getElementById("qualSolicitacaoDisp");
  let tipo_slc = document.getElementById(id_slc);
  if(tipo_slc != null){
    tipo_slc = tipo_slc.value;
  }else{
    tipo_slc = "dispensario";
  }


  const listCatacteresEspeciais = ['!', '@', '#', '$', '%', '&', '*', '-', '+', '=', '_'];
  let exist_especiais = true
  let comp_maior = true
  let comp_valor_maximo_atendido = true
  let comp_zero = true
  if (!valorInserido){
    console.log("está vazio")
  }else{

    exist_especiais = valorInserido.includes(listCatacteresEspeciais);
    comp_maior = parseInt(valorInserido) >= parseInt(valorMaximo);
    comp_valor_maximo_atendido = parseInt(valorInserido) > parseInt(valorMaximo);
    comp_zero = parseInt(valorInserido) <= 0;
  }
  console.log('Valor inserido: ' + valorInserido);
  console.log('inseido é caractere especial? ' + exist_especiais);
  console.log('inseido é maior que o que foi solicitado? ' + comp_valor_maximo_atendido);
  console.log('inseido é maior que o maximo? ' + comp_maior);
  console.log('inseido é menor que zero? ' + comp_zero);
  console.log('\n');
  let msg_vazio = "Insira um valor!";
  let msg_especiais = "Valor inválido! Insira apenas números!";
  let msg_maior = "Valor inválido!! Insira um valor abaixo do que há disponível.";
  let msg_zero = "Valor inválido!! Insira um valor maior que zero.";
  let msg_valor_acima_slc = "Valor inválido!! Insira um valor abaixo ou igual ao valor solicitado.";
  let msg_to_return = "";

  if (idButton == "operacao_slc_aprova") {
    if (comp_valor_maximo_atendido) {
      button.style.display = 'none';
      spanAlert.style.display = 'block';
      msg_to_return = msg_valor_acima_slc;

    } else if(comp_zero){
      button.style.display = 'none';  
      spanAlert.style.display = 'block';
      msg_to_return = msg_zero;
    } else {
      spanAlert.style.display = 'none';
      button.style.display = 'block';  

    }

  } else {

    console.log("Está no envio de slc \n\n\n");

    let chave = "Devolução";

    if (tipo_slc.toLowerCase().includes(chave.toLowerCase())) {

      if (comp_zero){
        spanAlert.style.display = 'block';
        button.type = 'button';
        msg_to_return = msg_zero;
      }else {
        spanAlert.style.display = 'none';
        button.type = 'submit';
      }
      
    } else {
      
      if (!comp_maior && !comp_zero) {
        spanAlert.style.display = 'none';
        button.type = 'submit';
      }else {
        spanAlert.style.display = 'block';
        button.type = 'button';
      }

      if(!valorInserido){
        msg_to_return = msg_vazio;
      }else{
        if (comp_zero){
          msg_to_return = msg_zero;
        }else if (comp_maior) {
          msg_to_return = msg_maior;
        }else if(exist_especiais){
          msg_to_return = msg_especiais; 
        }
      }

    }
  }

  label_title.innerHTML = msg_to_return;

}

function verifica_valor(valor, tag_msg_alert, button, value_reference) {
  let value_input = document.getElementById(valor).value + "";
  let span_alerta = document.getElementById(tag_msg_alert);
  let button_to_send = document.getElementById(button);
  
  if (value_input <= value_reference || value_input == "-0") {
    span_alerta.style.display = 'block';
    button_to_send.type = 'button';
  } else {
    span_alerta.style.display = 'none';
    button_to_send.type = 'submit';
  }
}