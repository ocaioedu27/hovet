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
$msg_insumo_inserido = "Atualização realizada com sucesso! Insumo: ";
$msg_mov = " Movimentação registrada com sucesso! Insumo: ";
$msg_final = "";

//var_dump($dados_enviados_array);

if (!empty($dados_enviados_array)) {
    $movimentacao_doar_farmacia = mysqli_real_escape_string($conexao,$_POST["doar_farmacia"]);
    $quem_guardou = mysqli_real_escape_string($conexao,$_POST["solicitante_retira_dispensario"]);
    $dataTransferDepToDisp = mysqli_real_escape_string($conexao,$_POST["dataTransferDepToDisp"]);

    foreach ($dados_enviados_array['insumoID_Insumodispensario'] as $chave_cad_dispensario => $valor_cad_dispensario) {

        $id_e_nome_insumo = explode(' - ', $valor_cad_dispensario);
        $id_insumo_farmacia = $id_e_nome_insumo[0];
        $nome_insumo = $id_e_nome_insumo[1];
        $qtd_doada = $dados_enviados_array['quantidadeInsumoDispensario'][$chave_cad_dispensario];

        $querySearchInsumoDep = "SELECT 
                                    farm.qtd,
                                    e.nome as estoque_nome
                                FROM 
                                    farmacia farm
                                INNER JOIN 
                                    estoques e
                                ON
                                    farm.estoque_id = e.id
                                WHERE 
                                    farm.id={$id_insumo_farmacia}";

        try {
            $procura_insumo_farmacia = mysqli_query($conexao, $querySearchInsumoDep) or die('//dispensario/inserir_dispensario/select_id_insumo - erro ao realizar consulta: ' . mysqli_error($conexao));
            //code...
        } catch (\Throwable $th) {
            echo $th;
        }
        $array_insumo_da_farmacia = mysqli_fetch_assoc($procura_insumo_farmacia);
        $qtd_atual_insumos_farm = $array_insumo_da_farmacia['qtd'];
        $estoque_nome = $array_insumo_da_farmacia['estoque_nome'];   
        
        $quantidade_atualizada = $qtd_atual_insumos_farm - $qtd_doada;
        // echo "<hr>";

        $query = "UPDATE farmacia SET qtd={$quantidade_atualizada} WHERE id={$id_insumo_farmacia}";

        //echo "<br>" . $query;

        try {
            //code...
            $inseriu = mysqli_query($conexao, $query);
        } catch (\Throwable $th) {
            echo $th;
        }

        if ($inseriu) { 
            $msg_final .= $msg_insumo_inserido . $nome_insumo;
        } else {
            die("Erro ao executar a inserção no Dispensário. " . mysqli_error($conexao));   
        }

        $tipo_movimentacao = strtok($movimentacao_doar_farmacia, " ");

        echo $tipo_movimentacao;

        $local_destino = "Doação";

        $local_origem = $estoque_nome;

        $usuario_id_nome = $sessionUserID . ' - ' . $userFirstName;

        /* exit; */

        if(atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id_nome, $nome_insumo)){
            $msg_final .= $msg_mov . $nome_insumo;
        }


    }

    echo '<script language="javascript">window.alert("'.$msg_final.'")</script>';
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=farmacia_resumo&" . $qualEstoque . "=1';</script>";


} else {
    echo "error";
}



?>