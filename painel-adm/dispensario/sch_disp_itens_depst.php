<?php

    include_once("../../db/connect.php");

    function retorna($depositoID_Insumodispensario, $conn){
        $resultado_insumoDeposito = "SELECT deposito_qtd, deposito_validade FROM deposito WHERE deposito_id = {$depositoID_Insumodispensario} LIMIT 1";
        $resultado_insumoDeposito = mysqli_query($conn, $resultado_insumoDeposito) or die("//dispensario/sch_disp_itens_depst/ - Erro: " . mysqli_error($conn));

        $valores_deposito = array();

        $quantidade = $resultado_insumoDeposito->num_rows;

        if ($quantidade != 0) {
            $row_insumoDeposito = mysqli_fetch_assoc($resultado_insumoDeposito);

            $valores_deposito['quantidadeInsumoDeposito'] = $row_insumoDeposito['deposito_qtd'];
            $valores_deposito['validadeInsumoDeposito'] = $row_insumoDeposito['deposito_validade'];

        } else{
            $valores_deposito['quantidadeInsumoDeposito'] = 'Insumo não encontrado!';
        }
        return json_encode($valores_deposito);
    }

    $depositoID_Insumodispensario = $_GET['depositoID_Insumodispensario'];

    if(isset($depositoID_Insumodispensario)){
        echo retorna($depositoID_Insumodispensario, $conexao);
    }
?>