<?php
$qtd_registros = 10;

$pagina = (isset($_GET['pagina']))?(int)$_GET['pagina']:1;

$inicio = ($qtd_registros * $pagina) - $qtd_registros;

$txt_pesquisa = (isset($_POST["txt_pesquisa"]))?$_POST["txt_pesquisa"]:"";

$usuario_nao_autorizado = false;
if ($sessionUserType!=2 && $sessionUserType!=3) {
    $painel_tmp = "Disp";
    $usuario_nao_autorizado = true;
}else {
    $painel_tmp = $txt_pesquisa;
}

$painel = $painel_tmp; 
//echo $txt_pesquisa;

$sql = "SELECT 
            e.id,
            e.nome,
            e.nome_real,
            e.descricao,
            tp.tipo
        FROM 
            estoques e
        INNER JOIN 
            tipos_estoques tp
        ON 
            e.tipos_estoques_id = tp.id
        WHERE
            e.id='$txt_pesquisa' or e.nome LIKE '{$painel}%' or e.descricao LIKE '{$txt_pesquisa}' or e.nome LIKE '{$txt_pesquisa}'
        ORDER BY 
            nome ASC 
        LIMIT 
            $inicio,$qtd_registros";

//echo "<br>select : " . $sql;

$rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

$resultados = '';
if ($rs->num_rows > 0){
    while($dados = mysqli_fetch_assoc($rs)){
        $qtd_linhas_tabelas++;

        $tipo_de_estoque_bruto = $dados['tipo'];
        $estoques_nome_real = $dados['nome_real'];
        $estoques_nome = $dados['nome'];
        //echo "<br>" . $estoques_nome;
        if ($usuario_nao_autorizado && substr($estoques_nome,0,4) != $painel) {
            continue;
        }
        $nome_real_estoque = retiraAcentos($tipo_de_estoque_bruto);

        $id = $dados["id"];
        $descricao = $dados["descricao"];

        $resultados .= '
            <tr class="tabela_dados">
                <td>'. $id .'</td>
                <td>
                    <a href="index.php?menuop='.$nome_real_estoque.'_resumo&'.$estoques_nome_real.'=1" class="form-control">'.$estoques_nome.'</a>
                </td>
                <td>'. $tipo_de_estoque_bruto .'</td>
                <td>'. $descricao .'</td>
                <td class="" id="td_operacoes_editar_deletar">
                    <a href="index.php?menuop=editar_estoque&id='.$id.'" class="confirmaEdit">
                        <button class="btn">
                            <span class="icon">
                                <ion-icon name="create-outline"></ion-icon>
                            </span>
                        </button>
                    </a>
                    <a href="index.php?menuop=excluir_estoque&id='.$id.'" class="confirmaDelete">
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
                <h3>Estoques</h3>
                <a href="index.php?menuop=cadastro_estoque">
                    <button class="btn" id="operacao_cadastro">Novo Estoque</button>
                </a>
                <a href="index.php?menuop=tp_estoque">
                    <button class="btn" id="operacao_retirar">Gerenciar Tipos de Estoque</button>
                </a>
            </div>
            <div class="d-flex jf-cnt-end">
                <form action="index.php?menuop=estoques" method="post" class="form_buscar">
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
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Tipo de Estoque</th>
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
                $sqlTotalEstoques = "SELECT id FROM estoques";
                $queryTotalEstoques = mysqli_query($conexao,$sqlTotalEstoques) or die(mysqli_error($conexao));

                $numTotalEstoques = mysqli_num_rows($queryTotalEstoques);
                $totalPaginasEstoques = ceil($numTotalEstoques/$qtd_registros);
                
                echo "<a href=\"?menuop=estoques&pagina=1\">Início</a> ";

                if ($pagina>6) {
                    ?>
                        <a href="?menuop=estoques?pagina=<?php echo $pagina-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasEstoques;$i++){

                    if ($i >= ($pagina) && $i <= ($pagina+5)) {
                        
                        if ($i==$pagina) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=estoques&pagina=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina<($totalPaginasEstoques-5)) {
                    ?>
                        <a href="?menuop=estoques?pagina=<?php echo $pagina+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=estoques&pagina=$totalPaginasEstoques\">Fim</a>";
            ?>
        </div>
    </div>
</section>