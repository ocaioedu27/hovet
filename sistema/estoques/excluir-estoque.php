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

    $idCategoria = $stringList[1];

    $categoriaId = $_GET[$idCategoria];

    echo "<br>Id: " . $categoriaId;

}

$sql = "SELECT id FROM estoques WHERE id={$categoriaId}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

if($result->num_rows>0){

    $sqlDelete = mysqli_query($conexao, "DELETE FROM estoques WHERE id=$categoriaId");
    
    echo "<script language='javascript'>window.alert('Item excluído com sucesso!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=estoques';</script>";
}


?>