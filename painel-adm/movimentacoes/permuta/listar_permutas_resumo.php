<section class="painel_insumos">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Todas as Permutas</h3>
            </div>
            <div>
                <form action="index.php?menuop=permuta" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_permuta" placeholder="Buscar">
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
                        <th>ID de Resgistro</th>
                        <th>Instituição</th>
                        <th>Data da Permuta</th>
                        <th>Visualizar Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_permuta = 10;

                        $pagina_permuta = (isset($_GET['pagina_permuta']))?(int)$_GET['pagina_permuta']:1;

                        $inicio_permuta = ($quantidade_registros_permuta * $pagina_permuta) - $quantidade_registros_permuta;

                        $txt_pesquisa_permuta = (isset($_POST["txt_pesquisa_permuta"]))?$_POST["txt_pesquisa_permuta"]:"";

                        $sql = "SELECT 
                                    p.permutas_id,
                                    p.permutas_qtd_retirado,
                                    p.permutas_data,
                                    p.permutas_oid_operacao,
                                    p.permutas_insumos_qtd_cadastrado,
                                    u.usuario_primeiro_nome,
                                    e.estoques_nome as nome_estoque_retirado,
                                    es.estoques_nome as nome_estoque_cadastrado,
                                    ins.insumos_nome as nome_insumo_cadastrado,
                                    i.insumos_nome as nome_insumo_retirado,
                                    inst.instituicoes_razao_social

                                FROM permutas p
                                
                                INNER JOIN 
                                    usuarios u
                                ON 
                                    p.permutas_operador = u.usuario_id
                                
                                INNER JOIN 
                                    deposito d 
                                ON 
                                    p.permutas_deposito_id = d.deposito_id
                                
                                INNER JOIN 
                                    insumos ins 
                                ON 
                                    p.permutas_insumos_id_cadastrado = ins.insumos_id
                                
                                INNER JOIN
                                    insumos i
                                ON 
                                    d.deposito_insumos_id = i.insumos_id
                                
                                INNER JOIN 
                                    estoques e
                                ON 
                                    p.permutas_estoques_id_retirado = e.estoques_id
                                
                                INNER JOIN 
                                    estoques es
                                ON 
                                    p.permutas_estoques_id_cadastrado = es.estoques_id

                                INNER JOIN 
                                    instituicoes inst
                                ON 
                                    p.permutas_instituicao_id = inst.instituicoes_id
                                    
                                WHERE
                                    p.permutas_oid_operacao = '{$txt_pesquisa_permuta}' or
                                    p.permutas_data LIKE '%{$txt_pesquisa_permuta}%' or
                                    inst.instituicoes_razao_social LIKE '%{$txt_pesquisa_permuta}%'

                                ORDER BY permutas_data ASC 

                                LIMIT $inicio_permuta,$quantidade_registros_permuta";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr class="tabela_dados">
                        <td><?=$dados["permutas_id"]?></td>
                        <td><?=$dados["permutas_oid_operacao"]?></td>
                        <td><?=$dados["instituicoes_razao_social"]?></td>
                        <td><?php echo date("d/m/Y H:i", strtotime($dados['permutas_data']));?></td>
                        <td>
                            <a href="index.php?menuop=permuta_por_oid&oidPermuta=<?=$dados["permutas_oid_operacao"]?>">Ver Detalhes</a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
            <div class="paginacao">
                <?php
                    $sqlTotalInsumos = "SELECT permutas_id FROM permutas";
                    $queryTotalInsumos = mysqli_query($conexao,$sqlTotalInsumos) or die(mysqli_error($conexao));

                    $numTotalInsumos = mysqli_num_rows($queryTotalInsumos);
                    $totalPaginasInsumos = ceil($numTotalInsumos/$quantidade_registros_permuta);
                    
                    echo "<a href=\"?menuop=permuta&pagina_permuta=1\">Início</a> ";

                    if ($pagina_permuta>6) {
                        ?>
                            <a href="?menuop=permuta&pagina_permuta=<?php echo $pagina_permuta-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasInsumos;$i++){

                        if ($i >= ($pagina_permuta) && $i <= ($pagina_permuta+5)) {
                            
                            if ($i==$pagina_permuta) {
                                echo "<span>$i</span>";
                            } else {
                                echo " <a href=\"?menuop=permuta&pagina_permuta=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina_permuta<($totalPaginasInsumos-5)) {
                        ?>
                            <a href="?menuop=permuta&pagina_permuta=<?php echo $pagina_permuta+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=permuta&pagina_permuta=$totalPaginasInsumos\">Fim</a>";
                ?>
            </div>
    </div>
</section>