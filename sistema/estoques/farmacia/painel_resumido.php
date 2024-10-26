<?php

use Sabberworm\CSS\Value\Value;

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
}


?>
<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Resumo de Insumos - Farmácia <?=$qualEstoque[-1]?></h3>
                <a href="index.php?menuop=cad_farm&<?=$qualEstoque?>">
                    <button class="btn" id="operacao_cadastro">Abastecer</button>
                </a>
                <a href="index.php?menuop=doar_farmacia&<?=$qualEstoque?>">
                    <button class="btn">Doar</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=farmacia_resumo&<?=$qualEstoque?>=1" method="post" class="form_buscar">
                    <input type="text" name="txt_search" placeholder="Buscar">
                    <button type="submit" class="btn">
                        <span class="icon">
                            <ion-icon name="search-outline"></ion-icon>
                        </span>
                    </button>
                </form>
            </div>
        </div>
        <?php
    
            $quantidade_registros_farmacia = 10;

            $pagina_farmacia = (isset($_GET[$qualEstoque]))?(int)$_GET[$qualEstoque]:1;

            $inicio_farmacia = ($quantidade_registros_farmacia * $pagina_farmacia) - $quantidade_registros_farmacia;

            $txt_search = (isset($_POST["txt_search"]))?$_POST["txt_search"]:"";
            
            $sql_listar = "";
            $insumos_cads_list = array();

            $sql = "SELECT
                        DISTINCT i.nome as insumos_nome
                    FROM 
                        farmacia farm 

                    INNER JOIN 
                        insumos i 
                    ON 
                        farm.insumos_id = i.id
                    INNER JOIN 
                        tipos_insumos tp
                    ON 
                        tp.id = i.tipo_insumos_id
                    INNER JOIN 
                        estoques es
                    ON 
                        farm.estoque_id = es.id 

                    WHERE
                        es.nome_real = '{$qualEstoque}' and
                        (i.nome LIKE '%{$txt_search}%' or
                        tp.tipo LIKE '%{$txt_search}%')
                    ORDER BY i.nome ASC 
                    LIMIT $inicio_farmacia,$quantidade_registros_farmacia";

            // echo $sql;
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

            if (count($insumos_cads_list) <= 0){
                $resultados = '
                <tr class="tabela_dados">
                    <td colspan="5" class="text-center">Nenhum registro para exibir!</td>
                </tr>';
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
                        <th>Estoque Cadastrado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        
                        $i = count($insumos_cads_list)-1;

                        if ($i >= 0){

                            while ($i >= 0) {
                                // echo $insumos_cads_list[$i];
                                $insumo_selecionado = $insumos_cads_list[$i];
                                $i--;
                                
                                $sql_qtd = "SELECT 
                                sum(farm.qtd) as farmacia_qtd_insumo,
                                i.nome as insumos_nome,
                                es.nome as estoques_nome,
                                tp.tipo

                                FROM farmacia farm 

                                INNER JOIN insumos i
                                ON farm.insumos_id = i.id

                                INNER JOIN tipos_insumos tp
                                ON tp.id = i.tipo_insumos_id

                                INNER JOIN estoques es
                                ON es.id = farm.estoque_id

                                WHERE 
                                es.nome_real = '{$qualEstoque}' and i.nome='{$insumo_selecionado}'";
                            
                                $resultado_qtd = mysqli_query($conexao, $sql_qtd) or die("//farmacia/quantidade_insumos_deposito/calcula_qtd - erro ao realizar a consulta: " . mysqli_error($conexao));

                                
                                $resultados = '';
                                // echo "aqui";
                                if ($resultado_qtd->num_rows > 0){
                                    while($dados_para_while = mysqli_fetch_assoc($resultado_qtd)){
                                        $insumos_nome = $dados_para_while['insumos_nome'];
                                        $tipo = $dados_para_while["tipo"];
                                        $farmacia_qtd_insumo = $dados_para_while["farmacia_qtd_insumo"];
                                        $estoques_nome = $dados_para_while["estoques_nome"];
                                        // echo 'pegou';
                                        $resultados .= '
                                            <tr class="tabela_dados">
                                                <td class="">
                                                    <a href="index.php?menuop=farmacia&'.$qualEstoque.'&'.$insumos_nome.'=1" class="form-group" style="padding: 0 20px; margin-bottom: 0;">Visualizar Detalhes</a>
                                                </td>
                                                <td><strong>'.$insumos_nome.'</strong></td>
                                                <td>'.$tipo.'</td>
                                                <td>'.$farmacia_qtd_insumo.'</td>
                                                <td>'.$estoques_nome.'</td>
                                            </tr>';

                                        $qtd_linhas_tabelas++;

                                    }
                                }

                                echo $resultados;
                            
                            }
                        } else{
                            echo $resultados;
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="paginacao">
            <?php
                
                $numTotaldeposito = count($insumos_cads_list);

                $totalPaginasdeposito = ceil($numTotaldeposito/$quantidade_registros_farmacia);
                
                echo "<a href=\"?menuop=farmacia_resumo&" . $qualEstoque . "=1\">Início</a> ";

                if ($pagina_farmacia>6) {
                    ?>
                        <a href="?menuop=farmacia_resumo&<?=$qualEstoque?>=<?php echo $pagina_farmacia-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasdeposito;$i++){

                    if ($i >= ($pagina_farmacia) && $i <= ($pagina_farmacia+5)) {
                        
                        if ($i==$pagina_farmacia) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=farmacia_resumo&". $qualEstoque . "=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina_farmacia<($totalPaginasdeposito-5)) {
                    ?>
                        <a href="?menuop=farmacia_resumo&<?=$qualEstoque?>=<?php echo $pagina_farmacia+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=farmacia_resumo&". $qualEstoque . "=$totalPaginasdeposito\">Fim</a>";
            ?>
        </div>
    </div>
</section>