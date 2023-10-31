
//para restringir perfis
function hasPermissionsJs(has_permissions){
    var permissionsUser_tmp = document.getElementById(has_permissions).value;

    console.log("//hasPermissions - Lista de dados: " +permissionsUser_tmp)

    const permissionsUser = permissionsUser_tmp.substring(0,5);
    const tamSystemPermissions = permissionsUser_tmp.substring(6);

    console.log("//hasPermissions - Usuário tem permissoes? " +permissionsUser)

    console.log("//hasPermissions - Quantidade de opcoes do sistema: " +tamSystemPermissions)

    // console.log(permissionsUser)
  
    let operacao_cadastrar_id = null;
    let operacao_retirar = null;
    let listar_notas_fiscais = null;
    let th_operacoes_editar_deletar_id = null;
    let qtd_colunas_tabelas = 0;
    let operacao_slc_aprova = null;
    let operacao_slc_reprova = null;
    let confirma_dados_slc = null;
    let menu_listar = null;
    let tipo_usuario_meus_dados = null;
    let quantidade_atendida_insumo_solic_dispensario = null;
  
    try {
  
      operacao_cadastrar_id = document.getElementById('operacao_cadastro');
      
      operacao_retirar = document.getElementById('operacao_retirar');
  
      // console.log(operacao_cadastrar_id);
      listar_notas_fiscais = document.getElementById('listar_notas_fiscais');
  
      th_operacoes_editar_deletar_id = document.getElementById('th_operacoes_editar_deletar');
  
      confirma_dados_slc = document.getElementById('confirma_dados_slc');
  
      qtd_colunas_tabelas = document.querySelector('#quantidade_linhas_tabelas').value;

      tipo_usuario_meus_dados = document.getElementById('tipo_usuario_meus_dados');

      quantidade_atendida_insumo_solic_dispensario = document.getElementById('quantidade_atendida_insumo_solic_dispensario');

    } catch (error) {
      console.log('erro ao tentar pegar a tag pelo id: '+error)
      qtd_colunas_tabelas = 0;
    }
  
    let i = 0;
  
    if(permissionsUser === "false"){
      console.log("usuario não tem permissões "+ permissionsUser);
  
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
  
      if (tipo_usuario_meus_dados) {
        tipo_usuario_meus_dados.remove();
      }
  
      if (quantidade_atendida_insumo_solic_dispensario) {
        quantidade_atendida_insumo_solic_dispensario.remove();
      }
  
      // console.log(qtd_colunas_tabelas,i);
      if (permissionsUser === "false") {
        while(i < tamSystemPermissions){
          console.log("//hasPermissions/whileNoMenus - usuário sem permissão")
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
          
          i++;

        }
          
      } else {
        console.log('nada será feito');
      }
    }
     
  }

hasPermissionsJs("tem_permissoes");