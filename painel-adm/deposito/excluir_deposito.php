<?php
$idInsumoDeposito = $_GET["idInsumodeposito"];

$sql = "SELECT * FROM deposito WHERE deposito_id={$idInsumoDeposito}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE from deposito WHERE deposito_id=$idInsumoDeposito");
    echo "<script language='javascript'>window.alert('Item excluído com sucesso!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=deposito';</script>";
}

?>