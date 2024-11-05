<?php

$stringList = array();

if ( isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
    // $contador = 0;
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
        array_push($stringList, $valor_est);

	}

    $num_nf_tmp = $stringList[1];
    $num_nf = $_GET[$num_nf_tmp];

}

?>

<section class="painel_insumos">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Compra com Número de NF <?=$num_nf?></h3>
            </div>
            <div class="d-flex jf-cnt-end">
                <form action="index.php?menuop=compra_por_nf&numNotaFiscal=<?=$num_nf?>" method="post" class="form_buscar">
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
                        <th>Insumo</th>
                        <th>Fornecedor</th>
                        <th>N° Nota Fiscal</th>
                        <th>Nota Fiscal</th>
                        <th>Data da Compra</th>
                        <th>Estoque de Destino</th>
                        <th>Visualizar Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_compras = 10;

                        $pagina = (isset($_GET['pagina']))?(int)$_GET['pagina']:1;

                        $inicio_compras = ($quantidade_registros_compras * $pagina) - $quantidade_registros_compras;

                        $txt_pesquisa = (isset($_POST["txt_pesquisa"]))?$_POST["txt_pesquisa"]:"";

                        $sql = "SELECT 
                                    c.nome_nf,
                                    c.num_nf,
                                    c.id,
                                    c.caminho,
                                    c.data_upload,
                                    i.id as insumos_id,
                                    i.nome as insumos_nome,
                                    f.razao_social,
                                    e.nome as estoques_nome
                                    FROM 
                                        compras c

                                    INNER JOIN 
                                        fornecedores f
                                    ON 
                                        f.id = c.fornecedor_id

                                    INNER JOIN 
                                        deposito d
                                    ON 
                                        d.id_origem = c.num_nf

                                    INNER JOIN 
                                        insumos i
                                    ON 
                                        d.insumos_id = i.id

                                    INNER JOIN 
                                        estoques e
                                    ON 
                                        d.estoque_id = e.id

                                    WHERE
                                        c.num_nf = {$num_nf} and (
                                        i.nome LIKE '%{$txt_pesquisa}%')

                                        ORDER BY data_upload ASC 
                                        LIMIT $inicio_compras,$quantidade_registros_compras";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr class="tabela_dados">
                        <td><?=$dados["id"]?></td>
                        <td><?=$dados["insumos_nome"]?></td>
                        <td><?=$dados["razao_social"]?></td>
                        <td><?=$dados["num_nf"]?></td>
                        <td><a target="_blank" href="<?=$dados['caminho']?>"><?=$dados["nome_nf"]?></a></td>
                        <td><?php echo date("d/m/Y H:i", strtotime($dados['data_upload']));?></td>
                        <td><?=$dados["estoques_nome"]?></td>
                        <td>
                            <a href="index.php?menuop=compra_detalhes&numNotaFiscal=<?=$dados["num_nf"]?>&insumoId=<?=$dados['insumos_id']?>">Ver Detalhes</a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
            <div class="paginacao">
                <?php
                    $sqlTotalInsumos = "SELECT
                                            id
                                        FROM 
                                            compras 
                                        WHERE
                                            num_nf = {$num_nf}";
                    $queryTotalInsumos = mysqli_query($conexao,$sqlTotalInsumos) or die(mysqli_error($conexao));

                    $numTotalInsumos = mysqli_num_rows($queryTotalInsumos);
                    $totalPaginasInsumos = ceil($numTotalInsumos/$quantidade_registros_compras);
                    
                    echo "<a href=\"?menuop=compra_por_nf&numNotaFiscal=$num_nf&pagina=1\">Início</a> ";

                    if ($pagina>6) {
                        ?>
                            <a href="?menuop=compra_por_nf&numNotaFiscal=<?=$num_nf?>&pagina=<?php echo $pagina-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasInsumos;$i++){

                        if ($i >= ($pagina) && $i <= ($pagina+5)) {
                            
                            if ($i==$pagina) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=compra_por_nf&numNotaFiscal=$num_nf&pagina=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina<($totalPaginasInsumos-5)) {
                        ?>
                            <a href="?menuop=compra_por_nf&numNotaFiscal=<?=$num_nf?>&pagina=<?php echo $pagina+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=compra_por_nf&numNotaFiscal=$num_nf&pagina=$totalPaginasInsumos\">Fim</a>";
                ?>
            </div>
    </div>
</section>