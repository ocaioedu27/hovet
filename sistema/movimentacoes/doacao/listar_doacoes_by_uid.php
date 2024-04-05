<?php

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

    $oid_operacao_tmp = $stringList[1];
    $oid_operacao = $_GET[$oid_operacao_tmp];

}

?>

<section class="painel_insumos">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Doações com registro "<?=$oid_operacao?>"</h3>
            </div>
            <div>
                <form action="index.php?menuop=doacao_por_oid&oidDoacao=<?=$oid_operacao?>" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_doacoes" placeholder="Buscar">
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
                    <tr class="tabela_dados">
                        <th>ID de Resgistro</th>
                        <th>Insumo Doado</th>
                        <th>Doador</th>
                        <th>Data da Doação</th>
                        <th>Estoque de Destino</th>
                        <th>Visualizar Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_doacoes = 10;

                        $pagina_doacoes = (isset($_GET['pagina_doacoes']))?(int)$_GET['pagina_doacoes']:1;

                        $inicio_doacoes = ($quantidade_registros_doacoes * $pagina_doacoes) - $quantidade_registros_doacoes;

                        $txt_pesquisa_doacoes = (isset($_POST["txt_pesquisa_doacoes"]))?$_POST["txt_pesquisa_doacoes"]:"";

                        $sql = "SELECT 
                                    d.oid_operacao,
                                    d.data_operacao,
                                    f.razao_social,
                                    i.id,
                                    i.nome as insumo_nome,
                                    e.nome as estoque_nome
                                FROM 
                                    doacoes d

                                INNER JOIN 
                                    fornecedores f
                                ON 
                                    f.id = d.fornecedor_id

                                INNER JOIN 
                                    deposito dep
                                ON 
                                    dep.id_origem = d.oid_operacao

                                INNER JOIN 
                                    insumos i
                                ON 
                                    dep.insumos_id = i.id

                                INNER JOIN 
                                    estoques e
                                ON 
                                    dep.estoque_id = e.id
                                    
                                WHERE
                                    d.oid_operacao = '{$oid_operacao}' and
                                    d.data_operacao LIKE '%{$txt_pesquisa_doacoes}%'
                                    GROUP BY i.nome 
                                    ORDER BY d.data_operacao ASC 
                                    LIMIT $inicio_doacoes,$quantidade_registros_doacoes";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr class="tabela_dados">
                        <td><?=$dados["oid_operacao"]?></td>
                        <td><?=$dados["insumo_nome"]?></td>
                        <td><?=$dados["razao_social"]?></td>
                        <td><?php echo date("d/m/Y H:i", strtotime($dados['data_operacao']));?></td>
                        <td><?=$dados["estoque_nome"]?></td>
                        <td>
                            <a href="index.php?menuop=doacao_detalhes&oidDoacao=<?=$dados["oid_operacao"]?>&insumoId=<?=$dados['id']?>">Ver Detalhes</a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
            <div class="paginacao">
                <?php
                    $sqlTotalInsumos = "SELECT 
                                            doacoes_id 
                                        FROM 
                                            doacoes
                                        WHERE 
                                            doacoes_oid_operacao = '{$oid_operacao}'";
                    // $queryTotalInsumos = mysqli_query($conexao,$sqlTotalInsumos) or die(mysqli_error($conexao));

                    // $numTotalInsumos = mysqli_num_rows($queryTotalInsumos);
                    $numTotalInsumos = $rs->num_rows;
                    $totalPaginasInsumos = ceil($numTotalInsumos/$quantidade_registros_doacoes);
                    
                    echo "<a href=\"?menuop=doacao_por_oid&oidDoacao=$oid_operacao&pagina_doacoes=1\">Início</a> ";

                    if ($pagina_doacoes>6) {
                        ?>
                            <a href="?menuop=cdoacao_por_oid&oidDoacao=<?=$oid_operacao?>&pagina_doacoes=<?php echo $pagina_doacoes-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasInsumos;$i++){

                        if ($i >= ($pagina_doacoes) && $i <= ($pagina_doacoes+5)) {
                            
                            if ($i==$pagina_doacoes) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=doacao_por_oid&oidDoacao=$oid_operacao&pagina_doacoes=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina_doacoes<($totalPaginasInsumos-5)) {
                        ?>
                            <a href="?menuop=doacao_por_oid&oidDoacao=<?=$oid_operacao?>&pagina_doacoes=<?php echo $pagina_doacoes+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=doacao_por_oid&oidDoacao=$oid_operacao&pagina_doacoes=$totalPaginasInsumos\">Fim</a>";
                ?>
            </div>
    </div>
</section>