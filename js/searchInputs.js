
async function searchInput_cadDeposito(valor_to_search, id_campo_digitado, cadType, origem=null) {
    // console.log('//searchInput_cadDisp - o ID do campo digitado é: '+id_campo_digitado);
    if (cadType == 1) { 
      if (valor_to_search.length >= 2) {
        // console.log("//deposito - Pesquisar: " + valor_to_search);
  
        const dados_cad_deposito = await fetch('./estoques/dispensario/sch_disp_itens_depst.php?cad_deposito_insumos_nome='+ valor_to_search);
  
        if (dados_cad_deposito) {
          
          const resposta_cad_deposito = await dados_cad_deposito.json();
  
          console.log(resposta_cad_deposito);
  
          let valor_get_id_ehPermuta = 1;
  
          var html_listados = '<ul class="display-flex-cl">';
  
          if (resposta_cad_deposito['erro']) {
  
            html_listados += '<li onclick=\'fechaSpan("resultado_cad_deposito_insumos",'+id_campo_digitado+')\'>'+resposta_cad_deposito['msg_error_insumos']+'</li>';
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
  
            html_listados += '<li onclick=\'fechaSpan("resultado_cad_disp_insumos",'+id_campo_digitado+')\'>'+resposta_cad_deposito['msg_error_insumos']+'</li>';
            // html_listados += '<li>'+resposta_cad_deposito['msg_error_insumos']+'</li>';
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
  
            // html_listados += '<li>'+resposta_cad_deposito['msg_error_insumos_disp']+'</li>';
            html_listados += '<li onclick=\'fechaSpan("resultado_slc_disp_insumos",'+id_campo_digitado+')\'>'+resposta_cad_deposito['msg_error_insumos_disp']+'</li>';
  
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
  
            // html_listados += '<li onclick=\'fechaSpan('+id_campo_digitado+')\'>'+resposta_cad_deposito['msg_error_insumos']+'</li>';
            html_listados += '<li onclick=\'fechaSpan("resultado_permuta_insumos",'+id_campo_digitado+')\'>'+resposta_cad_deposito['msg_error_insumos']+'</li>';
  
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

        const dados_estoque_destino = await fetch('./estoques/dispensario/sch_disp_itens_depst.php?cad_deposito_estoque_nome='+ valor_to_search+'&origem='+origem);
        // console.log('//permuta/ - retornou a pesquisa')
  
        if (dados_estoque_destino) {
          
          const resposta_cad_deposito = await dados_estoque_destino.json();
  
          console.log('//permuta/dados_permuta_dep = '+ resposta_cad_deposito);
  
          var html_listados = '<ul class="display-flex-cl">';
  
          if (resposta_cad_deposito['erro']) {
  
            // html_listados += '<li onclick=\'fechaSpan('+id_campo_digitado+')\'>'+resposta_cad_deposito['msg_error_estoques']+'</li>';
            html_listados += '<li onclick=\'fechaSpan("resultado_cad_deposito_estoque",'+id_campo_digitado+')\'>'+resposta_cad_deposito['msg_error_estoques']+'</li>';
  
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
    } else if (cadType == 7) {
      // PARA PROCURAR PERMISSOES DE USUARIOS
  
      if (valor_to_search.length >= 2) {
        console.log("//procura_permissao/ - Pesquisar: " + valor_to_search);
  
        const returned_dados_permissoes = await fetch('./estoques/dispensario/sch_disp_itens_depst.php?dados_permissoes='+ valor_to_search+ '&usuarioId='+origem);
        // console.log('//permuta/ - retornou a pesquisa')
  
        // let teste_ = JSON.stringify(returned_dados_permissoes);
        // console.log("//permissoes - json: " + teste_)
  
        if (returned_dados_permissoes) {
          
          const resposta_dados = await returned_dados_permissoes.json();
  
          // console.log('//ceder_permissoes/dados_permissoes = '+ resposta_dados);
  
          var html_listados = '<ul class="display-flex-cl">';
  
          if (resposta_dados['erro']) {
  
            html_listados += '<li onclick=\'fechaSpan("resultado_ceder_permissao",'+id_campo_digitado+')\'>'+resposta_dados['msg_error_permissoes']+'</li>';
          } else {
  
            for (let i = 0; i < resposta_dados['dados_permissoes'].length; i++) {
  
              html_listados += '<div class="display-flex-row">'
              
              html_listados += '<li onclick=\'getInsumoId('+ resposta_dados['dados_permissoes'][i].permissoesId+','+ JSON.stringify(resposta_dados['dados_permissoes'][i].nomeCategoriaPermissao)+','+ JSON.stringify(resposta_dados['dados_permissoes'][i].permissoesNome)+', '+id_campo_digitado+',"",7,"")\'>'+resposta_dados['dados_permissoes'][i].permissoesNome +'</li>';
              
              html_listados += '<li>|</li>';
  
              html_listados += '<li> '+resposta_dados['dados_permissoes'][i].nomeCategoriaPermissao +'</li>';
  
              html_listados += '</div>';
              
            }
          }
  
          html_listados += '</ul>';
  
          let resultado_cad_deposito_estoque = document.getElementById('resultado_ceder_permissao'+id_campo_digitado+'');
  
          resultado_cad_deposito_estoque.innerHTML = html_listados;
  
        } else {
  
          console.log('json vazio');
          
        }
      }
  
    } else if (cadType == 8) {// PARA PROCURAR TIPOS DE MOVIMENTAÇÕES
      if (valor_to_search.length >= 2) {
        console.log("//searchInput_cadDeposito/movimentacoes - Pesquisar: " + valor_to_search);
  
        const dados_retornados = await fetch('./estoques/dispensario/sch_disp_itens_depst.php?valor_movimentacoes='+ valor_to_search);
  
        if (dados_retornados) {
          
          const resposta_dados = await dados_retornados.json();
  
          console.log("//searchInput_cadDeposito/movimentacoes - resposta: ", resposta_dados);
  
          var html_listados = '<ul class="display-flex-cl">';
  
          if (resposta_dados['erro']) {
  
            html_listados += '<li onclick=\'fechaSpan("sugestao_resultado_span_",'+id_campo_digitado+')\'>'+resposta_dados['msg_erro']+'</li>';
          } else {
  
            for (let i = 0; i < resposta_dados['dados'].length; i++) {
  
              html_listados += '<div class="display-flex-row">'
              
              html_listados += '<li onclick=\'getInsumoId('+ resposta_dados['dados'][i].id_mov+','+ JSON.stringify(resposta_dados['dados'][i].desc_mov)+','+ JSON.stringify(resposta_dados['dados'][i].nome_mov)+', '+id_campo_digitado+',"",8,"")\'>'+resposta_dados['dados'][i].nome_mov +'</li>';
              
              html_listados += '<li>|</li>';
  
              html_listados += '<li> '+resposta_dados['dados'][i].desc_mov +'</li>';
  
              html_listados += '</div>';
              
            }
          }
  
          html_listados += '</ul>';
  
          let resultado_cad_deposito_estoque = document.getElementById('sugestao_resultado_span_'+id_campo_digitado+'');
  
          resultado_cad_deposito_estoque.innerHTML = html_listados;
  
        } else {
  
          console.log('json vazio');
          
        }
      }
    } else if (cadType == 9) {// PARA PROCURAR CATEGORIA DE FORNECEDORES
      if (valor_to_search.length >= 2) {
        console.log("//procura_categoria/ - Pesquisar: " + valor_to_search);
  
        const dados_categoria = await fetch('./estoques/dispensario/sch_disp_itens_depst.php?cad_cateogia_fornecedor='+ valor_to_search);
        // console.log('//permuta/ - retornou a pesquisa')
  
        if (dados_categoria) {
          
          const resposta_cad_categoria = await dados_categoria.json();
  
          console.log('//retorna_dados - Resultado = '+ resposta_cad_categoria);
  
          var html_listados = '<ul class="display-flex-cl">';
  
          if (resposta_cad_categoria['erro']) {
  
            html_listados += '<li onclick=\'fechaSpan("resultado_cad_categoria_fornecedor_",'+id_campo_digitado+')\'>'+resposta_cad_categoria['msg_error_categorias']+'</li>';
          } else {
  
            for (let i = 0; i < resposta_cad_categoria['dados_categorias'].length; i++) {
  
              html_listados += '<div class="display-flex-row">'
              
              html_listados += '<li onclick=\'getInsumoId('+ resposta_cad_categoria['dados_categorias'][i].categoriaId+',"",'+ JSON.stringify(resposta_cad_categoria['dados_categorias'][i].categoria_nome)+', '+id_campo_digitado+',"",9,"")\'>'+resposta_cad_categoria['dados_categorias'][i].categoria_nome +'</li>';
              
              // html_listados += '<li>|</li>';
  
              // html_listados += '<li> '+resposta_cad_categoria['dados_categorias'][i].categoria_desc +'</li>';
  
              html_listados += '</div>';
              
            }
          }
  
          html_listados += '</ul>';
  
          let result_to_show = document.getElementById('resultado_cad_categoria_fornecedor_'+id_campo_digitado+'');
  
          result_to_show.innerHTML = html_listados;
  
        } else {
  
          console.log('json vazio');
          
        }
      }
    } else if (cadType == 10) {// PROCURAR POR INSUMOS DA FARMÁCIA
       
      if (valor_to_search.length >= 2) {
        // console.log("//dispensario/ - Pesquisar: " + valor_to_search);
  
        const dados_cad_deposito = await fetch('./estoques/dispensario/sch_disp_itens_depst.php?doar_farmacia='+ valor_to_search);
  
        if (dados_cad_deposito) {
          
          const resposta = await dados_cad_deposito.json();
  
          console.log('//dispensario/dados_cad_deposito = '+ resposta);
  
          var html_listados = '<ul class="display-flex-cl">';
  
          if (resposta['erro']) {
  
            html_listados += '<li onclick=\'fechaSpan("resultado_cad_disp_insumos",'+id_campo_digitado+')\'>'+resposta['msg_error']+'</li>';
            // html_listados += '<li>'+resposta['msg_error_insumos']+'</li>';
          } else {
  
            for (let i = 0; i < resposta['dados'].length; i++) {
  
              html_listados += '<div class="display-flex-row">'

              let idInsumo = resposta['dados'][i].idInsumo;
              let descricaoInsumo = resposta['dados'][i].descricaoInsumo;
              let nomeInsumo = resposta['dados'][i].nomeInsumo;
              let qtdDisponivel = resposta['dados'][i].qtdDisponivelInsumo;
              let validadeInsumo = resposta['dados'][i].validadeInsumo;
              
              html_listados += '<li onclick=\'getInsumoId('+ idInsumo +',"'+ descricaoInsumo +'","'+ nomeInsumo +'", '+id_campo_digitado+','+ qtdDisponivel +', 2,"'+ validadeInsumo +'")\'>'+ idInsumo + ' - ' + nomeInsumo +'</li>';
  
              html_listados += '<li>|</li>';
  
              html_listados += '<li>'+resposta['dados'][i].descricaoInsumo +'</li>';
  
              html_listados += '<li>|</li>';
  
              let validade_bruta = new Date(resposta['dados'][i].validadeInsumo);
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
      
    }
}