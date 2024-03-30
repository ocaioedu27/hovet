<?php

$quantidade_registros_doacoes = 10;

$pagina_doacoes = (isset($_GET['pagina_doacoes']))?(int)$_GET['pagina_doacoes']:1;

$inicio_doacoes = ($quantidade_registros_doacoes * $pagina_doacoes) - $quantidade_registros_doacoes;

$txt_pesquisa_doacoes = (isset($_POST["txt_pesquisa_doacoes"]))?$_POST["txt_pesquisa_doacoes"]:"";

$sql = "SELECT 
            DISTINCT d.oid_operacao,
            d.data_operacao,
            f.razao_social

        FROM 
            doacoes d
            
        INNER JOIN 
            fornecedores f
            
        ON 
            f.id = d.fornecedor_id
            
        WHERE
            d.oid_operacao = '{$txt_pesquisa_doacoes}' or
            d.data_operacao LIKE '%{$txt_pesquisa_doacoes}%'
            ORDER BY data_operacao ASC
            LIMIT $inicio_doacoes,$quantidade_registros_doacoes";
$rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));


$resultados = '';
if ($rs->num_rows > 0){
    while($dados_para_while = mysqli_fetch_assoc($rs)){
        $oid_operacao = $dados_para_while['oid_operacao'];
        $razao_social = $dados_para_while["razao_social"];
        $data_operacao = date("d/m/Y H:i", strtotime($dados_para_while["data_operacao"]));

        $resultados .= '
            <tr class="tabela_dados">
                <td>'. $oid_operacao .'</td>
                <td>'. $razao_social .'</td>
                <td>'. $data_upload .'</td>
                <td>
                    <a href="index.php?menuop=doacao_por_oid&oidDoacao='.$oid_operacao.'">Informações</a>
                </td>
            </tr>';

        $qtd_linhas_tabelas++;

    }
} else{
    $resultados = '
        <tr class="tabela_dados">
            <td colspan="4" class="text-center">Nenhum registro para exibir!</td>
        </tr>';

} 
?>

<section class="painel_insumos">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Resumo de Doações</h3>
            </div>
            <div>
                <form action="index.php?menuop=doacao" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_doacoes" placeholder="Buscar">
                    <button type="submit" class="btn">
                        <span class="icon">
                            <ion-icon name="search-outline"></ion-icon>
                        </span>
                    </button>
                </form>
            </div>
        </div>
        <div class="tabelas">
            <table id="tabela_listar">
                <thead>
                    <tr class="tabela_dados">
                        <th>ID de Resgistro</th>
                        <th>Doador</th>
                        <th>Data da Doação</th>
                        <th>Visualizar Informações</th>
                    </tr>
                </thead>
                <tbody>
                    <?=$resultados?>
                </tbody>
            </table>
        </div>
            <div class="paginacao">
                <?php
                    $sqlTotalInsumos = "SELECT id FROM doacoes";
                    $queryTotalInsumos = mysqli_query($conexao,$sqlTotalInsumos) or die(mysqli_error($conexao));

                    $numTotalInsumos = mysqli_num_rows($queryTotalInsumos);
                    $totalPaginasInsumos = ceil($numTotalInsumos/$quantidade_registros_doacoes);
                    
                    echo "<a href=\"?menuop=doacao&pagina_doacoes=1\">Início</a> ";

                    if ($pagina_doacoes>6) {
                        ?>
                            <a href="?menuop=doacao?&pagina_doacoes=<?php echo $pagina_doacoes-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasInsumos;$i++){

                        if ($i >= ($pagina_doacoes) && $i <= ($pagina_doacoes+5)) {
                            
                            if ($i==$pagina_doacoes) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=doacao&pagina_doacoes=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina_doacoes<($totalPaginasInsumos-5)) {
                        ?>
                            <a href="?menuop=doacao&pagina_doacoes=<?php echo $pagina_doacoes+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=doacao&pagina_doacoes=$totalPaginasInsumos\">Fim</a>";
                ?>
            </div>
    </div>
</section>