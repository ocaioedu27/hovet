
<?php
  
function has_permission($per_user, $per_sistem){
    // var_dump($per_sistem);

    $cont_per_user = count($per_user);
    $i = 0;
    while ($i < $cont_per_user) {

        if (in_array($per_user[$i], $per_sistem)){

            return true;
            break;
        
        }else{
        
            $i++;
        }

    }

    return null;

}

function retornaDadosGeral($conn, $dado_requisitado, $table_name, $hasCondition, $dado_referencia, $dado_compare, $has_inner_join, $table_to_inner) {
    // echo "teste na function";
    $array_to_return = array();

    if ($hasCondition) {
        $sql = "SELECT {$dado_requisitado} FROM {$table_name} WHERE {$dado_compare}='{$dado_referencia}'";

    }else if($has_inner_join){
        $sql = "SELECT 
                    {$dado_requisitado} 
                FROM 
                    {$table_name}
                INNER JOIN 
                    {$table_to_inner}
                ON
                    {$table_name}.
                WHERE 
                    {$dado_compare}='{$dado_referencia}'";

    }else{
        $sql = "SELECT {$dado_requisitado} FROM {$table_name}";
    }

    $result = mysqli_query($conn, $sql) or die("//retornaDadosGeral - erro ao realizar a consulta: " . mysqli_error($conn));

    while($dados_para_while = mysqli_fetch_assoc($result)){

        $dado_requisitado_tmp = $dados_para_while[$dado_requisitado];
        array_push($array_to_return, $dado_requisitado_tmp);

    }

    return $array_to_return;
}

function retornaDadosInnerJoin($conn, $data_to_return, $table_to_from, $table_to_inner,$data_to_inner_table_from ,$data_to_inner_table_inner,$value_to_compare, $atribute_to_compare) {
    // echo "teste na function";
    $array_to_return = array();
    
    $sql = "SELECT 
                {$table_to_from}.{$data_to_return} 
            FROM 
                {$table_to_from}
            INNER JOIN 
                {$table_to_inner}
            ON
                {$table_to_from}.{$data_to_inner_table_from} = {$table_to_inner}.{$data_to_inner_table_inner}

            WHERE 
                {$atribute_to_compare}='{$value_to_compare}'";

    $result = mysqli_query($conn, $sql) or die("//retornaDadosInnerJoin - erro ao realizar a consulta: " . mysqli_error($conn));

    while($dados_para_while = mysqli_fetch_assoc($result)){

        $data_to_return_tmp = $dados_para_while[$data_to_return];
        array_push($array_to_return, $data_to_return_tmp);

    }

    return $array_to_return;
}

function retornaDadosInnerJoinComAnd($conn, $data_to_return, $table_to_from, $table_to_inner,$data_to_inner_table_from ,$data_to_inner_table_inner,$array_key_value_to_compare) {
    
    $array_to_return = array();

    //preparando o filtro
    $string_filter = '';

    $array_values = array();
    $array_values = $array_key_value_to_compare;

    foreach ($array_values as $key => $value) {
        // echo "Chave: $key | Valor: $value";
        $string_filter .= "$key = '$value' and ";
    }

    $string_filter = substr($string_filter, 0, -5);
    
    $sql = "SELECT 
                {$table_to_from}.{$data_to_return} 
            FROM 
                {$table_to_from}
            INNER JOIN 
                {$table_to_inner}
            ON
                {$table_to_from}.{$data_to_inner_table_from} = {$table_to_inner}.{$data_to_inner_table_inner}

            WHERE $string_filter
                ";

    $result = mysqli_query($conn, $sql) or die("//retornaDadosInnerJoin - erro ao realizar a consulta: " . mysqli_error($conn));

    while($dados_para_while = mysqli_fetch_assoc($result)){

        $data_to_return_tmp = $dados_para_while[$data_to_return];
        array_push($array_to_return, $data_to_return_tmp);

    }

    return $array_to_return;
}
  

// EXEMPLO DE USO

// Usar o arry de permissoes do sistema

//   $array_permissoes_sistema = retornaDadosGeral($conexao, "permissoes_id", "permissoes_usuario", false, "","");


// Usar o array de permissoes que o usuario tem

//   $array_permissoes_user = retornaDadosGeral($conexao, "uhp_permissoes_id", "usuarios_has_permissoes", true, 2, "uhp_usuario_id");


// guardando o retorno da funcao que verifica se o usuario tem as permissoes
//   $tem_permissao = has_permission($array_permissoes_user, $array_permissoes_sistema);

//   if ($tem_permissao) {
    
//     echo "<br>Pode acessar o painel";
  
//   } else{
    
//     echo "<br>Não pode acessar o painel";

//   }


  
//   has_permission($array_permissoes_user, $array_permissoes_sistema);
?>