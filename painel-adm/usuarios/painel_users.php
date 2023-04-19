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
                        <th>SIAPE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_usuarios = 10;

                        $pagina_usuarios = (isset($_GET['pagina_usuarios']))?(int)$_GET['pagina_usuarios']:1;

                        $inicio_usuarios = ($quantidade_registros_usuarios * $pagina_usuarios) - $quantidade_registros_usuarios;

                        $txt_pesquisa_usuarios = (isset($_POST["txt_pesquisa_usuarios"]))?$_POST["txt_pesquisa_usuarios"]:"";

                        $sql = "SELECT u.usuario_id, u.usuario_nome, u.usuario_mail, u.usuario_siape, t.tipo_usuario_tipo 
                            FROM usuarios AS u
                            INNER JOIN tipo_usuario AS t
                            on u.usuario_tipo_usuario_id = t.tipo_usuario_id
                        WHERE
                            u.usuario_id='{$txt_pesquisa_usuarios}' or
                            u.usuario_nome LIKE '%{$txt_pesquisa_usuarios}%' or
                            t.tipo_usuario_tipo LIKE '%{$txt_pesquisa_usuarios}%' or
                            u.usuario_siape LIKE '%{$txt_pesquisa_usuarios}%' or
                            u.usuario_mail LIKE '%{$txt_pesquisa_usuarios}%'
                            ORDER BY usuario_nome ASC 
                            LIMIT $inicio_usuarios,$quantidade_registros_usuarios";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr>
                        <td class="operacoes">
                            <a href="index.php?menuop=editar_usuario&idUsuario=<?=$dados["usuario_id"]?>" class="confirmaEdit">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                            <a href="index.php?menuop=excluir_usuario&idUsuario=<?=$dados["usuario_id"]?>"
                                class="confirmaDelete">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
                        <td><?=$dados["usuario_id"]?></td>
                        <td><?=$dados["usuario_nome"]?></td>
                        <td><?=$dados["usuario_mail"]?></td>
                        <td><?=$dados["tipo_usuario_tipo"]?></td>
                        <td><?=$dados["usuario_siape"]?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <div class="paginacao">
                <?php
                    $sqlTotalUsuarios = "SELECT usuario_id FROM usuarios";
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
                                echo "<span>$i</span>";
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