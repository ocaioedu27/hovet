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
$msg_insumo_inserido = "Cadastro realizado com sucesso! Insumo: ";
$msg_insumo_atualizado = "Quantidade de insumo atualizada com sucesso! Insumo: ";
$msg_permuta = "Permuta registrada com sucesso!";
$msg_mov = "Movimentação registrada com sucesso!";
$msg_final = "";

// var_dump($dados_enviados_array);

if (!empty($dados_enviados_array['btnPermutaInsumoDeposito'])) {

    $movimentacao_permuta_deposito = mysqli_real_escape_string($conexao,$_POST["movimentacao_permuta_deposito"]);
    $movimentacao_permuta_deposito = strtok($movimentacao_permuta_deposito, " ");
    // echo "<br/> tipo de movimentação: " . $movimentacao_permuta_deposito;

    $quemRealizouPermutaDep_completo = mysqli_real_escape_string($conexao,$_POST["quemRealizouPermutaDep"]);
    $quemRealizouPermutaDep = strtok($quemRealizouPermutaDep_completo, " ");
    // echo "<br/> quem realizou: " . $quemRealizouPermutaDep;

    $dataTransferPermutaDep = mysqli_real_escape_string($conexao,$_POST["dataTransferPermutaDep"]);
    // echo "<br/> Data da transferência: " . $dataTransferPermutaDep;
    // echo "<br/>";

    $instituicaoPermutaDep = mysqli_real_escape_string($conexao,$_POST["instituicaoPermutaDep"]);
    $instituicaoPermutaDep = strtok($instituicaoPermutaDep, " ");
    // echo "<br/> Instituicao: " . $instituicaoPermutaDep;

    // echo "<br/>";
    $oid_operacao = uniqid();
    $origem_operacao = "Permuta";

    foreach ($dados_enviados_array['insumoID_InsumoPermuta'] as $chave_permuta_dep => $valor_permuta_dep) {

        //para o insumo que será permutado - sairá do depósito
        $insumoID_InsumoPermuta_insumo_removido = $valor_permuta_dep;
        $insumoID_InsumoPermuta = strtok($insumoID_InsumoPermuta_insumo_removido, " ");
        $partestmp = explode( " - ", $insumoID_InsumoPermuta_insumo_removido);
        $insumo_nome_atualizado = $partestmp[1];

        // echo "<br/> Insumo do deposito: " . $insumoID_InsumoPermuta;

        $quantidadeInsumoDepositoPermuta = $dados_enviados_array['quantidadeInsumoDepositoPermuta'][$chave_permuta_dep];
        // echo "<br/> Quantidade permutadas: " . $quantidadeInsumoDepositoPermuta;

        $quantidadeInsumoDisponivelDeposito = $dados_enviados_array['quantidadeInsumoDisponivelDeposito'][$chave_permuta_dep];
        // echo "<br/> Quantidade atual no deposito: " . $quantidadeInsumoDisponivelDeposito;

        $validadeInsumoDeposito = $dados_enviados_array['validadeInsumoDeposito'][$chave_permuta_dep];
        // echo "<br/> Quantidade atual no deposito: " . $validadeInsumoDeposito;

        $depositoRetiradaPermuta = $dados_enviados_array['depositoRetiradaPermuta'][$chave_permuta_dep];
        $depositoRetiradaPermuta = strtok($depositoRetiradaPermuta, " ");
        // echo "<br/> Depósito de origem: " . $depositoRetiradaPermuta;

        $nova_qtd_to_dep = $quantidadeInsumoDisponivelDeposito-$quantidadeInsumoDepositoPermuta;
        // echo "<br/> Quantidade nova para o insumo retirado do deposito: " . $nova_qtd_to_dep;


        //para o insumo que será cadastrado
        $insumoID_InsumoCadPermuta_completo = $dados_enviados_array['insumoID_InsumoCadPermuta'][$chave_permuta_dep];
        $insumoID_InsumoCadPermuta = strtok($insumoID_InsumoCadPermuta_completo, " ");
        $partes = explode( " - ", $insumoID_InsumoCadPermuta_completo);
        $insumo_nome_cadastrado = $partes[1];
        // echo "<br/>ID do Insumo a ser cadastrado no deposito: " . $insumoID_InsumoCadPermuta;

        $validadeInsumoCadPermuta = $dados_enviados_array['validadeInsumoCadPermuta'][$chave_permuta_dep];
        // echo "<br/>Validade do insumo a ser cadastrado no deposito: " . $validadeInsumoCadPermuta;

        $quantidadeInsumoCadPermuta = $dados_enviados_array['quantidadeInsumoCadPermuta'][$chave_permuta_dep];
        // echo "<br/>Quantidade do insumo a ser cadastrado no deposito: " . $quantidadeInsumoCadPermuta;

        $depositoDestinoInsumoPermuta = $dados_enviados_array['depositoDestinoInsumoPermuta'][$chave_permuta_dep];
        $depositoDestinoInsumoPermuta = strtok($depositoDestinoInsumoPermuta, " ");
        // echo "<br/>Depósito de destino: " . $depositoDestinoInsumoPermuta;


        $sql_update_dep = "UPDATE 
                                deposito 
                            SET 
                                qtd = {$nova_qtd_to_dep}
                            WHERE 
                                id = {$insumoID_InsumoPermuta}";

        $fezUpdate = mysqli_query($conexao, $sql_update_dep);
        if ($fezUpdate) { 
            $msg_final .= '\n\n' . $msg_insumo_atualizado . $insumo_nome_atualizado;
        } else {
            die("//deposito/insere_dep - Erro ao executar a inserção no Depósito. " . mysqli_error($conexao));   
        }

        $sql_insert_dep = "INSERT INTO deposito (
            qtd,
            validade,
            origem_item,
            id_origem,
            insumos_id,
            estoque_id
            )
            VALUES(
                {$quantidadeInsumoCadPermuta},
                '{$validadeInsumoCadPermuta}',
                '{$origem_operacao}',
                '{$oid_operacao}',
                {$insumoID_InsumoCadPermuta},
                {$depositoDestinoInsumoPermuta}
            )";

        $inserirDep = mysqli_query($conexao, $sql_insert_dep);
        if ($inserirDep) { 
            $id_insumo_inserido = mysqli_insert_id($conexao);
            $msg_final .= '\n' . $msg_insumo_inserido . $insumo_nome_cadastrado;
            // echo "insumo inserido com sucesso";   
        } else {
            die("//deposito/insere_dep - Erro ao executar a inserção no Depósito. " . mysqli_error($conexao));   
        }

        $dep_id = $dadosGetId['deposito_id'];

        $sql_insert_permuta = "INSERT INTO permutas (
            usuario_id,
            deposito_id_cadastrado,
            deposito_id_removido,
            qtd_retirado,
            qtd_cadastrado,
            oid_operacao,
            fornecedor_id,
            tipos_movimentacoes_id
            )
            VALUES(
                {$quemRealizouPermutaDep},
                {$id_insumo_inserido},
                {$insumoID_InsumoPermuta},
                {$quantidadeInsumoDepositoPermuta},
                {$quantidadeInsumoCadPermuta},
                '{$oid_operacao}',
                {$instituicaoPermutaDep},
                {$movimentacao_permuta_deposito}
            )";

        // echo "<br>" . $sql_insert_permuta;
        
        try {
            $inserir = mysqli_query($conexao, $sql_insert_permuta);
            $msg_final .= '\n' . $msg_permuta;
            
        } catch (\Throwable $th) {
            //throw $th;
            echo "<br> $th";
            die("Erro ao cadastrar na tabela de permutas. " . mysqli_error($conexao)); 
        }


        $tipo_movimentacao = $movimentacao_permuta_deposito;

        $local_origem = $origem_operacao;

        $local_destino = "Depósito " . $qualEstoque[-1];

        $usuario_id_nome = $sessionUserID . ' - ' . $userFirstName;

        if(atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id_nome, $insumo_nome_atualizado)){
            $msg_final .= '\n' . $msg_mov;
        }

    }

    echo "<script language='javascript'>window.alert('". $msg_final ."!'); </script>"; 
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=deposito_resumo&" . $qualEstoque . "=1';</script>";
    
} else {
    echo "error";
}



?>