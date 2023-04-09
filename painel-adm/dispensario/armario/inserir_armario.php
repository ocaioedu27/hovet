<header>
    <h2>Inserir Insumo no Dispensário</h2>
</header>
<?php 
    $quantidadeInsumodispensario = mysqli_real_escape_string($conexao,$_POST["quantidadeInsumodispensario"]);
    $validadeInsumodispensario = mysqli_real_escape_string($conexao,$_POST["validadeInsumodispensario"]);
    $insumoID_Insumodispensario = mysqli_real_escape_string($conexao,$_POST["insumoID_Insumodispensario"]);
    $insumoID_Insumodispensario = $insumoID_Insumodispensario[0];
    $sql = "INSERT INTO dispensario (
        dispensario_Qtd,
        dispensario_Validade,
        dispensario_InsumosID)
        VALUES(
            {$quantidadeInsumodispensario},
            '{$validadeInsumodispensario}',
            {$insumoID_Insumodispensario}
        )";
        mysqli_query($conexao, $sql) or die("Erro ao executar a inserção. " . mysqli_error($conexao));

        echo "O Insumo foi cadastrado no dispensário do sistema com sucesso!";
?>