<?php

use Sabberworm\CSS\Value\Value;
$stringList = array();
// var_dump($_GET);

if (   isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
        array_push($stringList, $valor_est);
        // print_r($valor_est);
	}

    $qualStatus_tmp = $stringList[1];
    $qualStatus = $qualStatus_tmp;

    $pagina_slc_tmp = $stringList[2];
    $pagina_slc = $pagina_slc_tmp;
    // echo "<br>Tipo de operacao: $qualStatus_tmp";
}
               
$qtd_registros = 10;

$pagina = (isset($_GET[$qualEstoque]))?(int)$_GET[$qualEstoque]:1;

// print_r($_GET);

$inicio_solicitacoes = ($qtd_registros * $pagina) - $qtd_registros;

$txt_pesquisa = (isset($_POST["txt_pesquisa"]))?$_POST["txt_pesquisa"]:"";

$sql = "SELECT
    s.id,
    u.primeiro_nome,
    s.oid_solicitacao,
    s.data,
    stt.status,
    es.nome as estoques_nome,
    tp.movimentacao
    
FROM pre_solicitacoes s
    
    INNER JOIN usuarios u
    ON s.usuario_id = u.id
    
    INNER JOIN status_slc stt
    ON s.status_slc_id = stt.id
    
    INNER JOIN dispensario d
    ON s.dispensario_id = d.id
    
    INNER JOIN estoques es
    ON d.estoque_id = es.id
    
    INNER JOIN tipos_movimentacoes tp
    ON s.tp_movimentacoes_id = tp.id

WHERE
    stt.status = '{$qualStatus}' AND
    (s.oid_solicitacao LIKE '%{$txt_pesquisa}%' or u.primeiro_nome LIKE '%{$txt_pesquisa}%' or
    tp.movimentacao LIKE '%{$txt_pesquisa}%')
    
GROUP BY oid_solicitacao 
ORDER BY data DESC 
    
LIMIT $inicio_solicitacoes,$qtd_registros";
$rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));


$resultados = '';
if ($rs->num_rows > 0){
    while($dados_para_while = mysqli_fetch_assoc($rs)){
        $oid_solicitacao = $dados_para_while["oid_solicitacao"];
        $movimentacao_tmp = $dados_para_while["movimentacao"];
        $movimentacao = strtok($movimentacao_tmp, " ");
        $primeiro_nome = $dados_para_while["primeiro_nome"];
        $estoques_nome = $dados_para_while["estoques_nome"];
        $data = date("d/m/Y H:i", strtotime($dados_para_while["data"]));
        $status = $dados_para_while['status'];

        $resultados .= '
            <tr class="tabela_dados">
                <td>'. $oid_solicitacao .'</td>
                <td>'. $movimentacao .'</td>
                <td>'. $primeiro_nome .'</td>
                <td>'. $estoques_nome .'</td>
                <td>'. $data .'</td>
                <td>
                    <a href="index.php?menuop=pre_solicitacoes&idSolicitacao='. $oid_solicitacao . '&'. $status .'">Informações</a>
                </td>
            </tr>';

        $qtd_linhas_tabelas++;

    }
} else{
    $resultados = '
        <tr class="tabela_dados">
            <td colspan="6" class="text-center">Nenhum registro para exibir!</td>
        </tr>';

}  


?>

<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Solicitações</h3>
                <?php
                    
                    $sqlStatusTipo = "SELECT * FROM status_slc";
                    $resultTotalStatus = mysqli_query($conexao,$sqlStatusTipo) or die("//sql_status - erro ao realizar a consulta: " . mysqli_error($conexao));

                    while($tipo_status_slc = mysqli_fetch_assoc($resultTotalStatus)){
                    
                    ?>
                    
                    <a href="index.php?menuop=solicitacoes_resumo&<?=$tipo_status_slc['status']?>">
                        <button class="btn"><?=$tipo_status_slc['status']?>s</button>
                    </a>

                <?php
                    }
                ?>
            </div>
            <div>
                <form action="index.php?menuop=solicitacoes_resumo&<?=$qualStatus?>" method="post" class="form_buscar">
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
                        <th>Tipo de Solicitação</th>
                        <th>Solicitante</th>
                        <th>Dispensário de Origem</th>
                        <th>Data e Horário</th>
                        <th id="">Detalhes</th>
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
                $sqlTotalSlc = "SELECT 
                                    ps.id 
                                FROM 
                                    pre_solicitacoes ps
                                INNER JOIN 
                                    status_slc st
                                ON 
                                    st.id = ps.status_slc_id 
                                WHERE 
                                    st.status = '{$qualStatus}'
                                GROUP BY oid_solicitacao";

                $queryTotalSlc = mysqli_query($conexao,$sqlTotalSlc) or die(mysqli_error($conexao));

                $numTotalSlc = mysqli_num_rows($queryTotalSlc);

                $totalPaginasSlc = ceil($numTotalSlc/$qtd_registros);

                echo "<a href=\"?menuop=solicitacoes_resumo&" . $qualStatus . "&pagina=1\">Início</a> ";

                if ($pagina>6) {
                    ?>
                        <a href="?menuop=solicitacoes_resumo&<?=$qualStatus?>&pagina=<?php echo $pagina-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasSlc;$i++){
                    // print_r($i);

                    if ($i >= ($pagina) && $i <= ($pagina+5)) {
                        
                        if ($i==$pagina) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=solicitacoes_resumo&" . $qualStatus . "&pagina=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina<($totalPaginasSlc-4)) {
                    ?>
                        <a href="?menuop=solicitacoes_resumo&<?=$qualStatus?>&pagina=<?php echo $pagina+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=solicitacoes_resumo&$qualStatus&pagina=$totalPaginasSlc\">Fim</a>";
            ?>
        </div>
    </div>
</section>
