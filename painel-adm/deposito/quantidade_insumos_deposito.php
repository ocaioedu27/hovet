<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Quantidade dos insumos cadastrados no Depósito</h3>
            </div>
            <div>
                <form action="index.php?menuop=quantidade_insumos_deposito" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_deposito" placeholder="Buscar">
                    <button type="submit" class="btn">
                        <span class="icon">
                            <ion-icon name="search-outline"></ion-icon>
                        </span>
                    </button>
                </form>
            </div>
        </div>
        <div class="tabelas">
            <table class="tabela_listar">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Validade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_deposito = 10;

                        $pagina_deposito = (isset($_GET['pagina_deposito']))?(int)$_GET['pagina_deposito']:1;

                        $inicio_deposito = ($quantidade_registros_deposito * $pagina_deposito) - $quantidade_registros_deposito;

                        $txt_pesquisa_deposito = (isset($_POST["txt_pesquisa_deposito"]))?$_POST["txt_pesquisa_deposito"]:"";

                        $sql = "SELECT
                                    d.deposito_id, 
                                    d.deposito_qtd,
                                    date_format(d.deposito_validade, '%d/%m/%Y') as validadedeposito,
                                    i.insumos_nome
                                    FROM deposito d 
                                    INNER JOIN insumos i 
                                    ON d.deposito_insumos_id = i.insumos_id 
                                    WHERE
                                        d.deposito_id='{$txt_pesquisa_deposito}' or
                                        i.insumos_nome LIKE '%{$txt_pesquisa_deposito}%' or
                                        d.deposito_qtd LIKE '%{$txt_pesquisa_deposito}%' or
                                        d.deposito_validade LIKE '%{$txt_pesquisa_deposito}%'
                                        ORDER BY insumos_nome ASC 
                                        LIMIT $inicio_deposito,$quantidade_registros_deposito";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr>
                        <td><?=$dados["deposito_id"]?></td>
                        <td><?=$dados["insumos_nome"]?></td>
                        <td><?=$dados["deposito_qtd"]?></td>
                        <td><?=$dados["validadedeposito"]?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="paginacao">
            <?php
                $sqlTotaldeposito = "SELECT deposito_id FROM deposito";
                $queryTotaldeposito = mysqli_query($conexao,$sqlTotaldeposito) or die(mysqli_error($conexao));

                $numTotaldeposito = mysqli_num_rows($queryTotaldeposito);
                $totalPaginasdeposito = ceil($numTotaldeposito/$quantidade_registros_deposito);
                
                echo "<a href=\"?menuop=quantidade_insumos_deposito&pagina_qtd_deposito=1\">Início</a> ";

                if ($pagina_deposito>6) {
                    ?>
                        <a href="?menuop=quantidade_insumos_deposito?pagina_qtd_deposito=<?php echo $pagina_deposito-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasdeposito;$i++){

                    if ($i >= ($pagina_deposito) && $i <= ($pagina_deposito+5)) {
                        
                        if ($i==$pagina_deposito) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=quantidade_insumos_deposito&pagina_qtd_deposito=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina_deposito<($totalPaginasdeposito-5)) {
                    ?>
                        <a href="?menuop=quantidade_insumos_deposito?pagina_qtd_deposito=<?php echo $pagina_deposito+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=depoquantidade_insumos_depositosito&pagina_qtd_deposito=$totalPaginasdeposito\">Fim</a>";
            ?>
        </div>
    </div>
</section>