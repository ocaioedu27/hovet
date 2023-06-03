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
            <hr style="border-color: transparent;">
            <hr>
        <div class="group_cards" style="justify-content: space-between; ">
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
                            tp.tipos_insumos_tipo
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
            <div class="content_cards">
                <div class="titulo" style="padding: 0;">
                    <h2 title="Todos os insumos referentes a respectiva categoria">
                        <a href="index.php?menuop=insumos&categoriaInsumoId=<?=$dados['tipos_insumos_id']?>"><?=$dados['tipos_insumos_tipo']?></a>
                    </h2>
                    <span class="info">
                        <ion-icon name="help-circle-outline"></ion-icon>
                    </span>
                </div>
                <div class="cards cards_info" style="width: 380px;height: 165px;">
                    <div class="display-flex-row just-content-spc-around">
                        <div class="sub_dados">
                            <div class="titulo">
                                <h4>Nessa categoria</h4>
                                <span class="icon">
                                    <ion-icon name="file-tray-full-outline"></ion-icon>
                                </span>
                            </div>
                            <h3>Total de cadastrados: <?=$dados_info['qtd_insumos']?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
                echo '<input type="hidden" id="quantidade_linhas_tabelas" value="'.$qtd_linhas_tabelas.'">';
            ?>
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