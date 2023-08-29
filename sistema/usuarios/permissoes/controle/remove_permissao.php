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

    $userID_tmp = $stringList[1];
    $userID = $_GET[$userID_tmp];

    $idAcesso_tmp = $stringList[2];
    $idAcesso = $_GET[$idAcesso_tmp];

}

$sql = "SELECT
            uhp_id

        FROM 
            usuarios_has_permissoes

        WHERE 
            uhp_id ={$idAcesso} and uhp_usuario_id={$userID}";


$result = mysqli_query($conexao,$sql) or die("//excluir_permissao/select_por_id - Erro ao realizar a consulta. " . mysqli_error($conexao));

if($result->num_rows >0){

    echo "<br>Acesso retornado";
    $sqlDelete=mysqli_query($conexao, "DELETE from usuarios_has_permissoes WHERE uhp_id=$idAcesso and uhp_usuario_id={$userID}");

    echo "<script language='javascript'>window.alert('Acesso removido com sucesso!!'); </script>";
    echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=gerenciar_permissoes_usuario&idUsuario={$userID}';</script>";
}


?>