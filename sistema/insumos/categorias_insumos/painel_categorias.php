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

    $estoqueNomeReal = $stringList[1];
    $nome_insumo = $stringList[2];

}

$qualInsumo = $nome_insumo;

$qualEstoque_dep = $estoqueNomeReal;


if ($qualEstoque_dep != "") {
    $qualEstoque = $qualEstoque_dep;
    // echo "é dep: " . $qualEstoque;
}

?>

<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Categorias de Insumos</h3>
                <a href="index.php?menuop=cadastro_categoria_insumo">
                    <button class="btn" id="operacao_cadastro">Nova categoria</button>
                </a>
                <a href="index.php?menuop=cadastro_insumo">
                    <button class="btn" id="operacao_cadastro">Cadastrar Novo Insumo</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=categorias_insumos" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_insumos" placeholder="Buscar">
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
                        <th>Insumos na Categoria</th>
                        <th>Descrição</th>
                        <th id="th_operacoes_editar_deletar">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_insumos = 10;

                        $pagina_insumos = (isset($_GET['pagina_insumos']))?(int)$_GET['pagina_insumos']:1;

                        $inicio_insumos = ($quantidade_registros_insumos * $pagina_insumos) - $quantidade_registros_insumos;

                        $txt_pesquisa_insumos = (isset($_POST["txt_pesquisa_insumos"]))?$_POST["txt_pesquisa_insumos"]:"";


                        if ($sessionUserType!=2 && $sessionUserType!=3) {
                            $painel_tmp = "Disp";
                        }else {
                            $painel_tmp = $txt_pesquisa_insumos;
                        }

                        $painel = $painel_tmp; 
                        // echo $painel;

                        $sql = "SELECT 
                                    tp.tipos_insumos_id,
                                    tp.tipos_insumos_tipo,
                                    tp.tipos_insumos_descricao
                                FROM 
                                    tipos_insumos tp
                                WHERE
                                    tp.tipos_insumos_id = '{$txt_pesquisa_insumos}' or tp.tipos_insumos_tipo LIKE '{$painel}%'
                                    ORDER BY tipos_insumos_tipo ASC 
                                    LIMIT $inicio_insumos,$quantidade_registros_insumos";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                            $qtd_linhas_tabelas++;

                            $tipo_de_insumo_bruto = $dados['tipos_insumos_tipo'];
                            $tipo_de_insumo_id = $dados['tipos_insumos_id'];
                            // echo $tipo_de_insumo_id;

                            $nome_real_estoque = retiraAcentos($tipo_de_insumo_bruto);

                            $sql = "SELECT 
                                        count(i.insumos_id) as qtd_insumos
                                    FROM 
                                        insumos i
                                    WHERE
                                        i.insumos_tipo_insumos_id = {$tipo_de_insumo_id}";
                            $rs_info = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                            $dados_info = mysqli_fetch_assoc($rs_info);
                        
                    ?>
                    <tr>
                    <tr class="tabela_dados">
                        <td><?=$dados["tipos_insumos_id"]?></td>
                        <td>
                            <a href="index.php?menuop=insumos&categoriaInsumoId=<?=$dados['tipos_insumos_id']?>" class="form-control"><?=$dados['tipos_insumos_tipo']?></a>
                        </td>
                        <td><?=$dados_info["qtd_insumos"]?></td>
                        <td><?=$dados["tipos_insumos_descricao"]?></td>
                        <td class="operacoes" id="td_operacoes_editar_deletar">
                            <a href="index.php?menuop=editar_categoria_insumos&id=<?=$dados["tipos_insumos_id"]?>" class="confirmaEdit">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                            <a href="index.php?menuop=excluir_categoria_insumos&id=<?=$dados["tipos_insumos_id"]?>" class="confirmaDelete">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
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
                $sqlTotalinsumos = "SELECT tipos_insumos_id FROM tipos_insumos";
                $queryTotalinsumos = mysqli_query($conexao,$sqlTotalinsumos) or die(mysqli_error($conexao));

                $numTotalinsumos = mysqli_num_rows($queryTotalinsumos);
                $totalPaginasinsumos = ceil($numTotalinsumos/$quantidade_registros_insumos);
                
                echo "<a href=\"?menuop=categorias_insumos&pagina_insumos=1\">Início</a> ";

                if ($pagina_insumos>6) {
                    ?>
                        <a href="?menuop=categorias_insumos?pagina_insumos=<?php echo $pagina_insumos-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasinsumos;$i++){

                    if ($i >= ($pagina_insumos) && $i <= ($pagina_insumos+5)) {
                        
                        if ($i==$pagina_insumos) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=categorias_insumos&pagina_insumos=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina_insumos<($totalPaginasinsumos-5)) {
                    ?>
                        <a href="?menuop=categorias_insumos?pagina_insumos=<?php echo $pagina_insumos+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=categorias_insumos&pagina_insumos=$totalPaginasinsumos\">Fim</a>";
            ?>
        </div>
    </div>
</section>