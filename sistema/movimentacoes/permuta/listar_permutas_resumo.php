
<?php
$qtd_limit = 10;

$pagina = (isset($_GET['pagina']))?(int)$_GET['pagina']:1;

$inicio_permuta = ($qtd_limit * $pagina) - $qtd_limit;

$txt_pesquisa = (isset($_POST["txt_pesquisa"]))?$_POST["txt_pesquisa"]:"";

$sql = "SELECT 
            p.data,
            p.oid_operacao,
            f.razao_social
        FROM 
            permutas p
        INNER JOIN 
            fornecedores f
        ON 
            p.fornecedor_id = f.id
            
        WHERE
            p.oid_operacao LIKE '%{$txt_pesquisa}%' 

        GROUP BY oid_operacao 
        ORDER BY data ASC 

        LIMIT $inicio_permuta,$qtd_limit";
$rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

$resultados = '';
if ($rs->num_rows > 0){
    while($dados = mysqli_fetch_assoc($rs)){
        
        $permutas_oid_operacao = $dados["oid_operacao"];
        $fornecedores_razao_social = $dados["razao_social"];
        $permutas_data = date("d/m/Y H:i", strtotime($dados["data"]));

        $resultados .= '
            <tr class="tabela_dados">
                <td>'. $permutas_oid_operacao .'</td>
                <td>'. $fornecedores_razao_social .'</td>
                <td>'. $permutas_data .'</td>
                <td>
                    <a href="index.php?menuop=permuta_por_oid&ooidPermuta='. $permutas_oid_operacao . '">Informações</a>
                </td>
            </tr>';
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
                <h3>Resumo de Permutas</h3>
            </div>
            <div class="d-flex jf-cnt-end">
                <form action="index.php?menuop=permuta" method="post" class="form_buscar">
                    <input class="search_bar" type="text" name="txt_pesquisa" placeholder="Buscar">
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
                        <th>Instituição</th>
                        <th>Data da Permuta</th>
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
                    $sqlTotalInsumos = "SELECT oid_operacao FROM permutas";
                    $queryTotalInsumos = mysqli_query($conexao,$sqlTotalInsumos) or die(mysqli_error($conexao));

                    $numTotalInsumos = mysqli_num_rows($queryTotalInsumos);
                    $totalPaginasInsumos = ceil($numTotalInsumos/$qtd_limit);
                    
                    echo "<a href=\"?menuop=permuta&pagina=1\">Início</a> ";

                    if ($pagina>6) {
                        ?>
                            <a href="?menuop=permuta&pagina=<?php echo $pagina-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasInsumos;$i++){

                        if ($i >= ($pagina) && $i <= ($pagina+5)) {
                            
                            if ($i==$pagina) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=permuta&pagina=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina<($totalPaginasInsumos-5)) {
                        ?>
                            <a href="?menuop=permuta&pagina=<?php echo $pagina+2?>"> >> </a>
                        <?php
                    }

                    if ($pagina<($totalPaginasInsumos-1)) {
                        ?>
                            <a href="?menuop=permuta&pagina=<?php echo $pagina+1?>"> > </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=permuta&pagina=$totalPaginasInsumos\">Fim</a>";
                ?>
            </div>
    </div>
</section>