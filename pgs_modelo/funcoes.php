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
                                        (origem,
                                        destino,
                                        tipos_movimentacoes_id,
                                        usuario_id_nome,
                                        insumo_nome) 
                                        VALUE ('{$local_origem}','{$local_destino}',{$tipo_movimentacao},'{$usuario_id_nome}','{$insumo_nome}')";

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

?>