<section class="painel_insumos">
    <div class="container_painel">
        <div class="menu_user">
            <h3>Todos os Insumos</h3>
            <a href="index.php?menuop=cadastro_insumo">Cadastrar</a>
            <a href="#">Excluir</a>
        </div>
        <div class="menu_user">
            <table id="tabela_listar">
                <thead>
                    <tr>
                        <th>Selecionar</th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Unidade</th>
                        <th>Tipo de Insumo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
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
                        FROM insumos";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr>
                        <td>
                            <a href="index.php?menuop=editar_insumo&idInsumo=<?=$dados["id"]?>">Editar</a>
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