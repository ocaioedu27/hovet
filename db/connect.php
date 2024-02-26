<?php

include("config.php");

$conexao = new mysqli(SERVIDOR, USUARIO, SENHA, BANCO);

if($conexao->error){
    die("Erro na conexão com o servidor! " . $conexao->error);
}

?>