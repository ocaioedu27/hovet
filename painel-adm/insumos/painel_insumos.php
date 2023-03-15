<section class="painel_insumos">
    <div class="container_painel">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Todos os Insumos</h3>
                <a href="index.php?menuop=cadastro_insumo">
                    <button class="btn">Cadastrar</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=insumos" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_insumos" placeholder="Buscar">
                    <button type="submit" class="btn">
                        <span class="icon">
                            <ion-icon name="search-outline"></ion-icon>
                        </span>
                    </button>
                </form>
            </div>
        </div>
        <div class="menu_user">
            <table id="tabela_listar">
                <thead>
                    <tr class="tabela_dados">
                        <th>Operações</th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Unidade</th>
                        <th>Tipo de Insumo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $txt_pesquisa_insumos = (isset($_POST["txt_pesquisa_insumos"]))?$_POST["txt_pesquisa_insumos"]:"";

                        $sql = "SELECT 
                        id,
                        nome,
                        unidade,
                        CASE
                            WHEN insumo_tipo='1' THEN 'Medicamento'
                            WHEN insumo_tipo='2' THEN 'Materiais de procedimentos médicos'
                        ELSE
                            'NÃO ESPECIFICADO'
                        END AS insumo_tipo

                        FROM insumos 

                        WHERE
                            id='{$txt_pesquisa_insumos}' or
                            nome LIKE '%{$txt_pesquisa_insumos}%' or
                            insumo_tipo LIKE '%{$txt_pesquisa_insumos}%'
                            ORDER BY nome ASC";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr class="tabela_dados">
                        <td class="operacoes">
                            <a href="index.php?menuop=editar_insumo&idInsumo=<?=$dados["id"]?>" class="confirmaEdit">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                            <a href="index.php?menuop=excluir_insumo&idInsumo=<?=$dados["id"]?>" class="confirmaDelete">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
                        <td><?=$dados["id"]?></td>
                        <td><?=$dados["nome"]?></td>
                        <td><?=$dados["unidade"]?></td>
                        <td><?=$dados["insumo_tipo"]?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>