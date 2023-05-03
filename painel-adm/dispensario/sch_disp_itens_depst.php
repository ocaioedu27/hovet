<?php
    //retorna dados do deposito para movimentar do deposito para o dispensario

    include_once("../../db/connect.php");

    function retornaDadosDeposito($cad_disp_insumos_nome, $conn){
        $resultado_insumoDeposito = "SELECT
                                        d.deposito_id,
                                        d.deposito_qtd,
                                        d.deposito_validade,
                                        d.deposito_insumos_id,
                                        i.insumos_descricao,
                                        i.insumos_nome
                                        FROM deposito d 
                                        INNER JOIN insumos i
                                        ON d.deposito_insumos_id = i.insumos_id
                                        WHERE i.insumos_nome LIKE '%{$cad_disp_insumos_nome}%' LIMIT 10";
        $resultado_insumoDeposito = mysqli_query($conn, $resultado_insumoDeposito) or die("//dispensario/sch_disp_itens_depst/ - Erro: " . mysqli_error($conn));

        $valores_deposito = array();

        $quantidade = $resultado_insumoDeposito->num_rows;

        if ($quantidade != 0) {
            while ($row_insumoDeposito = mysqli_fetch_assoc($resultado_insumoDeposito)) {
        
                $valores_deposito[] = [
                    
                    'idInsumoDeposito' => $row_insumoDeposito['deposito_id'],
                    'nomeInsumoDeposito' => $row_insumoDeposito['insumos_nome'],
                    'quantidadeInsumoDeposito' => $row_insumoDeposito['deposito_qtd'],
                    'validadeInsumoDeposito' => $row_insumoDeposito['deposito_validade'],
                    'descricaoInsumoDeposito' => $row_insumoDeposito['insumos_descricao']
                ];
        
            }

            $retorna_valores = ['erro' => false, 'dados_insumos_deposito' => $valores_deposito];
            // $retorna_valores = ['erro' => true, 'msg_error_insumos' => 'Erro: nenhum insumo encontrado'];

        } else{
            $retorna_valores = ['erro' => true, 'msg_error_insumos_dep' => 'Insumo não encontrado'];
        }
        return json_encode($retorna_valores);
    }
    
    // para cadastrar dados no deposito a partir de informacoes dos insumos cadastrados no sistema
    function retorna_dados_insumos($cad_deposito_insumos_nome, $conn){
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
    $cad_disp_insumos_nome = $_GET['cad_disp_insumos_nome'];

    if(isset($cad_disp_insumos_nome)){
        echo retornaDadosDeposito($cad_disp_insumos_nome, $conexao);
    }

    // para cadastrar dados no deposito a partir de informacoes dos insumos cadastrados no sistema
    $cad_deposito_insumos_nome = $_GET['cad_deposito_insumos_nome'];

    if(isset($cad_deposito_insumos_nome)){
        echo retorna_dados_insumos($cad_deposito_insumos_nome, $conexao);
    }
?>