<?php
$idUsuario = $_GET["idUsuario"];

$sql = "SELECT * FROM usuarios WHERE id={$idUsuario}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE from usuarios WHERE id=$idUsuario");
}
header('Location: index.php?menuop=usuarios');

?>