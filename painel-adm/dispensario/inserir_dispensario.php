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

?>