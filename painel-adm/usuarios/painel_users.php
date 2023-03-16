<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Todos os usuários</h3>
                <a href="index.php?menuop=cadastro_usuario">
                    <button class="btn">Cadastrar</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=usuarios" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_usuarios" placeholder="Buscar">
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
                        $quantidade_registros_usuarios = 10;

                        $pagina_usuarios = (isset($_GET['pagina_usuarios']))?(int)$_GET['pagina_usuarios']:1;

                        $inicio_usuarios = ($quantidade_registros_usuarios * $pagina_usuarios) - $quantidade_registros_usuarios;

                        $txt_pesquisa_usuarios = (isset($_POST["txt_pesquisa_usuarios"]))?$_POST["txt_pesquisa_usuarios"]:"";

                        $sql = "SELECT * FROM usuarios 

                        WHERE
                            id='{$txt_pesquisa_usuarios}' or
                            nome LIKE '%{$txt_pesquisa_usuarios}%' or
                            tipo_usuario LIKE '%{$txt_pesquisa_usuarios}%' or
                            mail LIKE '%{$txt_pesquisa_usuarios}%'
                            ORDER BY nome ASC 
                            LIMIT $inicio_usuarios,$quantidade_registros_usuarios";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr>
                        <td class="operacoes">
                            <a href="index.php?menuop=editar_usuario&idUsuario=<?=$dados["id"]?>" class="confirmaEdit">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                            <a href="index.php?menuop=excluir_usuario&idUsuario=<?=$dados["id"]?>"
                                class="confirmaDelete">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
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
            <div class="paginacao">
                <?php
                    $sqlTotalUsuarios = "SELECT id FROM usuarios";
                    $queryTotalUsuarios = mysqli_query($conexao,$sqlTotalUsuarios) or die(mysqli_error($conexao));

                    $numTotalUsuarios = mysqli_num_rows($queryTotalUsuarios);
                    $totalPaginasUsuarios = ceil($numTotalUsuarios/$quantidade_registros_usuarios);
                    
                    echo "<a href=\"?menuop=usuarios&pagina_usuarios=1\">Início</a> ";

                    if ($pagina_usuarios>6) {
                        ?>
                            <a href="?menuop=usuarios?pagina_usuarios=<?php echo $pagina_usuarios-1?>"> << </a>
                        <?php
                    } 

                    for($i=1;$i<=$totalPaginasUsuarios;$i++){

                        if ($i >= ($pagina_usuarios) && $i <= ($pagina_usuarios+5)) {
                            
                            if ($i==$pagina_usuarios) {
                                echo $i;
                            } else {
                                echo " <a href=\"?menuop=usuarios&pagina_usuarios=$i\">$i</a> ";
                            } 
                        }          
                    }

                    if ($pagina_usuarios<($totalPaginasUsuarios-5)) {
                        ?>
                            <a href="?menuop=usuarios?pagina_usuarios=<?php echo $pagina_usuarios+1?>"> >> </a>
                        <?php
                    }
                    
                    echo " <a href=\"?menuop=usuarios&pagina_usuarios=$totalPaginasUsuarios\">Fim</a>";
                ?>
            </div>
        </div>
    </div>
</section>