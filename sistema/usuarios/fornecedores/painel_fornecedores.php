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
    $string_link_cadastro_fornecedor = "";
    $string_link_procurar_fornecedor = "";

    // fornecedores_ctg_id

    if (isset($categoriaId) && $chave_categoria == "fornecedores_ctg_id") {

        $categoria_id_for_select = "= " . $categoriaId;
        $string_link_cadastro_fornecedor = "cadastro_fornecedores&fornecedores_ctg_id=" . $categoriaId;
        $string_link_procurar_fornecedor = "fornecedores&fornecedores_ctg_id=" . $categoriaId;

        $sql_nome = "SELECT
                        categoria
                    FROM 
                        categorias_fornecedores
                    WHERE
                        id = {$categoriaId}";

        $resultado_nome = mysqli_query($conexao,$sql_nome) or die("Erro ao coletar o nome da categoria! " . mysqli_error($conexao));
        $categoria_nome_tmp = mysqli_fetch_assoc($resultado_nome);

        $categoria_nome = $categoria_nome_tmp['categoria'];
        
    } else {
        $categoria_id_for_select = "IS NOT NULL";
        $categoria_nome = "Todos os Fornecedores";
        $string_link_cadastro_fornecedor = "cadastro_fornecedores";
        $string_link_procurar_fornecedor = "fornecedores";
    }

}


$qtd_registros = 10;

$pagina = (isset($_GET['pagina']))?(int)$_GET['pagina']:1;

$inicio = ($qtd_registros * $pagina) - $qtd_registros;

$txt_pesquisa = (isset($_POST["txt_pesquisa"]))?$_POST["txt_pesquisa"]:"";

$sql = "SELECT 
            f.id,
            f.razao_social,
            f.cpf_cnpj,
            f.end_logradouro,
            f.end_email,
            c.categoria
        FROM 
            fornecedores f
        INNER JOIN 
            categorias_fornecedores c
        ON 
            c.id = f.ctg_fornecedores_id

        WHERE
            f.ctg_fornecedores_id {$categoria_id_for_select} 
            and 
            (f.id='{$txt_pesquisa}' or
            f.razao_social LIKE '%{$txt_pesquisa}%' or
            f.cpf_cnpj LIKE '%{$txt_pesquisa}%' or
            f.end_logradouro LIKE '%{$txt_pesquisa}%' or
            f.end_email LIKE '%{$txt_pesquisa}%' or
            c.categoria LIKE '%{$txt_pesquisa}%')
            ORDER BY f.razao_social ASC 
            LIMIT $inicio,$qtd_registros";

$rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

$resultados_to_show;
if($rs->num_rows > 0){
    while($dados = mysqli_fetch_assoc($rs)){
        $qtd_linhas_tabelas++;

        $id = $dados["id"];
        $razao_social = $dados["razao_social"];
        $end_email = $dados["end_email"];
        $end_logradouro = $dados["end_logradouro"];
        $cpf_cnpj = $dados["cpf_cnpj"];
        $categoria = $dados["categoria"];

        $resultados_to_show = '<tr class="tabela_dados">
            <td>'. $id .'</td>
            <td>'. $razao_social .'</td>
            <td>'. $end_email .'</td>
            <td>'. $end_logradouro .'</td>
            <td>'. $cpf_cnpj .'></td>
            <td>'. $categoria .'</td>
            <td class="operacoes" id="td_operacoes_editar_deletar">
                <a href="index.php?menuop=editar_fornecedor&fornecedores_ctg_id='. $categoriaId .'&id='. $id .'" class="confirmaEdit">
                    <button class="btn">
                        <span class="icon">
                            <ion-icon name="create-outline"></ion-icon>
                        </span>
                    </button>
                </a>
                <a href="index.php?menuop=excluir_fornecedor&fornecedores_ctg_id='. $categoriaId .'&id='. $id .'" class="confirmaDelete">
                    <button class="btn">
                        <span class="icon">
                            <ion-icon name="trash-outline"></ion-icon>
                        </span>
                    </button>
                </a>
            </td>
        </tr>';
    }
} else{
    $resultados_to_show = '
        <tr class="tabela_dados">
            <td colspan="7" class="text-center">Nenhum registro para exibir!</td>
        </tr>';
}
?>

<section class="painel_insumos">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3><?=$categoria_nome?></h3>
                <a href="index.php?menuop=<?=$string_link_cadastro_fornecedor?>" id="operacao_cadastro">
                    <button class="btn">Cadastrar</button>
                </a>
                <a href="index.php?menuop=cadastroCategoriaFornecedor" id="operacao_cadastro">
                    <button class="btn">Nova Categoria</button>
                </a>
            </div>
            <div class="d-flex jf-cnt-end">
                <form action="index.php?menuop=<?=$string_link_procurar_fornecedor?>" method="post" class="form_buscar">
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
                        <th>ID</th>
                        <th>Razão Social</th>
                        <th>E-mail</th>
                        <th>Logradouro</th>
                        <th>CPF / CNPJ</th>
                        <th>Categoria</th>
                        <th id="th_operacoes_editar_deletar">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        echo $resultados_to_show;

                        echo '<input type="hidden" id="quantidade_linhas_tabelas" value="'.$qtd_linhas_tabelas.'">';
                    ?>
                </tbody>
            </table>
        </div>
            <?php
                echo $msgSemDados;
            ?>
            <div class="paginacao">
                <?php
                    $sqlTotal = "SELECT id FROM fornecedores WHERE ctg_fornecedores_id $categoria_id_for_select";
                    $queryTotal = mysqli_query($conexao,$sqlTotal) or die(mysqli_error($conexao));

                    $numTotal = mysqli_num_rows($queryTotal);
                    $totalPaginas = ceil($numTotal/$qtd_registros);
                    if ($totalPaginas == 0) {
                        $totalPaginas = 1;
                    }
                    
                    echo "<a href=\"?menuop=$string_link_procurar_fornecedor&pagina=1\">Início</a> ";

                    if ($pagina>6) {
                        ?>
                            <a href="?menuop=<?=$string_link_procurar_fornecedor?>&pagina=<?php echo $pagina-1?>"> << </a>
                        <?php
                    }

                    for($i=1;$i<=$totalPaginas;$i++){
                        if ($i >= ($pagina) && $i <= ($pagina+5)) {
                            if ($i==$pagina) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=$string_link_procurar_fornecedor&pagina=$i\">$i</a> ";
                            } 
                        }          
                    }
                    

                    if ($pagina<($totalPaginas-5)) {
                        ?>
                            <a href="?menuop=<?=$string_link_procurar_fornecedor?>&pagina=<?php echo $pagina+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=$string_link_procurar_fornecedor&pagina=$totalPaginas\">Fim</a>";
                ?>
            </div>
    </div>
</section>