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

    $oid_solicitacao_tmp = $stringList[1];
    $oid_solicitacao = $_GET[$oid_solicitacao_tmp];
    // echo "<br>Oid: $oid_solicitacao";

    $qualStatus_tmp = $stringList[2];
    $qualStatus = $qualStatus_tmp;
    // echo "<br>Tipo de operacao: $qualStatus";
}
// echo 'passou';
?>
<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Solicitação: <?=$oid_solicitacao?></h3>
                <?php
                    
                    $sqlStatusTipo = "SELECT * FROM status_slc";
                    $resultTotalStatus = mysqli_query($conexao,$sqlStatusTipo) or die("//sql_status - erro ao realizar a consulta: " . mysqli_error($conexao));

                    while($tipo_status_slc = mysqli_fetch_assoc($resultTotalStatus)){
                    
                    ?>
                    
                    <a href="index.php?menuop=pre_solicitacoes&idSolicitacao=<?=$oid_solicitacao?>&<?=$tipo_status_slc['status']?>">
                        <button class="btn"><?=$tipo_status_slc['status']?>s</button>
                    </a>

                <?php
                    }
                ?>
            </div>
            <div>
                <form action="index.php?menuop=pre_solicitacoes&idSolicitacao=<?=$oid_solicitacao?>&<?=$qualStatus?>" method="post" class="form_buscar">
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
                        <th>Solicitante</th>
                        <th>Insumo Solicitado</th>
                        <th>Dispensário de Origem</th>
                        <th>Quantidade Solicitada</th>
                        <th>Data e Horário</th>
                        <th>Tipo de Solicitação</th>
                        <th>Status</th>
                        <th id="">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
               
                        $quantidade_registros_solicitacoes = 10;

                        $pagina = (isset($_GET['pagina']))?(int)$_GET['pagina']:1;

                        $inicio = ($quantidade_registros_solicitacoes * $pagina) - $quantidade_registros_solicitacoes;

                        // print_r($inicio);

                        $txt_pesquisa = (isset($_POST["txt_pesquisa"]))?$_POST["txt_pesquisa"]:"";

                        $sql = "SELECT
                                    s.id,
                                    u.primeiro_nome,
                                    i.nome as insumos_nome,
                                    s.qtd_solicitada,
                                    s.oid_solicitacao,
                                    s.data,
                                    st.setor,
                                    s.justificativa,
                                    stt.status,
                                    es.nome as estoques_nome,
                                    tp.movimentacao
                                    
                                FROM pre_solicitacoes s
                                    
                                    INNER JOIN usuarios u
                                    ON s.usuario_id = u.id
                                    
                                    INNER JOIN dispensario d
                                    ON s.dispensario_id = d.id
                                    
                                    INNER JOIN insumos i
                                    ON d.insumos_id = i.id 
                                    
                                    INNER JOIN setores st
                                    ON s.setor_destino_id = st.id
                                    
                                    INNER JOIN status_slc stt
                                    ON s.status_slc_id = stt.id
                                    
                                    INNER JOIN estoques es
                                    ON d.estoque_id = es.id
                                    
                                    INNER JOIN tipos_movimentacoes tp
                                    ON tp.id = s.tp_movimentacoes_id
                                
                                WHERE
                                    s.oid_solicitacao = '{$oid_solicitacao}' AND stt.status = '{$qualStatus}' AND (i.nome LIKE '%{$txt_pesquisa}%' or
                                    u.primeiro_nome LIKE '%{$txt_pesquisa}%' or
                                    tp.movimentacao LIKE '%{$txt_pesquisa}%')
                                    
                                ORDER BY data DESC 
                                    
                                LIMIT $inicio,$quantidade_registros_solicitacoes";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

                        while($dados_para_while = mysqli_fetch_assoc($rs)){
                            // $valor_form = $dados_para_while['estoques_nome_real'];
                            $qtd_linhas_tabelas++;

                            $pre_slc_id = $dados_para_while['id'];
                            // echo $pre_slc_id;
                        
                    ?>
                    <tr>
                        <td><?=$oid_solicitacao?></td>
                        <td><?=$dados_para_while["primeiro_nome"]?></td>
                        <td><?=$dados_para_while["insumos_nome"]?></td>
                        <td><?=$dados_para_while["estoques_nome"]?></td>
                        <td><?=$dados_para_while["qtd_solicitada"]?></td>
                        <td><?php echo date("d/m/Y H:i", strtotime($dados_para_while['data']));?></td>
                        <td>
                            <?php
                                $movimentacao_tmp = $dados_para_while["movimentacao"];
                                $tipo_slc = strtok($movimentacao_tmp, " ");
                                echo $tipo_slc;
                            ?>
                        </td>
                        <td style="color: 
                        <?php
                            $status_slc = $dados_para_while["status"];
                            if($status_slc == "Pendente"){
                                echo "goldenrod";
                            } elseif ($status_slc == "Aprovada"){
                                echo "green";
                            } elseif ($status_slc == "Recusada"){
                                echo "red";
                            }
                        ?>"><?=$status_slc?></td>
                        <td class="operacoes" id="">
                            <a href="index.php?menuop=atualiza_pre_solicitacao&idSolicitacao=<?=$pre_slc_id?>&aprovar"
                                class="confirmaOperacao" id="operacao_slc_aprova">
                                <button class="btn" style="color: green;">Aprovar</button>
                            </a>
                            <a href="index.php?menuop=atualiza_pre_solicitacao&idSolicitacao=<?=$pre_slc_id?>&recusar"
                                class="confirmaOperacao" id="operacao_slc_reprova">
                                <button class="btn" style="color: red;">Recusar</button>
                            </a>
                            <a href="index.php?menuop=detalhes_pre_solicitacao&solicitacao=<?=$oid_solicitacao?>&geral&idSolicitacao=<?=$pre_slc_id?>"
                                class="confirmaOperacao" id="detalhes_slc">
                                <button class="btn" style="color: blue;">Ver detalhes</button>
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
                $sqlTotalSlc = "SELECT 
                                    id 
                                FROM 
                                    pre_solicitacoes
                                WHERE 
                                    oid_solicitacao = '{$oid_solicitacao}'";

                $queryTotalSlc = mysqli_query($conexao,$sqlTotalSlc) or die(mysqli_error($conexao));

                $numTotalSlc = mysqli_num_rows($queryTotalSlc);


                // print_r($numTotalSlc);
                // if ($numTotalSlc == 0) {
                //     $numTotalSlc = 1;
                // }
                $totalPaginasSlc = ceil($numTotalSlc/$quantidade_registros_solicitacoes);

                echo "<a href=\"?menuop=pre_solicitacoes&idSolicitacao=$oid_solicitacao&$qualStatus&pagina=1\">Início</a> ";

                if ($pagina>6) {
                    ?>
                        <a href="?menuop=pre_solicitacoes&idSolicitacao=<?=$oid_solicitacao?>&<?=$qualStatus?>&pagina=<?php echo $pagina-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasSlc;$i++){
                    // print_r($i);

                    if ($i >= ($pagina) && $i <= ($pagina+5)) {
                        
                        if ($i==$pagina) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=pre_solicitacoes&idSolicitacao=$oid_solicitacao&$qualStatus&pagina=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina<($totalPaginasSlc-4)) {
                    ?>
                        <a href="?menuop=pre_solicitacoes&idSolicitacao=<?=$oid_solicitacao?>&<?=$qualStatus?>&pagina=<?php echo $pagina+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=pre_solicitacoes&idSolicitacao=$oid_solicitacao&$qualStatus&pagina=$totalPaginasSlc\">Fim</a>";
            ?>
        </div>
    </div>
</section>