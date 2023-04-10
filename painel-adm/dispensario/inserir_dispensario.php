<header>
    <h2>Inserir Insumo no Dispensário</h2>
</header>
<?php 

$depositoID_Insumodispensario = mysqli_real_escape_string($conexao,$_POST["depositoID_Insumodispensario"]);
$depositoID_Insumodispensario = strtok($depositoID_Insumodispensario, " ");
// echo "id do insumo no deposito: " . $depositoID_Insumodispensario;

$quantidadeInsumodispensario = mysqli_real_escape_string($conexao,$_POST["quantidadeInsumoDispensario"]);
echo "\nQuantidade de insumo no dispensario: " . $quantidadeInsumodispensario;

$validadeInsumodispensario = mysqli_real_escape_string($conexao,$_POST["validadeInsumoDeposito"]);
echo "\nValidade do insumo vindo do deposito: " . $validadeInsumodispensario;

$localInsumodispensario = mysqli_real_escape_string($conexao,$_POST["localInsumodispensario"]);
$localInsumodispensario = strtok($localInsumodispensario, " ");

$sql = "INSERT INTO dispensario (
    dispensario_Qtd,
    dispensario_Validade,
    dispensario_depositoId,
    dispensario_localId)
    VALUES(
        {$quantidadeInsumodispensario},
        '{$validadeInsumodispensario}',
        {$depositoID_Insumodispensario},
        {$localInsumodispensario}
    )";

if (mysqli_query($conexao, $sql)) {
    echo "O Insumo foi cadastrado no dispensário do sistema com sucesso!";    
} else {
    die("Erro ao executar a inserção no dispensário. " . mysqli_error($conexao));   
}

$quantidadeInsumoDeposito = mysqli_real_escape_string($conexao,$_POST["quantidadeInsumoDeposito"]);

$novaQtdInsumo_deposito = $quantidadeInsumoDeposito-$quantidadeInsumodispensario;

$sql_atualiza_qtd_deposito = "UPDATE deposito 
    SET deposito_Qtd = '{$novaQtdInsumo_deposito}' 
    WHERE deposito_id={$depositoID_Insumodispensario}";

if (mysqli_query($conexao, $sql_atualiza_qtd_deposito)) {
    echo "Quantidade do insumo no Depósito atualizada com sucesso!";
} else {
    die("Erro ao executar a inserção. " . mysqli_error($conexao));
}

?>