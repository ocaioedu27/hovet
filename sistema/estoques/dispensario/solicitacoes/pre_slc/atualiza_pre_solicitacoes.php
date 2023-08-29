<?php
$stringList = array();

if (   isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
        array_push($stringList, $valor_est);
        // print_r($valor_est);
	}

    $varIdSolicitacao = $stringList[1];

    $novo_status_slc = $stringList[2];
    
    echo "<br>Tipo de operacao: $novo_status_slc";
}


var_dump($_GET);

$idSolicitacao = $_GET[$varIdSolicitacao];
$dados_enviados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados_enviados);

// var_dump($stringList);

$sql = "SELECT 
            s.pre_slc_id,
            u.usuario_primeiro_nome,
            u.usuario_id,
            i.insumos_nome,
            s.pre_slc_qtd_solicitada,
            s.pre_slc_qtd_atendida,
            date_format(s.pre_slc_data, '%d/%m/%Y %H:%i:%s') AS pre_slc_data,
            st.setores_setor,
            s.pre_slc_justificativa,
            s.pre_slc_status_slc_id,
            s.pre_slc_dispensario_id,
            stt.status_slc_status,
            es.estoques_nome,
            tp.tipos_movimentacoes_movimentacao,
            tp.tipos_movimentacoes_id,
            d.dispensario_id,
            d.dispensario_estoques_id,
            d.dispensario_qtd,
            d.dispensario_insumos_id

            FROM pre_solicitacoes s
            
            INNER JOIN usuarios u
            ON s.pre_slc_solicitante = u.usuario_id
            
            INNER JOIN dispensario d
            ON s.pre_slc_dispensario_id = d.dispensario_id
            
            INNER JOIN insumos i
            ON d.dispensario_insumos_id = i.insumos_id 
            
            INNER JOIN setores st
            ON s.pre_slc_setor_destino = st.setores_id
            
            INNER JOIN status_slc stt
            ON s.pre_slc_status_slc_id = stt.status_slc_id
            
            INNER JOIN estoques es
            ON s.pre_slc_dips_solicitado = es.estoques_id
            
            INNER JOIN tipos_movimentacoes tp
            ON tp.tipos_movimentacoes_id = s.pre_slc_tp_movimentacoes_id
        
            WHERE pre_slc_id={$idSolicitacao}";

$result = mysqli_query($conexao, $sql) or die("//Solicitacoes/atualizar_status_solicitacao/ - Erro ao realizar a consulta. " . mysqli_error($conexao));

$dados_sql = mysqli_fetch_assoc($result);

$dispensario_id = $dados_sql['dispensario_id'];

// echo "<br/>//Coleta-valores/ dispensario id - " . $dispensario_id;

$quem_solicitou = $dados_sql['usuario_id'];

// echo "<br/>//Coleta-valores/ quem solicitou - " . $quem_solicitou;

$qualEstoque = $dados_sql['dispensario_estoques_id'];

// echo "<br/>//Coleta-valores/ estoque id - " . $qualEstoque;

$estoqueNome = $dados_sql['estoques_nome'];

// echo "<br/>//Coleta-valores/ Nome do estoque - " . $estoqueNome;

$tipos_movimentacoes_id = $dados_sql['tipos_movimentacoes_id'];

$setores_setor = $dados_sql['setores_setor'];

$solicitacoes_status_slc_id = $dados_sql['pre_slc_status_slc_id'];

$status_solicitacao = $dados_sql['status_slc_status'];

$insumos_nome = $dados_sql['insumos_nome'];

$dispensario_insumos_id = $dados_sql['dispensario_insumos_id'];

$quantidade_atual_dispensario = $dados_sql['dispensario_qtd'];

// echo "<br/>//Coleta-valores/ Quantidade atual no dispensario - " . $quantidade_atual_dispensario;

$pre_slc_qtd_solicitada = $dados_sql['pre_slc_qtd_solicitada'];

// echo "<br/>//Coleta-valores/ Quantidade solicitada - " . $pre_slc_qtd_solicitada;

$pre_slc_qtd_atendida = $dados_sql['pre_slc_qtd_atendida'];

// echo "<br/>//Coleta-valores/ Quantidade atendida - " . $pre_slc_qtd_atendida;



// verificacao de dados enviados

// if (!empty($dados_enviados["btnAprovaSlc"])) {
//     echo "<br/> Dados para aprovação.";
// } else {
//     echo "<br/> Solicitação reprovada.";
// }



if ($novo_status_slc == "aprovar" || !empty($dados_enviados["btnAprovaSlc"])) {

    if ($result->num_rows > 0) {

        // $quantidade_atendida = mysqli_real_escape_string($conexao, $_POST['quantidade_atendida_insumo_solic_dispensario']);
        $quantidade_atendida = "";

        if (isset($_POST['quantidade_atendida_insumo_solic_dispensario'])) {
            // echo "<br/> Foi definida a quantidade atendida via método post.";
            $quantidade_atendida =  mysqli_real_escape_string($conexao, $_POST['quantidade_atendida_insumo_solic_dispensario']);

        } else {
            // echo "<br/> Foi definida a quantidade atendida via método get.";
            $quantidade_atendida = $pre_slc_qtd_solicitada;
            // echo "<br/> qtd será totalmente atendida " . $quantidade_atendida;
        
        }
        

        // echo "<br/>//aprovar - quantidade atendida: " . $quantidade_atendida;

        $sql_altera_status = "UPDATE 
                                    pre_solicitacoes
                                SET    
                                    pre_slc_status_slc_id=1,
                                    pre_slc_qtd_atendida={$quantidade_atendida}
                                
                                WHERE 
                                    pre_slc_id={$idSolicitacao}";

        $deuCerto_altera_status = mysqli_query($conexao, $sql_altera_status);

        if ($deuCerto_altera_status) {
            
            echo "<script language='javascript'>window.alert('Status atualizado Com sucesso!'); </script>";
            $tipos_movimentacoes_id_tmp = 9;

        } else {

            echo "<script language='javascript'>window.alert('Erro ao atualizar status!'); </script>";
            die("<br/>//atualiza_status_slq/sql_Att - Erro: " . mysqli_error($conexao));
        }
        
        if ($tipos_movimentacoes_id == 7) {
            $nova_quantidade = $quantidade_atual_dispensario - $quantidade_atendida;

            // echo "<br/>//subtrai-qtds/ quantidade nova - " . $nova_quantidade;

            $local_origem_tmp = $estoqueNome;
            $local_destino_tmp = $setores_setor;
            

        } elseif ($tipos_movimentacoes_id == 8){
            $nova_quantidade = $quantidade_atual_dispensario + $quantidade_atendida;

            // echo "<br/>//Coleta-valores/ Quantidade somada - " . $nova_quantidade;

            $local_origem_tmp = $setores_setor;
            $local_destino_tmp = $estoqueNome;
        }

        $sql_update_disp_qtd_subtrair = "CALL updateDispensarioQtd($nova_quantidade, $dispensario_id)";

        $sql_atualizou_qtd = mysqli_query($conexao, $sql_update_disp_qtd_subtrair);

        if ($sql_atualizou_qtd) {
            
            echo "<script language='javascript'>window.alert('Quantidade atualizada com sucesso!'); </script>";
            echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=solicitacoes_resumo&Pendente';</script>";

        } else {

            echo "<script language='javascript'>window.alert('Erro ao atualizar quantidade!'); </script>";
            die("<br/>//atualiza_status_slq/sql_Att - Erro: " . mysqli_error($conexao));
        }
    }


} else {

    if ($result->num_rows > 0) {
    
        echo "<br/>//recusar - Novo status: " . $novo_status_slc;

        $sql_altera_status = "UPDATE pre_solicitacoes SET pre_slc_status_slc_id=2 WHERE pre_slc_id={$idSolicitacao}";

        $deuCerto = mysqli_query($conexao, $sql_altera_status);

        if ($deuCerto) {
            
            $tipos_movimentacoes_id_tmp = 10;
            echo "<script language='javascript'>window.alert('Status atualizado Com sucesso!'); </script>";
            echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=solicitacoes_resumo';</script>";

        } else {

            echo "<script language='javascript'>window.alert('Erro ao atualizar status!'); </script>";
            die("<br/>//atualiza_status_slq/sql_Att - Erro: " . mysqli_error($conexao));
        }
        
        if ($tipos_movimentacoes_id == 7) {
            $nova_quantidade = $quantidade_atual_dispensario - $quantidade_atendida;

            $local_origem_tmp = $estoqueNome;
            $local_destino_tmp = $setores_setor;
            

        } elseif ($tipos_movimentacoes_id == 8){
            $nova_quantidade = $quantidade_atual_dispensario + $quantidade_atendida;

            $local_origem_tmp = $setores_setor;
            $local_destino_tmp = $estoqueNome;
        }
    }

}


$tipo_movimentacao = $tipos_movimentacoes_id_tmp;

$local_origem = $local_origem_tmp;

$local_destino = $local_destino_tmp;

$usuario_id = $sessionUserID;

$insumo_id = $dispensario_insumos_id;

atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id, $insumo_id);
