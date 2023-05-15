<?php

use Sabberworm\CSS\Value\Value;

echo $qualEstoque;

$qualEstoque_dep = (isset($_POST["deposito"]))?$_POST["deposito"]:"";

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
                <h3>Depósito <?=$qualEstoque[-1]?></h3>
                <a href="index.php?menuop=cadastro_deposito&<?=$qualEstoque?>" id="operacao_cadastro">
                    <button class="btn">Inserir</button>
                </a>
                <div class="dropdown" id="operacao_retirar">
                    <a href="#">
                        <button class="btn">Retirar</button>
                    </a>
                    <div class="dropdown-content">
                        <ul>
                            <li>
                                <a href="index.php?menuop=cadastro_dispensario">Mover para o dispensário</a>
                                <a href="index.php?menuop=permutar_deposito">Permutar</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="index.php?menuop=quantidade_insumos_deposito">
                    <button class="btn">Quantidade de insumos</button>
                </a>
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
                        <th>Unidade</th>
                        <th>Local Cadastrado</th>
                        <th>Validade</th>
                        <th>Dias para o vencimento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
               
                        $quantidade_registros_deposito = 10;

                        $pagina_deposito = (isset($_GET[$qualEstoque]))?(int)$_GET[$qualEstoque]:1;

                        // print_r($_GET);

                        $inicio_deposito = ($quantidade_registros_deposito * $pagina_deposito) - $quantidade_registros_deposito;

                        $txt_pesquisa_deposito = (isset($_POST["txt_pesquisa_deposito"]))?$_POST["txt_pesquisa_deposito"]:"";

                        $sql = "SELECT
                                    d.deposito_id, 
                                    d.deposito_qtd,
                                    date_format(d.deposito_validade, '%d/%m/%Y') as validadedeposito,
                                    es.estoques_nome,
                                    es.estoques_nome_real,
                                    i.insumos_nome,
                                    i.insumos_unidade,
                                    datediff(d.deposito_validade, curdate()) as diasParaVencimentodeposito
                                    FROM deposito d 
                                    INNER JOIN insumos i 
                                    ON d.deposito_insumos_id = i.insumos_id
                                    INNER JOIN estoques es
                                    ON d.deposito_estoque_id = es.estoques_id 
                                    WHERE
                                        es.estoques_nome_real = '{$qualEstoque}' and
                                        (d.deposito_id='{$txt_pesquisa_deposito}' or
                                        i.insumos_nome LIKE '%{$txt_pesquisa_deposito}%' or
                                        i.insumos_unidade LIKE '%{$txt_pesquisa_deposito}%' or
                                        d.deposito_qtd LIKE '%{$txt_pesquisa_deposito}%' or
                                        d.deposito_validade LIKE '%{$txt_pesquisa_deposito}%')
                                        ORDER BY insumos_nome ASC 
                                        LIMIT $inicio_deposito,$quantidade_registros_deposito";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

                        while($dados_para_while = mysqli_fetch_assoc($rs)){
                            // $valor_form = $dados_para_while['estoques_nome_real'];
                            $qtd_linhas_tabelas++;
                        
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
                        <td><?=$dados_para_while["insumos_nome"]?></td>
                        <td><?=$dados_para_while["deposito_qtd"]?></td>
                        <td><?=$dados_para_while["insumos_unidade"]?></td>
                        <td><?=$dados_para_while["estoques_nome"]?></td>
                        <td><?=$dados_para_while["validadedeposito"]?></td>
                        <td <?php 
                                $dias = ['30','45'];
 
                                if($dados_para_while["diasParaVencimentodeposito"] <= $dias[0]){                                    
                                ?> class="vermelho" <?php
                                } else if($dados_para_while["diasParaVencimentodeposito"] <= $dias[1]){
                                    ?> class="amarelo" <?php
                                } else if($dados_para_while["diasParaVencimentodeposito"] > $dias[1]){
                                    ?> class="verde" <?php
                                } 
                                ?>><?php if ($dados_para_while["diasParaVencimentodeposito"] <= 0){
                                    echo "INSUMO VENCIDO!";
                                } else{
                                    echo $dados_para_while["diasParaVencimentodeposito"] . " dia(s) para o vencimento";
                                }
                                ?>
                        </td>
                    </tr>
                    <?php
                        }
                        // array_push($dados_form_buscar,$valor_form);
                        // print_r($dados_form_buscar);
                        echo '<input type="hidden" id="quantidade_linhas_tabelas" value="'.$qtd_linhas_tabelas.'">';
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
                
                echo "<a href=\"?menuop=deposito&" . $qualEstoque . "=1\">Início</a> ";

                if ($pagina_deposito>6) {
                    ?>
                        <a href="?menuop=deposito&<?=$qualEstoque?>=<?php echo $pagina_deposito-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasdeposito;$i++){

                    if ($i >= ($pagina_deposito) && $i <= ($pagina_deposito+5)) {
                        
                        if ($i==$pagina_deposito) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=deposito&". $qualEstoque . "=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina_deposito<($totalPaginasdeposito-5)) {
                    ?>
                        <a href="?menuop=deposito&<?=$qualEstoque?>=<?php echo $pagina_deposito+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=deposito&". $qualEstoque . "=$totalPaginasdeposito\">Fim</a>";
            ?>
        </div>
    </div>
</section>