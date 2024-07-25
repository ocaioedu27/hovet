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
$msg_mov = " Movimentação registrada com sucesso! Insumo: ";
$msg_final = "";

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

        $id_insumo_dep_to_disp = $valor_cad_dispensario;
        $id_insumo_dep_to_disp = strtok($id_insumo_dep_to_disp, " ");
        // echo "<br/>Id do insumo no deposito: $id_insumo_dep_to_disp";
        $quantidadeInsumoDispensario = $dados_enviados_array['quantidadeInsumoDispensario'][$chave_cad_dispensario];
        $validadeInsumoDeposito = $dados_enviados_array['validadeInsumoDeposito'][$chave_cad_dispensario];
        $localInsumodispensario = $dados_enviados_array['localInsumodispensario'][$chave_cad_dispensario];
        $localInsumodispensario = strtok($localInsumodispensario, " ");
        $dispensarioDestino_completo = $dados_enviados_array['dispensarioDestino'][$chave_cad_dispensario];
        $dispensarioDestino = strtok($dispensarioDestino_completo, " ");
        // echo "<br> Dispensario de destino" . $dispensarioDestino;

        $querySearchInsumoDep = "SELECT 
                                    d.insumos_id as dep_insumo_id,
                                    i.nome as insumo_nome,
                                    i.id as insumo_id,
                                    e.nome as estoque_nome
                                FROM 
                                    deposito d
                                INNER JOIN 
                                    estoques e
                                ON
                                    d.estoque_id = e.id
                                INNER JOIN 
                                    insumos i
                                ON
                                    d.insumos_id = i.id
                                WHERE 
                                    d.id={$id_insumo_dep_to_disp}";

        try {
            $procura_id_insumo_dep = mysqli_query($conexao, $querySearchInsumoDep) or die('//dispensario/inserir_dispensario/select_id_insumo - erro ao realizar consulta: ' . mysqli_error($conexao));
            //code...
        } catch (\Throwable $th) {
            echo $th;
        }
        $array_insumo_id = mysqli_fetch_assoc($procura_id_insumo_dep);
        $dep_insumo_id = $array_insumo_id['dep_insumo_id'];
        $insumo_nome = $array_insumo_id['insumo_nome'];
        $estoque_nome = $array_insumo_id['estoque_nome'];
        $insumo_id = $array_insumo_id['insumo_id'];
        
        // echo "<hr>";

        $sql_insert = "INSERT INTO dispensario (
            qtd,
            validade,
            deposito_id,
            local_id,
            insumos_id,
            estoque_id)
            VALUES(
                {$quantidadeInsumoDispensario},
                '{$validadeInsumoDeposito}',
                {$id_insumo_dep_to_disp},
                {$localInsumodispensario},
                {$insumo_id},
                {$dispensarioDestino}
            )";

        try {
            //code...
            $inseriu = mysqli_query($conexao, $sql_insert);
        } catch (\Throwable $th) {
            echo $th;
        }
        if ($inseriu) { 
            $msg_final .= $msg_insumo_inserido . $insumo_nome;
        } else {
            die("Erro ao executar a inserção no Dispensário. " . mysqli_error($conexao));   
        }

        $tipo_movimentacao = mysqli_real_escape_string($conexao,$_POST["mov_dep_to_disp"]);
        $tipo_movimentacao = strtok($tipo_movimentacao, " ");

        $partes = explode(' - ', $dispensarioDestino_completo);

        $local_destino = $partes[1];

        $local_origem = $estoque_nome;


        $usuario_id_nome = $sessionUserID . ' - ' . $userFirstName;

        if(atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id_nome, $insumo_nome)){
            $msg_final .= $msg_mov . $insumo_nome;
        }

    }

    echo '<script language="javascript">window.alert("'.$msg_final.'")</script>';
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=dispensario_resumo&" . $qualEstoque . "=1';</script>";


} else {
    echo "error";
}



?>