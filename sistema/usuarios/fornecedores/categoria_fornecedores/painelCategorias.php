<?php 

$stringList = array();

if ( isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
    // $contador = 0;
	// foreach ( $_GET as $chave => $valor ) {
    //     $valor_tmp = $chave;
    //     $position = strpos($valor_tmp, "menuop");
    //     $valor_est = strstr($valor_tmp,$position);
    //     array_push($stringList, $valor_est);

	// }
    // // var_dump($stringList);

    // echo "teste";


}



?>

<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Categorias de Fornecedores</h3>
                <a href="index.php?menuop=cadastroCategoriaFornecedor">
                    <button class="btn" id="operacao_cadastro">Nova categoria</button>
                </a>
                <a href="index.php?menuop=cadastro_fornecedores">
                    <button class="btn" id="operacao_cadastro">Cadastrar Novo Fornecedor</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=categorias_fornecedores" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa" placeholder="Buscar">
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
                        <th>Categoria</th>
                        <th>Total da Categoria</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros = 10;

                        $pagina = (isset($_GET['pagina']))?(int)$_GET['pagina']:1;

                        $inicio = ($quantidade_registros * $pagina) - $quantidade_registros;

                        $txt_pesquisa = (isset($_POST["txt_pesquisa"]))?$_POST["txt_pesquisa"]:"";

                        $sql = "SELECT 
                                    cf.cf_id,
                                    cf.cf_categoria,
                                    cf.cf_descricao
                                FROM 
                                    categorias_fornecedores as cf
                                WHERE
                                    cf.cf_id = '{$txt_pesquisa}' or cf.cf_categoria LIKE '%{$txt_pesquisa}%' or cf.cf_descricao LIKE '%{$txt_pesquisa}%'
                                    ORDER BY cf_categoria ASC 
                                    LIMIT $inicio,$quantidade_registros";

                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

                        
                        while($dados = mysqli_fetch_assoc($rs)){
                            $qtd_linhas_tabelas++;

                            $ctg_fornecedor_id = $dados['cf_id'];

                            $sql = "SELECT 
                                        count(f.fornecedores_id) as qtd_fornecedores
                                    FROM 
                                        fornecedores f
                                    WHERE
                                        f.fornecedores_ctg_fornecedores_id = {$ctg_fornecedor_id}";
                            $rs_info = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                            $dados_info = mysqli_fetch_assoc($rs_info);
                        
                    ?>
                    <tr class="tabela_dados">
                        <td class="operacoes" id="td_operacoes_editar_deletar">
                            <a href="index.php?menuop=editar_categoria_fornecedores&id=<?=$dados["cf_id"]?>" class="confirmaEdit">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                            <a href="index.php?menuop=excluir_categoria_fornecedor&categoriaId=<?=$dados["cf_id"]?>" class="confirmaDelete">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
                        <td><?=$dados["cf_id"]?></td>
                        <td>
                            <a href="index.php?menuop=fornecedores&fornecedores_ctg_id=<?=$dados["cf_id"]?>" class="form-control"><?=$dados["cf_categoria"]?></a>
                        </td>
                        <td><?=$dados_info["qtd_fornecedores"]?></td>
                        <td><?=$dados["cf_descricao"]?></td>
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
                $sqtTotalRegistros = "SELECT cf_id FROM categorias_fornecedores";
                $queryTotalRegistros = mysqli_query($conexao,$sqtTotalRegistros) or die(mysqli_error($conexao));

                $numTotalRegistros = mysqli_num_rows($queryTotalRegistros);
                $totalPaginas = ceil($numTotalRegistros/$quantidade_registros);
                
                echo "<a href=\"?menuop=categorias_fornecedores&pagina=1\">Início</a> ";

                if ($pagina>6) {
                    ?>
                        <a href="?menuop=categorias_fornecedores&pagina=<?php echo $pagina-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginas;$i++){

                    if ($i >= ($pagina) && $i <= ($pagina+1)) {
                        
                        if ($i==$pagina) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=categorias_fornecedores&pagina=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina<($totalPaginas-5)) {
                    ?>
                        <a href="?menuop=categorias_fornecedores&pagina=<?php echo $pagina+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=categorias_fornecedores&pagina=$totalPaginas\">Fim</a>";
            ?>
        </div>
    </div>
</section>