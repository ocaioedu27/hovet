<?php 

if (   isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
		// $$chave = $valor;
        // print_r($valor_est);
	}
}

$qualEstoque_dep = $valor_est;


if ($qualEstoque_dep != "") {
    $qualEstoque = $qualEstoque_dep;
    // echo "é dep: " . $qualEstoque;
}

$dados_enviados_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$msg_slc = "Solicitação enviada com sucesso!! Registro da solicitação para acompanhamento: ";
$msg_final = "";

if (!empty($dados_enviados_array['btnSolicitarInsumoDispensario'])) {

    $solicitante_insumo_dispensario = mysqli_real_escape_string($conexao,$_POST["solicitante_insumo_dispensario"]);
    $solicitante_insumo_dispensario = strtok($solicitante_insumo_dispensario, " ");
    // echo "<br/> quem Solicitou: " . $solicitante_insumo_dispensario;

    $operacao_dispensario = mysqli_real_escape_string($conexao,$_POST["operacao_dispensario"]);
    $operacao_dispensario = strtok($operacao_dispensario, " ");
    // echo "<br/> Qual a operacao: " . $operacao_dispensario;

    $setor_destino_solicitacao_dispensario = mysqli_real_escape_string($conexao,$_POST["setor_destino_solicitacao_dispensario"]);
    // echo "<br/> Setor de destino: " . $setor_destino_solicitacao_dispensario;
    $setor_destino_nome_tmp = $setor_destino_solicitacao_dispensario;
    $setor_destino_nome = substr($setor_destino_nome_tmp,4);
    $setor_destino_solicitacao_dispensario = strtok($setor_destino_solicitacao_dispensario, " ");

    $data_operacao_dispensario = mysqli_real_escape_string($conexao,$_POST["data_operacao_dispensario"]);
    // echo "<br/> Data da transferência: " . $data_operacao_dispensario;

    $tipo_dispensario = mysqli_real_escape_string($conexao,$_POST["tipo_dispensario"]);
    $tipo_dispensario = strtok($tipo_dispensario, " ");
    // echo "<br/>Dispensário de onde foi solicitado: " . $tipo_dispensario;

    $justifica_requisicao = mysqli_real_escape_string($conexao,$_POST["justifica_requisicao"]);

    $status_slc_id = 3;

    $oid_operacao = uniqid();
    // echo $oid_operacao;

    $contador_slc = 0;

    foreach ($dados_enviados_array['insumo_dispensario_id'] as $chave_solic_dispensario => $valor_solic_dispensario) {

        $contador_slc++;

        $insumo_dispensario_id = $valor_solic_dispensario;
        $insumo_dispensario_id = strtok($insumo_dispensario_id, " ");
        $quantidade_insumo_solic_dispensario = $dados_enviados_array['quantidade_insumo_solic_dispensario'][$chave_solic_dispensario];
        $quantidade_atual_dispensario = $dados_enviados_array['quantidade_atual_dispensario'][$chave_solic_dispensario];
        $validade_insumo_dispensario = $dados_enviados_array['validade_insumo_dispensario'][$chave_solic_dispensario];

        $procura_id_insumo = mysqli_query($conexao, "SELECT insumos_id FROM dispensario WHERE id={$insumo_dispensario_id}") or die('//dispensario/solicita_disp/select_id_estoque - erro ao realizar consulta: ' . mysqli_error($conexao));
        $dados = mysqli_fetch_assoc($procura_id_insumo);
        $insumo_id_tmp = $dados['dispensario_insumos_id'];


        echo "<br/>contador no loop: " . $contador_slc;
        echo "<br/>Oid da solicitacao: " . $oid_operacao;
        echo "<br/>Id do insumo do dispensario: " . $insumo_dispensario_id;
        echo "<br/>Quantidade solicitada: " . $quantidade_insumo_solic_dispensario;
        echo "<br/>Quantidade atual no dispensario: " . $quantidade_atual_dispensario;
        echo "<br/>Validade do insumo: " . $validade_insumo_dispensario;
        echo "<br/>";
        

        $sql_insert = "INSERT INTO pre_solicitacoes (
            usuario_id,
            setor_destino_id,
            justificativa,
            dispensario_id,
            qtd_solicitada,
            tp_movimentacoes_id,
            status_slc_id,
            oid_solicitacao)
            VALUES(
                {$solicitante_insumo_dispensario},
                {$setor_destino_solicitacao_dispensario},
                '{$justifica_requisicao}',
                {$insumo_dispensario_id},
                {$quantidade_insumo_solic_dispensario},
                {$operacao_dispensario},
                {$status_slc_id},
                '{$oid_operacao}'
            )";

        // echo $sql_insert;
        // exit;

        try {
            $guardar_slq = mysqli_query($conexao, $sql_insert);
            if ($guardar_slq) { 
                echo "";
            
            } else {
                die("Erro ao executar a inserção no Dispensário. " . mysqli_error($conexao));   
            }

        } catch (\Throwable $th) {
            echo $th;
        }
        
    }
    $msg_final .= '\n'.$msg_slc . $oid_operacao;

    echo '<script language="javascript">window.alert("'.$msg_final.'")</script>';
    // exit;
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=dispensario_resumo&" . $qualEstoque . "=1';</script>";


} else {
    echo "error";
}

?>