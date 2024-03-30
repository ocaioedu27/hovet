<?php
$idInsumodispensario = $_GET["idInsumodispensario"];

$sql = "SELECT 
            disp.id as disp_id,
            disp.deposito_id,
            disp.estoques_id,
            e.nome_real,
            e.nome as estoque_nome,
            i.id as insumo_id,
            i.nome as insumo_nome
        FROM 
            dispensario disp
        INNER JOIN
            insumos i
        ON 
            disp.insumos_id = i.id
        INNER JOIN 
            estoques e
        ON 
            disp.estoques_id = e.id
        WHERE 
            disp.id={$idInsumodispensario}";

$result = mysqli_query($conexao,$sql) or die("//Dispensario/excluir_dispensario/ - Erro ao realizar a consulta. " . mysqli_error($conexao));

$dados_sql = mysqli_fetch_assoc($result);
$insumo_id = $dados_sql['insumo_id'];
$insumo_nome = $dados_sql['insumo_nome'];
$estoque_id = $dados_sql['dispensario_estoques_id'];
$estoqueNome = $dados_sql['estoques_nome'];
// echo $deposito_insumos_id;


if($result->num_rows >0){
    $sqlDelete=mysqli_query($conexao, "DELETE from dispensario WHERE id=$idInsumodispensario");
    echo "<script language='javascript'>window.alert('Item excluído com sucesso!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=dispensario_resumo&" . $estoque_id . "=1';</script>";
    // echo "<br/>Item excluido com sucesso";
}


$tipo_movimentacao = 5;

$local_origem = $estoqueNome;

$local_destino = "Despejo";

$usuario_id_nome = $sessionUserID . ' - '. $userFirstName;

atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id_nome, $insumo_nome);
?>