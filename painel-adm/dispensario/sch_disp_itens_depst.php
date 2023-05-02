<?php
    //retorna dados do deposito para movimentar do deposito para o dispensario

    include_once("../../db/connect.php");

    function retorna($depositoID_Insumodispensario, $conn){
        $resultado_insumoDeposito = "SELECT
                                        d.deposito_qtd,
                                        d.deposito_validade,
                                        i.insumos_descricao,
                                        i.insumos_nome 
                                        FROM deposito d 
                                        INNER JOIN insumos i
                                        ON d.deposito_insumos_id = i.insumos_id
                                        WHERE d.deposito_id={$depositoID_Insumodispensario} LIMIT 1";
        $resultado_insumoDeposito = mysqli_query($conn, $resultado_insumoDeposito) or die("//dispensario/sch_disp_itens_depst/ - Erro: " . mysqli_error($conn));

        $valores_deposito = array();

        $quantidade = $resultado_insumoDeposito->num_rows;

        if ($quantidade != 0) {
            $row_insumoDeposito = mysqli_fetch_assoc($resultado_insumoDeposito);

            $valores_deposito['nomeInsumoDeposito'] = $row_insumoDeposito['insumos_nome'];
            $valores_deposito['quantidadeInsumoDeposito'] = $row_insumoDeposito['deposito_qtd'];
            $valores_deposito['validadeInsumoDeposito'] = $row_insumoDeposito['deposito_validade'];
            $valores_deposito['descricaoInsumoDeposito'] = $row_insumoDeposito['insumos_descricao'];

        } else{
            $valores_deposito['quantidadeInsumoDeposito'] = 'Insumo não encontrado!';
        }
        return json_encode($valores_deposito);
    }
    
    // para cadastrar dados no deposito a partir de informacoes dos insumos cadastrados no sistema
    function retorna_dados_nsumos($cad_deposito_insumos_nome, $conn){
        $sql_insumo = "SELECT
                                insumos_descricao,
                                insumos_nome,
                                insumos_qtd_critica,
                                insumos_id
                                FROM insumos
                                WHERE  
                                insumos_nome LIKE '%{$cad_deposito_insumos_nome}%' LIMIT 10";
        $resultado_insumo = mysqli_query($conn, $sql_insumo) or die("//dispensario/sch_disp_itens_depst/ - Erro: " . mysqli_error($conn));

        $valores_deposito = array();

        $quantidade = $resultado_insumo->num_rows;

        if ($quantidade != 0) {
            while ($row_insumoDeposito = mysqli_fetch_assoc($resultado_insumo)) {
        
                $valores_insumos[] = [
                    
                    'idInsumo' => $row_insumoDeposito['insumos_id'],
                    'nomeInsumo' => $row_insumoDeposito['insumos_nome'],
                    'qtdCriticaInsumo' => $row_insumoDeposito['insumos_qtd_critica'],
                    'descricaoInsumo' => $row_insumoDeposito['insumos_descricao']
                ];
        
            }

            $retorna_valores = ['erro' => false, 'dados_insumos' => $valores_insumos];
            // $retorna_valores = ['erro' => true, 'msg_error_insumos' => 'Erro: nenhum insumo encontrado'];

        } else{
            $retorna_valores = ['erro' => true, 'msg_error_insumos' => 'Insumo não encontrado'];
        }
        return json_encode($retorna_valores);
    }

    // para cadastrar insumos no dispensario a partir de dados do deposito
    $depositoID_Insumodispensario = $_GET['depositoID_Insumodispensario'];

    if(isset($depositoID_Insumodispensario)){
        echo retorna($depositoID_Insumodispensario, $conexao);
    }

    // para cadastrar dados no deposito a partir de informacoes dos insumos cadastrados no sistema
    $cad_deposito_insumos_nome = $_GET['cad_deposito_insumos_nome'];

    if(isset($cad_deposito_insumos_nome)){
        echo retorna_dados_nsumos($cad_deposito_insumos_nome, $conexao);
    }
?>