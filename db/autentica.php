<!-- Usa-se o _once para incluir o arquivo uam única vez, se houver outras chamadas ele não duplica -->
<!-- Primeira coisa a se fazer é iniciar a sessão do php para recuperar as informações do usuário e para evitar qualquer tipo de problema como alertas usa-se o @ no inicio da sessão -->


<?php 
require_once("connect.php");
@session_start();

if(empty($_post['usuario']) || empty($_POST['senha'])){
	header("location:index.php");
}

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$res = $pdo->prepare("SELECT * from usuarios where usuario = :usuario and senha = :senha ");

$res->bindValue(":usuario", $usuario);
$res->bindValue(":senha", $senha);
$res->exercute();

$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados);



if($linhas > 0){
	$_SESSION['nome_usuario'] = $dados[0]['nome'];
	header("location:painel-adm/index.php");
}else{
	echo "<script language='javascript'>window.alert('Dados Incorretos!!'); </script>";
	echo "<script language='javascript'>window.location='login.php';</script>";
}


 ?>