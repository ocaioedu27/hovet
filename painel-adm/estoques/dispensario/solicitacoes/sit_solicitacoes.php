<?php
// $idSolicitacao = $_GET["idSolicitacao"];
// echo $idSolicitacao;
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
    $tipo_operacao = $stringList[2];
    
    echo "<br>Tipo de operacao: $tipo_operacao";
}

$idSolicitacao = $_GET[$varIdSolicitacao];

// var_dump($stringList);

$sql = "SELECT 
            s.solicitacoes_id,
            u.usuario_primeiro_nome,
            u.usuario_id,
            i.insumos_nome,
            s.solicitacoes_qtd_solicitada,
            date_format(s.solicitacoes_data, '%d/%m/%Y %H:%i:%s') AS solicitacoes_data,
            st.setores_setor,
            s.solicitacoes_justificativa,
            stt.status_slc_status,
            es.estoques_nome,
            tp.tipos_movimentacoes_movimentacao,
            tp.tipos_movimentacoes_id,
            d.dispensario_id,
            d.dispensario_estoques_id

            FROM solicitacoes s
            
            INNER JOIN usuarios u
            ON s.solicitacoes_solicitante = u.usuario_id
            
            INNER JOIN dispensario d
            ON s.solicitacoes_dispensario_id = d.dispensario_id
            
            INNER JOIN insumos i
            ON d.dispensario_insumos_id = i.insumos_id 
            
            INNER JOIN setores st
            ON s.solicitacoes_setor_destino = st.setores_id
            
            INNER JOIN status_slc stt
            ON s.solicitacoes_status_slc_id = stt.status_slc_id
            
            INNER JOIN estoques es
            ON s.solicitacoes_dips_solicitado = es.estoques_id
            
            INNER JOIN tipos_movimentacoes tp
            ON tp.tipos_movimentacoes_id = s.solicitacoes_tp_movimentacoes_id
        
            WHERE solicitacoes_id={$idSolicitacao}";

$result = mysqli_query($conexao, $sql) or die("//Solicitacoes/atualizar_status_solicitacao/ - Erro ao realizar a consulta. " . mysqli_error($conexao));

$dados_sql = mysqli_fetch_assoc($result);
$dispensario_id = $dados_sql['dispensario_id'];
echo "<br/>ID do insumo do dispensario: " . $dispensario_id;

$quem_solicitou = $dados_sql['usuario_id'];
echo "<br/>Quem solicitou o insumo do dispensario: " . $quem_solicitou;

$qualEstoque = $dados_sql['dispensario_estoques_id'];
echo "<br/>Qual id do dispensario: " . $qualEstoque;

$estoqueNome = $dados_sql['estoques_nome'];
echo "<br/>Nome do dispensario: " . $estoqueNome;

$tipos_movimentacoes_id = $dados_sql['tipos_movimentacoes_id'];
$nomeMovimentacao = $dados_sql['tipos_movimentacoes_movimentacao'];
echo "<br/>ID do tipo de movimentacao: " . $tipos_movimentacoes_id . " - " . $nomeMovimentacao;

$setores_setor = $dados_sql['setores_setor'];
echo "<br/>Para onde está indo: " . $setores_setor;
// echo $deposito_insumos_id;


// if ($result->num_rows > 0) {
//     $sqlDelete = mysqli_query($conexao, "DELETE from dispensario WHERE dispensario_id=$idInsumodispensario");
//     echo "<script language='javascript'>window.alert('Item excluído com sucesso!!'); </script>";
//     echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=dispensario_resumo&" . $qualEstoque . "=1';</script>";
//     // echo "<br/>Item excluido com sucesso";
// }


// $tipo_movimentacao = $tipos_movimentacoes_id;

// $local_origem = $estoqueNome;

// $local_destino = $setores_setor;

// $usuario_id = $quem_solicitou;

// $insumo_id = $deposito_insumos_id;

// atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id, $insumo_id);
