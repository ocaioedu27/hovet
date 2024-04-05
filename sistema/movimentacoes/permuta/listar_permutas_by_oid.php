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

    $qtd_registro = 10;

    $pagina = (isset($_GET['pagina']))?(int)$_GET['pagina']:1;

    $inicio_permutas = ($qtd_registro * $pagina) - $qtd_registro;

    $txt_pesquisa = (isset($_POST["txt_pesquisa"]))?$_POST["txt_pesquisa"]:"";

    $sql = "SELECT 
                p.oid_operacao,
                p.data,
                ins.nome as nome_insumo_cadastrado,
                i.nome as nome_insumo_retirado,
                f.razao_social

            FROM permutas p
            
                INNER JOIN usuarios u
                ON p.usuario_id = u.id
            
                INNER JOIN deposito dep_cad
                ON p.deposito_id_cadastrado = dep_cad.id
            
                INNER JOIN insumos i
                ON dep_cad.insumos_id = i.id

                INNER JOIN estoques e
                ON dep_cad.estoque_id = e.id
            
                INNER JOIN deposito dep_remv 
                ON p.deposito_id_removido = dep_remv.id
            
                INNER JOIN insumos ins
                ON dep_remv.insumos_id = ins.id
            
                INNER JOIN estoques es
                ON dep_remv.estoque_id = es.id

                INNER JOIN fornecedores f
                ON p.fornecedor_id = f.id
                
                WHERE
                    p.oid_operacao='{$oid_operacao}'
                    ORDER BY p.data DESC 
                    LIMIT $inicio_permutas,$qtd_registro";
    $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

    $resultados = '';
    if ($rs->num_rows > 0){
        while($dados = mysqli_fetch_assoc($rs)){
            
            $permutas_oid_operacao = $dados["oid_operacao"];
            $nome_insumo_retirado = $dados['nome_insumo_retirado'];
            $fornecedores_razao_social = $dados["razao_social"];
            $nome_insumo_cadastrado = $dados['nome_insumo_cadastrado'];
            $permutas_data = date("d/m/Y H:i", strtotime($dados["data"]));

            $resultados .= '
                <tr class="tabela_dados">
                    <td>'. $permutas_oid_operacao .'</td>
                    <td>'. $nome_insumo_retirado .'</td>
                    <td>'. $fornecedores_razao_social .'</td>
                    <td>'. $nome_insumo_cadastrado .'</td>
                    <td>'. $permutas_data .'</td>
                    <td class="operacoes">
                        <a href="index.php?menuop=detalhar_permuta&permutaId='. $permutas_oid_operacao . '">Ver detalhes</a>
                    </td>
                </tr>';
        }
    } else{
        $resultados = '
            <tr class="tabela_dados">
                <td colspan="6" class="text-center">Nenhum registro para exibir!</td>
            </tr>';
    }

?>

<section class="painel_insumos">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Permutas com registro "<?=$oid_operacao?>"</h3>
            </div>
            <div>
                <form action="index.php?menuop=permuta_por_oid&oidPermuta=<?=$oid_operacao?>" method="post" class="form_buscar">
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
                    <tr class="tabela_dados">
                        <th>ID de Resgistro</th>
                        <th>Insumo Retirado</th>
                        <th>Instituição</th>
                        <th>Insumo Cadastrado</th>
                        <th>Data da Permuta</th>
                        <th>Visualizar Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    <?=$resultados?>
                </tbody>
            </table>
        </div>
            <div class="paginacao">
                <?php

                    // echo $oid_operacao;

                    $sqlTotalInsumos = "SELECT 
                                            id 
                                        FROM 
                                            permutas
                                        WHERE 
                                            oid_operacao = '{$oid_operacao}'";
                    $queryTotalInsumos = mysqli_query($conexao,$sqlTotalInsumos) or die(mysqli_error($conexao));

                    $numTotalInsumos = mysqli_num_rows($queryTotalInsumos);
                    $totalPaginasInsumos = ceil($numTotalInsumos/$qtd_registro);
                    
                    echo "<a href=\"?menuop=permuta_por_oid&oidPermuta=$oid_operacao&pagina=1\">Início</a> ";

                    if ($pagina>6) {
                        ?>
                            <a href="?menuop=permuta_por_oid&oidPermuta=<?=$oid_operacao?>&pagina=<?php echo $pagina-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasInsumos;$i++){

                        if ($i >= ($pagina) && $i <= ($pagina+5)) {
                            
                            if ($i==$pagina) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=permuta_por_oid&oidPermuta=$oid_operacao&pagina=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina<($totalPaginasInsumos-5)) {
                        ?>
                            <a href="?menuop=permuta_por_oid&oidPermuta=<?=$oid_operacao?>&pagina=<?php echo $pagina+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=permuta_por_oid&oidPermuta=$oid_operacao&pagina=$totalPaginasInsumos\">Fim</a>";
                ?>
            </div>
    </div>
</section>