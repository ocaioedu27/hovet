<?php

$stringList = array();

if ( isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
    // Cria variáveis dinamicamente
    // $contador = 0;
    foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
        array_push($stringList, $valor_est);

    }
    // var_dump($stringList);

    $idPermissao_tmp = $stringList[1];

    $idPermissao = $_GET[$idPermissao_tmp];

}

$sql = "SELECT * FROM permissoes_usuario WHERE permissoes_id={$idPermissao}";
$result = mysqli_query($conexao,$sql) or die("//excluir_permissao/select_por_id - Erro ao realizar a consulta. " . mysqli_error($conexao));

if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE from permissoes_usuario WHERE permissoes_id=$idPermissao");

    echo "<script language='javascript'>window.alert('Permissão excluída com sucesso!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=permissoes';</script>";
}


?>