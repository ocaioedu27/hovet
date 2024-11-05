<?php

$stringList = array();

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


// Para listar os dados da tabela

$quantidade_registros_solicitacoes = 10;

$pagina = (isset($_GET[$qualEstoque]))?(int)$_GET[$qualEstoque]:1;

// print_r($_GET);

$inicio = ($quantidade_registros_solicitacoes * $pagina) - $quantidade_registros_solicitacoes;

$txt_pesquisa = (isset($_POST["txt_pesquisa"]))?$_POST["txt_pesquisa"]:"";

$sql = "SELECT
    s.id,
    s.qtd_solicitada,
    s.oid_solicitacao,
    s.data,
    s.justificativa,
    stt.status,
    st.setor,
    es.nome,
    tp.movimentacao,
    u.primeiro_nome,
    i.nome
    
FROM pre_solicitacoes s
    
    INNER JOIN usuarios u
    ON s.usuario_id = u.id
    
    INNER JOIN dispensario d
    ON s.dispensario_id = d.id
    
    INNER JOIN estoques es
    ON d.estoque_id = es.id
    
    INNER JOIN insumos i
    ON d.insumos_id = i.id 
    
    INNER JOIN setores st
    ON s.setor_destino_id = st.id
    
    INNER JOIN status_slc stt
    ON s.status_slc_id = stt.id
    
    INNER JOIN tipos_movimentacoes tp
    ON s.tp_movimentacoes_id = tp.id

WHERE
    s.usuario_id = {$sessionUserID} AND stt.status = '{$qualStatus}' AND
    (s.oid_solicitacao LIKE '%{$txt_pesquisa}%' or u.primeiro_nome LIKE '%{$txt_pesquisa}%' or
    tp.movimentacao LIKE '%{$txt_pesquisa}%')
    
GROUP BY oid_solicitacao 
ORDER BY data DESC 
    
LIMIT $inicio,$quantidade_registros_solicitacoes";

try {
    $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
//code...
} catch (\Throwable $th) {
    echo $th;
}

$resultados = '';
if ($rs->num_rows > 0){
    while($dados_para_while = mysqli_fetch_assoc($rs)){
        
        $id = $dados_para_while["id"];
        $oid_solicitacao = $dados_para_while["oid_solicitacao"];
        $movimentacao_tmp = $dados_para_while["movimentacao"];
        $movimentacao = strtok($movimentacao_tmp, " ");
        $primeiro_nome = $dados_para_while["primeiro_nome"];
        $nome = $dados_para_while["nome"];
        $data = date("d/m/Y H:i", strtotime($dados_para_while["data"]));
        $status = $dados_para_while['status'];

        $resultados .= '
            <tr class="tabela_dados">
                <td>'. $oid_solicitacao .'</td>
                <td>'. $movimentacao .'</td>
                <td>'. $primeiro_nome .'</td>
                <td>'. $nome .'</td>
                <td>'. $data .'</td>
                <td>
                    <a href="index.php?menuop=pre_solicitacoes&idSolicitacao='. $oid_solicitacao . '&'. $status .'">Informações</a>
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
<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Minhas Solicitações</h3>
                <div>
                    <div class="menu-hamburguer" onclick="habilitaDropdown('dropdown-content', 'block')">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="dropdown-content dropdown-content-on" id="dropdown-content">
                        <a href="index.php?menuop=minhas_solicitacoes&Aprovada">
                            <button class="btn">Aprovadas</button>
                        </a>
                        <a href="index.php?menuop=minhas_solicitacoes&Pendente">
                            <button class="btn">Pendentes</button>
                        </a>
                        <a href="index.php?menuop=minhas_solicitacoes&Recusada">
                            <button class="btn">Recusadas</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="d-flex jf-cnt-end">
                <form action="index.php?menuop=minhas_solicitacoes&<?=$qualStatus?>" method="post" class="form_buscar">
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
                        <th>Tipo de Solicitação</th>
                        <th>Solicitante</th>
                        <th>Dispensário de Origem</th>
                        <th>Data e Horário</th>
                        <th id="">Detalhes</th>
                    </tr>
                </thead>
                <tbody>

                    <?=$resultados?>
                    <?php
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
                                    st.id = ps.id 
                                WHERE 
                                    st.status = '{$qualStatus}'
                                GROUP BY oid_solicitacao";

                $queryTotalSlc = mysqli_query($conexao,$sqlTotalSlc) or die(mysqli_error($conexao));

                $numTotalSlc = mysqli_num_rows($queryTotalSlc);

                $totalPaginasSlc = ceil($numTotalSlc/$quantidade_registros_solicitacoes);
                if ($totalPaginasSlc == 0) {
                    $totalPagtotalPaginasSlcinas = 1;
                }

                echo "<a href=\"?menuop=minhas_solicitacoes&" . $qualStatus . "&pagina=1\">Início</a> ";

                if ($pagina>6) {
                    ?>
                        <a href="?menuop=minhas_solicitacoes&<?=$qualStatus?>&pagina=<?php echo $pagina-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasSlc;$i++){

                    if ($i >= ($pagina) && $i <= ($pagina+5)) {
                        
                        if ($i==$pagina) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=minhas_solicitacoes&" . $qualStatus . "&pagina=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina<($totalPaginasSlc-4)) {
                    ?>
                        <a href="?menuop=minhas_solicitacoes&<?=$qualStatus?>&pagina=<?php echo $pagina+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=minhas_solicitacoes&$qualStatus&pagina=$totalPaginasSlc\">Fim</a>";
            ?>
        </div>
    </div>
</section>