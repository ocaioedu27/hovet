<?php 

// echo $qualEstoque;

// $qualEstoque = (isset($_POST["dispensario"]))?$_POST["dispensario"]:"";

// $qualEstoque_dep = $_POST['deposito'];
$stringList = array();


if (   isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
        array_push($stringList, $valor_est);
        // print_r($valor_est);
	}

    $estoqueNomeReal = $stringList[1];
    $nome_insumo = $stringList[2];
    
    // echo "<br>Nome real: $estoqueNomeReal<br>Nome do insumo: $nome_insumo";
}

$qualInsumo = $nome_insumo;

$qualEstoque_disp = $estoqueNomeReal;



if ($qualEstoque_disp != "") {
    $qualEstoque = $qualEstoque_disp;
}


?>

<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Dispensário <?=$qualEstoque[-1]?></h3>
                <a href="index.php?menuop=cadastro_dispensario&<?=$qualEstoque?>">
                    <button class="btn" id="operacao_cadastro">Inserir</button>
                </a>
                <a href="index.php?menuop=solicitar_dispensario&<?=$qualEstoque?>">
                    <button class="btn">Solicitar insumos</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=dispensario&<?=$qualEstoque?>&<?=$qualInsumo?>=1" method="post" class="form_buscar">
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
                        <th id="th_operacoes_editar_deletar">Operações</th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Unidade</th>
                        <th>Categoria</th>
                        <th>Estoque Cadastrado</th>
                        <th>Validade</th>
                        <th>Local</th>
                        <th>Dias para o vencimento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_dispensario = 10;

                        // echo "<br>" . $quantidade_registros_dispensario;

                        $pagina_dispensario = (isset($_GET[$qualInsumo]))?(int)$_GET[$qualInsumo]:1;

                        // echo "<br>" . $pagina_dispensario;

                        $inicio_dispensario = ($quantidade_registros_dispensario * $pagina_dispensario) - $quantidade_registros_dispensario;

                        // echo "<br>" . $inicio_dispensario;

                        $txt_pesquisa_dispensario = (isset($_POST["txt_pesquisa_dispensario"]))?$_POST["txt_pesquisa_dispensario"]:"";

                        // echo "<br>" . $txt_pesquisa_dispensario;

                        // $sql_listar = "";
                        $insumos_cads_list = array();

                        $sql = "SELECT 
                                    disp.id,
                                    disp.qtd,
                                    date_format(disp.validade, '%d/%m/%Y') AS validadeDispensario,
                                    i.nome as insumos_nome,
                                    i.unidade,
                                    i.qtd_critica,
                                    datediff(disp.validade, curdate()) AS diasParaVencimentoDispensario,
                                    lcd.nome as local_nome,
                                    es.nome as estoques_nome,
                                    es.nome_real,
                                    tp.tipo

                                    FROM dispensario disp

                                    INNER JOIN deposito deps
                                    ON disp.deposito_id = deps.id

                                    INNER JOIN insumos i
                                    ON disp.insumos_id = i.id

                                    INNER JOIN tipos_insumos tp
                                    ON tp.id = i.tipo_insumos_id

                                    INNER JOIN local_dispensario lcd 
                                    ON disp.local_id = lcd.id

                                    INNER JOIN estoques es
                                    ON disp.estoque_id = es.id

                                    WHERE
                                    es.nome_real = '{$qualEstoque}' and i.nome = '{$qualInsumo}' and (lcd.nome LIKE '%{$txt_pesquisa_dispensario}%')

                                    ORDER BY i.nome ASC 
                                    LIMIT $inicio_dispensario,$quantidade_registros_dispensario";

                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

                        // echo "fez o select";

                        while($dados = mysqli_fetch_assoc($rs)){
                            // echo "teste";
                            $qtd_linhas_tabelas++;
                            $i = $qtd_linhas_tabelas-1;
                        
                    ?>
                    <tr>
                        <td class="" id="td_operacoes_editar_deletar">
                            <a href="index.php?menuop=excluir_dispensario&idInsumodispensario=<?=$dados["id"]?>"
                                class="confirmaDelete">
                                <button class="btn">

                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
                        <td><?=$dados["id"]?></td>
                        <td>
                            <?php
                            
                            $insumos_nome = $dados["insumos_nome"];
                            // echo $insumos_nome;
                            // echo $insumos_cads_list[0];

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
                        <td><?=$dados["validadeDispensario"]?></td>
                        <td><?=$dados["local_nome"]?></td>
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
                                sum(d.qtd) as dispensario_qtd_insumo,
                                i.nome as insumos_nome,
                                i.qtd_critica,
                                es.nome as estoques_nome
                            FROM 
                                dispensario d 
                            INNER JOIN 
                                insumos i
                            ON 
                                d.insumos_id = i.id
                            INNER JOIN 
                                estoques es
                            ON 
                                es.id = d.estoque_id
                            WHERE 
                                es.nome_real = '{$qualEstoque}' and i.nome='{$insumo_selecionado}'";
                        
                            $resultado_qtd = mysqli_query($conexao, $sql_qtd) or die("//dispensario/quantidade_insumos_dispensario/calcula_qtd - erro ao realizar a consulta: " . mysqli_error($conexao));

                            while ($dados = mysqli_fetch_assoc($resultado_qtd)) {
                                // var_dump($dados);
                        
                    ?>
                    <tr>
                        <td><?=$dados['insumos_nome']?></td>
                        <td><?=$dados['dispensario_qtd_insumo']?></td>
                        <td><?=$dados['estoques_nome']?></td>
                        <td class="<?php
                        
                        $qtd_cadastrada = $dados["dispensario_qtd_insumo"];
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
                $sqlTotaldispensario = "SELECT d.id 
                                            FROM dispensario d
                                            INNER JOIN estoques e
                                            ON e.id = d.estoque_id
                                            WHERE e.nome_real='{$qualEstoque}'";
                $queryTotaldispensario = mysqli_query($conexao,$sqlTotaldispensario) or die(mysqli_error($conexao));

                $numTotaldispensario = mysqli_num_rows($queryTotaldispensario);
                $totalPaginasdispensario = ceil($numTotaldispensario/$quantidade_registros_dispensario);
                
                echo "<a href=\"?menuop=dispensario&" . $qualEstoque ."&" . $qualInsumo . "=1\">Início</a> ";

                if ($pagina_dispensario>6) {
                    ?>
                        <a href="?menuop=dispensario&<?=$qualEstoque?>&<?=$qualInsumo?>=<?php echo $pagina_dispensario-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasdispensario;$i++){

                    if ($i >= ($pagina_dispensario) && $i <= ($pagina_dispensario+5)) {
                        
                        if ($i==$pagina_dispensario) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=dispensario&" . $qualEstoque . "&" . $qualInsumo . "=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina_dispensario<($totalPaginasdispensario-5)) {
                    ?>
                        <a href="?menuop=dispensario&<?=$qualEstoque?>&<?=$qualInsumo?>=<?php echo $pagina_dispensario+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=dispensario&" . $qualEstoque . "&" . $qualInsumo ."=$totalPaginasdispensario\">Fim</a>";
            ?>
        </div>
    </div>
</section>