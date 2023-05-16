<header>
    <h2>Inserir Insumo no Dispensário</h2>
</header>
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

if (!empty($dados_enviados_array['btnSolicitarInsumoDispensario'])) {

    $solicitante_insumo_dispensario = mysqli_real_escape_string($conexao,$_POST["solicitante_insumo_dispensario"]);
    $solicitante_insumo_dispensario = strtok($solicitante_insumo_dispensario, " ");
    // echo "<br/> quem Solicitou: " . $solicitante_insumo_dispensario;

    $operacao_dispensario = mysqli_real_escape_string($conexao,$_POST["operacao_dispensario"]);
    $operacao_dispensario = strtok($operacao_dispensario, " ");
    // echo "<br/> Qual a operacao: " . $operacao_dispensario;

    $setor_destino_solicitacao_dispensario = mysqli_real_escape_string($conexao,$_POST["setor_destino_solicitacao_dispensario"]);
    // echo "<br/> Setor de destino: " . $setor_destino_solicitacao_dispensario;
    $setor_destino_solicitacao_dispensario = strtok($setor_destino_solicitacao_dispensario, " ");

    $data_operacao_dispensario = mysqli_real_escape_string($conexao,$_POST["data_operacao_dispensario"]);
    // echo "<br/> Data da transferência: " . $data_operacao_dispensario;

    $tipo_dispensario = mysqli_real_escape_string($conexao,$_POST["tipo_dispensario"]);
    $tipo_dispensario = strtok($tipo_dispensario, " ");
    // echo "<br/>Dispensário de onde foi solicitado: " . $tipo_dispensario;

    $justifica_requisicao = mysqli_real_escape_string($conexao,$_POST["justifica_requisicao"]);

    $status_slc_id = 3;

    foreach ($dados_enviados_array['insumo_dispensario_id'] as $chave_solic_dispensario => $valor_solic_dispensario) {

        $insumo_dispensario_id = $valor_solic_dispensario;
        $insumo_dispensario_id = strtok($insumo_dispensario_id, " ");
        $quantidade_insumo_solic_dispensario = $dados_enviados_array['quantidade_insumo_solic_dispensario'][$chave_solic_dispensario];
        $quantidade_atual_dispensario = $dados_enviados_array['quantidade_atual_dispensario'][$chave_solic_dispensario];
        $validade_insumo_dispensario = $dados_enviados_array['validade_insumo_dispensario'][$chave_solic_dispensario];
        $localInsumodispensario = $dados_enviados_array['localInsumodispensario'][$chave_solic_dispensario];
        $localInsumodispensario = strtok($localInsumodispensario, " ");

        $procura_id_insumo_dep = mysqli_query($conexao, "SELECT estoques_id FROM estoques WHERE estoques_nome_real='{$qualEstoques}'") or die('//dispensario/solicita_disp/select_id_estoque - erro ao realizar consulta: ' . mysqli_error($conexao));
        $dados = mysqli_fetch_assoc($procura_id_insumo_dep);
        $estoque_id = $dados['estoques_id'];
        
        // echo '<br/>id do insumo no dispensario: ' . $insumo_id['deposito_insumos_id'];
        // echo "<br/>Chave para o insumo: $chave_solic_dispensario";
        // echo "<br/>Id do insumo do Dispensário: $insumo_dispensario_id";
        // echo "<br/>Quantidade Solicitada: $quantidade_insumo_solic_dispensario";
        // echo "<br/>Validade: $validade_insumo_dispensario";
        // echo "<br/>Quantidade Atual: $quantidade_atual_dispensario";
        // echo "<hr>";

        $sql_insert = "INSERT INTO solicitacoes (
            solicitacoes_solicitante,
            solicitacoes_dips_solicitado,
            solicitacoes_setor_destino,
            solicitacoes_justificativa,
            solicitacoes_dispensario_id,
            solicitacoes_qtd_solicitada,
            solicitacoes_tp_movimentacoes_id,
            solicitacoes_status_slc_id)
            VALUES(
                {$solicitante_insumo_dispensario},
                {$tipo_dispensario},
                {$setor_destino_solicitacao_dispensario},
                '{$justifica_requisicao}',
                {$insumo_dispensario_id},
                {$quantidade_insumo_solic_dispensario},
                {$operacao_dispensario},
                {$status_slc_id}
            )";

        if (mysqli_query($conexao, $sql_insert)) { 
            echo "<script language='javascript'>window.alert('Solicitação enviada com sucesso!!'); </script>";
            echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=dispensario&" . $qualEstoque . "=1';</script>";
            // echo "insumo inserido com sucesso";   
        } else {
            die("Erro ao executar a inserção no Dispensário. " . mysqli_error($conexao));   
        }
    }

    // echo "<br/>Justificativa: " . $justifica_requisicao;

} else {
    echo "error";
}

// $procura_id_insumo_dep = mysqli_query($conexao, "SELECT estoques_id FROM estoques WHERE estoques_nome_real='{$qualEstoques}'") or die('//dispensario/solicita_disp/select_id_estoque - erro ao realizar consulta: ' . mysqli_error($conexao));
// $dados = mysqli_fetch_assoc($procura_id_insumo_dep);
// $estoque_id = $dados['estoques_id'];
        
        // echo '<br/>id do insumo no dispensario: ' . $insumo_id['deposito_insumos_id'];
// $tipo_movimentacao = mysqli_real_escape_string($conexao,$_POST["mov_dep_to_disp"]);
// $tipo_movimentacao = strtok($tipo_movimentacao, " ");

// $local_origem = "Depósito";

// $local_destino = "Dispenário";

// $usuario_id = $_SESSION['usuario_id'];

// $insumo_id = $insumo_dispensario_id;

// atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id, $insumo_id);

?>