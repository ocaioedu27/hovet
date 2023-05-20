<?php
$idInsumoDeposito = $_GET["idInsumodeposito"];

$sql = "SELECT e.estoques_nome_real,
            e.estoques_nome,
            d.deposito_insumos_id
            FROM deposito d 
            INNER JOIN estoques e
            ON d.deposito_estoque_id = e.estoques_id
            WHERE deposito_id = {$idInsumoDeposito}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

$dados_sql = mysqli_fetch_assoc($result);
$deposito_insumos_id = $dados_sql['deposito_insumos_id'];
$qualEstoque = $dados_sql['estoques_nome_real'];
$estoqueNome = $dados_sql['estoques_nome'];
// echo $deposito_insumos_id;

if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE from deposito WHERE deposito_id=$idInsumoDeposito");
    echo "<script language='javascript'>window.alert('Item excluído com sucesso!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=deposito_resumo&" . $qualEstoque . "=1';</script>";
}

$tipo_movimentacao = 5;

$local_origem = $estoqueNome;

$local_destino = "Despejo";

$usuario_id = $_SESSION['usuario_id'];

$insumo_id = $deposito_insumos_id;

atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id, $insumo_id);

?>