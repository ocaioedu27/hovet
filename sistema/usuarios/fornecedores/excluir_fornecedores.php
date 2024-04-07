<?php
$idFornecedor = $_GET["idFornecedor"];
if (empty($_GET['idFornecedor'])){
    
    echo "<script language='javascript'>window.alert('preencha o ID!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=fornecedores';</script>";
    exit;

}

$sql = "SELECT * FROM fornecedores WHERE id={$idFornecedor}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE from fornecedores WHERE id=$idFornecedor");
    echo "<script language='javascript'>window.alert('Fornecedor excluído com sucesso!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=fornecedores';</script>";
}
// header('Location: index.php?menuop=usuarios');

?>