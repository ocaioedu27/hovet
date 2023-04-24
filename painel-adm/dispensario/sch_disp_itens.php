<?php

    include_once("../../db/connect.php");

    function retorna($dispensario_id, $conn){
        $resultado_insumo_dispensario = "SELECT dispensario_qtd FROM dispensario WHERE dispensario_id = {$dispensario_id} LIMIT 1";
        $resultado_insumo_dispensario = mysqli_query($conn, $resultado_insumo_dispensario) or die("//dispensario/sch_disp_itens/ - Erro: " . mysqli_error($conn));

        $valores_dispensario = array();

        $quantidade = $resultado_insumo_dispensario->num_rows;

        if ($quantidade != 0) {
            $row_insumoDeposito = mysqli_fetch_assoc($resultado_insumo_dispensario);

            $valores_dispensario['quantidade_atual_dispensario'] = $row_insumoDeposito['dispensario_qtd'];

        } else{
            $valores_dispensario['quantidade_atual_dispensario'] = 'Insumo não encontrado!';
        }
        return json_encode($valores_dispensario);
    }

    $dispensario_id = $_GET['dispensario_id'];

    if(isset($dispensario_id)){
        echo retorna($dispensario_id, $conexao);
    }
?>