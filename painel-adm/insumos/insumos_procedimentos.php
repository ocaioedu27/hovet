<section class="painel_insumos">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Material de procedimento</h3>
                <a href="index.php?menuop=cadastro_insumo" id="operacao_cadastro">
                    <button class="btn">Cadastrar</button>
                </a>
                <a href="index.php?menuop=cadastro_categoria_insumo" id="operacao_cadastro">
                    <button class="btn">Nova Categoria</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=insumos_procedimentos" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_insumos" placeholder="Buscar">
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
                        <th>Nome</th>
                        <th>Unidade</th>
                        <th>Categoria de Insumo</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_insumos = 10;

                        $pagina_insumos = (isset($_GET['pagina_insumos']))?(int)$_GET['pagina_insumos']:1;

                        $inicio_insumos = ($quantidade_registros_insumos * $pagina_insumos) - $quantidade_registros_insumos;

                        $txt_pesquisa_insumos = (isset($_POST["txt_pesquisa_insumos"]))?$_POST["txt_pesquisa_insumos"]:"";

                        $sql = "SELECT i.insumos_id, i.insumos_nome, i.insumos_unidade, i.insumos_descricao, t.tipos_insumos_tipo
                        FROM insumos AS i
                        INNER JOIN tipos_insumos AS t
                        on i.insumos_tipo_insumos_id = t.tipos_insumos_id
                        WHERE
                            i.insumos_tipo_insumos_id=2 AND
                            (i.insumos_id='{$txt_pesquisa_insumos}' or
                            i.insumos_nome LIKE '%{$txt_pesquisa_insumos}%' or 
                            i.insumos_unidade LIKE '%{$txt_pesquisa_insumos}%' or
                            i.insumos_descricao LIKE '%{$txt_pesquisa_insumos}%')
                            ORDER BY insumos_nome ASC 
                            LIMIT $inicio_insumos,$quantidade_registros_insumos";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                            $qtd_linhas_tabelas++;
                        
                    ?>
                    <tr class="tabela_dados">
                        <td class="operacoes" id="td_operacoes_editar_deletar">
                            <a href="index.php?menuop=editar_insumo&idInsumo=<?=$dados["insumos_id"]?>" class="confirmaEdit">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                            <a href="index.php?menuop=excluir_insumo&idInsumo=<?=$dados["insumos_id"]?>" class="confirmaDelete">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
                        <td><?=$dados["insumos_id"]?></td>
                        <td><?=$dados["insumos_nome"]?></td>
                        <td><?=$dados["insumos_unidade"]?></td>
                        <td><?=$dados["tipos_insumos_tipo"]?></td>
                        <td><?=$dados["insumos_descricao"]?></td>
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
                $sqlTotalInsumos = "SELECT insumos_id,insumos_tipo_insumos_id FROM insumos WHERE insumos_tipo_insumos_id=2";
                $queryTotalInsumos = mysqli_query($conexao,$sqlTotalInsumos) or die(mysqli_error($conexao));

                $numTotalInsumos = mysqli_num_rows($queryTotalInsumos);
                $totalPaginasInsumos = ceil($numTotalInsumos/$quantidade_registros_insumos);
                
                echo "<a href=\"?menuop=insumos_procedimentos&pagina_insumos=1\">Início</a> ";

                if ($pagina_insumos>6) {
                    ?>
                        <a href="?menuop=insumos_procedimentos?pagina_insumos=<?php echo $pagina_insumos-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasInsumos;$i++){

                    if ($i >= ($pagina_insumos) && $i <= ($pagina_insumos+5)) {
                        
                        if ($i==$pagina_insumos) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=insumos_procedimentos&pagina_insumos=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina_insumos<($totalPaginasInsumos-5)) {
                    ?>
                        <a href="?menuop=insumos_procedimentos?pagina_insumos=<?php echo $pagina_insumos+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=insumos_procedimentos&pagina_insumos=$totalPaginasInsumos\">Fim</a>";
            ?>
        </div>
    </div>
</section>