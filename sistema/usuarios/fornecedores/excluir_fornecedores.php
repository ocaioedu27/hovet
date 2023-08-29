<?php
$idFornecedor = $_GET["idFornecedor"];

$sql = "SELECT * FROM fornecedores WHERE fornecedores_id={$idFornecedor}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE from fornecedores WHERE fornecedores_id=$idFornecedor");
    echo "<script language='javascript'>window.alert('Fornecedor excluído com sucesso!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=fornecedores';</script>";
}
// header('Location: index.php?menuop=usuarios');

?>