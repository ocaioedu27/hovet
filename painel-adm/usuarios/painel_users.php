<section class="painel_usuarios">
    <div class="container_painel">
        <div class="menu_user">
            <h3>Todos os usuários</h3>
            <a href="index.php?menuop=cadastro_usuario">
                <button class="btn">Cadastrar</button>
            </a>
        </div>
        <div class="menu_user">
            <table id="tabela_listar">
                <thead>
                    <tr>
                        <th>Editar</th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Tipo de usuario</th>
                        <th>CPF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM usuarios";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr>
                        <td class="operacoes">
                            <a href="index.php?menuop=editar_usuario&idUsuario=<?=$dados["id"]?>">
                                <button class="btn">Editar</button>
                            </a>
                            <a href="index.php?menuop=excluir_usuario&idUsuario=<?=$dados["id"]?>">
                                <button class="btn">Excluir</button>
                            </a>
                        </td>
                        <td><?=$dados["id"]?></td>
                        <td><?=$dados["nome"]?></td>
                        <td><?=$dados["mail"]?></td>
                        <td><?=$dados["tipo_usuario"]?></td>
                        <td><?=$dados["cpf"]?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>