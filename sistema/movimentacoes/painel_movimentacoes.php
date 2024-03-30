
<?php
    $quantidade_registros_movimentacoes = 10;

    $pagina = (isset($_GET['pagina']))?(int)$_GET['pagina']:1;

    $inicio = ($quantidade_registros_movimentacoes * $pagina) - $quantidade_registros_movimentacoes;

    $txt_pesquisa = (isset($_POST["txt_pesquisa"]))?$_POST["txt_pesquisa"]:"";

    $sql = "SELECT
                m.insumo_nome,
                m.usuario_id_nome,
                m.id,
                m.origem,
                m.destino,
                m.data_operacao,
                tm.movimentacao
            FROM 
                historico_movimentacoes m
            INNER JOIN 
                tipos_movimentacoes tm
            ON 
                m.tipos_movimentacoes_id = tm.id
            WHERE
                m.insumo_nome LIKE '%{$txt_pesquisa}%' 
                OR m.origem LIKE '%{$txt_pesquisa}%'
                OR m.destino LIKE '%{$txt_pesquisa}%'
                OR tm.movimentacao LIKE '%{$txt_pesquisa}%'
            ORDER BY 
                data_operacao DESC 
            LIMIT 
                $inicio,$quantidade_registros_movimentacoes";

    try{
        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
    }catch (\Throwable $th){
        echo $th;
    }

    $resultados = '';

    if ($rs->num_rows > 0){
        while($dados = mysqli_fetch_assoc($rs)){
            
            $movimentacoes_id = $dados['id'];
            $insumos_nome = $dados["insumo_nome"];
            $movimentacoes_data_operacao = date("d/m/Y H:i", strtotime($dados["data_operacao"]));
            $tipos_movimentacoes_movimentacao = $dados['movimentacao'];
            $movimentacoes_origem = $dados["origem"];
            $movimentacoes_destino = $dados['destino'];
            // $usuario_nome_completo = $dados['nome_completo'];
            

            $resultados .= '
                <tr class="tabela_dados">
                    <td>'. $movimentacoes_id .'</td>
                    <td>'. $insumos_nome .'</td>
                    <td>'. $movimentacoes_data_operacao .'</td>
                    <td>'. $tipos_movimentacoes_movimentacao .'</td>
                    <td>'. $movimentacoes_origem .'</td>
                    <td>'. $movimentacoes_destino .'</td>
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
                <td colspan="8" class="text-center">Nenhum registro para exibir!</td>
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

                    $sqlTotalMovimentacoes = "SELECT id FROM historico_movimentacoes";
                    $queryTotalMovimentacoes = mysqli_query($conexao,$sqlTotalMovimentacoes) or die(mysqli_error($conexao));

                    if($queryTotalMovimentacoes->num_rows >= 1){
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
                    }else {
                        echo '<a href="">Inicio</a><span>1</span><a href="">Fim</a>';
                    }
                ?>
            </div>
    </div>
</section>