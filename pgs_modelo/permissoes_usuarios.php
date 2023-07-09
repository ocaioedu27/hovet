
<?php
  
function has_permission($per_user, $per_sistem){
    // var_dump($per_sistem);

    $cont_per_user = count($per_user);
    $i = 0;
    while ($i < $cont_per_user) {
        // echo "<br> per user" . $per_user[$i];
        // echo " per sistema" . $per_sistem[$i];


        if (in_array($per_user[$i], $per_sistem)){

            // echo $per_user[$i];

            return true;
            break;
        
        }else{
        
            // echo $per_user[$i];
            // echo "<br> per sistema" . $per_sistem[$i];
            $i++;
            // echo $per_user[$i];
        
        }

    }

    return null;

}

function retornaDadosGeral($conn, $dado_requisitado, $table_name, $hasCondition, $dado_referencia, $dado_compare) {
    // echo "teste na function";
    $array_to_return = array();

    if ($hasCondition) {
        $sql = "SELECT {$dado_requisitado} FROM {$table_name} WHERE {$dado_compare}={$dado_referencia}";
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

function testeEcho($message) {
    return $message;
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