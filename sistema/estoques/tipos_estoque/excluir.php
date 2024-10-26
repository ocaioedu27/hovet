<?php
$id = $_GET["id"];

$sql = "SELECT * FROM tipos_estoques WHERE id={$id}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE FROM tipos_estoques WHERE id=$id");
    echo "<script language='javascript'>window.alert('Tipo de estoque exclído com sucesso!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=tp_estoque';</script>";
}

?>