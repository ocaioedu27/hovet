<?php
$idInsumoDeposito = $_GET["idInsumodeposito"];

$sql = "SELECT * FROM deposito WHERE deposito_id={$idInsumoDeposito}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

$dados_sql = mysqli_fetch_assoc($result);
$deposito_insumos_id = $dados_sql['deposito_insumos_id'];
// echo $deposito_insumos_id;

$tipo_movimentacao = 5;

$local_origem = "Depósito";

$local_destino = "Lixo";

$usuario_id = $_SESSION['usuario_id'];

$insumo_id = $deposito_insumos_id;

atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id, $insumo_id);

if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE from deposito WHERE deposito_id=$idInsumoDeposito");
    echo "<script language='javascript'>window.alert('Item excluído com sucesso!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=deposito';</script>";
}

?>