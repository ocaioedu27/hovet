<section class="painel_insumos">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Todos os Insumos</h3>
                <a href="index.php?menuop=cadastro_insumo">
                    <button class="btn">Cadastrar</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=insumos" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_insumos" placeholder="Buscar">
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
                        <th>Operações</th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Unidade</th>
                        <th>Tipo de Insumo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_insumos = 10;

                        $pagina_insumos = (isset($_GET['pagina_insumos']))?(int)$_GET['pagina_insumos']:1;

                        $inicio_insumos = ($quantidade_registros_insumos * $pagina_insumos) - $quantidade_registros_insumos;

                        $txt_pesquisa_insumos = (isset($_POST["txt_pesquisa_insumos"]))?$_POST["txt_pesquisa_insumos"]:"";

                        $sql = "SELECT 
                        id,
                        nome,
                        unidade,
                        insumo_tipo

                        FROM insumos 

                        WHERE
                            id='{$txt_pesquisa_insumos}' or
                            nome LIKE '%{$txt_pesquisa_insumos}%' or
                            insumo_tipo LIKE '%{$txt_pesquisa_insumos}%'
                            ORDER BY nome ASC 
                            LIMIT $inicio_insumos,$quantidade_registros_insumos";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr class="tabela_dados">
                        <td class="operacoes">
                            <a href="index.php?menuop=editar_insumo&idInsumo=<?=$dados["id"]?>" class="confirmaEdit">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                            <a href="index.php?menuop=excluir_insumo&idInsumo=<?=$dados["id"]?>" class="confirmaDelete">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
                        <td><?=$dados["id"]?></td>
                        <td><?=$dados["nome"]?></td>
                        <td><?=$dados["unidade"]?></td>
                        <td><?=$dados["insumo_tipo"]?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <div class="paginacao">
                <?php
                    $sqlTotalInsumos = "SELECT id FROM insumos";
                    $queryTotalInsumos = mysqli_query($conexao,$sqlTotalInsumos) or die(mysqli_error($conexao));

                    $numTotalInsumos = mysqli_num_rows($queryTotalInsumos);
                    $totalPaginasInsumos = ceil($numTotalInsumos/$quantidade_registros_insumos);
                    
                    echo "<a href=\"?menuop=insumos&pagina_insumos=1\">Início</a> ";

                    if ($pagina_insumos>6) {
                        ?>
                            <a href="?menuop=insumos?pagina_insumos=<?php echo $pagina_insumos-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasInsumos;$i++){

                        if ($i >= ($pagina_insumos) && $i <= ($pagina_insumos+5)) {
                            
                            if ($i==$pagina_insumos) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=insumos&pagina_insumos=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina_insumos<($totalPaginasInsumos-5)) {
                        ?>
                            <a href="?menuop=insumos?pagina_insumos=<?php echo $pagina_insumos+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=insumos&pagina_insumos=$totalPaginasInsumos\">Fim</a>";
                ?>
            </div>
        </div>
    </div>
</section>