<section class="painel_insumos">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Todas as Movimentações</h3>
                <a href="#" id="">
                    <button class="btn">Gerar Relatório</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=listar_movimentacoes" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_movimentacoes" placeholder="Buscar">
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
                        <th id="th_operacoes_editar_deletar">Operações</th>
                        <th>ID</th>
                        <th>Nome do Insumo</th>
                        <th>Data da Ação</th>
                        <th>Tipo</th>
                        <th>Origem</th>
                        <th>Destino</th>
                        <th>Quem Realizou</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_movimentacoes = 10;

                        $pagina_movimentacoes = (isset($_GET['pagina_movimentacoes']))?(int)$_GET['pagina_movimentacoes']:1;

                        $inicio_movimentacoes = ($quantidade_registros_movimentacoes * $pagina_movimentacoes) - $quantidade_registros_movimentacoes;

                        $txt_pesquisa_mov = (isset($_POST["txt_pesquisa_mov"]))?$_POST["txt_pesquisa_mov"]:"";

                        $sql = "SELECT
                                i.insumos_nome,
                                i.insumos_descricao,
                                m.movimentacoes_id,
                                m.movimentacoes_origem,
                                m.movimentacoes_destino,
                                tm.tipos_movimentacoes_movimentacao,
                                m.movimentacoes_usuario_id,
                                date_format(m.data_operacao, '%d/%m/%Y %H:%i:%s') AS movimentacoes_data_operacao,
                                u.usuario_nome_completo
                                FROM movimentacoes m
                                INNER JOIN insumos i
                                on m.movimentacoes_insumos_id = i.insumos_id
                                INNER JOIN usuarios u
                                ON u.usuario_id = m.movimentacoes_usuario_id
                                INNER JOIN tipos_movimentacoes tm
                                ON m.movimentacoes_tipos_movimentacoes_id = tm.tipos_movimentacoes_id
                                WHERE
                                    i.insumos_nome LIKE '%{$txt_pesquisa_mov}%' or
                                    u.usuario_nome_completo LIKE '%{$txt_pesquisa_mov}%' or
                                    i.insumos_descricao LIKE '%{$txt_pesquisa_mov}%'
                                    ORDER BY insumos_nome ASC 
                                    LIMIT $inicio_movimentacoes,$quantidade_registros_movimentacoes";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                            $qtd_linhas_tabelas++;
                        
                    ?>
                    <tr class="tabela_dados">
                        <td class="operacoes" id="td_operacoes_editar_deletar">
                            <a href="index.php?menuop=excluir_mov&movId=<?=$dados["movimentacoes_id"]?>" class="confirmaDelete">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
                        <td><?=$dados["movimentacoes_id"]?></td>
                        <td><?=$dados["insumos_nome"]?></td>
                        <td><?=$dados["movimentacoes_data_operacao"]?></td>
                        <td>
                            <a href="index.php?menuop=<?=retiraAcentos($dados["tipos_movimentacoes_movimentacao"])?>"><?=$dados["tipos_movimentacoes_movimentacao"]?></a>
                        </td>
                        <td><?=$dados["movimentacoes_origem"]?></td>
                        <td><?=$dados["movimentacoes_destino"]?></td>
                        <td><?=$dados["usuario_nome_completo"]?></td>
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
                    $sqlTotalMovimentacoes = "SELECT movimentacoes_id FROM movimentacoes";
                    $queryTotalMovimentacoes = mysqli_query($conexao,$sqlTotalMovimentacoes) or die(mysqli_error($conexao));

                    $numTotalMovimentacoes = mysqli_num_rows($queryTotalMovimentacoes);
                    $totalPaginasMovimentacoes = ceil($numTotalMovimentacoes/$quantidade_registros_movimentacoes);
                    
                    echo "<a href=\"?menuop=listar_movimentacoes&pagina_movimentacoes=1\">Início</a> ";

                    if ($pagina_movimentacoes>6) {
                        ?>
                            <a href="?menuop=listar_movimentacoes?pagina_movimentacoes=<?php echo $pagina_movimentacoes-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasMovimentacoes;$i++){

                        if ($i >= ($pagina_movimentacoes) && $i <= ($pagina_movimentacoes+5)) {
                            
                            if ($i==$pagina_movimentacoes) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=listar_movimentacoes&pagina_movimentacoes=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina_movimentacoes<($totalPaginasMovimentacoes-5)) {
                        ?>
                            <a href="?menuop=listar_movimentacoes?pagina_movimentacoes=<?php echo $pagina_movimentacoes+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=listar_movimentacoes&pagina_movimentacoes=$totalPaginasMovimentacoes\">Fim</a>";
                ?>
            </div>
    </div>
</section>