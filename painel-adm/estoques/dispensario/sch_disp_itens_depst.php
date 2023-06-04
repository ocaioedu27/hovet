<?php
    //retorna dados do deposito para movimentar do deposito para o dispensario

    include_once("../../../db/connect.php");

    function retornaDadosDeposito($cad_disp_insumos_nome, $conn){
        $resultado_insumoDeposito = "SELECT
                                        d.deposito_id,
                                        d.deposito_qtd,
                                        d.deposito_validade,
                                        d.deposito_insumos_id,
                                        i.insumos_descricao,
                                        i.insumos_nome,
                                        es.estoques_nome,
                                        es.estoques_id
                                        FROM deposito d 
                                        INNER JOIN insumos i
                                        ON d.deposito_insumos_id = i.insumos_id
                                        INNER JOIN estoques es
                                        ON d.deposito_estoque_id = es.estoques_id
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
                    'descricaoInsumoDeposito' => $row_insumoDeposito['insumos_descricao'],
                    'depositoOrigemId' => $row_insumoDeposito['estoques_id'],
                    'depositoOrigemNome' => $row_insumoDeposito['estoques_nome']
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

    function retorna_dados_estoques($cad_deposito_estoque_nome, $conn){
        $sql_insumo = "SELECT * FROM estoques
                                WHERE  
                                estoques_nome LIKE '%{$cad_deposito_estoque_nome}%' LIMIT 10";
        $resultado_estoques = mysqli_query($conn, $sql_insumo) or die("//estoques/dispensario/sch_disp_itens_depst/ - Erro: " . mysqli_error($conn));

        $valores_estoques = array();

        $quantidade = $resultado_estoques->num_rows;

        if ($quantidade != 0) {
            while ($row_estoques = mysqli_fetch_assoc($resultado_estoques)) {
        
                $valores_estoques[] = [
                    
                    'estoqueId' => $row_estoques['estoques_id'],
                    'estoqueNome' => $row_estoques['estoques_nome']
                ];
        
            }

            $retorna_valores = ['erro' => false, 'dados_estoques' => $valores_estoques];
            // $retorna_valores = ['erro' => true, 'msg_error_insumos' => 'Erro: nenhum insumo encontrado'];

        } else{
            $retorna_valores = ['erro' => true, 'msg_error_estoques' => 'Estoque não cadastrado'];
        }
        return json_encode($retorna_valores);
    }

    function retorna_categoria($valor_to_search, $conn){
        $sql_insumo = "SELECT 
                            * 
                        FROM 
                            tipos_insumos
                        WHERE  
                            tipos_insumos_tipo LIKE '%{$valor_to_search}%' LIMIT 10";

        $resultado = mysqli_query($conn, $sql_insumo) or die("//estoques/dispensario/sch_disp_itens_depst/sql_pesquisa - Erro: " . mysqli_error($conn));

        // $valores_categorias = array();

        $quantidade = $resultado->num_rows;

        if ($quantidade != 0) {
            while ($row_categorias = mysqli_fetch_assoc($resultado)) {
        
                $valores_categorias[] = [
                    
                    'categoriaId' => $row_categorias['tipos_insumos_id'],
                    'categoria_nome' => $row_categorias['tipos_insumos_tipo'],
                    'categoria_desc' => $row_categorias['tipos_insumos_descricao']
                ];
        
            }

            $retorna_valores = ['erro' => false, 'dados_categorias' => $valores_categorias];

        } else{
            $retorna_valores = ['erro' => true, 'msg_error_categorias' => 'Categoria não encontrada'];
        }
        return json_encode($retorna_valores);
    }


    function retornInsumosDisp($insumos_nome, $conn){

        $resultado_insumo_dispensario = "SELECT
                                            d.dispensario_id,
                                            d.dispensario_qtd,
                                            d.dispensario_validade,
                                            i.insumos_descricao,
                                            i.insumos_nome
                                            FROM dispensario d 
                                            INNER JOIN insumos i
                                            ON d.dispensario_insumos_id = i.insumos_id
                                            WHERE i.insumos_nome LIKE '%{$insumos_nome}%' LIMIT 10";
        $resultado_insumo_dispensario = mysqli_query($conn, $resultado_insumo_dispensario) or die("//dispensario/sch_disp_itens/ - Erro: " . mysqli_error($conn));

        $valores_insumos_disp = array();

        $quantidade = $resultado_insumo_dispensario->num_rows;

        if ($quantidade != 0) {
            while ($row_insumoDeposito = mysqli_fetch_assoc($resultado_insumo_dispensario)) {
        
                $valores_insumos_disp[] = [
                    
                    'idInsumoDisp' => $row_insumoDeposito['dispensario_id'],
                    'nomeInsumoDisp' => $row_insumoDeposito['insumos_nome'],
                    'qtdDisponivelInsumoDisp' => $row_insumoDeposito['dispensario_qtd'],
                    'validadeInsumoDisp' => $row_insumoDeposito['dispensario_validade'],
                    'descricaoInsumoDisp' => $row_insumoDeposito['insumos_descricao']
                ];
        
            }

            $retorna_valores_disp = ['erro' => false, 'dados_insumos_disp' => $valores_insumos_disp];
            // $retorna_valores = ['erro' => true, 'msg_error_insumos' => 'Erro: nenhum insumo encontrado'];

        } else{
            $retorna_valores_disp = ['erro' => true, 'msg_error_insumos_disp' => 'Insumo não encontrado'];
        }
        return json_encode($retorna_valores_disp);
    }

    function findKeyWord($texto,$palavra){

        if(preg_match("%\b{$palavra}\b%",$texto)){
            return true;
        } else {
            return false;
        }
    }

    // para solicitar insumos no dispensario a partir de dados lá cadastrados
    $request_disp_insumos_nome = $_GET['request_disp_insumos_nome'];

    if(isset($request_disp_insumos_nome)){
        echo retornInsumosDisp($request_disp_insumos_nome, $conexao);
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

    // para retornar dados da tabela de estoques no momento do cadastro de insumos no deposito
    $cad_deposito_estoque_nome = $_GET['cad_deposito_estoque_nome'];

    if(isset($cad_deposito_estoque_nome)){

        echo retorna_dados_estoques($cad_deposito_estoque_nome, $conexao);
    }

    // Para procurar por categorias
    $cad_cateogia_insumo = $_GET['cad_cateogia_insumo'];

    if(isset($cad_cateogia_insumo)){

        echo retorna_categoria($cad_cateogia_insumo, $conexao);
    }
?>