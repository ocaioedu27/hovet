<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Estoques</h3>
                <a href="index.php?menuop=cadastro_estoque">
                    <button class="btn" id="operacao_cadastro">Novo Estoque</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=estoques" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_estoquess" placeholder="Buscar">
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
                        <th>Nome</th>
                        <th>Tipo de Estoque</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_estoques = 10;

                        $pagina_estoques = (isset($_GET['pagina_estoques']))?(int)$_GET['pagina_estoques']:1;

                        $inicio_estoques = ($quantidade_registros_estoques * $pagina_estoques) - $quantidade_registros_estoques;

                        $txt_pesquisa_estoques = (isset($_POST["txt_pesquisa_estoques"]))?$_POST["txt_pesquisa_estoques"]:"";

                        $sql = "SELECT 
                                    *
                                FROM estoques e
                                INNER JOIN tipos_estoques tp
                                ON e.estoques_tipos_estoques_id = tp.tipos_estoques_id
                                WHERE
                                    e.estoques_id='{$txt_pesquisa_estoques}' or
                                    e.estoques_nome LIKE '%{$txt_pesquisa_estoques}%' or
                                    e.estoques_descricao LIKE '%{$txt_pesquisa_estoques}%'
                                    ORDER BY estoques_nome ASC 
                                    LIMIT $inicio_estoques,$quantidade_registros_estoques";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                            $qtd_linhas_tabelas++;

                            $tipo_de_estoque_bruto = $dados['tipos_estoques_tipo'];
                            $estoques_nome = $dados['estoques_nome_real'];

                            $nome_real_estoque = retiraAcentos($tipo_de_estoque_bruto);
                            // $estoques_nome = retiraAcentos($estoques_nome_bruto);
                            // $estoques_nome = str_replace(" ", "",$estoques_nome);
                            // echo "<br>Nome do estoque: " . $estoques_nome;
                            
                            // $qualEstoque = $estoques_nome_bruto;
                            // echo $qualEstoque;
                        
                    ?>
                    <tr>
                        <td><?=$dados["estoques_id"]?></td>
                        <td>
                            <!-- <div>
                                <form action="index.php?menuop=<?=$nome_real_estoque?>&<?=$estoques_nome?>" method="post" class="form_buscar">
                                    <input type="submit" name="<?=$nome_real_estoque?>" class="form-control" value="<?=$dados["estoques_nome"]?>">
                                </form>
                            </div> -->
                            <a href="index.php?menuop=<?=$nome_real_estoque?>&<?=$estoques_nome?>"><?=$dados["estoques_nome"]?></a>
                        </td>
                        <td><?=$dados["tipos_estoques_tipo"]?></td>
                        <td><?=$dados["estoques_descricao"]?></td>
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
                $sqlTotalEstoques = "SELECT estoques_id FROM estoques";
                $queryTotalEstoques = mysqli_query($conexao,$sqlTotalEstoques) or die(mysqli_error($conexao));

                $numTotalEstoques = mysqli_num_rows($queryTotalEstoques);
                $totalPaginasEstoques = ceil($numTotalEstoques/$quantidade_registros_estoques);
                
                echo "<a href=\"?menuop=estoques&pagina_estoques=1\">Início</a> ";

                if ($pagina_estoques>6) {
                    ?>
                        <a href="?menuop=estoques?pagina_estoques=<?php echo $pagina_estoques-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasEstoques;$i++){

                    if ($i >= ($pagina_estoques) && $i <= ($pagina_estoques+5)) {
                        
                        if ($i==$pagina_estoques) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=estoques&pagina_estoques=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina_estoques<($totalPaginasEstoques-5)) {
                    ?>
                        <a href="?menuop=estoques?pagina_estoques=<?php echo $pagina_estoques+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=estoques&pagina_estoques=$totalPaginasEstoques\">Fim</a>";
            ?>
        </div>
    </div>
</section>