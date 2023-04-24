<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Quantidade dos insumos cadastrados no Depósito</h3>
            </div>
            <div>
                <form action="index.php?menuop=quantidade_insumos_deposito" method="post" class="form_buscar">
                    <span class="span_select_qtd">Selecione o Insumo</span>
                    <select name="txt_pesquisa_deposito">
                        <option> - selecione - </option>
                        <?php
                            $sql_listar = "SELECT DISTINCT i.insumos_id, i.insumos_nome 
                            FROM deposito d
                            INNER JOIN insumos i
                            ON d.deposito_insumos_id = i.insumos_id";
                            $result_insumos = mysqli_query($conexao,$sql_listar) or die("//Deposito/quantidade_insumos/ - Erro ao executar a consulta! " . mysqli_error($conexao));
                            while($insumos = mysqli_fetch_assoc($result_insumos)){
                        ?>
                        <option><?=$insumos["insumos_nome"]?></option>
    
                        <?php
                            }
                        ?>
                    </select>
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
                                        i.insumos_nome='{$txt_pesquisa_deposito}'
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
        <div class="tabelas">
            <table class="tabela_listar qtd_total">
                <thead>
                    <tr>
                        <th>Quantidade total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // $insumo_selecionado = (isset($_POST["txt_pesquisa_deposito"]))?$_POST["txt_pesquisa_deposito"]:"";
                        $insumo_selecionado = $_POST['txt_pesquisa_deposito'];
                        if ($insumo_selecionado == " - selecione - ") {
                            $insumo_selecionado = "";
                        }
                        
                        $sql_qtd = "SELECT 
                            sum(d.deposito_qtd) as deposito_qtd_insumo
                            FROM deposito d 
                            INNER JOIN insumos i
                            ON d.deposito_insumos_id = i.insumos_id
                            WHERE 
                            i.insumos_nome='{$insumo_selecionado}'";
                        
                        $resultado_qtd = mysqli_query($conexao, $sql_qtd) or die("//Deposito/quantidade_insumos_deposito/calcula_qtd - erro ao realizar a consulta: " . mysqli_error($conexao));

                        $qtd_processada = mysqli_fetch_assoc($resultado_qtd);

                        if ($qtd_processada['deposito_qtd_insumo'] == null) {
                            $qtd_processada['deposito_qtd_insumo'] = 'Nenhum insumo selecionado'; 
                        }
                    ?>
                    <tr>
                        <td><?=$qtd_processada['deposito_qtd_insumo']?></td>
                    </tr>
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