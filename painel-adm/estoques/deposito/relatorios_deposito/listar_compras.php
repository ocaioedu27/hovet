<section class="painel_insumos">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Todas as Compras</h3>
            </div>
            <div>
                <form action="index.php?menuop=compras" method="post" class="form_buscar">
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
                        <th>Número da Nota Fiscal</th>
                        <th>Nota Fiscal</th>
                        <th>Insumo</th>
                        <th>Data upload</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_compras = 10;

                        $pagina_compras = (isset($_GET['pagina_compras']))?(int)$_GET['pagina_compras']:1;

                        $inicio_compras = ($quantidade_registros_compras * $pagina_compras) - $quantidade_registros_compras;

                        $txt_pesquisa_compras = (isset($_POST["txt_pesquisa_compras"]))?$_POST["txt_pesquisa_compras"]:"";

                        $sql = "SELECT 
                                    i.insumos_nome, 
                                    n.compras_nome,
                                    n.compras_num_nf,
                                    n.compras_id,
                                    n.compras_caminho,
                                    n.compras_data_upload
                                    FROM compras n
                                    INNER JOIN insumos i
                                    on n.compras_insumos_id = i.insumos_id
                                    WHERE
                                        n.compras_insumos_id='{$txt_pesquisa_compras}' or
                                        i.insumos_nome LIKE '%{$txt_pesquisa_compras}%' or
                                        n.compras_nome LIKE '%{$txt_pesquisa_compras}%' or
                                        n.compras_data_upload LIKE '%{$txt_pesquisa_compras}%'
                                        ORDER BY compras_data_upload ASC 
                                        LIMIT $inicio_compras,$quantidade_registros_compras";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr class="tabela_dados">
                        <td><?=$dados["compras_id"]?></td>
                        <td><?=$dados["compras_num_nf"]?></td>
                        <td><a target="_blank" href="<?=$dados['compras_caminho']?>"><?=$dados["compras_nome"]?></a></td>
                        <td><?=$dados["insumos_nome"]?></td>
                        <td><?php echo date("d/m/Y H:i", strtotime($dados['compras_data_upload']));?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
            <div class="paginacao">
                <?php
                    $sqlTotalInsumos = "SELECT compras_id FROM compras";
                    $queryTotalInsumos = mysqli_query($conexao,$sqlTotalInsumos) or die(mysqli_error($conexao));

                    $numTotalInsumos = mysqli_num_rows($queryTotalInsumos);
                    $totalPaginasInsumos = ceil($numTotalInsumos/$quantidade_registros_compras);
                    
                    echo "<a href=\"?menuop=compras&pagina_compras=1\">Início</a> ";

                    if ($pagina_compras>6) {
                        ?>
                            <a href="?menuop=compras?pagina_compras=<?php echo $pagina_compras-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasInsumos;$i++){

                        if ($i >= ($pagina_compras) && $i <= ($pagina_compras+5)) {
                            
                            if ($i==$pagina_compras) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=compras&pagina_compras=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina_compras<($totalPaginasInsumos-5)) {
                        ?>
                            <a href="?menuop=compras?pagina_compras=<?php echo $pagina_compras+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=compras&pagina_compras=$totalPaginasInsumos\">Fim</a>";
                ?>
            </div>
    </div>
</section>