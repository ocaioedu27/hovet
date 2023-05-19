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
                <h3>Resumo de Insumos - Dispensário <?=$qualEstoque[-1]?></h3>
                <a href="index.php?menuop=cadastro_dispensario&<?=$qualEstoque?>">
                    <button class="btn" id="operacao_cadastro">Inserir</button>
                </a>
                <a href="index.php?menuop=solicitar_dispensario&<?=$qualEstoque?>">
                    <button class="btn">Solicitar insumos</button>
                </a>
                <a href="index.php?menuop=quantidade_insumos_dispensario">
                    <button class="btn">Quantidade de insumos</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=dispensario_resumo&<?=$qualEstoque?>=1" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_dispensario" placeholder="Buscar">
                    <button type="submit" class="btn">
                        <span class="icon">
                            <ion-icon name="search-outline"></ion-icon>
                        </span>
                    </button>
                </form>
            </div>
        </div>
        <?php
    
            $quantidade_registros_dispensario = 10;

            $pagina_dispensario = (isset($_GET[$qualEstoque]))?(int)$_GET[$qualEstoque]:1;

            // print_r($_GET);

            $inicio_dispensario = ($quantidade_registros_dispensario * $pagina_dispensario) - $quantidade_registros_dispensario;

            $txt_pesquisa_dispensario = (isset($_POST["txt_pesquisa_dispensario"]))?$_POST["txt_pesquisa_dispensario"]:"";
            
            $sql_listar = "";
            $insumos_cads_list = array();

            $sql = "SELECT
                        d.dispensario_id, 
                        d.dispensario_qtd,
                        date_format(d.dispensario_validade, '%d/%m/%Y') as validadedeposito,
                        es.estoques_nome,
                        es.estoques_nome_real,
                        i.insumos_nome,
                        i.insumos_unidade,
                        datediff(d.dispensario_validade, curdate()) as diasParaVencimento,
                        i.insumos_qtd_critica
                        FROM dispensario d 
                        INNER JOIN insumos i 
                        ON d.dispensario_insumos_id = i.insumos_id
                        INNER JOIN estoques es
                        ON d.dispensario_estoques_id = es.estoques_id 
                        WHERE
                            es.estoques_nome_real = '{$qualEstoque}' and
                            (d.dispensario_id='{$txt_pesquisa_dispensario}' or
                            i.insumos_nome LIKE '%{$txt_pesquisa_dispensario}%' or
                            i.insumos_unidade LIKE '%{$txt_pesquisa_dispensario}%' or
                            d.dispensario_qtd LIKE '%{$txt_pesquisa_dispensario}%' or
                            d.dispensario_validade LIKE '%{$txt_pesquisa_dispensario}%')
                            ORDER BY insumos_nome ASC 
                            LIMIT $inicio_dispensario,$quantidade_registros_dispensario";

            
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
                            sum(d.dispensario_qtd) as dispensario_qtd_insumo,
                            i.insumos_nome,
                            es.estoques_nome
                            FROM dispensario d 
                            INNER JOIN insumos i
                            ON d.dispensario_insumos_id = i.insumos_id
                            INNER JOIN estoques es
                            ON es.estoques_id = d.dispensario_estoques_id
                            WHERE 
                            es.estoques_nome_real = '{$qualEstoque}' and i.insumos_nome='{$insumo_selecionado}'";
                        
                            $resultado_qtd = mysqli_query($conexao, $sql_qtd) or die("//Dispensario/quantidade_insumos_deposito/calcula_qtd - erro ao realizar a consulta: " . mysqli_error($conexao));

                            while ($dados = mysqli_fetch_assoc($resultado_qtd)) {
                                // var_dump($dados);
                        
                    ?>
                    <tr>
                        <td class="">
                            <a href="index.php?menuop=dispensario&<?=$qualEstoque?>&<?=$dados['insumos_nome']?>=1" class="form-group" style="padding: 0 20px; margin-bottom: 0;">Visualizar Insumo</a>
                        </td>
                        <td><?=$dados['insumos_nome']?></td>
                        <td><?=$dados['dispensario_qtd_insumo']?></td>
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
                $sqlTotaldeposito = "SELECT d.dispensario_id 
                                        FROM dispensario d
                                        INNER JOIN estoques e
                                        ON e.estoques_id = d.dispensario_estoques_id
                                        WHERE e.estoques_nome_real='{$qualEstoque}'";
                $queryTotaldeposito = mysqli_query($conexao,$sqlTotaldeposito) or die(mysqli_error($conexao));

                $numTotaldeposito = mysqli_num_rows($queryTotaldeposito);
                $totalPaginasdeposito = ceil($numTotaldeposito/$quantidade_registros_dispensario);
                
                echo "<a href=\"?menuop=dispensario_resumo&" . $qualEstoque . "=1\">Início</a> ";

                if ($pagina_dispensario>6) {
                    ?>
                        <a href="?menuop=dispensario_resumo&<?=$qualEstoque?>=<?php echo $pagina_dispensario-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasdeposito;$i++){

                    if ($i >= ($pagina_dispensario) && $i <= ($pagina_dispensario+5)) {
                        
                        if ($i==$pagina_dispensario) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=dispensario_resumo&". $qualEstoque . "=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina_dispensario<($totalPaginasdeposito-5)) {
                    ?>
                        <a href="?menuop=dispensario_resumo&<?=$qualEstoque?>=<?php echo $pagina_dispensario+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=dispensario_resumo&". $qualEstoque . "=$totalPaginasdeposito\">Fim</a>";
            ?>
        </div>
    </div>
</section>