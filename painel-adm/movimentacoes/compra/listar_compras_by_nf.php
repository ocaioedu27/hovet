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
                <h3>Todas as Compras</h3>
            </div>
            <div>
                <form action="index.php?menuop=compra_por_nf&numNotaFiscal=<?=$num_nf?>" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_compras" placeholder="Buscar">
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

                        $pagina_compras = (isset($_GET['pagina_compras']))?(int)$_GET['pagina_compras']:1;

                        $inicio_compras = ($quantidade_registros_compras * $pagina_compras) - $quantidade_registros_compras;

                        $txt_pesquisa_compras = (isset($_POST["txt_pesquisa_compras"]))?$_POST["txt_pesquisa_compras"]:"";

                        $sql = "SELECT 
                                    c.compras_nome,
                                    c.compras_num_nf,
                                    c.compras_id,
                                    c.compras_caminho,
                                    c.compras_data_upload,
                                    i.insumos_id,
                                    i.insumos_nome,
                                    f.fornecedores_razao_social,
                                    e.estoques_nome
                                    FROM 
                                        compras c

                                    INNER JOIN 
                                        fornecedores f
                                    ON 
                                        f.fornecedores_id = c.compras_fornecedor_id

                                    INNER JOIN 
                                        deposito d
                                    ON 
                                        d.deposito_id_origem = c.compras_num_nf

                                    INNER JOIN 
                                        insumos i
                                    ON 
                                        d.deposito_insumos_id = i.insumos_id

                                    INNER JOIN 
                                        estoques e
                                    ON 
                                        d.deposito_estoque_id = e.estoques_id

                                    WHERE
                                        c.compras_num_nf = {$num_nf} and (
                                        i.insumos_nome LIKE '%{$txt_pesquisa_compras}%')

                                        ORDER BY compras_data_upload ASC 
                                        LIMIT $inicio_compras,$quantidade_registros_compras";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr class="tabela_dados">
                        <td><?=$dados["compras_id"]?></td>
                        <td><?=$dados["insumos_nome"]?></td>
                        <td><?=$dados["fornecedores_razao_social"]?></td>
                        <td><?=$dados["compras_num_nf"]?></td>
                        <td><a target="_blank" href="<?=$dados['compras_caminho']?>"><?=$dados["compras_nome"]?></a></td>
                        <td><?php echo date("d/m/Y H:i", strtotime($dados['compras_data_upload']));?></td>
                        <td><?=$dados["estoques_nome"]?></td>
                        <td>
                            <a href="index.php?menuop=compra_detalhes&numNotaFiscal=<?=$dados["compras_num_nf"]?>&insumoId=<?=$dados['insumos_id']?>">Ver Detalhes</a>
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
                                            compras_id
                                        FROM 
                                            compras 
                                        WHERE
                                            compras_num_nf = {$num_nf}";
                    $queryTotalInsumos = mysqli_query($conexao,$sqlTotalInsumos) or die(mysqli_error($conexao));

                    $numTotalInsumos = mysqli_num_rows($queryTotalInsumos);
                    $totalPaginasInsumos = ceil($numTotalInsumos/$quantidade_registros_compras);
                    
                    echo "<a href=\"?menuop=compra_por_nf&numNotaFiscal=$num_nf&pagina_compras=1\">Início</a> ";

                    if ($pagina_compras>6) {
                        ?>
                            <a href="?menuop=compra_por_nf&numNotaFiscal=<?=$num_nf?>&pagina_compras=<?php echo $pagina_compras-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasInsumos;$i++){

                        if ($i >= ($pagina_compras) && $i <= ($pagina_compras+5)) {
                            
                            if ($i==$pagina_compras) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=compra_por_nf&numNotaFiscal=$num_nf&pagina_compras=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina_compras<($totalPaginasInsumos-5)) {
                        ?>
                            <a href="?menuop=compra_por_nf&numNotaFiscal=<?=$num_nf?>&pagina_compras=<?php echo $pagina_compras+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=compra_por_nf&numNotaFiscal=$num_nf&pagina_compras=$totalPaginasInsumos\">Fim</a>";
                ?>
            </div>
    </div>
</section>