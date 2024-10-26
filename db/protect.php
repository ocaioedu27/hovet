<?php
			
if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['usuario_id'])){
    die("Você não pode acessar o sistema porque não está com uma sessão válida ou iniciada com login. <p><a href=\"\hovet/index.php\">Entrar</a></p>");
}

?>