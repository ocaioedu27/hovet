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

$sql_user = "SELECT usuario_primeiro_nome FROM usuarios WHERE usuario_id = {$userId}";
$r = mysqli_query($conexao, $sql_user) or die("//Conceder_acesso/slq_user - Erro ao realizar a consulta: " . mysqli_error($conexao));

$dados_user = mysqli_fetch_assoc($r); 

?>


<div class="voltar" style="justify-content: space-around;">
    <h4>Concedendo Permissão(ões) a <?=$dados_user['usuario_primeiro_nome']?></h4>
    <div>
        <a href="index.php?menuop=gerenciar_permissoes_usuario&idUsuario=<?=$userId?>" class="confirmaVolta">
            <button class="btn">
                <span class="icon">
                    <ion-icon name="arrow-back-outline"></ion-icon>
                </span>
            </button>
        </a>
    </div>
</div>
<div class="container cadastro_all">
    <div class="cards cadastro_categoria_insumo">
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=inserir_acesso&usuarioId=<?=$userId?>" method="post">

            <div id="dados_acesso_usuario">
                <div class="display-flex-row">
                    <div class="form-group">

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Nome da Permissão</label>
                                <input type="text" class="form-control" name="nomeAcessoUsuario[]" id="nomeAcessoUsuario1" placeholder="Nome da permissão..." onkeyup="searchInput_cadDeposito(this.value, 1, 7,<?=$userId?>)" required>
                                <span class="ajuste_span" id="resultado_ceder_permissao1" style="
        margin: 18% auto;"></span>
                            </div>

                        </div>

                        <div class="form-group valida_movimentacao">
                            <div class="display-flex-cl">
                                <label>Descrição da Permissão</label>
                                <textarea name="descAcessoUsuario[]" class="form-control" rows="3" id="descAcessoUsuario1" readonly></textarea>
                            </div>
                        </div>
                    </div>


                    <input type="hidden" value="<?=$userId?>" id="id_user_to_add_permission" name="id_user_to_add_permission">

                    <button class="btn" type="button" onclick="adicionaCampoCad(11)" style="padding: 0;">+</button>

                </div> 

            </div>

            <div class="form-group valida_movimentacao">
                <label>Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="valida_dados_ceder_permissao" required>
            </div>

            
            <div class="form-group">
                <input type="submit" value="Ceder Permissão(ões)" name="btnCederPermissoesUser" class="btn_cadastrar" id="btnCederPermissoesUser" style="width: 60%;">
            </div>
        </form>
    </div>
</div>