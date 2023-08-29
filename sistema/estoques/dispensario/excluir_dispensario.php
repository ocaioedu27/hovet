<?php
$idInsumodispensario = $_GET["idInsumodispensario"];

$sql = "SELECT disp.dispensario_id,
        disp.dispensario_deposito_id,
        dep.deposito_insumos_id,
        disp.dispensario_estoques_id,
        e.estoques_nome_real,
        e.estoques_nome
        FROM dispensario disp
        INNER JOIN
        deposito dep
        ON disp.dispensario_deposito_id = dep.deposito_id
        INNER JOIN estoques e
        ON disp.dispensario_estoques_id = e.estoques_id
        WHERE dispensario_id={$idInsumodispensario}";
$result = mysqli_query($conexao,$sql) or die("//Dispensario/excluir_dispensario/ - Erro ao realizar a consulta. " . mysqli_error($conexao));

$dados_sql = mysqli_fetch_assoc($result);
$deposito_insumos_id = $dados_sql['deposito_insumos_id'];
$qualEstoque = $dados_sql['dispensario_estoques_id'];
$estoqueNome = $dados_sql['estoques_nome'];
// echo $deposito_insumos_id;


if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE from dispensario WHERE dispensario_id=$idInsumodispensario");
    echo "<script language='javascript'>window.alert('Item excluído com sucesso!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=dispensario_resumo&" . $qualEstoque . "=1';</script>";
    // echo "<br/>Item excluido com sucesso";
}


$tipo_movimentacao = 5;

$local_origem = $estoqueNome;

$local_destino = "Despejo";

$usuario_id = $_SESSION['usuario_id'];

$insumo_id = $deposito_insumos_id;

atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id, $insumo_id);
?>