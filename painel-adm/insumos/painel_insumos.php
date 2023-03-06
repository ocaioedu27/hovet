<section class="painel_insumos">
    <div class="container_painel">
        <div class="menu_user">
            <h3>Todos os Insumos</h3>
            <a href="index.php?menuop=cadastro_insumo">Cadastrar</a>
            <a href="#">Excluir</a>
            <a href="#">Modificar dados</a>
        </div>
        <div class="menu_user">
            <table id="tabela_listar">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Unidade</th>
                        <th>Tipo de Insumo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM insumos";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr>
                        <td><?=$dados["id"]?></td>
                        <td><?=$dados["nome"]?></td>
                        <td><?=$dados["unidade"]?></td>
                        <td>
                            <?php
                            if($dados["insumo_tipo"] == 1 ){
                                echo "Medicamento";
                            }else{
                                echo "Materiais de procedimentos médicos";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>