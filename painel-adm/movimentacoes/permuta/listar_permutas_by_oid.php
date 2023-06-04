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
                <h3>Todas as Permutas</h3>
            </div>
            <div>
                <form action="index.php?menuop=permuta" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_permutas" placeholder="Buscar">
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
                        <th>ID</th>
                        <th>Insumo Retirado</th>
                        <th>ID de Resgistro</th>
                        <th>Instituição</th>
                        <th>Insumo Cadastrado</th>
                        <th>Data da Permuta</th>
                        <th>Visualizar Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_permutas = 10;

                        $pagina_permutas = (isset($_GET['pagina_permutas']))?(int)$_GET['pagina_permutas']:1;

                        $inicio_permutas = ($quantidade_registros_permutas * $pagina_permutas) - $quantidade_registros_permutas;

                        $txt_pesquisa_permutas = (isset($_POST["txt_pesquisa_permutas"]))?$_POST["txt_pesquisa_permutas"]:"";

                        $sql = "SELECT p.permutas_id,
                                    p.permutas_qtd_retirado,
                                    p.permutas_oid_operacao,
                                    p.permutas_data,
                                    p.permutas_insumos_qtd_cadastrado,
                                    u.usuario_primeiro_nome,
                                    e.estoques_nome as nome_estoque_retirado,
                                    es.estoques_nome as nome_estoque_cadastrado,
                                    ins.insumos_nome as nome_insumo_cadastrado,
                                    i.insumos_nome as nome_insumo_retirado,
                                    inst.instituicoes_razao_social

                                FROM permutas p
                                
                                    INNER JOIN usuarios u
                                    ON p.permutas_operador = u.usuario_id
                                
                                    INNER JOIN deposito d 
                                    ON p.permutas_deposito_id = d.deposito_id
                                
                                    INNER JOIN insumos ins
                                    ON p.permutas_insumos_id_cadastrado = ins.insumos_id
                                
                                    INNER JOIN insumos i
                                    ON d.deposito_insumos_id = i.insumos_id
                                
                                    INNER JOIN estoques e
                                    ON p.permutas_estoques_id_retirado = e.estoques_id
                                
                                    INNER JOIN estoques es
                                    ON p.permutas_estoques_id_cadastrado = es.estoques_id

                                    INNER JOIN instituicoes inst
                                    ON p.permutas_instituicao_id = inst.instituicoes_id
                                    
                                    WHERE
                                        p.permutas_oid_operacao='{$oid_operacao}'
                                        ORDER BY permutas_data DESC 
                                        LIMIT $inicio_permutas,$quantidade_registros_permutas";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr class="tabela_dados">
                        <td><?=$dados["permutas_id"]?></td>
                        <td><?=$dados["nome_insumo_retirado"]?></td>
                        <td><?=$dados["permutas_oid_operacao"]?></td>
                        <td><?=$dados["instituicoes_razao_social"]?></td>
                        <td><?=$dados["nome_insumo_cadastrado"]?></td>
                        <td>
                            <?php 
                                echo date("d/m/Y H:i", strtotime($dados['permutas_data']));
                            ?>
                        </td>
                        <td class="operacoes" id="">
                            <a href="index.php?menuop=detalhar_permuta&permutaId=<?=$dados["permutas_id"]?>"
                                class="confirmaOperacao">
                                <button class="btn" style="color: green;">Ver Detalhes</button>
                            </a>
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
                    $sqlTotalInsumos = "SELECT doacoes_id FROM doacoes";
                    $queryTotalInsumos = mysqli_query($conexao,$sqlTotalInsumos) or die(mysqli_error($conexao));

                    $numTotalInsumos = mysqli_num_rows($queryTotalInsumos);
                    $totalPaginasInsumos = ceil($numTotalInsumos/$quantidade_registros_permutas);
                    
                    echo "<a href=\"?menuop=permuta&pagina_permutas=1\">Início</a> ";

                    if ($pagina_permutas>6) {
                        ?>
                            <a href="?menuop=permuta?pagina_permutas=<?php echo $pagina_permutas-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasInsumos;$i++){

                        if ($i >= ($pagina_permutas) && $i <= ($pagina_permutas+5)) {
                            
                            if ($i==$pagina_permutas) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=permuta&pagina_permutas=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina_permutas<($totalPaginasInsumos-5)) {
                        ?>
                            <a href="?menuop=permuta?pagina_permutas=<?php echo $pagina_permutas+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=permuta&pagina_permutas=$totalPaginasInsumos\">Fim</a>";
                ?>
            </div>
    </div>
</section>