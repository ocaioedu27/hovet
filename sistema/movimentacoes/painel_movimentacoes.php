
<?php
    $quantidade_registros_movimentacoes = 10;

    $pagina = (isset($_GET['pagina']))?(int)$_GET['pagina']:1;

    $inicio_movimentacoes = ($quantidade_registros_movimentacoes * $pagina) - $quantidade_registros_movimentacoes;

    $txt_pesquisa_mov = (isset($_POST["txt_pesquisa_mov"]))?$_POST["txt_pesquisa_mov"]:"";

    $sql = "SELECT
            i.insumos_nome,
            i.insumos_descricao,
            m.movimentacoes_id,
            m.movimentacoes_origem,
            m.movimentacoes_destino,
            tm.tipos_movimentacoes_movimentacao,
            m.movimentacoes_usuario_id,
            m.movimentacoes_data_operacao,
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
                ORDER BY movimentacoes_data_operacao DESC 
                LIMIT $inicio_movimentacoes,$quantidade_registros_movimentacoes";
    $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

    $resultados = '';

    if ($rs->num_rows > 0){
        while($dados = mysqli_fetch_assoc($rs)){
            
            $movimentacoes_id = $dados['movimentacoes_id'];
            $insumos_nome = $dados["insumos_nome"];
            $movimentacoes_data_operacao = date("d/m/Y H:i", strtotime($dados["movimentacoes_data_operacao"]));
            $tipos_movimentacoes_movimentacao = $dados['tipos_movimentacoes_movimentacao'];
            $movimentacoes_origem = $dados["movimentacoes_origem"];
            $movimentacoes_destino = $dados['movimentacoes_destino'];
            $usuario_nome_completo = $dados['usuario_nome_completo'];
            

            $resultados .= '
                <tr class="tabela_dados">
                    <td>'. $movimentacoes_id .'</td>
                    <td>'. $insumos_nome .'</td>
                    <td>'. $movimentacoes_data_operacao .'</td>
                    <td>'. $tipos_movimentacoes_movimentacao .'</td>
                    <td>'. $movimentacoes_origem .'</td>
                    <td>'. $movimentacoes_destino .'</td>
                    <td>'. $usuario_nome_completo .'</td>
                    <td class="operacoes" id="td_operacoes_editar_deletar">
                        <a href="index.php?menuop=excluir_mov&movId=' . $movimentacoes_id . '" class="confirmaDelete">
                            <button class="btn">
                                <span class="icon">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </span>
                            </button>
                        </a>
                    </td>
                </tr>';

            $qtd_linhas_tabelas++;

        }
    } else{
        $resultados = '
            <tr class="tabela_dados">
                <td colspan="4" class="text-center">Nenhum registro para exibir!</td>
            </tr>';
    }

?>


<section class="painel_insumos">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Todas as Movimentações</h3>
                <a href="pdf/relatorio_movimentacao.php" id="">
                    <button class="btn">Gerar Relatório</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=listar_movimentacoes" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_mov" placeholder="Buscar">
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
                        <th>ID</th>
                        <th>Nome do Insumo</th>
                        <th>Data da Ação</th>
                        <th>Tipo</th>
                        <th>Origem</th>
                        <th>Destino</th>
                        <th>Quem Realizou</th>
                        <th id="th_operacoes_editar_deletar">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <?=$resultados?>
                </tbody>
            </table>
        </div>
            <div class="paginacao">
                <?php
                    echo '<input type="hidden" id="quantidade_linhas_tabelas" value="'.$qtd_linhas_tabelas.'">';

                    $sqlTotalMovimentacoes = "SELECT movimentacoes_id FROM movimentacoes";
                    $queryTotalMovimentacoes = mysqli_query($conexao,$sqlTotalMovimentacoes) or die(mysqli_error($conexao));

                    $numTotalMovimentacoes = mysqli_num_rows($queryTotalMovimentacoes);
                    $totalPaginasMovimentacoes = ceil($numTotalMovimentacoes/$quantidade_registros_movimentacoes);
                    
                    echo "<a href=\"?menuop=listar_movimentacoes&pagina=1\">Início</a> ";
                    $num_antes = "";
                    $num_depois = "";

                    if ($pagina>1) {
                        ?>
                            <a href="?menuop=listar_movimentacoes&pagina=<?php echo $pagina-1?>"> < </a>
                        <?php
                    } 

                    if ($pagina>2) {
                        ?>
                            <a href="?menuop=listar_movimentacoes&pagina=<?php echo $pagina-2?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasMovimentacoes;$i++){

                        if ($i >= ($pagina) && $i <= ($pagina+5)) {
                            
                            if ($i==$pagina) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=listar_movimentacoes&pagina=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina<($totalPaginasMovimentacoes-1)) {
                        ?>
                            <a href="?menuop=listar_movimentacoes&pagina=<?php echo $pagina+1?>"> > </a>
                        <?php
                    }

                    if ($pagina<($totalPaginasMovimentacoes-2)) {
                        ?>
                            <a href="?menuop=listar_movimentacoes&pagina=<?php echo $pagina+2?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=listar_movimentacoes&pagina=$totalPaginasMovimentacoes\">Fim</a>";
                ?>
            </div>
    </div>
</section>