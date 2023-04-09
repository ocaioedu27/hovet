<?php
$idInsumodispensario = $_GET["idInsumodispensario"];

$sql = "SELECT * FROM dispensario WHERE dispensario_id={$idInsumodispensario}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE from dispensario WHERE dispensario_id=$idInsumodispensario");
}
header('Location: index.php?menuop=dispensario');

?>