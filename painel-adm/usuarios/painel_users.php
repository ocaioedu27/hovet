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
                        <th>Operações</th>
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
                            <div class="operacao">
                                <label for="ischeckEdit"></label>
                                <input type="checkbox" id="ischeckEdit" onclick="mostraEdicao()">
                                <div id="editarNada">
                                    <button class="btn">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </button>
                                </div>
                                <a href="index.php?menuop=editar_usuario&idUsuario=<?=$dados["id"]?>" id="mostraEditar" style="display: none;">
                                    <button class="btn">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </button>
                                </a>
                            </div>

                            <div class="operacao">
                                <label for="isCheckedDelete"></label>
                                <input type="checkbox" id="isCheckedDelete" onclick="mostraExclusao()">
                                <div id="excluirNada">
                                    <button class="btn">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </button>
                                </div>
                                <a href="index.php?menuop=excluir_usuario&idUsuario=<?=$dados["id"]?>" id="mostraExcluir" style="display: none;">
                                    <button class="btn">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </button>
                                </a>
                            </div>
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