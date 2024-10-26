<?php

use function PHPSTORM_META\type;

if(isset($_POST['mail']) || isset($_POST['senha'])){
	if (strlen($_POST['mail']) == 0) {
		echo "Preencha seu e-mail";
	} elseif (strlen($_POST['senha']) == 0) {
		echo "Preencha sua senha";
	} else {
		$email = $conexao->real_escape_string($_POST['mail']);
		$senha = $conexao->real_escape_string($_POST['senha']);

		$sql_code = "SELECT * FROM usuarios WHERE mail = '$email' LIMIT 1";
		$sql_query = $conexao->query($sql_code) or die("//Autentica - Falha na execução do código SQL: " . $conexao->error);

		$quantidade = $sql_query->num_rows;

		if ($quantidade == 1) {
			$usuario = $sql_query->fetch_assoc();

			$statusUsu = $usuario['status'];
			// echo $statusUsu;
			// exit;
			if ($statusUsu == 0) {
				echo "<script language='javascript'>window.alert('Usuário Inativo! Fale com o adminstrador do Sistema para reativar sua conta!!'); </script>";
				echo "<script language='javascript'>window.location='/hovet/index.php';</script>";
				exit;
			}

			if (password_verify($senha, $usuario['senha'])) {
				if(!isset($_SESSION)){
					session_start();
				}

				$_SESSION['usuario_id'] = $usuario['id'];
				$_SESSION['usuario_primeiro_nome'] = $usuario['primeiro_nome'];
				$_SESSION['usuario_tipo_usuario_id'] = $usuario['tipo_usuario_id'];

				header("Location: /hovet/sistema/index.php");

			} else{
				echo "<script language='javascript'>window.alert('Erro ao realizar o login! Senha incorreta)!!'); </script>";
				echo "<script language='javascript'>window.location='/hovet/index.php';</script>"; 
			}

		} else {
			echo "<script language='javascript'>window.alert('Erro ao realizar o login! Email incorreto ou usuário não existe!!'); </script>";
			echo "<script language='javascript'>window.location='/hovet/index.php';</script>";
		}
	}
}

?>