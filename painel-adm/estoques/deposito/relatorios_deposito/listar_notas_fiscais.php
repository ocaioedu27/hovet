<section class="painel_insumos">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Notas Fiscais</h3>
            </div>
            <div>
                <form action="index.php?menuop=listar_notas_fiscais" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_notas_fiscais" placeholder="Buscar">
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
                        <th>Nota Fiscal</th>
                        <th>Insumo</th>
                        <th>Data upload</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_insumos = 10;

                        $pagina_lista_notas_fiscais = (isset($_GET['pagina_lista_notas_fiscais']))?(int)$_GET['pagina_lista_notas_fiscais']:1;

                        $inicio_insumos = ($quantidade_registros_insumos * $pagina_lista_notas_fiscais) - $quantidade_registros_insumos;

                        $txt_pesquisa_notas_fiscais = (isset($_POST["txt_pesquisa_notas_fiscais"]))?$_POST["txt_pesquisa_notas_fiscais"]:"";

                        $sql = "SELECT 
                                    i.insumos_nome, 
                                    n.notas_fiscais_nome,
                                    n.notas_fiscais_id,
                                    n.notas_fiscais_caminho,
                                    n.notas_fiscais_data_upload
                                    FROM notas_fiscais n
                                    INNER JOIN insumos i
                                    on n.notas_fiscais_insumos_id = i.insumos_id
                                    WHERE
                                        n.notas_fiscais_insumos_id='{$txt_pesquisa_notas_fiscais}' or
                                        i.insumos_nome LIKE '%{$txt_pesquisa_notas_fiscais}%' or
                                        n.notas_fiscais_nome LIKE '%{$txt_pesquisa_notas_fiscais}%' or
                                        n.notas_fiscais_data_upload LIKE '%{$txt_pesquisa_notas_fiscais}%'
                                        ORDER BY notas_fiscais_data_upload ASC 
                                        LIMIT $inicio_insumos,$quantidade_registros_insumos";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr class="tabela_dados">
                        <td><?=$dados["notas_fiscais_id"]?></td>
                        <td><a target="_blank" href="<?=$dados['notas_fiscais_caminho']?>"><?=$dados["notas_fiscais_nome"]?></a></td>
                        <td><?=$dados["insumos_nome"]?></td>
                        <td><?php echo date("d/m/Y H:i", strtotime($dados['notas_fiscais_data_upload']));?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
            <div class="paginacao">
                <?php
                    $sqlTotalInsumos = "SELECT notas_fiscais_id FROM notas_fiscais";
                    $queryTotalInsumos = mysqli_query($conexao,$sqlTotalInsumos) or die(mysqli_error($conexao));

                    $numTotalInsumos = mysqli_num_rows($queryTotalInsumos);
                    $totalPaginasInsumos = ceil($numTotalInsumos/$quantidade_registros_insumos);
                    
                    echo "<a href=\"?menuop=listar_notas_fiscais&pagina_lista_notas_fiscais=1\">Início</a> ";

                    if ($pagina_lista_notas_fiscais>6) {
                        ?>
                            <a href="?menuop=listar_notas_fiscais?pagina_lista_notas_fiscais=<?php echo $pagina_lista_notas_fiscais-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasInsumos;$i++){

                        if ($i >= ($pagina_lista_notas_fiscais) && $i <= ($pagina_lista_notas_fiscais+5)) {
                            
                            if ($i==$pagina_lista_notas_fiscais) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=listar_notas_fiscais&pagina_lista_notas_fiscais=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina_lista_notas_fiscais<($totalPaginasInsumos-5)) {
                        ?>
                            <a href="?menuop=listar_notas_fiscais?pagina_lista_notas_fiscais=<?php echo $pagina_lista_notas_fiscais+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=listar_notas_fiscais&pagina_lista_notas_fiscais=$totalPaginasInsumos\">Fim</a>";
                ?>
            </div>
    </div>
</section>