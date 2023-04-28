// para adicionar campos automaticamente
var controle_campo_cad_deposito = 1;
function adicionaCampoCadDeposito() {
    controle_campo_cad_deposito++;
    document.getElementById('dados_insumo').insertAdjacentHTML('beforeend', '<div id="campoCadDeposito'+controle_campo_cad_deposito+'"><div class="form-group valida_movimentacao"> <div class="display-flex-cl"><label>Nome</label><input class="form-control" type"text" name="insumoID_Insumodeposito[]" id="insumoID_Insumodeposito'+controle_campo_cad_deposito+'" onkeyup="searchInput_cadDeposito(this.value)" placeholder="Informe o nome do insumo..." required/><span class="ajuste_span" id="resultado_cad_deposito_insumos'+controle_campo_cad_deposito+'"></span></div><div class="display-flex-cl"><label>Quantidade</label><input type="text" class="form-control" name="quantidadeInsumodeposito[]" required></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control" name="validadeInsumodeposito[]" required></div><div class="display-flex-cl"><label>Quantidade Crítica</label><input type="text" class="form-control" required></div></div><div class="form-group valida_movimentacao"><div class="display-flex-cl"><label>Descrição</label><textarea type="text" class="form-control largura_um_quarto" id="descricaoInsumoCadDep'+controle_campo_cad_deposito+'" readonly></textarea></div><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="removerCampoCadDeposito('+ controle_campo_cad_deposito +')" style="padding: 0;">-</button></div></div>');
}

function removerCampoCadDeposito(idCampoCadDeposito) {
    document.getElementById('campoCadDeposito'+idCampoCadDeposito).remove();
}


async function searchInput_cadDeposito(valor_to_search) {
    if (valor_to_search.length >= 2) {
      // console.log("Pesquisar: " + valor_to_search);

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
            
            html_listados += '<li style="margin-right: 10px;" onclick=\'getInsumoId('+ resposta_cad_deposito['dados_insumos'][i].idInsumo+','+ JSON.stringify(resposta_cad_deposito['dados_insumos'][i].descricaoInsumo)+','+ JSON.stringify(resposta_cad_deposito['dados_insumos'][i].nomeInsumo)+')\'>'+resposta_cad_deposito['dados_insumos'][i].nomeInsumo +' -</li>';

            html_listados += '<li> '+resposta_cad_deposito['dados_insumos'][i].descricaoInsumo +'</li>';

            html_listados += '</div>'
            
          }
        }

        html_listados += '</ul>';
        
        document.getElementById('resultado_cad_deposito_insumos'+controle_campo_cad_deposito+'').innerHTML = html_listados;

      } else {

        console.log('json vazio');
        
      }
    }
}


function getInsumoId(idInsumo, descricaoInsumo, nomeINsumo) {
  // console.log("id do insumo encontrado: " + idInsumo)
  // console.log("Decricao do insumo encontrado: " + descricaoInsumo)


  document.getElementById('insumoID_Insumodeposito'+controle_campo_cad_deposito+'').value = idInsumo+' - '+nomeINsumo;
  
  document.getElementById('descricaoInsumoCadDep'+controle_campo_cad_deposito+'').value = descricaoInsumo;
}


const fechar_span = document.getElementById('insumoID_Insumodeposito'+controle_campo_cad_deposito+'');
document.addEventListener('click', function(event){
  const validar_click_span = fechar_span.contains(event.target);
  if (!validar_click_span) {
    document.getElementById('resultado_cad_deposito_insumos'+controle_campo_cad_deposito+'').innerHTML = '';
  }
})

//para restringir perfis
var sessionUserType = document.querySelector('#sessionUserType').value;
function returnUserSession(sessionUserType){
  let operacao_cadastrar_id = document.getElementById('operacao_cadastro');
  
  let operacao_retirar = document.getElementById('operacao_retirar');

  // console.log(operacao_cadastrar_id);
  let listar_notas_fiscais = document.getElementById('listar_notas_fiscais');

  let th_operacoes_editar_deletar_id = document.getElementById('th_operacoes_editar_deletar');

  let qtd_colunas_tabelas = document.querySelector('#quantidade_linhas_tabelas').value;
  // console.log(qtd_colunas_tabelas)
  let i = 0;

  if(sessionUserType!=5 || sessionUserType!=3){
    // console.log("usuario não terá opcoes de cadastro")
    operacao_cadastrar_id.remove();
    if (operacao_retirar) {      
      operacao_retirar.remove();
    }
    th_operacoes_editar_deletar_id.remove();
    listar_notas_fiscais.remove();
    while(i < qtd_colunas_tabelas){
      qtd_colunas_tabelas--;
      // console.log('teste');
      let td_operacoes_editar_deletar = document.getElementById('td_operacoes_editar_deletar');
      td_operacoes_editar_deletar.remove();
    }
  }
}

returnUserSession(sessionUserType)