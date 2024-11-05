<?php
$qtd_registros = 10;

$pagina = (isset($_GET['pagina']))?(int)$_GET['pagina']:1;

$inicio = ($qtd_registros * $pagina) - $qtd_registros;

$txt_pesquisa = (isset($_POST["txt_pesquisa"]))?$_POST["txt_pesquisa"]:"";

$sql = "SELECT 
            c.nome_nf,
            c.num_nf,
            c.id as compra_id,
            c.caminho,
            c.data_upload,
            f.razao_social
            FROM 
                compras c
            INNER JOIN 
                fornecedores f
            ON 
                f.id = c.fornecedor_id
            WHERE
                c.num_nf = '{$txt_pesquisa}' or
                c.nome_nf LIKE '%{$txt_pesquisa}%' or
                c.data_upload LIKE '%{$txt_pesquisa}%'
            ORDER BY 
                data_upload ASC 
            LIMIT 
                $inicio,$qtd_registros";
$rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

$resultados = '';
if ($rs->num_rows > 0){
    while($dados_para_while = mysqli_fetch_assoc($rs)){
        $compra_id = $dados_para_while['compra_id'];
        $num_nf = $dados_para_while["num_nf"];
        $razao_social = $dados_para_while["razao_social"];
        $compras_caminho = $dados_para_while["caminho"];
        $nome_nf = $dados_para_while["nome_nf"];
        $data_upload = date("d/m/Y H:i", strtotime($dados_para_while["data_upload"]));

        $resultados .= '
            <tr class="tabela_dados">
                <td>'. $compra_id .'</td>
                <td>'. $num_nf .'</td>
                <td>'. $razao_social .'</td>
                <td>
                    <a target="_blank" href="'.$compras_caminho.'">'. $nome_nf .'</a>
                </td>
                <td>'. $data_upload .'</td>
                <td>
                    <a href="index.php?menuop=compra_por_nf&numNotaFiscal='.$num_nf.'">Informações</a>
                </td>
            </tr>';

        $qtd_linhas_tabelas++;

    }
} else{
    $resultados = '
        <tr class="tabela_dados">
            <td colspan="6" class="text-center">Nenhum registro para exibir!</td>
        </tr>';

}  

?>

<section class="painel_insumos">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Resumo de Compras</h3>
            </div>
            <div class="d-flex jf-cnt-end">
                <form action="index.php?menuop=compra" method="post" class="form_buscar">
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
                        <th>ID</th>
                        <th>N° Nota Fiscal</th>
                        <th>Fornecedor</th>
                        <th>Nota Fiscal</th>
                        <th>Data da Compra</th>
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
                    $sqlTotalInsumos = "SELECT id FROM compras";
                    $queryTotalInsumos = mysqli_query($conexao,$sqlTotalInsumos) or die(mysqli_error($conexao));

                    $numTotalInsumos = mysqli_num_rows($queryTotalInsumos);
                    $totalPaginasInsumos = ceil($numTotalInsumos/$qtd_registros);
                    
                    echo "<a href=\"?menuop=compra&pagina=1\">Início</a> ";

                    if ($pagina>6) {
                        ?>
                            <a href="?menuop=compra?pagina=<?php echo $pagina-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasInsumos;$i++){

                        if ($i >= ($pagina) && $i <= ($pagina+5)) {
                            
                            if ($i==$pagina) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=compra&pagina=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina<($totalPaginasInsumos-5)) {
                        ?>
                            <a href="?menuop=compra?pagina=<?php echo $pagina+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=compra&pagina=$totalPaginasInsumos\">Fim</a>";
                ?>
            </div>
    </div>
</section>