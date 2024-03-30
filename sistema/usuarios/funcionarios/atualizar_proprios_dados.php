
<?php 
$painel = "";

if ($sessionUserType != 2 && $sessionUserType != 5) {
    $painel = "pagina_principal";
    $idUsuario = mysqli_real_escape_string($conexao,$_POST["idUsuario"]);

} else {
    $painel = "usuarios";
    $idUsuario = $sessionUserID;
}

if (isset( $_GET['menuop'] ) && !empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
		// $$chave = $valor;
        // print_r($valor_est);
	}

    $qualOperacao = $valor_est;
}

$idUsuarioToModify = mysqli_real_escape_string($conexao,$_POST["idUsuario"]);
$senha = $conexao->real_escape_string($_POST['validaSenhaUsuario']);

$sql_code = "SELECT * FROM usuarios WHERE id = {$idUsuarioToModify} LIMIT 1";
$sql_query = $conexao->query($sql_code) or die("//Autentica - Falha na execução do código SQL: " . $conexao->error);

$quantidade = $sql_query->num_rows;

if ($quantidade == 1) {

    $sqlSenha = "SELECT * FROM usuarios WHERE id = {$idUsuario} LIMIT 1";
    $execQuery = $conexao->query($sqlSenha) or die("//Autentica - Falha na execução do código SQL: " . $conexao->error);
    $usuario = $execQuery->fetch_assoc();

    if (password_verify($senha, $usuario['usuario_senha'])) {

        if ($qualOperacao != "alterar_senha") {

            $nomeCompletoUsuario = mysqli_real_escape_string($conexao,$_POST["nomeCompletoUsuario"]);
            $primeiroNomeUsuario = mysqli_real_escape_string($conexao,$_POST["primeiroNomeUsuario"]);
            $sobrenomeUsuario = mysqli_real_escape_string($conexao,$_POST["sobrenomeUsuario"]);
            $mailUsuario = mysqli_real_escape_string($conexao,$_POST["mailUsuario"]);
            $statusUsu = mysqli_real_escape_string($conexao, $_POST['statusUsu']);
            // $tipoUsuario = $tipoUsuario[0];
            $tipoUsuario = strtok($tipoUsuario, " ");
            $siapeUsuario = mysqli_real_escape_string($conexao,$_POST["siapeUsuario"]);

            $sql = "UPDATE 
                        usuarios 
                    SET 
                        nome_completo = '{$nomeCompletoUsuario}',
                        primeiro_nome = '{$primeiroNomeUsuario}',
                        sobrenome = '{$sobrenomeUsuario}',
                        mail = '{$mailUsuario}',
                        siape = '{$siapeUsuario}',
                        status = {$statusUsu}
                    WHERE 
                        id={$idUsuarioToModify}";

            $msg_to_user = "Dados atualizados";
            
        } else {
            $senhaUsuarioAtualizada = mysqli_real_escape_string($conexao,$_POST["senhaUsuarioAtualizada"]);
            $senhaUsuarioAtualizada = password_hash($senhaUsuarioAtualizada, PASSWORD_DEFAULT);

            $sql = "UPDATE 
                        usuarios 
                    SET 
                        senha = '{$senhaUsuarioAtualizada}'
                    WHERE 
                        id = {$idUsuarioToModify}";

            $msg_to_user = "Senha atualizada";
        }

        try {
            
            if(mysqli_query($conexao, $sql)){
        
                echo "<script language='javascript'>window.alert('$msg_to_user com sucesso!'); </script>";
                echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=$painel';</script>";
        
            } else{
                echo "<script language='javascript'>window.alert('Erro ao atualizar usuário!'); </script>";
                echo " <a href=\"/hovet/sistema/index.php?menuop=editar_usuario&idUsuario=$idUsuarioToModify\">Voltar ao formulário de edição</a> <br/>";
        
                die("Erro: " . mysqli_error($conexao));
            }

        } catch (\Throwable $th) {
            echo $th;
        }

    } else{
        echo "<script language='javascript'>window.alert('Erro ao realizar alteração. Senha incorreta!!'); </script>";
        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=editar_usuario&idUsuario=". $idUsuarioToModify ."';</script>"; 
    }
} else {
    echo "//atualiza_usuario/procura_user - erro: " . die(mysqli_error($conexao));
}

?>