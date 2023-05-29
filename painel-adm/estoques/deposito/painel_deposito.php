<?php

use Sabberworm\CSS\Value\Value;

// echo $qualEstoque;

// $qualEstoque_dep = (isset($_POST["deposito"]))?$_POST["deposito"]:"";

$stringList = array();

if ( isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
    // $contador = 0;
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
        array_push($stringList, $valor_est);

	}

    $estoqueNomeReal = $stringList[1];
    $nome_insumo = $stringList[2];

}

$qualInsumo = $nome_insumo;

$qualEstoque_dep = $estoqueNomeReal;


if ($qualEstoque_dep != "") {
    $qualEstoque = $qualEstoque_dep;
    // echo "é dep: " . $qualEstoque;
}


?>
<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Depósito <?=$qualEstoque[-1]?></h3>
                <div class="dropdown" id="operacao_retirar">
                    <a href="#">
                        <button class="btn">Cadastrar</button>
                    </a>
                    <div class="dropdown-content">
                        <ul>
                            <li>
                                <a href="index.php?menuop=cadastro_deposito&<?=$qualEstoque?>">Cadstrar Novo Insumo</a>
                                <a href="index.php?menuop=permutar_deposito&<?=$qualEstoque?>">Permutar</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="dropdown" id="operacao_retirar">
                    <a href="#">
                        <button class="btn">Retirar</button>
                    </a>
                    <div class="dropdown-content">
                        <ul>
                            <li>
                                <a href="index.php?menuop=cadastro_dispensario&<?=$qualEstoque?>">Mover para o dispensário</a>
                                <a href="index.php?menuop=permutar_deposito&<?=$qualEstoque?>">Permutar</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <form action="index.php?menuop=deposito&<?=$qualEstoque?>=1" method="post" class="form_buscar">
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
                        <th id="th_operacoes_editar_deletar">Operações</th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Estoque crítico</th>
                        <th>Unidade</th>
                        <th>Local Cadastrado</th>
                        <th>Validade</th>
                        <th>Dias para o vencimento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
               
                        $quantidade_registros_deposito = 10;

                        // echo "<br>" . $quantidade_registros_deposito;

                        $pagina_deposito = (isset($_GET[$qualInsumo]))?(int)$_GET[$qualInsumo]:1;
                        // echo "<br>" . $pagina_deposito;

                        // print_r($_GET);

                        $inicio_deposito = ($quantidade_registros_deposito * $pagina_deposito) - $quantidade_registros_deposito;
                        // echo "<br>" . $inicio_deposito;

                        $txt_pesquisa_deposito = (isset($_POST["txt_pesquisa_deposito"]))?$_POST["txt_pesquisa_deposito"]:"";
                        
                        $sql_listar = "";
                        $insumos_cads_list = array();

                        $sql = "SELECT
                                    d.deposito_id, 
                                    d.deposito_qtd,
                                    date_format(d.deposito_validade, '%d/%m/%Y') as validadedeposito,
                                    es.estoques_nome,
                                    es.estoques_nome_real,
                                    i.insumos_nome,
                                    i.insumos_unidade,
                                    datediff(d.deposito_validade, curdate()) as diasParaVencimentodeposito,
                                    i.insumos_qtd_critica
                                    FROM deposito d 
                                    INNER JOIN insumos i 
                                    ON d.deposito_insumos_id = i.insumos_id
                                    INNER JOIN estoques es
                                    ON d.deposito_estoque_id = es.estoques_id 
                                    WHERE
                                        es.estoques_nome_real = '{$qualEstoque}' and i.insumos_nome='{$qualInsumo}'
                                        ORDER BY insumos_nome ASC 
                                        LIMIT $inicio_deposito,$quantidade_registros_deposito";
                        if (empty($txt_pesquisa_deposito)) {   
                            $sql_listar = "";
                        }

                        
                        $rs = mysqli_query($conexao,$sql) or die("//select-principal - Erro ao executar a consulta! " . mysqli_error($conexao));

                        // var_dump($rs);
                        while($dados_para_while = mysqli_fetch_assoc($rs)){
                            $qtd_linhas_tabelas++;
                            $i = $qtd_linhas_tabelas-1;
                    ?>
                    <tr>
                        <td class="operacoes" id="td_operacoes_editar_deletar">
                            <a href="index.php?menuop=excluir_deposito&idInsumodeposito=<?=$dados_para_while["deposito_id"]?>"
                                class="confirmaDelete">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
                        <td><?=$dados_para_while["deposito_id"]?></td>
                        <td>
                            <?php
                            
                            $insumos_nome = $dados_para_while["insumos_nome"];
                            // echo $insumos_nome;
                            // echo $insumos_cads_list[0];

                            $estaNaLista = in_array($insumos_nome, $insumos_cads_list);

                            if (!$estaNaLista) {
                                array_push($insumos_cads_list,$insumos_nome);   
                            }

                            echo $insumos_nome;
                            
                            ?>
                        </td>
                        <td><?=$dados_para_while["deposito_qtd"]?></td>
                        <td class="<?php
                        
                        $qtd_cadastrada = $dados_para_while["deposito_qtd"];
                        $qtd_critica = $dados_para_while["insumos_qtd_critica"];
                        $qtd_toleravel = $qtd_critica+($qtd_critica*20/100);

                        $class_bg = "";
                        $msg_alert = "";

                        // echo "toleravel " . $qtd_toleravel;
                        if ($qtd_cadastrada != null) {
                            
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
                        } else {
                            $msg_alert = "";
                        }

                        ?>">
                            <?=$msg_alert?>
                        </td>
                        <td><?=$dados_para_while["insumos_unidade"]?></td>
                        <td><?=$dados_para_while["estoques_nome"]?></td>
                        <td><?=$dados_para_while["validadedeposito"]?></td>
                        <td class="<?php 
                                $dias = ['30','45'];

                                $diasVencimento = $dados_para_while['diasParaVencimentodeposito'];

                                if ($diasVencimento != null) {
                                    
                                    if($diasVencimento <= $dias[0]){                                    
                                        echo "vermelho";
                                    } else if($diasVencimento <= $dias[1]){
                                        echo "amarelo";
                                    } else if($diasVencimento > $dias[1]){
                                        echo "verde";
                                    } 
                                }
                                ?>">
                                
                                <?php 
                                if ($diasVencimento != null) {
                                    
                                    if ($diasVencimento <= 0){
                                        echo "INSUMO VENCIDO!";
                                    } else{
                                        echo $diasVencimento . " dia(s) para o vencimento";
                                    }

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
                            sum(d.deposito_qtd) as deposito_qtd_insumo,
                            i.insumos_nome,
                            es.estoques_nome
                            FROM deposito d 
                            INNER JOIN insumos i
                            ON d.deposito_insumos_id = i.insumos_id
                            INNER JOIN estoques es
                            ON es.estoques_id = d.deposito_estoque_id
                            WHERE 
                            es.estoques_nome_real = '{$qualEstoque}' and i.insumos_nome='{$insumo_selecionado}'";
                        
                            $resultado_qtd = mysqli_query($conexao, $sql_qtd) or die("//Deposito/quantidade_insumos_deposito/calcula_qtd - erro ao realizar a consulta: " . mysqli_error($conexao));

                            while ($dados = mysqli_fetch_assoc($resultado_qtd)) {
                                // var_dump($dados);
                        
                    ?>
                    <tr>
                        <td><?=$dados['insumos_nome']?></td>
                        <td><?=$dados['deposito_qtd_insumo']?></td>
                        <td><?=$dados['estoques_nome']?></td>
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
                $sqlTotaldeposito = "SELECT d.deposito_id 
                                        FROM deposito d
                                        INNER JOIN insumos i
                                        ON i.insumos_id = d.deposito_insumos_id
                                        INNER JOIN estoques e
                                        ON e.estoques_id = d.deposito_estoque_id
                                        WHERE e.estoques_nome_real='{$qualEstoque}' and i.insumos_nome='{$qualInsumo}'";
                $queryTotaldeposito = mysqli_query($conexao,$sqlTotaldeposito) or die(mysqli_error($conexao));

                $numTotaldeposito = mysqli_num_rows($queryTotaldeposito);
                // echo $numTotaldeposito;
                $totalPaginasdeposito = ceil($numTotaldeposito/$quantidade_registros_deposito);
                
                echo "<a href=\"?menuop=deposito&" . $qualEstoque . "&" . $qualInsumo . "=1\">Início</a> ";

                if ($pagina_deposito>1) {
                    ?>
                        <a href="?menuop=deposito&<?=$qualEstoque?>&<?=$qualInsumo?>=<?php echo $pagina_deposito-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasdeposito;$i++){

                    if ($i >= ($pagina_deposito) && $i <= ($pagina_deposito+5)) {
                        
                        if ($i==$pagina_deposito) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=deposito&". $qualEstoque . "&" . $qualInsumo . "=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina_deposito<($totalPaginasdeposito-5)) {
                    ?>
                        <a href="?menuop=deposito&<?=$qualEstoque?>&<?=$qualInsumo?>=<?php echo $pagina_deposito+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=deposito&". $qualEstoque . "&" . $qualInsumo . "=$totalPaginasdeposito\">Fim</a>";
            ?>
        </div>
    </div>
</section>