<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Dispensário</h3>
                <a href="index.php?menuop=cadastro_dispensario">
                    <button class="btn">Inserir</button>
                </a>
                <a href="#">
                    <button class="btn">Retirar</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=dispensario" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_dispensario" placeholder="Buscar">
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
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Validade</th>
                        <th>Local</th>
                        <th>Dias para o vencimento</th>
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
                                    d.dispensario_Qtd,
                                    date_format(d.dispensario_Validade, '%d/%m/%Y') as validadeDispensario,
                                    i.nome,
                                    datediff(d.dispensario_Validade, curdate()) as diasParaVencimentoDispensario
                                    FROM dispensario d 
                                    INNER JOIN insumos i 
                                    ON d.dispensario_InsumosID = i.id 
                                    WHERE
                                        d.dispensario_id='{$txt_pesquisa_dispensario}' or
                                        i.nome LIKE '%{$txt_pesquisa_dispensario}%' or
                                        d.dispensario_Qtd LIKE '%{$txt_pesquisa_dispensario}%' or
                                        d.dispensario_Validade LIKE '%{$txt_pesquisa_dispensario}%'
                                        ORDER BY nome ASC 
                                        LIMIT $inicio_dispensario,$quantidade_registros_dispensario";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr><!--
                        <td class="operacoes">
                            <a href="index.php?menuop=excluir_dispensario&idInsumodispensario=<?=$dados["dispensario_id"]?>"
                                class="confirmaDelete">
                                <button class="btn">

                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>-->
                        <td><?=$dados["dispensario_id"]?></td>
                        <td><?=$dados["nome"]?></td>
                        <td><?=$dados["dispensario_Qtd"]?></td>
                        <td><?=$dados["validadeDispensario"]?></td>
                        <td <?php 
                                $dias = ['30','45'];
 
                                if($dados["diasParaVencimentoDispensario"] <= $dias[0]){                                    
                                ?> class="vermelho" <?php
                                } else if($dados["diasParaVencimentoDispensario"] <= $dias[1]){
                                    ?> class="amarelo" <?php
                                } else if($dados["diasParaVencimentoDispensario"] > $dias[1]){
                                    ?> class="verde" <?php
                                } 
                                ?>><?php if ($dados["diasParaVencimentoDispensario"] <= 0){
                                    echo "INSUMO VENCIDO!";
                                } else{
                                    echo $dados["diasParaVencimentoDispensario"] . " dia(s) para o vencimento";
                                }
                                ?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <div class="paginacao">
                <?php
                    $sqlTotaldispensario = "SELECT dispensario_id FROM dispensario";
                    $queryTotaldispensario = mysqli_query($conexao,$sqlTotaldispensario) or die(mysqli_error($conexao));

                    $numTotaldispensario = mysqli_num_rows($queryTotaldispensario);
                    $totalPaginasdispensario = ceil($numTotaldispensario/$quantidade_registros_dispensario);
                    
                    echo "<a href=\"?menuop=dispensario&pagina_dispensario=1\">Início</a> ";

                    if ($pagina_dispensario>6) {
                        ?>
                            <a href="?menuop=dispensario?pagina_dispensario=<?php echo $pagina_dispensario-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasdispensario;$i++){

                        if ($i >= ($pagina_dispensario) && $i <= ($pagina_dispensario+5)) {
                            
                            if ($i==$pagina_dispensario) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=dispensario&pagina_dispensario=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina_dispensario<($totalPaginasdispensario-5)) {
                        ?>
                            <a href="?menuop=dispensario?pagina_dispensario=<?php echo $pagina_dispensario+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=dispensario&pagina_dispensario=$totalPaginasdispensario\">Fim</a>";
                ?>
            </div>
        </div>
    </div>
</section>