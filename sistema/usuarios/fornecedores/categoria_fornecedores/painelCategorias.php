<?php 

$quantidade_registros = 10;

$pagina = (isset($_GET['pagina']))?(int)$_GET['pagina']:1;

$inicio = ($quantidade_registros * $pagina) - $quantidade_registros;

$txt_pesquisa = (isset($_POST["txt_pesquisa"]))?$_POST["txt_pesquisa"]:"";

$sql = "SELECT 
            id,
            categoria,
            descricao
        FROM 
            categorias_fornecedores
        WHERE
            id = '{$txt_pesquisa}' or categoria LIKE '%{$txt_pesquisa}%' or descricao LIKE '%{$txt_pesquisa}%'
            ORDER BY categoria ASC 
            LIMIT $inicio,$quantidade_registros";

$rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));


$resultados = '';
if ($rs->num_rows > 0){
    while($dados_para_while = mysqli_fetch_assoc($rs)){
        
        $id = $dados_para_while["id"];
        $categoria = $dados_para_while["categoria"];
        $descricao = $dados_para_while["descricao"];

        $sql = "SELECT 
                    count(id) as qtd_fornecedores
                FROM 
                    fornecedores f
                WHERE
                    ctg_fornecedores_id = {$id}";
        $rs_info = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
        $dados_info = mysqli_fetch_assoc($rs_info);

        $qtd_fornecedores = $dados_info["qtd_fornecedores"];

        $resultados .= '
            <tr class="tabela_dados">
                <td>'. $id .'</td>
                <td>'. $categoria .'</td>
                <td>'. $qtd_fornecedores .'</td>
                <td>'. $descricao .'</td>
                <td class="" id="td_operacoes_editar_deletar">
                    <a href="index.php?menuop=editar_categoria_fornecedores&id='.$id.'" class="confirmaEdit">
                        <button class="btn">
                            <span class="icon">
                                <ion-icon name="create-outline"></ion-icon>
                            </span>
                        </button>
                    </a>
                    <a href="index.php?menuop=excluir_categoria_fornecedor&categoriaId='.$id.'" class="confirmaDelete">
                        <button class="btn">
                            <span class="icon">
                                <ion-icon name="trash-outline"></ion-icon>
                            </span>
                        </button>
                    </a>
                </td>
            </tr>';
        $qtd_linhas_tabelas++;
    }
} else{
    $resultados = '
        <tr class="tabela_dados">
            <td colspan="4" class="text-center">Nenhum registro para exibir!</td>
        </tr>';

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
                        <th>ID</th>
                        <th>Categoria</th>
                        <th>Total da Categoria</th>
                        <th>Descrição</th>
                        <th id="th_operacoes_editar_deletar">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        echo $resultados;
                        echo '<input type="hidden" id="quantidade_linhas_tabelas" value="'.$qtd_linhas_tabelas.'">';
                    ?>
                </tbody>
            </table>
        </div>
        <div class="paginacao">
            <?php
                $sqtTotalRegistros = "SELECT id FROM categorias_fornecedores";
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