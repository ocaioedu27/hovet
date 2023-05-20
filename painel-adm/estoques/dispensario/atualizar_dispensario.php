<header>
    <h2>Atualizar Insumo do Dispensário</h2>
</header>
<?php
    $idInsumoDispensario = mysqli_real_escape_string($conexao,$_POST["dispensario_id"]);
    $idInsumoDispensario = strtok($idInsumoDispensario, " ");
    $qtd_selecionada_dispensario = mysqli_real_escape_string($conexao,$_POST["quantidade_operacao_dispensario"]);
    
    $tipo_operacao = mysqli_real_escape_string($conexao, $_POST["operacao_dispensario"]);
    $tipo_operacao = strtok($tipo_operacao, " ");

    $sql_lista_qtd_insumo = "SELECT 
                        dispensario_qtd 
                        FROM 
                        dispensario
                        WHERE
                        dispensario_id={$idInsumoDispensario}";
                    
    $dados_insumo_dispensario = mysqli_query($conexao, $sql_lista_qtd_insumo) or die("//dispensario/atualiza_dispensario/select_qtd_insumo - erro ao realizar a consulta: " . mysqli_error($conexao));

    $resultado_select_qtd = mysqli_fetch_assoc($dados_insumo_dispensario);
    
    $quantidade_atual_dispensario = $resultado_select_qtd['dispensario_qtd'];

    $nova_qtd_dispensario = $quantidade_atual_dispensario-$qtd_selecionada_dispensario;

    $devolucao_qtd_dispensario = $quantidade_atual_dispensario+$qtd_selecionada_dispensario;

    if ($tipo_operacao == 1) {

        $sql = "UPDATE 
        dispensario
        SET
        dispensario_qtd = {$nova_qtd_dispensario} 
        WHERE 
        dispensario_id={$idInsumoDispensario}";

        if (mysqli_query($conexao, $sql)) {
            echo "<script language='javascript'>window.alert('Retirada realizada com sucesso!!'); </script>";
            echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=dispensario_resumo';</script>";

        } else {
            die("//Dispensario/atualiza_dispensario/retirada - Erro ao executar a inserção no dispensário. " . mysqli_error($conexao));   
        }

    } else {

        $sql = "UPDATE 
        dispensario
        SET
        dispensario_qtd = {$devolucao_qtd_dispensario} 
        WHERE 
        dispensario_id={$idInsumoDispensario}";

        if (mysqli_query($conexao, $sql)) {
            echo "<script language='javascript'>window.alert('Devolução realizada com sucesso!!'); </script>";
            echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=dispensario_resumo';</script>";

        } else {
            die("//Dispensario/atualiza_dispensario/devolução - Erro ao executar a atualização no dispensário. " . mysqli_error($conexao));   
        }
    }

?>