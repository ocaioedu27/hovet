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
    $oid_operacao = uniqid();
    $origem_operacao = "Permuta";

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

        $depositoRetiradaPermuta = $dados_enviados_array['depositoRetiradaPermuta'][$chave_permuta_dep];
        $depositoRetiradaPermuta = strtok($depositoRetiradaPermuta, " ");
        echo "<br/> Depósito de origem: " . $depositoRetiradaPermuta;

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

        $sql_insert_permuta = "INSERT INTO permutas (
            permutas_operador,
            permutas_deposito_id,
            permutas_qtd_retirado,
            permutas_oid_operacao,
            permutas_instituicao_id,
            permutas_validade_retirado,
            permutas_estoques_id_retirado,
            permutas_insumos_id_cadastrado,
            permutas_insumos_validade_cadastrado,
            permutas_insumos_qtd_cadastrado,
            permutas_estoques_id_cadastrado
            )
            VALUES(
                {$quemRealizouPermutaDep},
                {$insumoID_InsumoPermuta},
                {$quantidadeInsumoDepositoPermuta},
                '{$oid_operacao}',
                {$instituicaoPermutaDep},
                '{$validadeInsumoDeposito}',
                {$depositoRetiradaPermuta},
                {$insumoID_InsumoCadPermuta},
                '{$validadeInsumoCadPermuta}',
                {$quantidadeInsumoCadPermuta},
                {$depositoDestinoInsumoPermuta}
            )";

        if (mysqli_query($conexao, $sql_insert_permuta)) { 
            echo "<script language='javascript'>window.alert('Permuta registrada com sucesso!!'); </script>";  
        } else {
            die("Erro ao executar a inserção no Dispensário. " . mysqli_error($conexao));   
        }

        $sql_update_dep = "UPDATE 
                            deposito 
                            SET 
                            deposito_qtd = {$nova_qtd_to_dep}
                            WHERE 
                            deposito_id = {$insumoID_InsumoPermuta}";

        if (mysqli_query($conexao, $sql_update_dep)) { 
            echo "<script language='javascript'>window.alert('Insumo Cadastrado no Depósito com sucesso!!'); </script>";
        } else {
            die("//deposito/insere_dep - Erro ao executar a inserção no Depósito. " . mysqli_error($conexao));   
        }

        $sql_insert_dep = "INSERT INTO deposito (
            deposito_qtd,
            deposito_validade,
            deposito_origem_item,
            deposito_id_origem,
            deposito_insumos_id,
            deposito_estoque_id
            )
            VALUES(
                {$quantidadeInsumoCadPermuta},
                '{$validadeInsumoCadPermuta}',
                '{$origem_operacao}',
                '{$oid_operacao}',
                {$insumoID_InsumoCadPermuta},
                {$depositoDestinoInsumoPermuta}
            )";

        if (mysqli_query($conexao, $sql_insert_dep)) { 
            echo "<script language='javascript'>window.alert('Insumo Cadastrado no Depósito com sucesso!!'); </script>";
            echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=deposito_resumo&" . $qualEstoque . "=1';</script>";
            // echo "insumo inserido com sucesso";   
        } else {
            die("//deposito/insere_dep - Erro ao executar a inserção no Depósito. " . mysqli_error($conexao));   
        }

        $tipo_movimentacao = $movimentacao_permuta_deposito;

        $local_origem = $origem_operacao;

        $local_destino = "Depósito " . $qualEstoque[-1];

        $usuario_id = $quemRealizouPermutaDep;

        $insumo_id = $insumoID_InsumoPermuta;
        
        atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id, $insumo_id);
    }
} else {
    echo "error";
}



?>