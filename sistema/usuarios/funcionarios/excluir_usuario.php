<?php
$idUsuario = $_GET["idUsuario"];

$sql = "SELECT * FROM usuarios WHERE usuario_id={$idUsuario}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE from usuarios WHERE usuario_id=$idUsuario");
    echo "<script language='javascript'>window.alert('Usuário excluído com sucesso!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=usuarios';</script>";
}
// header('Location: index.php?menuop=usuarios');

?>