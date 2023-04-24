// Para completar campos automaticamente no momento de retirada do deposito para o dispensario


$(document).ready(function(){
    $("select[name='depositoID_Insumodispensario']").blur(function(){
        
        var $quantidadeInsumoDeposito = $("input[name='quantidadeInsumoDeposito']");
        var $validadeInsumoDeposito = $("input[name='validadeInsumoDeposito']");
        var depositoID_Insumodispensario = $(this).val()
        depositoID_Insumodispensario = depositoID_Insumodispensario.split(' ')[0];

        $.getJSON('http://localhost/hovet/painel-adm/dispensario/sch_disp_itens_depst.php',{depositoID_Insumodispensario},
    
            function(retorno){
                console.log(depositoID_Insumodispensario);

                $quantidadeInsumoDeposito.val(retorno.quantidadeInsumoDeposito);
                $validadeInsumoDeposito.val(retorno.validadeInsumoDeposito);
        });
    });
});


// Para completar campos automaticamente no momento de retirada de insumos do dispensario

$(document).ready(function(){
    $("select[name='depositoID_Insumodispensario']").blur(function(){
        
        var $quantidadeInsumoDeposito = $("input[name='quantidadeInsumoDeposito']");
        var $validadeInsumoDeposito = $("input[name='validadeInsumoDeposito']");
        var depositoID_Insumodispensario = $(this).val()
        depositoID_Insumodispensario = depositoID_Insumodispensario.split(' ')[0];

        $.getJSON('http://localhost/hovet/painel-adm/dispensario/sch_disp_itens_depst.php',{depositoID_Insumodispensario},
    
            function(retorno){
                console.log(depositoID_Insumodispensario);

                $quantidadeInsumoDeposito.val(retorno.quantidadeInsumoDeposito);
                $validadeInsumoDeposito.val(retorno.validadeInsumoDeposito);
        });
    });
});