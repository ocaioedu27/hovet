<header>
    <h2>Inserir Insumo no Dispensário</h2>
</header>
<?php 

$depositoID_Insumodispensario = mysqli_real_escape_string($conexao,$_POST["depositoID_Insumodispensario"]);
$depositoID_Insumodispensario = strtok($depositoID_Insumodispensario, " ");
$quantidadeInsumodispensario = mysqli_real_escape_string($conexao,$_POST["quantidadeInsumoDispensario"]);
$validadeInsumodispensario = mysqli_real_escape_string($conexao,$_POST["validadeInsumoDeposito"]);
$localInsumodispensario = mysqli_real_escape_string($conexao,$_POST["localInsumodispensario"]);
$localInsumodispensario = strtok($localInsumodispensario, " ");

$sql = "INSERT INTO dispensario (
    dispensario_qtd,
    dispensario_validade,
    dispensario_deposito_id,
    dispensario_local_id)
    VALUES(
        {$quantidadeInsumodispensario},
        '{$validadeInsumodispensario}',
        {$depositoID_Insumodispensario},
        {$localInsumodispensario}
    )";

if (mysqli_query($conexao, $sql)) {
    echo "<script language='javascript'>window.alert('Insumo inserido no Dispensário com sucesso!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=dispensario';</script>";   
} else {
    die("//Dispensario/inserir_dispensario/ - Erro ao executar a inserção no dispensário. " . mysqli_error($conexao));   
}

$tipo_movimentacao = mysqli_real_escape_string($conexao,$_POST["mov_dep_to_disp"]);
$tipo_movimentacao = strtok($tipo_movimentacao, " ");

$local_origem = "Depósito";

$local_destino = "Dispenário";

$usuario_id = $_SESSION['usuario_id'];

$insumo_id = $depositoID_Insumodispensario;

atualiza_movimentacao($conexao, $tipo_movimentacao, $local_origem, $local_destino, $usuario_id, $insumo_id);

?>