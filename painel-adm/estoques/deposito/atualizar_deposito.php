<header>
    <h2>Atualizando Itens do Depósito - Permuta</h2>
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

if (!empty($dados_enviados_array['btnPermutaInsumoDeposito'])) {

    $movimentacao_permuta_deposito = mysqli_real_escape_string($conexao,$_POST["movimentacao_permuta_deposito"]);
    $movimentacao_permuta_deposito = strtok($movimentacao_permuta_deposito, " ");
    echo "<br/> tipo de movimentação: " . $movimentacao_permuta_deposito;

    $quemRealizouPermutaDep = mysqli_real_escape_string($conexao,$_POST["quemRealizouPermutaDep"]);
    $quemRealizouPermutaDep = strtok($quemRealizouPermutaDep, " ");
    echo "<br/> quem realizou: " . $quemRealizouPermutaDep;

    $dataTransferPermutaDep = mysqli_real_escape_string($conexao,$_POST["dataTransferPermutaDep"]);
    echo "<br/> Data da transferência: " . $dataTransferPermutaDep;
    // echo "<br/>";

    $instituicaoPermutaDep = mysqli_real_escape_string($conexao,$_POST["instituicaoPermutaDep"]);
    $instituicaoPermutaDep = strtok($instituicaoPermutaDep, " ");
    echo "<br/> Instituicao: " . $instituicaoPermutaDep;

    // echo "<br/>";

    foreach ($dados_enviados_array['insumoID_InsumoPermuta'] as $chave_permuta_dep => $valor_permuta_dep) {

        //para o insumo que será permutado - sairá do depósito
        $insumoID_InsumoPermuta = $valor_permuta_dep;
        $insumoID_InsumoPermuta = strtok($insumoID_InsumoPermuta, " ");
        echo "<br/> Insumo do deposito: " . $insumoID_InsumoPermuta;

        $quantidadeInsumoDepositoPermuta = $dados_enviados_array['quantidadeInsumoDepositoPermuta'][$chave_permuta_dep];
        echo "<br/> Quantidade permutadas: " . $quantidadeInsumoDepositoPermuta;

        $quantidadeInsumoDisponivelDeposito = $dados_enviados_array['quantidadeInsumoDisponivelDeposito'][$chave_permuta_dep];
        echo "<br/> Quantidade atual no deposito: " . $quantidadeInsumoDisponivelDeposito;

        $validadeInsumoDeposito = $dados_enviados_array['validadeInsumoDeposito'][$chave_permuta_dep];
        echo "<br/> Quantidade atual no deposito: " . $validadeInsumoDeposito;

        $nova_qtd_to_dep = $quantidadeInsumoDisponivelDeposito-$quantidadeInsumoDepositoPermuta;
        echo "<br/> Quantidade nova para o insumo retirado do deposito: " . $nova_qtd_to_dep;


        //para o insumo que será cadastrado
        $insumoID_InsumoCadPermuta = $dados_enviados_array['insumoID_InsumoCadPermuta'][$chave_permuta_dep];
        $insumoID_InsumoCadPermuta = strtok($insumoID_InsumoCadPermuta, " ");
        echo "<br/>ID do Insumo a ser cadastrado no deposito: " . $insumoID_InsumoCadPermuta;

        $validadeInsumoCadPermuta = $dados_enviados_array['validadeInsumoCadPermuta'][$chave_permuta_dep];
        echo "<br/>Validade do insumo a ser cadastrado no deposito: " . $validadeInsumoCadPermuta;

        $quantidadeInsumoCadPermuta = $dados_enviados_array['quantidadeInsumoCadPermuta'][$chave_permuta_dep];
        echo "<br/>Quantidade do insumo a ser cadastrado no deposito: " . $quantidadeInsumoCadPermuta;

        $depositoDestinoInsumoPermuta = $dados_enviados_array['depositoDestinoInsumoPermuta'][$chave_permuta_dep];
        $depositoDestinoInsumoPermuta = strtok($depositoDestinoInsumoPermuta, " ");
        echo "<br/>Depósito de destino: " . $depositoDestinoInsumoPermuta;
        
        // echo '<br/>id do insumo: ' . $insumo_id['deposito_insumos_id'];
        // echo "<br/>Chave para o insumo: $chave_permuta_dep";
        // echo "<br/>Id do insumo no deposito: $depositoID_Insumodispensario";
        // echo "<br/>Id do insumo: $insumo_id";
        // echo "<br/>Quantidade: $quantidadeInsumoDispensario";
        // echo "<br/>Validade: $validadeInsumoDeposito";
        // echo "<br/>Local: $localInsumodispensario";
        // echo "<hr>";

        // $sql_insert = "INSERT INTO dispensario (
        //     dispensario_qtd,
        //     dispensario_validade,
        //     dispensario_deposito_id,
        //     dispensario_local_id,
        //     dispensario_insumos_id,
        //     dispensario_estoques_id)
        //     VALUES(
        //         {$quantidadeInsumoDispensario},
        //         '{$validadeInsumoDeposito}',
        //         {$depositoID_Insumodispensario},
        //         {$localInsumodispensario},
        //         {$insumo_id},
        //         {$depositoDestinoInsumodeposito}
        //     )";

        // if (mysqli_query($conexao, $sql_insert)) { 
        //     echo "<script language='javascript'>window.alert('Insumo inserido no Dispensário com sucesso!!'); </script>";
        //     echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=dispensario_resumo&" . $qualEstoque . "=1';</script>";
        //     // echo "insumo inserido com sucesso";   
        // } else {
        //     die("Erro ao executar a inserção no Dispensário. " . mysqli_error($conexao));   
        // }
    }
} else {
    echo "error";
}


// $tipo_movimentacao = mysqli_real_escape_string($conexao,$_POST["mov_dep_to_disp"]);
// $tipo_movimentacao = strtok($tipo_movimentacao, " ");

// $local_origem = "Depósito";

// $local_destino = "Dispensário " . $qualEstoque[-1];

// $usuario_id = $_SESSION['usuario_id'];

// $insumo_id = $depositoID_Insumodispensario;

// atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id, $insumo_id);

?>