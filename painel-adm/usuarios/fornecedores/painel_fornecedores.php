<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Todos os Fornecedores</h3>
                <a href="index.php?menuop=cadastro_fornecedores" id="operacao_cadastro">
                    <button class="btn">Cadastrar Fornecedor</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=fornecedores" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_fornecedores" placeholder="Buscar">
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
                        <th id="th_operacoes_editar_deletar">Operações</th>
                        <th>ID</th>
                        <th>Razão Social</th>
                        <th>E-mail</th>
                        <th>Endereço</th>
                        <th>CNPJ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_fornecedores = 10;

                        $pagina_fornecedores = (isset($_GET['pagina_fornecedores']))?(int)$_GET['pagina_fornecedores']:1;

                        $inicio_fornecedores = ($quantidade_registros_fornecedores * $pagina_fornecedores) - $quantidade_registros_fornecedores;

                        $txt_pesquisa_fornecedores = (isset($_POST["txt_pesquisa_fornecedores"]))?$_POST["txt_pesquisa_fornecedores"]:"";

                        $sql = "SELECT * 
                                FROM fornecedores
                                WHERE
                                    fornecedores_id='{$txt_pesquisa_fornecedores}' or
                                    fornecedores_razao_social LIKE '%{$txt_pesquisa_fornecedores}%' or
                                    fornecedores_cpf_cnpj LIKE '%{$txt_pesquisa_fornecedores}%' or
                                    fornecedores_end_logradouro LIKE '%{$txt_pesquisa_fornecedores}%' or
                                    fornecedores_end_email LIKE '%{$txt_pesquisa_fornecedores}%'
                                    ORDER BY fornecedores_razao_social ASC 
                                    LIMIT $inicio_fornecedores,$quantidade_registros_fornecedores";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                            $qtd_linhas_tabelas++;
                    ?>
                    <tr>
                        <td class="operacoes" id="td_operacoes_editar_deletar">
                            <a href="index.php?menuop=editar_fornecedores&idFornecedor=<?=$dados["fornecedores_id"]?>" class="confirmaEdit">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                            <a href="index.php?menuop=excluir_fornecedores&idFornecedor=<?=$dados["fornecedores_id"]?>"
                                class="confirmaDelete" >
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
                        <td><?=$dados["fornecedores_id"]?></td>
                        <td><?=$dados["fornecedores_razao_social"]?></td>
                        <td><?=$dados["fornecedores_end_email"]?></td>
                        <td><?=$dados["fornecedores_end_logradouro"]?></td>
                        <td><?=$dados["fornecedores_cpf_cnpj"]?></td>
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
                $sqlTotalFornecedores = "SELECT fornecedores_id FROM fornecedores";
                $queryTotalFornecedores = mysqli_query($conexao,$sqlTotalFornecedores) or die(mysqli_error($conexao));

                $numTotalFornecedores = mysqli_num_rows($queryTotalFornecedores);
                $totalPaginasFornecedores = ceil($numTotalFornecedores/$quantidade_registros_fornecedores);
                
                echo "<a href=\"?menuop=fornecedores&pagina_fornecedores=1\">Início</a> ";

                if ($pagina_fornecedores>6) {
                    ?>
                        <a href="?menuop=fornecedores?pagina_fornecedores=<?php echo $pagina_fornecedores-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasFornecedores;$i++){

                    if ($i >= ($pagina_fornecedores) && $i <= ($pagina_fornecedores+5)) {
                        
                        if ($i==$pagina_fornecedores) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=fornecedores&pagina_fornecedores=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina_fornecedores<($totalPaginasFornecedores-5)) {
                    ?>
                        <a href="?menuop=fornecedores?pagina_fornecedores=<?php echo $pagina_fornecedores+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=fornecedores&pagina_fornecedores=$totalPaginasFornecedores\">Fim</a>";
            ?>
        </div>
    </div>
</section>