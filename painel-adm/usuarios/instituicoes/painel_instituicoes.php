<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Todas as instituições</h3>
                <a href="index.php?menuop=cadastro_instituicoes" id="operacao_cadastro">
                    <button class="btn">Cadastrar Instituição</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=instituicoes" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_instituicoes" placeholder="Buscar">
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
                        $quantidade_registros_instituicoes = 10;

                        $pagina_instituicoes = (isset($_GET['pagina_instituicoes']))?(int)$_GET['pagina_instituicoes']:1;

                        $inicio_instituicoes = ($quantidade_registros_instituicoes * $pagina_instituicoes) - $quantidade_registros_instituicoes;

                        $txt_pesquisa_instituicoes = (isset($_POST["txt_pesquisa_instituicoes"]))?$_POST["txt_pesquisa_instituicoes"]:"";

                        $sql = "SELECT * 
                                FROM instituicoes
                                WHERE
                                    instituicoes_id='{$txt_pesquisa_instituicoes}' or
                                    instituicoes_razao_social LIKE '%{$txt_pesquisa_instituicoes}%' or
                                    instituicoes_cpf_cnpj LIKE '%{$txt_pesquisa_instituicoes}%' or
                                    instituicoes_end_logradouro LIKE '%{$txt_pesquisa_instituicoes}%' or
                                    instituicoes_end_email LIKE '%{$txt_pesquisa_instituicoes}%'
                                    ORDER BY instituicoes_razao_social ASC 
                                    LIMIT $inicio_instituicoes,$quantidade_registros_instituicoes";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                            $qtd_linhas_tabelas++;
                    ?>
                    <tr>
                        <td class="operacoes" id="td_operacoes_editar_deletar">
                            <a href="index.php?menuop=editar_instituicoes&idFornecedor=<?=$dados["instituicoes_id"]?>" class="confirmaEdit">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                            <a href="index.php?menuop=excluir_instituicoes&idFornecedor=<?=$dados["instituicoes_id"]?>"
                                class="confirmaDelete" >
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
                        <td><?=$dados["instituicoes_id"]?></td>
                        <td><?=$dados["instituicoes_razao_social"]?></td>
                        <td><?=$dados["instituicoes_end_email"]?></td>
                        <td><?=$dados["instituicoes_end_logradouro"]?></td>
                        <td><?=$dados["instituicoes_cpf_cnpj"]?></td>
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
                $sqlTotalFornecedores = "SELECT instituicoes_id FROM instituicoes";
                $queryTotalFornecedores = mysqli_query($conexao,$sqlTotalFornecedores) or die(mysqli_error($conexao));

                $numTotalFornecedores = mysqli_num_rows($queryTotalFornecedores);
                $totalPaginasFornecedores = ceil($numTotalFornecedores/$quantidade_registros_instituicoes);
                
                echo "<a href=\"?menuop=instituicoes&pagina_instituicoes=1\">Início</a> ";

                if ($pagina_instituicoes>6) {
                    ?>
                        <a href="?menuop=instituicoes?pagina_instituicoes=<?php echo $pagina_instituicoes-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasFornecedores;$i++){

                    if ($i >= ($pagina_instituicoes) && $i <= ($pagina_instituicoes+5)) {
                        
                        if ($i==$pagina_instituicoes) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=instituicoes&pagina_instituicoes=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina_instituicoes<($totalPaginasFornecedores-5)) {
                    ?>
                        <a href="?menuop=instituicoes?pagina_instituicoes=<?php echo $pagina_instituicoes+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=instituicoes&pagina_instituicoes=$totalPaginasFornecedores\">Fim</a>";
            ?>
        </div>
    </div>
</section>