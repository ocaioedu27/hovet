<header>
    <h2>Inserir Insumo no Dispensário</h2>
</header>
<?php 
$quantidadeInsumodispensario = mysqli_real_escape_string($conexao,$_POST["quantidadeInsumodispensario"]);
$validadeInsumodispensario = mysqli_real_escape_string($conexao,$_POST["validadeInsumodispensario"]);
$depositoID_Insumodispensario = mysqli_real_escape_string($conexao,$_POST["depositoID_Insumodispensario"]);
$depositoID_Insumodispensario = $depositoID_Insumodispensario[0];
$localInsumodispensario = mysqli_real_escape_string($conexao,$_POST["localInsumodispensario"]);
$localInsumodispensario = $localInsumodispensario[0];
$sql = "INSERT INTO dispensario (
    dispensario_Qtd,
    dispensario_Validade,
    dispensario_InsumosID,
    dispensario_localId)
    VALUES(
        {$quantidadeInsumodispensario},
        '{$validadeInsumodispensario}',
        {$depositoID_Insumodispensario},
        {$localInsumodispensario}
    )";

$resultado_inserir_disp = mysqli_query($conexao, $sql);

if ($resultado_inserir_disp) {
    echo "O Insumo foi cadastrado no dispensário do sistema com sucesso!";    
} else {
    die("Erro ao executar a inserção no dispensário. " . mysqli_error($conexao));   
}

$quantidadeInsumoDeposito = mysqli_real_escape_string($conexao,$_POST["quantidadeInsumoDeposito"]);

$novaQtdInsumo_deposito = $quantidadeInsumoDeposito-$quantidadeInsumodispensario;

$sql_atualiza_qtd_deposito = "UPDATE deposito 
    SET deposito_Qtd = '{$novaQtdInsumo_deposito}' 
    WHERE id={$insumoID_Insumodispensario}";

$resultado_atualiza_deposito_qtd = mysqli_query($conexao, $sql_atualiza_qtd_deposito);

if ($resultado_atualiza_deposito_qtd) {
    echo "Quantidade do insumo no Depósito atualizada com sucesso!";
} else {
    die("Erro ao executar a inserção. " . mysqli_error($conexao));
}

?>