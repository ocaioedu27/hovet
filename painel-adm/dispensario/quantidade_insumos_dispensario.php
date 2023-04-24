<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Quantidade dos insumos cadastrados no Dispensário</h3>
            </div>
            <div>
                <form action="index.php?menuop=quantidade_insumos_dispensario" method="post" class="form_buscar">
                    <span class="span_select_qtd">Selecione o Insumo</span>
                    <select name="txt_pesquisa_dispensario">
                        <option> - selecione - </option>
                        <?php
                            $sql_listar = "SELECT DISTINCT i.insumos_id, i.insumos_nome 
                            FROM dispensario disp
                            INNER JOIN deposito dep
                            ON disp.dispensario_deposito_id = dep.deposito_id
                            INNER JOIN insumos i
                            ON dep.deposito_insumos_id = i.insumos_id";
                            $result_insumos = mysqli_query($conexao,$sql_listar) or die("//Dispensario/quantidade_insumos/ - Erro ao executar a consulta! " . mysqli_error($conexao));
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
                        <th>Local</th>
                        <th>Validade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_dispensario = 10;

                        $pagina_dispensario = (isset($_GET['pagina_dispensario']))?(int)$_GET['pagina_dispensario']:1;

                        $inicio_dispensario = ($quantidade_registros_dispensario * $pagina_dispensario) - $quantidade_registros_dispensario;

                        $txt_pesquisa_dispensario = (isset($_POST["txt_pesquisa_dispensario"]))?$_POST["txt_pesquisa_dispensario"]:"";

                        $sql = "SELECT
                                    d.dispensario_id, 
                                    d.dispensario_qtd,
                                    date_format(d.dispensario_validade, '%d/%m/%Y') as validadedispensario,
                                    i.insumos_nome,
                                    lcd.local_nome
                                    FROM dispensario d 
                                    INNER JOIN deposito dep 
                                    ON d.dispensario_deposito_id = dep.deposito_id
                                    INNER JOIN insumos i
                                    ON dep.deposito_insumos_id = i.insumos_id
                                    INNER JOIN local_dispensario lcd 
                                    ON d.dispensario_local_id = lcd.local_id 
                                    WHERE
                                        i.insumos_nome='{$txt_pesquisa_dispensario}'
                                        ORDER BY insumos_nome ASC 
                                        LIMIT $inicio_dispensario,$quantidade_registros_dispensario";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr>
                        <td><?=$dados["dispensario_id"]?></td>
                        <td><?=$dados["insumos_nome"]?></td>
                        <td><?=$dados["dispensario_qtd"]?></td>
                        <td><?=$dados["local_nome"]?></td>
                        <td><?=$dados["validadedispensario"]?></td>
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
                        // $insumo_selecionado = (isset($_POST["txt_pesquisa_dispensario"]))?$_POST["txt_pesquisa_dispensario"]:"";
                        $insumo_selecionado = $_POST['txt_pesquisa_dispensario'];
                        if ($insumo_selecionado == " - selecione - ") {
                            $insumo_selecionado = "";
                        }
                        
                        $sql_qtd = "SELECT 
                            sum(d.dispensario_qtd) as dispensario_qtd_insumo
                            FROM dispensario d
                            INNER JOIN deposito dep
                            ON d.dispensario_deposito_id = dep.deposito_id
                            INNER JOIN insumos i
                            ON dep.deposito_insumos_id = i.insumos_id
                            where
                            i.insumos_nome = '{$insumo_selecionado}'";
                        
                        $resultado_qtd = mysqli_query($conexao, $sql_qtd) or die("//dispensario/quantidade_insumos_dispensario/calcula_qtd - erro ao realizar a consulta: " . mysqli_error($conexao));

                        $qtd_processada = mysqli_fetch_assoc($resultado_qtd);

                        if ($qtd_processada['dispensario_qtd_insumo'] == null) {
                            $qtd_processada['dispensario_qtd_insumo'] = 'Nenhum insumo selecionado'; 
                        }
                    ?>
                    <tr>
                        <td><?=$qtd_processada['dispensario_qtd_insumo']?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="paginacao">
            <?php
                $sqlTotaldispensario = "SELECT dispensario_id FROM dispensario";
                $queryTotaldispensario = mysqli_query($conexao,$sqlTotaldispensario) or die(mysqli_error($conexao));

                $numTotaldispensario = mysqli_num_rows($queryTotaldispensario);
                $totalPaginasdispensario = ceil($numTotaldispensario/$quantidade_registros_dispensario);
                
                echo "<a href=\"?menuop=quantidade_insumos_dispensario&pagina_qtd_dispensario=1\">Início</a> ";

                if ($pagina_dispensario>6) {
                    ?>
                        <a href="?menuop=quantidade_insumos_dispensario?pagina_qtd_dispensario=<?php echo $pagina_dispensario-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasdispensario;$i++){

                    if ($i >= ($pagina_dispensario) && $i <= ($pagina_dispensario+5)) {
                        
                        if ($i==$pagina_dispensario) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=quantidade_insumos_dispensario&pagina_qtd_dispensario=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina_dispensario<($totalPaginasdispensario-5)) {
                    ?>
                        <a href="?menuop=quantidade_insumos_dispensario?pagina_qtd_dispensario=<?php echo $pagina_dispensario+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=depoquantidade_insumos_dispensariosito&pagina_qtd_dispensario=$totalPaginasdispensario\">Fim</a>";
            ?>
        </div>
    </div>
</section>