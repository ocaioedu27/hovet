<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Depósito</h3>
                <a href="index.php?menuop=cadastro_deposito">
                    <button class="btn">Inserir</button>
                </a>
                <div class="dropdown">
                    <a href="#">
                        <button class="btn">Retirar</button>
                    </a>
                    <div class="dropdown-content">
                        <ul>
                            <li>
                                <a href="index.php?menuop=cadastro_dispensario">Mover para o dispensário</a>
                                <a href="#">Permutar</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <form action="index.php?menuop=deposito" method="post" class="form_buscar">
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
            <table id="tabela_listar">
                <thead>
                    <tr>
                        <th>Operações</th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Unidade</th>
                        <th>Validade</th>
                        <th>Dias para o vencimento</th>
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
                                    i.insumos_nome,
                                    i.insumos_unidade,
                                    datediff(d.deposito_validade, curdate()) as diasParaVencimentodeposito
                                    FROM deposito d 
                                    INNER JOIN insumos i 
                                    ON d.deposito_insumos_id = i.insumos_id 
                                    WHERE
                                        d.deposito_id='{$txt_pesquisa_deposito}' or
                                        i.insumos_nome LIKE '%{$txt_pesquisa_deposito}%' or
                                        i.insumos_unidade LIKE '%{$txt_pesquisa_deposito}%' or
                                        d.deposito_qtd LIKE '%{$txt_pesquisa_deposito}%' or
                                        d.deposito_validade LIKE '%{$txt_pesquisa_deposito}%'
                                        ORDER BY insumos_nome ASC 
                                        LIMIT $inicio_deposito,$quantidade_registros_deposito";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr>
                        <td class="operacoes">
                            <a href="index.php?menuop=excluir_deposito&idInsumodeposito=<?=$dados["deposito_id"]?>"
                                class="confirmaDelete">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
                        <td><?=$dados["deposito_id"]?></td>
                        <td><?=$dados["insumos_nome"]?></td>
                        <td><?=$dados["deposito_qtd"]?></td>
                        <td><?=$dados["insumos_unidade"]?></td>
                        <td><?=$dados["validadedeposito"]?></td>
                        <td <?php 
                                $dias = ['30','45'];
 
                                if($dados["diasParaVencimentodeposito"] <= $dias[0]){                                    
                                ?> class="vermelho" <?php
                                } else if($dados["diasParaVencimentodeposito"] <= $dias[1]){
                                    ?> class="amarelo" <?php
                                } else if($dados["diasParaVencimentodeposito"] > $dias[1]){
                                    ?> class="verde" <?php
                                } 
                                ?>><?php if ($dados["diasParaVencimentodeposito"] <= 0){
                                    echo "INSUMO VENCIDO!";
                                } else{
                                    echo $dados["diasParaVencimentodeposito"] . " dia(s) para o vencimento";
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
                    $sqlTotaldeposito = "SELECT deposito_id FROM deposito";
                    $queryTotaldeposito = mysqli_query($conexao,$sqlTotaldeposito) or die(mysqli_error($conexao));

                    $numTotaldeposito = mysqli_num_rows($queryTotaldeposito);
                    $totalPaginasdeposito = ceil($numTotaldeposito/$quantidade_registros_deposito);
                    
                    echo "<a href=\"?menuop=deposito&pagina_deposito=1\">Início</a> ";

                    if ($pagina_deposito>6) {
                        ?>
                            <a href="?menuop=deposito?pagina_deposito=<?php echo $pagina_deposito-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasdeposito;$i++){

                        if ($i >= ($pagina_deposito) && $i <= ($pagina_deposito+5)) {
                            
                            if ($i==$pagina_deposito) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=deposito&pagina_deposito=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina_deposito<($totalPaginasdeposito-5)) {
                        ?>
                            <a href="?menuop=deposito?pagina_deposito=<?php echo $pagina_deposito+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=deposito&pagina_deposito=$totalPaginasdeposito\">Fim</a>";
                ?>
            </div>
        </div>
    </div>
</section>