<?php
$idInsumo = $_GET["idInsumo"];

$sql = "SELECT * FROM insumos WHERE id={$idInsumo}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE from insumos WHERE id=$idInsumo");
}

header('Location: index.php?menuop=insumos');

?>