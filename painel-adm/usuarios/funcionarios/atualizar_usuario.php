<header>
    <h2>Atualizar Usuário</h2>
</header>
<?php 


$painel = "";

if ($sessionUserType != 5 && $sessionUserType != 3) {
    $painel = "pagina_principal";
} else {
    $painel = "usuarios";
}


$stringList = array();

if (   isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
        array_push($stringList, $valor_est);
        // print_r($valor_est);
	}

    $varIdSolicitacao = $stringList[1];
    $novo_status_slc = $stringList[2];
    
    // echo "<br>Tipo de operacao: $novo_status_slc";
}

$idSolicitacao = $_GET[$varIdSolicitacao];

$idUsuario = mysqli_real_escape_string($conexao,$_POST["idUsuario"]);

$senha = $conexao->real_escape_string($_POST['validaSenhaUsuario']);

$sql_code = "SELECT * FROM usuarios WHERE usuario_id = {$idUsuario} LIMIT 1";
$sql_query = $conexao->query($sql_code) or die("//Autentica - Falha na execução do código SQL: " . $conexao->error);

$quantidade = $sql_query->num_rows;

if ($quantidade == 1) {
    $usuario = $sql_query->fetch_assoc();

    if (password_verify($senha, $usuario['usuario_senha'])) {
    
        $nomeCompletoUsuario = mysqli_real_escape_string($conexao,$_POST["nomeCompletoUsuario"]);
        $primeiroNomeUsuario = mysqli_real_escape_string($conexao,$_POST["primeiroNomeUsuario"]);
        $sobrenomeUsuario = mysqli_real_escape_string($conexao,$_POST["sobrenomeUsuario"]);
        $mailUsuario = mysqli_real_escape_string($conexao,$_POST["mailUsuario"]);
        $tipoUsuario = mysqli_real_escape_string($conexao,$_POST["tipoUsuario"]);
        // $tipoUsuario = $tipoUsuario[0];
        $tipoUsuario = strtok($tipoUsuario, " ");
        $siapeUsuario = mysqli_real_escape_string($conexao,$_POST["siapeUsuario"]);
        $sql = "UPDATE usuarios SET 
            usuario_nome_completo = '{$nomeCompletoUsuario}',
            usuario_primeiro_nome = '{$primeiroNomeUsuario}',
            usuario_sobrenome = '{$sobrenomeUsuario}',
            usuario_mail = '{$mailUsuario}',
            usuario_tipo_usuario_id = {$tipoUsuario},
            usuario_siape = '{$siapeUsuario}'
            WHERE usuario_id={$idUsuario}
            ";

            if(mysqli_query($conexao, $sql)){
        
                echo "<script language='javascript'>window.alert('Usuário atualizado com sucesso!'); </script>";
                echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=$painel';</script>";
        
            } else{
                echo "<script language='javascript'>window.alert('Erro ao atualizar usuário!'); </script>";
                echo " <a href=\"/hovet/painel-adm/index.php?menuop=editar_usuario&idUsuario=$idUsuario\">Voltar ao formulário de edição</a> <br/>";
        
                die("Erro: " . mysqli_error($conexao));
            }

    } else{
        echo "<script language='javascript'>window.alert('Erro ao realizar alteração. Senha incorreta!!'); </script>";
        echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=editar_usuario&idUsuario=". $idUsuario ."';</script>"; 
    }
} else {
    echo "//atualiza_usuario/procura_user - erro: " . die(mysqli_error($conexao));
}

?>