<?php

$stringList = array();

if ( isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
    // $contador = 0;
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
        array_push($stringList, $valor_est);

	}
    // var_dump($stringList);

    $userId_tmp = $stringList[1];

    $userId = $_GET[$userId_tmp];

}

$sql = "SELECT
            u.usuario_id,
            u.usuario_primeiro_nome,
            uhp.uhp_id,
            p.permissoes_id,
            p.permissoes_nome
        FROM 
            usuarios_has_permissoes uhp
        INNER JOIN
            usuarios u
        ON 
            u.usuario_id = uhp.uhp_usuario_id

        INNER JOIN
            permissoes_usuario p
        ON
            p.permissoes_id = uhp.uhp_permissoes_id 
        
        WHERE
            u.usuario_id  = {$userId}";

$result = mysqli_query($conexao,$sql) or die("//editar_permissoes/Select_Geral - Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados_user = mysqli_fetch_assoc($result);

?>

<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Gerenciando as Permissões de <?=$dados_user['usuario_primeiro_nome']?></h3>
                <div>
                    <a href="index.php?menuop=conceder_permissao&idUsuario=<?=$dados_user['usuario_id']?>" id="operacao_cadastro">
                        <button class="btn">Conceder Permissão</button>
                    </a>
                </div>
            </div>
            <div>
                <form action="index.php?menuop=gerenciar_permissoes_usuario&idUsuario=<?=$userId?>" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_gerenciar_permissoes" placeholder="Buscar">
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
                        <th id="th_operacoes_editar_deletar">Operação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $quantidade_registros_permissoes = 10;

                        $pagina = (isset($_GET['pagina']))?(int)$_GET['pagina']:1;

                        $inicio_permissoes = ($quantidade_registros_permissoes * $pagina) - $quantidade_registros_permissoes;

                        // $txt_pesquisa_gerenciar_permissoes = (isset($_POST["txt_pesquisa_gerenciar_permissoes"]))?$_POST["txt_pesquisa_gerenciar_permissoes"]:"";

                        $txt_pesquisa_gerenciar_permissoes = $_POST["txt_pesquisa_gerenciar_permissoes"];

                        if (isset($txt_pesquisa_gerenciar_permissoes) && $txt_pesquisa_gerenciar_permissoes != "") {
                            $txt_pesquisa_gerenciar_permissoes = $_POST["txt_pesquisa_gerenciar_permissoes"];
                            echo $txt_pesquisa_gerenciar_permissoes;
                        } else{

                            $txt_pesquisa_gerenciar_permissoes = "";
                        }

                        $rs = $result;

                        while($dados = mysqli_fetch_assoc($rs)){
                            // echo "<br>Teste";
                            $qtd_linhas_tabelas++;
                    ?>
                    <tr>
                        <td><?=$dados["uhp_id"]?></td>
                        <td><?=$dados["permissoes_nome"]?></td>
                        <td class="operacoes" id="td_operacoes_editar_deletar">
                            <a href="index.php?menuop=remover_permissao&idUsuario=<?=$dados["usuario_id"]?>&idPermissao=<?=$dados['uhp_id']?>">
                                <button class="btn">Remover</button>
                            </a>
                        </td>
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
                $sqlTotalUsuarios = "SELECT
                                        uhp_id

                                    FROM 
                                        usuarios_has_permissoes
                                        
                                    WHERE 
                                        uhp_usuario_id = {$userId}";

                $queryTotalUsuarios = mysqli_query($conexao,$sqlTotalUsuarios) or die(mysqli_error($conexao));

                $numTotalUsuarios = mysqli_num_rows($queryTotalUsuarios);
                $totalPaginasUsuarios = ceil($numTotalUsuarios/$quantidade_registros_permissoes);
                
                echo "<a href=\"?menuop=gerenciar_permissoes_usuario&idUsuario=" . $userId . "&pagina=1\">Início</a> ";

                if ($pagina>6) {
                    ?>
                        <a href="?menuop=gerenciar_permissoes_usuario&idUsuario=<?=$userId?>&pagina=<?php echo $pagina-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasUsuarios;$i++){

                    if ($i >= ($pagina) && $i <= ($pagina+5)) {
                        
                        if ($i==$pagina) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=gerenciar_permissoes_usuario&idUsuario" . $userId . "&pagina=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina<($totalPaginasUsuarios-5)) {
                    ?>
                        <a href="?menuop=gerenciar_permissoes_usuario&idUsuario=<?=$userId?>&pagina=<?php echo $pagina+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=gerenciar_permissoes_usuario&idUsuario=" . $userId . "&pagina=$totalPaginasUsuarios\">Fim</a>";
            ?>
        </div>
    </div>
</section>