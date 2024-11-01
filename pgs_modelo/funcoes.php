<?php 

function retiraAcentos($string){
    $caracteres_sem_acento = array(
        'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Â'=>'Z', 'Â'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
        'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
        'Ï'=>'I', 'Ñ'=>'N', 'Å'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
        'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
        'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
        'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'Å'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
        'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
        'Ä'=>'a', 'î'=>'i', 'â'=>'a', 'È'=>'s', 'È'=>'t', 'Ä'=>'A', 'Î'=>'I', 'Â'=>'A', 'È'=>'S', 'È'=>'T',
    );
    
    $nova_string = strtr($string, $caracteres_sem_acento);
    $nova_string = strtolower($nova_string);
    
    return $nova_string;
    
}

function atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id_nome, $insumo_nome){

    $sql_identifica_movimentacao = "INSERT 
                                        INTO historico_movimentacoes 
                                            (origem,destino,tipos_movimentacoes_id,usuario_id_nome,insumo_nome)
                                        VALUES 
                                            ('{$local_origem}','{$local_destino}',{$tipo_movimentacao},'{$usuario_id_nome}','{$insumo_nome}')";
    

    try {
        $inseriu = mysqli_query($conexao, $sql_identifica_movimentacao);
    } catch (\Throwable $th) {
        echo "//cadMovimentacao - error: " . $th;
    }
    
    if ($inseriu) { 
        // echo "<script language='javascript'>window.alert('Movimentação registrada com sucesso!!'); </script>";
        return true;
    } else {
        die("Erro ao executar a atualização da movimentação. " . mysqli_error($conexao));
        return false;
    }

}

function getVencidosEstoques($conexao,$estoquePreferencia, $data_referencia, $intervalo_dias){
    $arrValores = [];

    $sql= "SELECT 
            d.id, 
            d.qtd,
            date_format(d.validade, '%d/%m/%Y') as validade,
            i.nome,
            i.unidade,
            datediff(d.validade, curdate()) as diasvencimento,
            es.nome as estoques_nome
        FROM 
            ". $estoquePreferencia ." d 
        INNER JOIN 
            insumos i 
        ON
            d.insumos_id = i.id
        INNER JOIN 
            estoques es
        ON
            es.id = d.estoque_id
        WHERE 
            d.validade<='{$data_referencia}' + interval {$intervalo_dias} day ORDER BY i.nome ASC";
        
    // echo '<br><br>' . $sql;
    try {
        $result = $conexao->query($sql);
        if ($result->num_rows > 0){
            for ($j=0; $j < $result->num_rows; $j++) {
                $dados_tmp = $result->fetch_assoc();
                array_push($arrValores, $dados_tmp);
            }
        }    
    } catch (\Throwable $th) {
        echo "//funcoes/getVencidosEstoques - erro ao realizar a coleta de dados: " . $th;
        die($conexao);
    }

    return $arrValores;
}

function getCriticosEstoques($conexao,$estoquePreferencia, $where = null){
    $arrValores = [];
    $where = strlen($where)>0 ? " WHERE " . $where : "";

    $sql= "SELECT 
                distinct i.nome,
                i.id,
                i.descricao,
                i.qtd_critica, 
                d.estoque_id,
                tp.tipo, 
                es.nome as estoqueNome,
                es.nome_real as estoqueNomeReal
            FROM 
                {$estoquePreferencia} d 
            INNER JOIN 
                insumos i
            ON 
                d.insumos_id = i.id
            INNER JOIN 
                tipos_insumos tp
            ON 
                tp.id = i.tipo_insumos_id
            INNER JOIN 
                estoques es
            ON 
                es.id = d.estoque_id" . $where;

    // echo $sql;
        
    try {
        $result = $conexao->query($sql);
        if ($result->num_rows > 0){
            for ($j=0; $j < $result->num_rows; $j++) {
                $dados_tmp = $result->fetch_assoc();
                array_push($arrValores, $dados_tmp);
            }
        }    
    } catch (\Throwable $th) {
        echo "//funcoes/getVencidosEstoques - erro ao realizar a coleta de dados: " . $th;
        die($conexao);
    }

    return $arrValores;
}



function selectDados($conexao, $from, $fields = null, $where = null){
    $arrValores = [];
    $where = strlen($where)>0 ? " WHERE " . $where : "";
    $fields = strlen($fields)>0 ? $fields : "*";

    $sql= "SELECT ". $fields . " FROM " . $from . " " . $where;
        
    try {
        $result = $conexao->query($sql);
        if ($result->num_rows > 0){
            for ($j=0; $j < $result->num_rows; $j++) {
                $dados_tmp = $result->fetch_assoc();
                array_push($arrValores, $dados_tmp);
            }
        }    
    } catch (\Throwable $th) {
        echo "<br>//funcoes/selectDados - erro ao realizar a coleta de dados: " . $th;
        die($conexao);
    }

    return $arrValores;
}



/**
 * Método responsável por trazer dados do banco de dados utilizando inner join.
 * A forma correta de usar é 'linkar' as tabelas e seus atributos que serão usadas no inner join ao chamar a função, você deve alternar os atributos de cada tabela.
 * Por exemplo: selectInnnerJoin(['att1','att2', ...], 'deposito', ['tipo_insumo_id']);
 * @param array $attrsToReturn -> Atributos a serem retornados
 * @param string $tableToFrom -> tabela para usar após o ... FROM <table_here> ...
 * @param array $arrayAttFrom-> atributos que são referentes à tabela do from e serão usados na forma: ON tableFrom.AttFrom = tableInner.AttInner
 * @param array $arrTableToInner-> Tabelas que serão usadas no INNER JOIN: INNER JOIN tableInner
 * @param array $arrayAttFrom-> atributos que são referentes à tabela do from e serão usados na forma: ON tableFrom.AttFrom = tableInner.AttInner
 * @param string $where -> clausula where
 * 
 */
function selectInnnerJoin($conexao, $attrsToReturn, $tableToFrom, $arrayAttFrom, $arrTableToInner, $arrAttrsTableInner, $where = null){
    $arrValores = [];
    // echo '<br>chegou aqui';
    $where = strlen($where) ? ' WHERE ' . $where : '';

    $query = '
        SELECT 
            '. implode(',',$attrsToReturn).'
        FROM 
            '.$tableToFrom;

    $inner = '';

    for ($i=0; $i < count($arrayAttFrom); $i++) { 

        $inner .= "
            INNER JOIN " . $arrTableToInner[$i] .'
            ON '. $tableToFrom.'.'. $arrayAttFrom[$i] .' = '. $arrTableToInner[$i] .'.'. $arrAttrsTableInner[$i] .'';
    
    }

    $query = $query . $inner . ' ' .$where;

    // echo $query;

    try {
        $result = $conexao->query($query);
        if ($result->num_rows > 0){
            for ($j=0; $j < $result->num_rows; $j++) {
                $dados_tmp = $result->fetch_assoc();
                // echo '<br>' . $dados_tmp['qtd_insumos'];
                array_push($arrValores, $dados_tmp);
            }
        }    
    } catch (\Throwable $th) {
        echo "//funcoes/getVencidosEstoques - erro ao realizar a coleta de dados: " . $th;
        die($conexao);
    }

    // echo "<pre>"; print_r($query); echo "</pre>"; exit;

    return $arrValores;

}

function formatarString($string) {
    $texto = substr($string, 0, -1); 
    $ultimoCaracter = substr($string, -1);

    $textoFormatado = ucfirst($texto);

    return $textoFormatado . ' ' . $ultimoCaracter;
}

function removerEspacos($string) {
    // Remove todos os espaços da string
    return str_replace(' ', '', $string);
}


/**
 * Método responsável por comparar movimentacoes a partir de dados
 * @param array $dados -> dados que serão utilizados para as validações
 * @param string $movimentacao -> movimentação desejada
 * @param string $status-> status desejado
 * utilizado no home.php
 * 
 */
function processaSolicitacoes($dados){
    // variaveis e constantes
    $requisicoes = "requis";
    $devolucoes = "devolu";
    
    $aprovada = "aprovada";
    $recusada = "recusada"; 
    $pendente = "pendente";

    $movimetacoes = [
        $requisicoes,
        $devolucoes
        ];
    $requisicoes_array = [
        $aprovada => 0,
        $recusada => 0,
        $pendente => 0,
    ];
    $devolucoes_array = [
        $aprovada => 0,
        $recusada => 0,
        $pendente => 0,
    ];
    $solicitacoes = [
        $requisicoes=>$requisicoes_array,
        $devolucoes=>$devolucoes_array
    ];

    for ($i=0; $i < count($dados); $i++) {
        $movimentacao_para_comparar = substr(strtolower($dados[$i][0]), 0, 6);
        $status_para_comparar = strtolower($dados[$i][1]);

        $qtd_atual_req_aprov = $solicitacoes[$requisicoes][$aprovada];
        $qtd_atual_req_recu = $solicitacoes[$requisicoes][$recusada];
        $qtd_atual_req_pend = $solicitacoes[$requisicoes][$pendente];

        $qtd_atual_devol_aprov = $solicitacoes[$devolucoes][$aprovada];
        $qtd_atual_devol_recu = $solicitacoes[$devolucoes][$recusada];
        $qtd_atual_devol_pend = $solicitacoes[$devolucoes][$pendente];

        if ($movimentacao_para_comparar == $requisicoes) {
            if ($status_para_comparar == $aprovada) {
                $solicitacoes[$requisicoes][$aprovada] = $qtd_atual_req_aprov + 1;
            }elseif ($status_para_comparar == $recusada) {
                $solicitacoes[$requisicoes][$recusada] = $qtd_atual_req_recu + 1;
            }elseif ($status_para_comparar == $pendente) {
                $solicitacoes[$requisicoes][$pendente] = $qtd_atual_req_pend + 1;
            }
        }else{
            if ($status_para_comparar == $aprovada) {
                $solicitacoes[$devolucoes][$aprovada] = $qtd_atual_devol_aprov + 1;
            }elseif ($status_para_comparar == $recusada) {
                $solicitacoes[$devolucoes][$recusada] = $qtd_atual_devol_recu + 1;
            }elseif ($status_para_comparar == $pendente) {
                $solicitacoes[$devolucoes][$pendente] = $qtd_atual_devol_pend + 1;
            }
        }
    }

    return $solicitacoes;
}


?>