<?php
$qtd_registros = 10;

$pagina = (isset($_GET['pagina']))?(int)$_GET['pagina']:1;

$inicio = ($qtd_registros * $pagina) - $qtd_registros;

$txt_pesquisa = (isset($_POST["txt_pesquisa"]))?$_POST["txt_pesquisa"]:"";

if ($sessionUserType!=2 && $sessionUserType!=3) {
    $painel_tmp = "Disp";
}else {
    $painel_tmp = $txt_pesquisa;
}

$painel = $painel_tmp; 

$sql = "SELECT 
            id,
            tipo
        FROM 
            tipos_estoques
        WHERE
            id = '{$txt_pesquisa}' or tipo LIKE '{$txt_pesquisa}%'
            ORDER BY tipo ASC 
            LIMIT $inicio,$qtd_registros";
$rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

$resultados = '';
if ($rs->num_rows > 0){
    while($dados = mysqli_fetch_assoc($rs)){
        $qtd_linhas_tabelas++;

        $id = $dados["id"];
        $tipo = $dados['tipo'];
        $tipo_estoque_sem_acento = retiraAcentos($tipo);


        $resultados .= '
            <tr class="tabela_dados">
                <td>'. $id .'</td>
                <td>
                    <a href="index.php?menuop='.$tipo_estoque_sem_acento.'_resumo&'.$tipo_estoque_sem_acento.'=1" class="form-control">'.$tipo.'</a>
                </td>
                <td class="" id="td_operacoes_editar_deletar">
                    <a href="index.php?menuop=edit_tp_estoque&id='.$id.'" class="confirmaEdit">
                        <button class="btn">
                            <span class="icon">
                                <ion-icon name="create-outline"></ion-icon>
                            </span>
                        </button>
                    </a>
                    <a href="index.php?menuop=excl_tp_estoque&id='.$id.'" class="confirmaDelete">
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
            <td colspan="3" class="text-center">Nenhum registro para exibir!</td>
        </tr>';

}
?>

<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Tipos de Estoque</h3>
                <a href="index.php?menuop=cad_tp_estoque">
                    <button class="btn" id="operacao_cadastro">Novo Tipo de Estoque</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=tipos_estoque" method="post" class="form_buscar">
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
                        <th>Tipo</th>
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
                $sqlTotalEstoques = "SELECT id FROM tipos_estoques";
                $queryTotalEstoques = mysqli_query($conexao,$sqlTotalEstoques) or die(mysqli_error($conexao));

                $numTotalEstoques = mysqli_num_rows($queryTotalEstoques);
                $totalPaginasEstoques = ceil($numTotalEstoques/$qtd_registros);
                
                echo "<a href=\"?menuop=tipos_estoque&pg=1\">Início</a> ";

                if ($pagina>6) {
                    ?>
                        <a href="?menuop=tipos_estoque&pg=<?php echo $pagina-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasEstoques;$i++){

                    if ($i >= ($pagina) && $i <= ($pagina+5)) {
                        
                        if ($i==$pagina) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=tipos_estoque&pg=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina<($totalPaginasEstoques-5)) {
                    ?>
                        <a href="?menuop=tipos_estoque&pg=<?php echo $pagina+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=tipos_estoque&pg=$totalPaginasEstoques\">Fim</a>";
            ?>
        </div>
    </div>
</section>