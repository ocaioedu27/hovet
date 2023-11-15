<?php

use Sabberworm\CSS\Value\Value;

echo $qualEstoque;

// $qualEstoque_dep = (isset($_POST["deposito"]))?$_POST["deposito"]:"";

$qualEstoque_teste = $_POST;

if (   isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
		// $$chave = $valor;
        // print_r($valor_est);
	}
}

$qualEstoque_dep = $valor_est;


if ($qualEstoque_dep != "") {
    $qualEstoque = $qualEstoque_dep;
    // echo "é dep: " . $qualEstoque;
}


?>
<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Resumo de Insumos - Depósito <?=$qualEstoque[-1]?></h3>
                <div class="dropdown" id="operacao_cadastro">
                    <a href="#">
                        <button class="btn">Cadastrar</button>
                    </a>
                    <div class="dropdown-content">
                        <ul>
                            <li>
                                <a href="index.php?menuop=cadastro_deposito&<?=$qualEstoque?>">Cadstrar Novo Insumo</a>
                            </li>
                            <li>
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
                            </li>
                            <li>
                                <a href="index.php?menuop=permutar_deposito&<?=$qualEstoque?>">Permutar</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <form action="index.php?menuop=deposito_resumo&<?=$qualEstoque?>=1" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_deposito" placeholder="Buscar">
                    <button type="submit" class="btn">
                        <span class="icon">
                            <ion-icon name="search-outline"></ion-icon>
                        </span>
                    </button>
                </form>
            </div>
        </div>
        <?php
    
            $quantidade_registros_deposito = 10;

            $pagina_deposito = (isset($_GET[$qualEstoque]))?(int)$_GET[$qualEstoque]:1;

            // print_r($_GET);

            $inicio_deposito = ($quantidade_registros_deposito * $pagina_deposito) - $quantidade_registros_deposito;

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

                        INNER JOIN tipos_insumos tp
                        ON tp.tipos_insumos_id = i.insumos_tipo_insumos_id

                        INNER JOIN estoques es
                        ON d.deposito_estoque_id = es.estoques_id 

                        WHERE
                            es.estoques_nome_real = '{$qualEstoque}' and
                            (d.deposito_id='{$txt_pesquisa_deposito}' or
                            i.insumos_nome LIKE '%{$txt_pesquisa_deposito}%' or
                            tp.tipos_insumos_tipo LIKE '%{$txt_pesquisa_deposito}%')
                            ORDER BY insumos_nome ASC 
                            LIMIT $inicio_deposito,$quantidade_registros_deposito";

            
            $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

            // var_dump($rs);
            while($dados_para_while = mysqli_fetch_assoc($rs)){
                $qtd_linhas_tabelas++;
                $i = $qtd_linhas_tabelas-1;
                
                $insumos_nome = $dados_para_while["insumos_nome"];

                $estaNaLista = in_array($insumos_nome, $insumos_cads_list);

                if (!$estaNaLista) {
                    array_push($insumos_cads_list,$insumos_nome);   
                }

            }
            echo '<input type="hidden" id="quantidade_linhas_tabelas" value="'.$qtd_linhas_tabelas.'">';
        ?>
        <div class="tabelas">
            <table class="tabela_listar">
                <thead>
                    <tr>
                        <th>Visualizar</th>
                        <th>Insumo</th>
                        <th>Categoria</th>
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
                            es.estoques_nome,
                            tp.tipos_insumos_tipo
                            FROM deposito d 
                            INNER JOIN insumos i
                            ON d.deposito_insumos_id = i.insumos_id
                            INNER JOIN tipos_insumos tp
                            ON tp.tipos_insumos_id = i.insumos_tipo_insumos_id
                            INNER JOIN estoques es
                            ON es.estoques_id = d.deposito_estoque_id
                            WHERE 
                            es.estoques_nome_real = '{$qualEstoque}' and i.insumos_nome='{$insumo_selecionado}'";
                        
                            $resultado_qtd = mysqli_query($conexao, $sql_qtd) or die("//Deposito/quantidade_insumos_deposito/calcula_qtd - erro ao realizar a consulta: " . mysqli_error($conexao));

                            while ($dados = mysqli_fetch_assoc($resultado_qtd)) {
                                // var_dump($dados);
                        
                    ?>
                    <tr>
                        <td class="">
                            <a href="index.php?menuop=deposito&<?=$qualEstoque?>&<?=$dados['insumos_nome']?>=1" class="form-group" style="padding: 0 20px; margin-bottom: 0;">Visualizar Detalhes</a>
                        </td>
                        <td><strong><?=$dados['insumos_nome']?></strong></td>
                        <td><?=$dados['tipos_insumos_tipo']?></td>
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
                                        INNER JOIN estoques e
                                        ON e.estoques_id = d.deposito_estoque_id
                                        WHERE e.estoques_nome_real='{$qualEstoque}'";
                $queryTotaldeposito = mysqli_query($conexao,$sqlTotaldeposito) or die(mysqli_error($conexao));

                $numTotaldeposito = mysqli_num_rows($queryTotaldeposito);
                $totalPaginasdeposito = ceil($numTotaldeposito/$quantidade_registros_deposito);
                
                echo "<a href=\"?menuop=deposito_resumo&" . $qualEstoque . "=1\">Início</a> ";

                if ($pagina_deposito>6) {
                    ?>
                        <a href="?menuop=deposito_resumo&<?=$qualEstoque?>=<?php echo $pagina_deposito-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasdeposito;$i++){

                    if ($i >= ($pagina_deposito) && $i <= ($pagina_deposito+5)) {
                        
                        if ($i==$pagina_deposito) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=deposito_resumo&". $qualEstoque . "=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina_deposito<($totalPaginasdeposito-5)) {
                    ?>
                        <a href="?menuop=deposito_resumo&<?=$qualEstoque?>=<?php echo $pagina_deposito+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=deposito_resumo&". $qualEstoque . "=$totalPaginasdeposito\">Fim</a>";
            ?>
        </div>
    </div>
</section>