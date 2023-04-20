<?php
$idInsumo = $_GET["idInsumo"];

$sql = "SELECT * FROM insumos WHERE insumos_id={$idInsumo}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE from insumos WHERE insumos_id=$idInsumo");
    echo "<script language='javascript'>window.alert('Item excluído com sucesso!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=insumos';</script>";
}


?>