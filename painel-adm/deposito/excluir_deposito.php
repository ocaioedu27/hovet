<?php
$idInsumoDeposito = $_GET["idInsumoDeposito"];

$sql = "SELECT * FROM deposito WHERE deposito_id={$idInsumoDeposito}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE from deposito WHERE id=$idInsumoDeposito");
}
header('Location: index.php?menuop=deposito');

?>