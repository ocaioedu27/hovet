<?php

use Sabberworm\CSS\Value\Value;
$stringList = array();
// var_dump($_GET);

if (   isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
        array_push($stringList, $valor_est);
        // print_r($valor_est);
	}

    $oid_permissoes_tmp = $stringList[1];
    $oid_permissoes = $_GET[$oid_permissoes_tmp];
    // echo "<br>Oid: $oid_permissoes";

    $qualStatus_tmp = $stringList[2];
    $qualStatus = $qualStatus_tmp;
    // echo "<br>Tipo de operacao: $qualStatus";
}

?>
<section class="painel_usuarios">
    <div class="container">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Gerênciar Permissões</h3>
                <div>

                    <a href="index.php?menuop=cadastrar_permissoes">
                        <button class="btn">Criar Nova Permissão</button>
                    </a>

                </div>
            </div>
            <div>
                <form action="index.php?menuop=permissoes" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_permissoes" placeholder="Buscar">
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
                        <th id="">Operações</th>
                        <th>ID</th>
                        <th>Permissão</th>
                        <th>Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
               
                        $quantidade_registros_permissoes = 10;

                        $pagina_permissoes = (isset($_GET['pagina_permissoes']))?(int)$_GET['pagina_permissoes']:1;;

                        $inicio_permissoes = ($quantidade_registros_permissoes * $pagina_permissoes) - $quantidade_registros_permissoes;

                        $txt_pesquisa_permissoes = $_POST["txt_pesquisa_permissoes"];

                        if (isset($txt_pesquisa_permissoes) && $txt_pesquisa_permissoes != "") {
                            $txt_pesquisa_permissoes = $_POST["txt_pesquisa_permissoes"];
                            // echo $txt_pesquisa_permissoes;
                        } else{

                            $txt_pesquisa_permissoes = "";
                        }

                        $sql = "SELECT 
                                    p.permissoes_id,
                                    p.permissoes_nome,
                                    cp.cp_nome

                                FROM 
                                    permissoes_usuario p
                                
                                INNER JOIN
                                    categorias_permissoes cp
                                ON
                                    p.permissoes_ctg_perm_id = cp.cp_id

                                WHERE
                                    p.permissoes_id = '{$txt_pesquisa_permissoes}' or p.permissoes_nome LIKE '%{$txt_pesquisa_permissoes}%'

                                ORDER BY cp.cp_nome
                                    
                                LIMIT $inicio_permissoes,$quantidade_registros_permissoes";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

                        while($dados_para_while = mysqli_fetch_assoc($rs)){
                            // $valor_form = $dados_para_while['estoques_nome_real'];
                            $qtd_linhas_tabelas++;

                            // $pre_slc_id = $dados_para_while['pre_slc_id'];
                            // echo $pre_slc_id;
                        
                    ?>
                    <tr>
                        <td class="operacoes" id="td_operacoes_editar_deletar">
                            <a href="index.php?menuop=editar_permissoes&idPermissao=<?=$dados_para_while["permissoes_id"]?>" class="confirmaEdit">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                            <a href="index.php?menuop=excluir_permissoes&idPermissao=<?=$dados_para_while["permissoes_id"]?>"
                                class="confirmaDelete" >
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
                        <td><?=$dados_para_while["permissoes_id"]?></td>
                        <td><?=$dados_para_while["permissoes_nome"]?></td>
                        <td><?=$dados_para_while["cp_nome"]?></td>
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
                $sqlTotalSlc = "SELECT 
                                    permissoes_id 
                                FROM 
                                    permissoes_usuario";

                $queryTotalSlc = mysqli_query($conexao,$sqlTotalSlc) or die(mysqli_error($conexao));

                $numTotalSlc = mysqli_num_rows($queryTotalSlc);

                $totalPaginasSlc = ceil($numTotalSlc/$quantidade_registros_permissoes);

                echo "<a href=\"?menuop=permissoes&idpermissoes=$oid_permissoes&$qualStatus&pagina_permissoes=1\">Início</a> ";

                if ($pagina_permissoes>1) {
                    ?>
                        <a href="?menuop=permissoes&idpermissoes=<?=$oid_permissoes?>&<?=$qualStatus?>&pagina_permissoes=<?php echo $pagina_permissoes-1?>"> < </a>
                    <?php
                } 

                if ($pagina_permissoes>6) {
                    ?>
                        <a href="?menuop=permissoes&idpermissoes=<?=$oid_permissoes?>&<?=$qualStatus?>&pagina_permissoes=<?php echo $pagina_permissoes-1?>"> << </a>
                    <?php
                } 

                for($i=1;$i<=$totalPaginasSlc;$i++){
                    // print_r($i);

                    if ($i >= ($pagina_permissoes) && $i <= ($pagina_permissoes+5)) {
                        
                        if ($i==$pagina_permissoes) {
                            echo "<span>$i</span>";
                        } else {
                            echo " <a href=\"?menuop=permissoes&idpermissoes=$oid_permissoes&$qualStatus&pagina_permissoes=$i\">$i</a> ";
                        } 
                    }          
                }

                if ($pagina_permissoes < $totalPaginasSlc) {
                    ?>
                        <a href="?menuop=permissoes&idpermissoes=<?=$oid_permissoes?>&<?=$qualStatus?>&pagina_permissoes=<?php echo $pagina_permissoes+1?>"> > </a>
                    <?php
                }

                if ($pagina_permissoes<($totalPaginasSlc-4)) {
                    ?>
                        <a href="?menuop=permissoes&idpermissoes=<?=$oid_permissoes?>&<?=$qualStatus?>&pagina_permissoes=<?php echo $pagina_permissoes+1?>"> >> </a>
                    <?php
                }
                
                echo " <a href=\"?menuop=permissoes&idpermissoes=$oid_permissoes&$qualStatus&pagina_permissoes=$totalPaginasSlc\">Fim</a>";
            ?>
        </div>
    </div>
</section>