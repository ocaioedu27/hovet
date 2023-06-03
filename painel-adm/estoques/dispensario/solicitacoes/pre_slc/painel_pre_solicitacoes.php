<?php

use Sabberworm\CSS\Value\Value;

if (isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
		// $$chave = $valor;
        // print_r($valor_est);
	}
}

$qualStatus = $valor_est;

?>
<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Pré-Solicitações</h3>
                <?php
                    
                    $sqlStatusTipo = "SELECT * FROM status_slc";
                    $resultTotalStatus = mysqli_query($conexao,$sqlStatusTipo) or die("//sql_status - erro ao realizar a consulta: " . mysqli_error($conexao));

                    while($tipo_status_slc = mysqli_fetch_assoc($resultTotalStatus)){
                    
                    ?>
                    
                    <a href="index.php?menuop=pre_solicitacoes&<?=$tipo_status_slc['status_slc_status']?>">
                        <button class="btn"><?=$tipo_status_slc['status_slc_status']?>s</button>
                    </a>

                <?php
                    }
                ?>
            </div>
            <div>
                <form action="index.php?menuop=pre_solicitacoes&<?=$qualStatus?>" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_solicitacoes" placeholder="Buscar">
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

                        $pagina_solicitacoes = 0;
                        
                        if(isset($_GET[$qualStatus])){
                            $pagina_solicitacoes = 1;
                        }

                        $inicio_solicitacoes = ($quantidade_registros_solicitacoes * $pagina_solicitacoes) - $quantidade_registros_solicitacoes;

                        // print_r($inicio_solicitacoes);

                        $txt_pesquisa_solicitacoes = (isset($_POST["txt_pesquisa_solicitacoes"]))?$_POST["txt_pesquisa_solicitacoes"]:"";

                        $sql = "SELECT
                                    s.pre_slc_id,
                                    u.usuario_primeiro_nome,
                                    i.insumos_nome,
                                    s.pre_slc_qtd_solicitada,
                                    date_format(s.pre_slc_data, '%d/%m/%Y %H:%i:%s') AS pre_slc_data,
                                    st.setores_setor,
                                    s.pre_slc_justificativa,
                                    stt.status_slc_status,
                                    es.estoques_nome,
                                    tp.tipos_movimentacoes_movimentacao
                                    
                                FROM pre_solicitacoes s
                                    
                                    INNER JOIN usuarios u
                                    ON s.pre_slc_solicitante = u.usuario_id
                                    
                                    INNER JOIN dispensario d
                                    ON s.pre_slc_dispensario_id = d.dispensario_id
                                    
                                    INNER JOIN insumos i
                                    ON d.dispensario_insumos_id = i.insumos_id 
                                    
                                    INNER JOIN setores st
                                    ON s.pre_slc_setor_destino = st.setores_id
                                    
                                    INNER JOIN status_slc stt
                                    ON s.pre_slc_status_slc_id = stt.status_slc_id
                                    
                                    INNER JOIN estoques es
                                    ON s.pre_slc_dips_solicitado = es.estoques_id
                                    
                                    INNER JOIN tipos_movimentacoes tp
                                    ON tp.tipos_movimentacoes_id = s.pre_slc_tp_movimentacoes_id
                                
                                WHERE
                                    stt.status_slc_status = '{$qualStatus}' AND
                                    (s.pre_slc_id='{$txt_pesquisa_solicitacoes}' or
                                    i.insumos_nome LIKE '%{$txt_pesquisa_solicitacoes}%' or
                                    u.usuario_primeiro_nome LIKE '%{$txt_pesquisa_solicitacoes}%' or
                                    tp.tipos_movimentacoes_movimentacao LIKE '%{$txt_pesquisa_solicitacoes}%')
                                    
                                ORDER BY insumos_nome ASC 
                                    
                                LIMIT $inicio_solicitacoes,$quantidade_registros_solicitacoes";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

                        while($dados_para_while = mysqli_fetch_assoc($rs)){
                            // $valor_form = $dados_para_while['estoques_nome_real'];
                            $qtd_linhas_tabelas++;
                        
                    ?>
                    <tr>
                        <td>
                            <?php
                                $solicitacao_id = $dados_para_while["pre_slc_id"];
                                echo $solicitacao_id;    
                            ?>
                        </td>
                        <td><?=$dados_para_while["usuario_primeiro_nome"]?></td>
                        <td><?=$dados_para_while["insumos_nome"]?></td>
                        <td><?=$dados_para_while["estoques_nome"]?></td>
                        <td><?=$dados_para_while["pre_slc_qtd_solicitada"]?></td>
                        <td><?=$dados_para_while["pre_slc_data"]?></td>
                        <td>
                            <?php
                                $movimentacao_tmp = $dados_para_while["tipos_movimentacoes_movimentacao"];
                                $tipo_slc = strtok($movimentacao_tmp, " ");
                                echo $tipo_slc;
                            ?>
                        </td>
                        <td style="color: 
                        <?php
                            $status_slc = $dados_para_while["status_slc_status"];
                            if($status_slc == "Pendente"){
                                echo "goldenrod";
                            } elseif ($status_slc == "Aprovada"){
                                echo "green";
                            } elseif ($status_slc == "Recusada"){
                                echo "red";
                            }
                        ?>"><?=$status_slc?></td>
                        <td class="operacoes" id="">
                            <a href="index.php?menuop=atualiza_solicitacao&idSolicitacao=<?=$solicitacao_id?>&aprovar"
                                class="confirmaOperacao" id="operacao_slc_aprova">
                                <button class="btn" style="color: green;">Aprovar</button>
                            </a>
                            <a href="index.php?menuop=atualiza_solicitacao&idSolicitacao=<?=$solicitacao_id?>&recusar"
                                class="confirmaOperacao" id="operacao_slc_reprova">
                                <button class="btn" style="color: red;">Recusar</button>
                            </a>
                            <a href="index.php?menuop=detalhes_pre_solicitacao&geral&idSolicitacao=<?=$solicitacao_id?>"
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
                $sqlTotalSlc = "SELECT pre_slc_id FROM pre_solicitacoes";
                $queryTotalSlc = mysqli_query($conexao,$sqlTotalSlc) or die(mysqli_error($conexao));

                $numTotalSlc = mysqli_num_rows($queryTotalSlc);
                // print_r($numTotalSlc);
                if ($numTotalSlc == 0) {
                    $numTotalSlc = 1;
                }
                $totalPaginasSlc = ceil($numTotalSlc/$quantidade_registros_solicitacoes);

                if ($numTotalSlc == 0) {
                    $numTotalSlc = 1;
                }
                
                echo "<a href=\"?menuop=pre_solicitacoes&" . $qualStatus . "=1\">Início</a> ";

                if ($pagina_solicitacoes>6) {
                    ?>
                        <a href="?menuop=pre_solicitacoes&<?=$qualStatus?>=<?php echo $pagina_solicitacoes-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasSlc;$i++){
                    // print_r($i);

                    if ($i >= ($pagina_solicitacoes) && $i <= ($pagina_solicitacoes+5)) {
                        
                        if ($i==$pagina_solicitacoes) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=pre_solicitacoes&" . $qualStatus . "=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina_solicitacoes<($totalPaginasSlc-4)) {
                    ?>
                        <a href="?menuop=pre_solicitacoes&<?=$qualStatus?>=<?php echo $pagina_solicitacoes+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=pre_solicitacoes&$qualStatus=$totalPaginasSlc\">Fim</a>";
            ?>
        </div>
    </div>
</section>