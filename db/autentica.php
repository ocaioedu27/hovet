<?php 
if(isset($_POST['mail']) || isset($_POST['senha'])){
	if (strlen($_POST['mail']) == 0) {
		echo "Preencha seu e-mail";
	} elseif (strlen($_POST['senha']) == 0) {
		echo "Preencha sua senha";
	} else {
		$email = $conexao->real_escape_string($_POST['mail']);
		$senha = $conexao->real_escape_string($_POST['senha']);

		$sql_code = "SELECT * FROM usuarios WHERE usuario_mail = '$email' LIMIT 1";
		$sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);

		$quantidade = $sql_query->num_rows;

		if ($quantidade == 1) {
			$usuario = $sql_query->fetch_assoc();

			if (password_verify($senha, $usuario['usuario_senha'])) {
			
				if(!isset($_SESSION)){
					session_start();
				}

				$_SESSION['usuario_id'] = $usuario['usuario_id'];
				$_SESSION['usuario_nome'] = $usuario['usuario_nome'];

				header("Location: /hovet/painel-adm/index.php");

			} else{
				echo "<script language='javascript'>window.alert('Erro ao realizar o login! Email ou senha incorreto(s)!!'); </script>";
				echo "<script language='javascript'>window.location='/hovet/index.php';</script>"; 
			}

		} else {
			echo "<script language='javascript'>window.alert('Erro ao realizar o login! Email ou senha incorreto(s)!!'); </script>";
			echo "<script language='javascript'>window.location='/hovet/index.php';</script>";
		}
	}
}

?>