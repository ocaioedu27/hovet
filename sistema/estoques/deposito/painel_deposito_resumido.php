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
                <div class="" id="operacao_cadastro">
                    <a href="index.php?menuop=cadastro_deposito&<?=$qualEstoque?>">
                        <button class="btn">Cadastrar</button>
                    </a>
                </div>
                <div class="dropdown" id="operacao_retirar">
                    <a href="index.php?menuop=cadastro_dispensario&<?=$qualEstoque?>">
                        <button class="btn">Abastecer Dispensário</button>
                    </a>
                </div>
                <div class="" id="operacao_cadastro">
                    <a href="index.php?menuop=permutar_deposito&<?=$qualEstoque?>">
                        <button class="btn">Permutar</button>
                    </a>
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
                        DISTINCT i.nome as insumos_nome
                    FROM 
                        deposito d 
                    INNER JOIN 
                        insumos i 
                    ON 
                        d.insumos_id = i.id
                    INNER JOIN 
                        tipos_insumos tp
                    ON 
                        tp.id = i.tipo_insumos_id
                    INNER JOIN 
                        estoques es
                    ON 
                        d.estoque_id = es.id 
                    WHERE
                        es.nome_real = '{$qualEstoque}' and
                        (d.id='{$txt_pesquisa_deposito}' or
                        i.nome LIKE '%{$txt_pesquisa_deposito}%' or
                        tp.tipo LIKE '%{$txt_pesquisa_deposito}%')
                        ORDER BY i.nome ASC 
                        LIMIT $inicio_deposito,$quantidade_registros_deposito";

            // echo $sql;
            $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

            $qtd_resultados = $rs->num_rows;
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
                        $qtdResult = 0;
                        while ($i >= 0) {
                            // echo $insumos_cads_list[$i];
                            $insumo_selecionado = $insumos_cads_list[$i];
                            $i--;
                            
                            $sql_qtd = "SELECT 
                            sum(d.qtd) as deposito_qtd_insumo,
                            i.nome as insumos_nome,
                            es.nome as estoques_nome,
                            tp.tipo
                            FROM deposito d 
                            INNER JOIN insumos i
                            ON d.insumos_id = i.id
                            INNER JOIN tipos_insumos tp
                            ON tp.id = i.tipo_insumos_id
                            INNER JOIN estoques es
                            ON es.id = d.estoque_id
                            WHERE 
                            es.nome_real = '{$qualEstoque}' and i.nome='{$insumo_selecionado}'";
                        
                            $resultado_qtd = mysqli_query($conexao, $sql_qtd) or die("//Deposito/quantidade_insumos_deposito/calcula_qtd - erro ao realizar a consulta: " . mysqli_error($conexao));
                            
                            $resultados = '';
                            if ($resultado_qtd->num_rows > 0){
                                while($dados_para_while = mysqli_fetch_assoc($resultado_qtd)){
                                    $insumos_nome = $dados_para_while['insumos_nome'];
                                    $tipo = $dados_para_while["tipo"];
                                    $deposito_qtd_insumo = $dados_para_while["deposito_qtd_insumo"];
                                    $estoques_nome = $dados_para_while["estoques_nome"];

                                    $resultados .= '
                                        <tr class="tabela_dados">
                                            <td class="">
                                                <a href="index.php?menuop=deposito&'.$qualEstoque.'&'.$insumos_nome.'=1" class="form-group" style="padding: 0 20px; margin-bottom: 0;">Visualizar Detalhes</a>
                                            </td>
                                            <td><strong>'.$insumos_nome.'</strong></td>
                                            <td>'.$tipo.'</td>
                                            <td>'.$deposito_qtd_insumo.'</td>
                                            <td>'.$estoques_nome.'</td>
                                        </tr>';

                                    $qtd_linhas_tabelas++;

                                }
                            } else{
                                $resultados = '
                                    <tr class="tabela_dados">
                                        <td colspan="5" class="text-center">Nenhum registro para exibir!</td>
                                    </tr>';

                            } 
                            echo $resultados;
                        
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="paginacao">
            <?php
    
                $numTotaldeposito = count($insumos_cads_list);
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