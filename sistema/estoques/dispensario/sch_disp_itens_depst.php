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
            $retorna_valores = ['erro' => true, 'msg_error_insumos' => 'Insumo não encontrado'];
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

    function retorna_permissoes($valor_to_search,$userId, $conn){
        

        // echo "<br>" . $valor_to_search;
        // echo "<br>" . $userId;
        $retorna_valores = array();
        
        $sql = "SELECT
                    p.permissoes_id
                FROM 
                    usuarios_has_permissoes uhp
                INNER JOIN
                    usuarios u
                ON 
                    u.usuario_id = uhp.uhp_usuario_id

                INNER JOIN
                    permissoes_usuario p
                ON
                    p.permissoes_id = uhp.uhp_permissoes_id 
                
                WHERE
                    u.usuario_id  = {$userId}";

        $result_user_perm = mysqli_query($conn, $sql) or die("//estoques/dispensario/sch_disp_itens_depst/sql_pesquisa_permissoes_user - Erro: " . mysqli_error($conn));

        // $list_permissoes_user = array();

        $quantidade = $result_user_perm->num_rows;

        // echo "<br> qtd linhas " . $quantidade;

        if ($quantidade != 0) {
            $string_filter = "";

            while ($dados_tmp = mysqli_fetch_assoc($result_user_perm)) {

                $permissao_user = $dados_tmp['permissoes_id'];
                // array_push($list_permissoes_user, $permissao_user);
                $string_filter .= " permissoes_id != $permissao_user and";
        
            }

            $string_filter = substr($string_filter, 0, -4);

            // echo "<br>Filtro: " . $string_filter;
        
            //Pesquisa pelas permissoes que o usuário não possui
            $sql_permissoes_gerais = "SELECT 
                                        p.permissoes_id,
                                        p.permissoes_nome,
                                        cp.cp_nome 
                                    FROM 
                                        permissoes_usuario p
                                    
                                    INNER JOIN
                                        categorias_permissoes cp
                                    ON
                                        p.permissoes_ctg_perm_id = cp.cp_id 

                                    WHERE 
                                        $string_filter and permissoes_nome LIKE '%{$valor_to_search}%'

                                    LIMIT 10";

            $restult_no_permissions_user = mysqli_query($conn, $sql_permissoes_gerais) or die("//estoques/dispensario/sch_disp_itens_depst/Pesquisa_Permissoes_que_user_nao_tem - Erro: " . mysqli_error($conn));

            // echo "teste";



            $quantidade_permissoes_que_nao_possui = $restult_no_permissions_user->num_rows;

            if ($quantidade_permissoes_que_nao_possui != 0) {

                while ($row_permissoes = mysqli_fetch_assoc($restult_no_permissions_user)) {
            
                    $valores_permissoes[] = [
                        
                        'permissoesId' => $row_permissoes['permissoes_id'],
                        'permissoesNome' => $row_permissoes['permissoes_nome'],
                        'nomeCategoriaPermissao' => $row_permissoes['cp_nome']
                    ];
            
                }

                $retorna_valores = ['erro' => false, 'dados_permissoes' => $valores_permissoes];

            } else{

                $retorna_valores = ['erro' => true, 'msg_error_permissoes' => 'Permissão não encontrada! Ou já concedida'];
            }
            
        }
        // var_dump($retorna_valores);

        return json_encode($retorna_valores);
    }

    function retorna_movimentacoes($value_to_compare, $conn){

        $sql = "SELECT 
                    tipos_movimentacoes_id,
                    tipos_movimentacoes_movimentacao,
                    tipos_movimentacoes_descricao
                FROM
                    tipos_movimentacoes
                WHERE 
                    tipos_movimentacoes_movimentacao LIKE '%{$value_to_compare}%'";

        $result = mysqli_query($conn, $sql) or die("//dispensario/sch_disp_itens/ - Erro: " . mysqli_error($conn));

        $valores = array();

        $quantidade = $result->num_rows;

        if ($quantidade != 0) {
            while ($array_row = mysqli_fetch_assoc($result)) {
        
                $valores[] = [
                    
                    'id_mov' => $array_row['tipos_movimentacoes_id'],
                    'nome_mov' => $array_row['tipos_movimentacoes_movimentacao'],
                    'desc_mov' => $array_row['tipos_movimentacoes_descricao']
                ];
        
            }

            $values_array_return = ['erro' => false, 'dados' => $valores];

        } else{
            $values_array_return = ['erro' => true, 'msg_erro' => 'Nada foi encontrado'];
        }
        return json_encode($values_array_return);
    }

    function retorna_categoria_fornecedor($valor_to_search, $conn){
        $sql = "SELECT 
                            * 
                        FROM 
                            categorias_fornecedores
                        WHERE  
                            cf_categoria LIKE '%{$valor_to_search}%' LIMIT 10";

        $resultado = mysqli_query($conn, $sql) or die("//estoques/dispensario/sch_disp_itens_depst/sql_pesquisa - Erro: " . mysqli_error($conn));

        // $valores_categorias = array();

        $quantidade = $resultado->num_rows;

        if ($quantidade != 0) {
            while ($row_categorias = mysqli_fetch_assoc($resultado)) {
        
                $valores_categorias[] = [
                    
                    'categoriaId' => $row_categorias['cf_id'],
                    'categoria_nome' => $row_categorias['cf_categoria'],
                    'categoria_desc' => $row_categorias['cf_descricao']
                ];
        
            }

            $retorna_valores = ['erro' => false, 'dados_categorias' => $valores_categorias];

        } else{
            $retorna_valores = ['erro' => true, 'msg_error_categorias' => 'Categoria não encontrada'];
        }
        return json_encode($retorna_valores);
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

    // Para procurar por permissoes
    $stringList = array();

    if ( isset( $_GET['dados_permissoes'] ) && ! empty( $_GET['dados_permissoes'] )) {
        // Cria variáveis dinamicamente
        // $contador = 0;
        foreach ( $_GET as $chave => $valor ) {
            $valor_tmp = $chave;
            $position = strpos($valor_tmp, "menuop");
            $valor_est = strstr($valor_tmp,$position);
            array_push($stringList, $valor_est);

        }
        // var_dump($stringList);

        $valor_permissao_tmp = $stringList[0];
        $valor_permissao = $_GET[$valor_permissao_tmp];

        $usuarioID_tmp = $stringList[1];
        $usuarioID = $_GET[$usuarioID_tmp];

        echo retorna_permissoes($valor_permissao, $usuarioID, $conexao);

    }

    // Para procurar por tipos de movimentações
    $valor_movimentacoes = $_GET['valor_movimentacoes'];

    if(isset($valor_movimentacoes)){

        echo retorna_movimentacoes($valor_movimentacoes, $conexao);
    }

    // Para procurar por categorias
    $cad_cateogia_fornecedor = $_GET['cad_cateogia_fornecedor'];

    if(isset($cad_cateogia_fornecedor)){

        echo retorna_categoria_fornecedor($cad_cateogia_fornecedor, $conexao);
    }
?>