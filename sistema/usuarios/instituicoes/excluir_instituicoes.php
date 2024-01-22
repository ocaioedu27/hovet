<?php
$idInstituicao = $_GET["idInstituicao"];

echo "Id da instituição: " . $idInstituicao;

$sql = "SELECT * FROM instituicoes WHERE instituicoes_id={$idInstituicao}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE from instituicoes WHERE instituicoes_id=$idInstituicao");
    echo "<script language='javascript'>window.alert('Instituição excluído com sucesso!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=instituicoes';</script>";
}
// header('Location: index.php?menuop=usuarios');

?>