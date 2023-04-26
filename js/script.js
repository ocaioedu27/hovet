// para adicionar campos automaticamente
var controle_campo_cad_deposito = 1;
function adicionaCampoCadDeposito() {
    controle_campo_cad_deposito++;
    document.getElementById('dados_insumo').insertAdjacentHTML('beforeend', '<div class="form-group valida_movimentacao" id="campoCadDeposito'+controle_campo_cad_deposito+'"> <div class="display-flex-cl"><label>Nome</label><input class="form-control" type"text" name="nomeInsumoPesquisar[]" placeholder="teste" id="nomeInsumoPesquisar"></div><div class="display-flex-cl"><label>Quantidade</label><input type="text" class="form-control" name="quantidadeInsumodeposito[]" required></div><div class="display-flex-cl"><label>Validade</label><input type="date" class="form-control" name="validadeInsumodeposito[]" required></div><div class="display-flex-cl"><label>Descrição</label><input type="text" class="form-control" readonly></div><button class="btn" type="button" id="'+controle_campo_cad_deposito+'" onclick="removerCampoCadDeposito('+ controle_campo_cad_deposito +')" style="padding: 0;">-</button></div>');
}


function removerCampoCadDeposito(idCampoCadDeposito) {
    document.getElementById('campoCadDeposito'+idCampoCadDeposito).remove();
}