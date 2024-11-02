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
    // var_dump($stringList);

    $chave_categoria = $stringList[1];

    $categoriaId = $_GET[$chave_categoria];

    $categoria_nome = "";
    $categoria_id_for_select = "";
    $string_link_cadastro_insumo = "";
    $string_link_procurar_insumo = "";

    if (isset($categoriaId) && $chave_categoria == "categoriaInsumoId") {

        $categoria_id_for_select = "= " . $categoriaId;
        $string_link_cadastro_insumo = "cadastro_insumo&categoriaInsumoId=" . $categoriaId;
        $string_link_procurar_insumo = "insumos&categoriaInsumoId=" . $categoriaId;

        $sql_nome = "SELECT
                        tipo
                    FROM 
                        tipos_insumos
                    WHERE
                        id = {$categoriaId}";

        $resultado_nome = mysqli_query($conexao,$sql_nome) or die("Erro ao coletar o nome da categoria! " . mysqli_error($conexao));
        $categoria_nome_tmp = mysqli_fetch_assoc($resultado_nome);

        $categoria_nome = $categoria_nome_tmp['tipo'];
        
    } else {
        $categoria_id_for_select = "IS NOT NULL";
        $categoria_nome = "Todos os Insumos";
        $string_link_cadastro_insumo = "cadastro_insumo";
        $string_link_procurar_insumo = "insumos";
    }

}


?>

<section class="painel_insumos">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3><?=$categoria_nome?></h3>
                <a href="index.php?menuop=<?=$string_link_cadastro_insumo?>" id="operacao_cadastro">
                    <button class="btn">Cadastrar</button>
                </a>
                <a href="index.php?menuop=cadastro_categoria_insumo" id="operacao_cadastro">
                    <button class="btn">Nova Categoria</button>
                </a>
            </div>
            <div class="d-flex jf-cnt-end">
                <form action="index.php?menuop=<?=$string_link_procurar_insumo?>" method="post" class="form_buscar">
                    <input class="search_bar" type="text" name="txt_pesquisa" placeholder="Buscar">
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
                        <th id="th_operacoes_editar_deletar">Operações</th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Unidade</th>
                        <th>Categoria de Insumo</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_insumos = 10;

                        $pagina = (isset($_GET['pagina']))?(int)$_GET['pagina']:1;

                        $inicio_insumos = ($quantidade_registros_insumos * $pagina) - $quantidade_registros_insumos;

                        $txt_pesquisa = (isset($_POST["txt_pesquisa"]))?$_POST["txt_pesquisa"]:"";

                        $sql = "SELECT 
                                    i.id,
                                    i.nome, 
                                    i.unidade, 
                                    i.descricao,
                                    t.tipo,
                                    i.qtd_critica
                                FROM 
                                    insumos i
                                INNER JOIN 
                                    tipos_insumos t
                                ON
                                    i.tipo_insumos_id = t.id
                                WHERE
                                    i.tipo_insumos_id $categoria_id_for_select AND 
                                    (i.id='{$txt_pesquisa}' or
                                    i.nome LIKE '%{$txt_pesquisa}%' or
                                    t.tipo LIKE '%{$txt_pesquisa}%' or
                                    i.unidade LIKE '%{$txt_pesquisa}%' or
                                    i.descricao LIKE '%{$txt_pesquisa}%')
                                    ORDER BY nome ASC 
                                    LIMIT $inicio_insumos,$quantidade_registros_insumos";

                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                            $qtd_linhas_tabelas++;
                        
                    ?>
                    <tr class="tabela_dados">
                        <td class="operacoes" id="td_operacoes_editar_deletar">
                            <a href="index.php?menuop=editar_insumo&categoriaInsumoId=<?=$categoriaId?>&idInsumo=<?=$dados["id"]?>" class="confirmaEdit">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                            <a href="index.php?menuop=excluir_insumo&categoriaInsumoId=<?=$categoriaId?>&idInsumo=<?=$dados["id"]?>" class="confirmaDelete">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
                        <td><?=$dados["id"]?></td>
                        <td><?=$dados["nome"]?></td>
                        <td><?=$dados["unidade"]?></td>
                        <td><?=$dados["tipo"]?></td>
                        <td><?=$dados["descricao"]?></td>
                    </tr>
                    <?php
                        }
                        echo '<input type="hidden" id="quantidade_linhas_tabelas" value="'.$qtd_linhas_tabelas.'">';
                    ?>
                </tbody>
            </table>
        </div>
            <div class="paginacao">
                <?php
                    $sqlTotalInsumos = "SELECT id FROM insumos WHERE tipo_insumos_id $categoria_id_for_select";
                    $queryTotalInsumos = mysqli_query($conexao,$sqlTotalInsumos) or die(mysqli_error($conexao));

                    $numTotalInsumos = mysqli_num_rows($queryTotalInsumos);
                    $totalPaginasInsumos = ceil($numTotalInsumos/$quantidade_registros_insumos);
                    
                    echo "<a href=\"?menuop=$string_link_procurar_insumo&pagina=1\">Início</a> ";

                    if ($pagina>6) {
                        ?>
                            <a href="?menuop=<?=$string_link_procurar_insumo?>&pagina=<?php echo $pagina-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasInsumos;$i++){

                        if ($i >= ($pagina) && $i <= ($pagina+5)) {
                            
                            if ($i==$pagina) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=$string_link_procurar_insumo&pagina=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina<($totalPaginasInsumos-5)) {
                        ?>
                            <a href="?menuop=<?=$string_link_procurar_insumo?>&pagina=<?php echo $pagina+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=$string_link_procurar_insumo&pagina=$totalPaginasInsumos\">Fim</a>";
                ?>
            </div>
    </div>
</section>