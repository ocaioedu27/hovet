
<?php
$quantidade_registros_usuarios = 10;

$pagina_usuarios = (isset($_GET['pagina_usuarios']))?(int)$_GET['pagina_usuarios']:1;

$inicio_usuarios = ($quantidade_registros_usuarios * $pagina_usuarios) - $quantidade_registros_usuarios;

$txt_pesquisa_usuarios = (isset($_POST["txt_pesquisa_usuarios"]))?$_POST["txt_pesquisa_usuarios"]:"";

$sql = "SELECT 
            u.id, 
            u.primeiro_nome, 
            u.mail,
            u.siape,
            u.status,
            t.tipo 
        FROM 
            usuarios u
        INNER JOIN 
            tipo_usuario t
        ON 
            u.tipo_usuario_id = t.id
        WHERE
            u.id='{$txt_pesquisa_usuarios}' or
            u.primeiro_nome LIKE '%{$txt_pesquisa_usuarios}%' or
            t.tipo LIKE '%{$txt_pesquisa_usuarios}%' or
            u.siape LIKE '%{$txt_pesquisa_usuarios}%' or
            u.mail LIKE '%{$txt_pesquisa_usuarios}%'
        ORDER BY 
            primeiro_nome ASC 
        LIMIT 
            $inicio_usuarios,$quantidade_registros_usuarios";

$rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
$resultados = '';
if ($rs->num_rows > 0){
    while($dados = mysqli_fetch_assoc($rs)){
        $qtd_linhas_tabelas++;

        $id = $dados['id'];
        $primeiro_nome = $dados['primeiro_nome'];
        $mail = $dados['mail'];
        $tipo = $dados['tipo'];
        $siape = $dados['siape'];
        $status = $dados["status"] ? 'Ativo': 'Inativo'; 

        $resultados .= '
            <tr class="tabela_dados">
                <td>'. $id .'</td>
                <td>'. $primeiro_nome .'</td>
                <td>'. $mail .'</td>
                <td>'. $tipo .'</td>
                <td>'. $status .'</td>
                <td>'. $siape .'</td>
                <td class="" id="td_operacoes_editar_deletar">
                    <a href="index.php?menuop=editar_usuario&idUsuario='.$id.'" class="confirmaEdit">
                        <button class="btn">
                            <span class="icon">
                                <ion-icon name="create-outline"></ion-icon>
                            </span>
                        </button>
                    </a>
                    <a href="index.php?menuop=excluir_usuario&idUsuario='.$id.'" class="confirmaDelete">
                        <button class="btn">
                            <span class="icon">
                                <ion-icon name="trash-outline"></ion-icon>
                            </span>
                        </button>
                    </a>
                </td>
            </tr>';
    }
} else{
    $resultados = '
        <tr class="tabela_dados">
            <td colspan="4" class="text-center">Nenhum registro para exibir!</td>
        </tr>';

}
?>

<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Todos os usuários</h3>
                <a href="index.php?menuop=cadastro_usuario" id="operacao_cadastro">
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
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Tipo de Usuário</th>
                        <th>Status</th>
                        <th>SIAPE</th>
                        <th id="th_operacoes_editar_deletar">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        echo $resultados;
                        echo '<input type="hidden" id="quantidade_linhas_tabelas" value="'.$qtd_linhas_tabelas.'">';
                    ?>
                </tbody>
            </table>
        </div>
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
</section>