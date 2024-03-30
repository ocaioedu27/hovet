<?php
$idInsumoDeposito = $_GET["idInsumodeposito"];

$sql = "SELECT e.nome_real,
            e.nome as estoque_nome,
            d.deposito_insumos_id,
            i.nome as insumo_nome
        FROM 
            deposito d 
        INNER JOIN 
            estoques e
        ON 
            d.estoque_id = e.id
        INNER JOIN 
            insumos i
        ON 
            d.insumos_id = i.id
        WHERE 
            id = {$idInsumoDeposito}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));

$dados_sql = mysqli_fetch_assoc($result);
$deposito_insumos_id = $dados_sql['insumos_id'];
$insumo_nome = $dados_sql['insumo_nome'];
$qualEstoque = $dados_sql['nome_real'];
$estoqueNome = $dados_sql['estoque_nome'];
// echo $deposito_insumos_id;

if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE from deposito WHERE id=$idInsumoDeposito");
    echo "<script language='javascript'>window.alert('Item excluído com sucesso!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=deposito_resumo&" . $qualEstoque . "=1';</script>";
}

$tipo_movimentacao = 5;

$local_origem = $estoqueNome;

$local_destino = "Despejo";

$usuario_id_nome = $sessionUserID . ' - ' . $userFirstName;

atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id, $insumo_nome);

?>