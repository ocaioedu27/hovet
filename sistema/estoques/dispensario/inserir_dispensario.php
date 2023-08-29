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

// var_dump($dados_enviados_array);

if (!empty($dados_enviados_array['btnAdicionarInsumoDispensario'])) {

    $mov_dep_to_disp = mysqli_real_escape_string($conexao,$_POST["mov_dep_to_disp"]);
    // echo "<br/> tipo de movimentação guardou: " . $mov_dep_to_disp;

    $quem_guardou = mysqli_real_escape_string($conexao,$_POST["solicitante_retira_dispensario"]);
    // echo "<br/> quem guardou: " . $quem_guardou;

    $dataTransferDepToDisp = mysqli_real_escape_string($conexao,$_POST["dataTransferDepToDisp"]);
    // echo "<br/> Data da transferência: " . $dataTransferDepToDisp;
    // echo "<br/>";

    foreach ($dados_enviados_array['insumoID_Insumodispensario'] as $chave_cad_dispensario => $valor_cad_dispensario) {

        $depositoID_Insumodispensario = $valor_cad_dispensario;
        $depositoID_Insumodispensario = strtok($depositoID_Insumodispensario, " ");
        // echo "<br/>Id do insumo no deposito: $depositoID_Insumodispensario";
        $quantidadeInsumoDispensario = $dados_enviados_array['quantidadeInsumoDispensario'][$chave_cad_dispensario];
        $validadeInsumoDeposito = $dados_enviados_array['validadeInsumoDeposito'][$chave_cad_dispensario];
        $localInsumodispensario = $dados_enviados_array['localInsumodispensario'][$chave_cad_dispensario];
        $localInsumodispensario = strtok($localInsumodispensario, " ");
        $depositoDestinoInsumodeposito = $dados_enviados_array['depositoDestinoInsumodeposito'][$chave_cad_dispensario];
        $depositoDestinoInsumodeposito = strtok($depositoDestinoInsumodeposito, " ");
        // echo "<br> Dispensario de destino" . $depositoDestinoInsumodeposito;

        $procura_id_insumo_dep = mysqli_query($conexao, "SELECT deposito_insumos_id FROM deposito WHERE deposito_id={$depositoID_Insumodispensario}") or die('//dispensario/inserir_dispensario/select_id_insumo - erro ao realizar consulta: ' . mysqli_error($conexao));
        $array_insumo_id = mysqli_fetch_assoc($procura_id_insumo_dep);
        $insumo_id = $array_insumo_id['deposito_insumos_id'];
        
        // echo '<br/>id do insumo: ' . $insumo_id;
        // echo "<br/>Chave para o insumo: $chave_cad_dispensario";
        // echo "<br/>Id do insumo no deposito: $depositoID_Insumodispensario";
        // echo "<br/>Id do insumo: $insumo_id";
        // echo "<br/>Quantidade: $quantidadeInsumoDispensario";
        // echo "<br/>Validade: $validadeInsumoDeposito";
        // echo "<br/>Local: $localInsumodispensario";
        // echo "<hr>";

        $sql_insert = "INSERT INTO dispensario (
            dispensario_qtd,
            dispensario_validade,
            dispensario_deposito_id,
            dispensario_local_id,
            dispensario_insumos_id,
            dispensario_estoques_id)
            VALUES(
                {$quantidadeInsumoDispensario},
                '{$validadeInsumoDeposito}',
                {$depositoID_Insumodispensario},
                {$localInsumodispensario},
                {$insumo_id},
                {$depositoDestinoInsumodeposito}
            )";

        if (mysqli_query($conexao, $sql_insert)) { 
            echo "<script language='javascript'>window.alert('Insumo inserido no Dispensário com sucesso!!'); </script>";
            echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=dispensario_resumo&" . $qualEstoque . "=1';</script>";
            // echo "insumo inserido com sucesso";   
        } else {
            die("Erro ao executar a inserção no Dispensário. " . mysqli_error($conexao));   
        }
    }
} else {
    echo "error";
}


$tipo_movimentacao = mysqli_real_escape_string($conexao,$_POST["mov_dep_to_disp"]);
$tipo_movimentacao = strtok($tipo_movimentacao, " ");

$local_origem = "Depósito";

$local_destino = "Dispensário " . $qualEstoque[-1];

$usuario_id = $_SESSION['usuario_id'];

$insumo_id = $depositoID_Insumodispensario;

atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id, $insumo_id);

?>