<?php 

$stringList = array();


if (isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
        array_push($stringList, $valor_est);
        // print_r($valor_est);
	}

    $estoqueNomeReal = $stringList[1];
    $nome_insumo_tmp = $stringList[2];
    $nome_insumo = str_replace('_', ' ', $nome_insumo_tmp);
}

$qualInsumo = $nome_insumo;

$qualEstoque_farm = $estoqueNomeReal;



if ($qualEstoque_farm != "") {
    $qualEstoque = $qualEstoque_farm;
}


?>

<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Farmácia <?=$qualEstoque[-1]?> - <?=$nome_insumo?></h3>
                <a href="index.php?menuop=cad_farm&<?=$qualEstoque?>">
                    <button class="btn" id="operacao_cadastro">Abastecer</button>
                </a>
                <a href="index.php?menuop=doar_farmacia&<?=$qualEstoque?>">
                    <button class="btn">Doar</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=farmacia&<?=$qualEstoque?>&<?=$qualInsumo?>=1" method="post" class="form_buscar">
                    <input type="text" name="txt_search" placeholder="Buscar">
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
                        <th>Unidade</th>
                        <th>Categoria</th>
                        <th>Estoque Cadastrado</th>
                        <th>Validade</th>
                        <th>Dias para o vencimento</th>
                        <th id="th_operacoes_editar_deletar">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_farmacia = 10;

                        // echo "<br>" . $quantidade_registros_farmacia;

                        $pagina_farmacia = (isset($_GET[$qualInsumo]))?(int)$_GET[$qualInsumo]:1;

                        // echo "<br>" . $pagina_farmacia;

                        $inicio_farmacia = ($quantidade_registros_farmacia * $pagina_farmacia) - $quantidade_registros_farmacia;

                        // echo "<br>" . $inicio_farmacia;

                        $txt_search = (isset($_POST["txt_search"]))?$_POST["txt_search"]:"";

                        // echo "<br>" . $txt_search;

                        // $sql_listar = "";
                        $insumos_cads_list = array();

                        //echo "<br>" . $qualInsumo;

                        $sql = "SELECT 
                                    farm.id,
                                    farm.qtd,
                                    date_format(farm.validade, '%d/%m/%Y') AS validadefarmacia,
                                    i.nome as insumos_nome,
                                    i.unidade,
                                    i.qtd_critica,
                                    datediff(farm.validade, curdate()) AS diasParaVencimentofarmacia,
                                    es.nome as estoques_nome,
                                    es.nome_real,
                                    tp.tipo

                                    FROM farmacia farm

                                    INNER JOIN deposito deps
                                    ON farm.deposito_id = deps.id

                                    INNER JOIN insumos i
                                    ON farm.insumos_id = i.id

                                    INNER JOIN tipos_insumos tp
                                    ON tp.id = i.tipo_insumos_id

                                    INNER JOIN estoques es
                                    ON farm.estoque_id = es.id

                                    WHERE
                                    es.nome_real = '{$qualEstoque}' and i.nome = '{$qualInsumo}'

                                    ORDER BY i.nome ASC 
                                    LIMIT $inicio_farmacia,$quantidade_registros_farmacia";

                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

                        // echo "fez o select";

                        while($dados = mysqli_fetch_assoc($rs)){
                            // echo "teste";
                            $qtd_linhas_tabelas++;
                            $i = $qtd_linhas_tabelas-1;
                        
                    ?>
                    <tr>
                        <td><?=$dados["id"]?></td>
                        <td>
                            <?php
                            
                            $insumos_nome = $dados["insumos_nome"];

                            $estaNaLista = in_array($insumos_nome, $insumos_cads_list);

                            if (!$estaNaLista) {
                                array_push($insumos_cads_list,$insumos_nome);   
                            }

                            echo $insumos_nome;
                            
                            ?>
                        </td>
                        <td><?=$dados["qtd"]?></td>
                        <td><?=$dados["unidade"]?></td>
                        <td><?=$dados["tipo"]?></td>
                        <td><?=$dados["estoques_nome"]?></td>
                        <td><?=$dados["validadefarmacia"]?></td>
                        <td <?php 
                                $dias = ['30','45'];
 
                                if($dados["diasParaVencimentofarmacia"] <= $dias[0]){                                    
                                ?> class="vermelho" <?php
                                } else if($dados["diasParaVencimentofarmacia"] <= $dias[1]){
                                    ?> class="amarelo" <?php
                                } else if($dados["diasParaVencimentofarmacia"] > $dias[1]){
                                    ?> class="verde" <?php
                                } 
                                ?>><?php if ($dados["diasParaVencimentofarmacia"] <= 0){
                                    echo "INSUMO VENCIDO!";
                                } else{
                                    echo $dados["diasParaVencimentofarmacia"] . " dia(s) para o vencimento";
                                }
                                ?>
                        </td>
                        <td class="" id="td_operacoes_editar_deletar">
                            <a href="index.php?menuop=excl_farm&idInsumoFarm=<?=$dados["id"]?>"
                                class="confirmaDelete">
                                <button class="btn">

                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                        echo '<input type="hidden" id="quantidade_linhas_tabelas" value="'.$qtd_linhas_tabelas.'">';
                    ?>
                </tbody>
            </table>
        </div>
        <div class="tabelas">
            <table class="tabela_listar qtd_total">
                <thead>
                    <tr>
                        <th>Insumo</th>
                        <th>Quantidade total</th>
                        <th>Local Cadastrado</th>
                        <th>Estoque Crítico</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        
                        $i = count($insumos_cads_list)-1;
                        // var_dump( $insumos_cads_list);
                        while ($i >= 0) {
                            // echo $insumos_cads_list[$i];
                            $insumo_selecionado = $insumos_cads_list[$i];
                            $i--;
                            
                            $sql_qtd = "SELECT 
                                sum(farm.qtd) as farm_qtd_insumo,
                                i.nome as insumos_nome,
                                i.qtd_critica,
                                es.nome as estoques_nome
                            FROM 
                                farmacia farm 
                            INNER JOIN 
                                insumos i
                            ON 
                                farm.insumos_id = i.id
                            INNER JOIN 
                                estoques es
                            ON 
                                es.id = farm.estoque_id
                            WHERE 
                                es.nome_real = '{$qualEstoque}' and i.nome='{$insumo_selecionado}'";
                        
                            $resultado_qtd = mysqli_query($conexao, $sql_qtd) or die("//farmacia/quantidade_insumos_farmacia/calcula_qtd - erro ao realizar a consulta: " . mysqli_error($conexao));

                            while ($dados = mysqli_fetch_assoc($resultado_qtd)) {
                                // var_dump($dados);
                        
                    ?>
                    <tr>
                        <td><?=$dados['insumos_nome']?></td>
                        <td><?=$dados['farm_qtd_insumo']?></td>
                        <td><?=$dados['estoques_nome']?></td>
                        <td class="<?php
                        
                        $qtd_cadastrada = $dados["farm_qtd_insumo"];
                        $qtd_critica = $dados["qtd_critica"];
                        $qtd_toleravel = $qtd_critica+($qtd_critica*20/100);

                        $class_bg = "";
                        $msg_alert = "";

                        // echo "toleravel " . $qtd_toleravel;

                        if ($qtd_cadastrada <= $qtd_critica) {
                            $class_bg = "vermelho";
                            $msg_alert = "Nível Crítico";
                            echo $class_bg;
                        } elseif ($qtd_cadastrada >= $qtd_toleravel) {
                            $class_bg = "amarelo";
                            $msg_alert = "Nível Tolerável";
                            echo $class_bg;
                        } else {
                            $class_bg = "verde";
                            $msg_alert = "Nível Normal";
                            echo $class_bg;
                        }

                        ?>">
                            <?=$msg_alert?>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="paginacao">
            <?php
                $sqlTotalfarmacia = "SELECT 
                                        farm.id 
                                    FROM 
                                        farmacia farm
                                    INNER JOIN 
                                        estoques e
                                    ON 
                                        e.id = farm.estoque_id
                                    WHERE 
                                        e.nome_real='{$qualEstoque}'";

                $queryTotalfarmacia = mysqli_query($conexao,$sqlTotalfarmacia) or die(mysqli_error($conexao));

                $numTotalfarmacia = mysqli_num_rows($queryTotalfarmacia);
                $totalPaginasfarmacia = ceil($numTotalfarmacia/$quantidade_registros_farmacia);
                
                echo "<a href=\"?menuop=farmacia&" . $qualEstoque ."&" . $qualInsumo . "=1\">Início</a> ";

                if ($pagina_farmacia>6) {
                    ?>
                        <a href="?menuop=farmacia&<?=$qualEstoque?>&<?=$qualInsumo?>=<?php echo $pagina_farmacia-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasfarmacia;$i++){

                    if ($i >= ($pagina_farmacia) && $i <= ($pagina_farmacia+5)) {
                        
                        if ($i==$pagina_farmacia) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=farmacia&" . $qualEstoque . "&" . $qualInsumo . "=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina_farmacia<($totalPaginasfarmacia-5)) {
                    ?>
                        <a href="?menuop=farmacia&<?=$qualEstoque?>&<?=$qualInsumo?>=<?php echo $pagina_farmacia+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=farmacia&" . $qualEstoque . "&" . $qualInsumo ."=$totalPaginasfarmacia\">Fim</a>";
            ?>
        </div>
    </div>
</section>