<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Estoque de Insumos</h3>
                <a href="index.php?menuop=cadastro_deposito">
                    <button class="btn">Inserir</button>
                </a>
                <a href="#">
                    <button class="btn">Retirar</button>
                </a>
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
                        <th>Tipo de Insumo</th>
                        <th>Setor</th>
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
                                    d.id, d.nome, d.quantidade, date_format(d.validade, '%d/%m/%Y') AS validade, tpIn.tipo, s.setor, datediff(d.validade, curdate()) as diasParaVencimento
                                    FROM deposito AS d 
                                    INNER JOIN tipos_insumos AS tpIn 
                                    ON d.tipo_tipoInsumos_ID = tpIn.id 
                                    INNER JOIN setores AS s ON d.setor_setorID = s.id 
                                    WHERE
                                        d.id='{$txt_pesquisa_deposito}' or
                                        d.nome LIKE '%{$txt_pesquisa_deposito}%' or
                                        tpIn.id LIKE '%{$txt_pesquisa_deposito}%' or
                                        s.setor LIKE '%{$txt_pesquisa_deposito}%'
                                        ORDER BY nome ASC 
                                        LIMIT $inicio_deposito,$quantidade_registros_deposito";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr>
                        <td class="operacoes">
                            <!--
                            <a href="index.php?menuop=editar_deposito&idInsumoDeposito=<?=$dados["id"]?>"
                                class="confirmaEdit">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                            -->
                            <a href="index.php?menuop=excluir_deposito&idInsumoDeposito=<?=$dados["id"]?>"
                                class="confirmaDelete">
                                <button class="btn">

                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
                        <td><?=$dados["id"]?></td>
                        <td><?=$dados["nome"]?></td>
                        <td><?=$dados["quantidade"]?></td>
                        <td><?=$dados["tipo"]?></td>
                        <td><?=$dados["setor"]?></td>
                        <td><?=$dados["validade"]?></td>
                        <td <?php 
                                $dias = ['30','45'];
 
                                if($dados["diasParaVencimento"] <= $dias[0]){                                    
                                ?> class="vermelho" <?php
                                } else if($dados["diasParaVencimento"] <= $dias[1]){
                                    ?> class="amarelo" <?php
                                } else if($dados["diasParaVencimento"] > $dias[1]){
                                    ?> class="verde" <?php
                                } 
                                ?>><?php if ($dados["diasParaVencimento"] <= 0){
                                    echo "INSUMO VENCIDO!";
                                } else{
                                    echo $dados["diasParaVencimento"] . " dia(s) para o vencimento";
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
                    $sqlTotalDeposito = "SELECT id FROM deposito";
                    $queryTotalDeposito = mysqli_query($conexao,$sqlTotalDeposito) or die(mysqli_error($conexao));

                    $numTotalDeposito = mysqli_num_rows($queryTotalDeposito);
                    $totalPaginasDeposito = ceil($numTotalDeposito/$quantidade_registros_deposito);
                    
                    echo "<a href=\"?menuop=deposito&pagina_deposito=1\">Início</a> ";

                    if ($pagina_deposito>6) {
                        ?>
                            <a href="?menuop=deposito?pagina_deposito=<?php echo $pagina_deposito-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasDeposito;$i++){

                        if ($i >= ($pagina_deposito) && $i <= ($pagina_deposito+5)) {
                            
                            if ($i==$pagina_deposito) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=deposito&pagina_deposito=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina_deposito<($totalPaginasDeposito-5)) {
                        ?>
                            <a href="?menuop=deposito?pagina_deposito=<?php echo $pagina_deposito+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=deposito&pagina_deposito=$totalPaginasDeposito\">Fim</a>";
                ?>
            </div>
        </div>
    </div>
</section>