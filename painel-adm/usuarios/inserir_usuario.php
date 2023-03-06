<header>
    <h2>Inserir contato</h2>
</header>
<?php 
    
    $nomeUsuario = mysqli_real_escape_string($conexao,$_POST["nomeUsuario"]);
    $sql = "INSET INTO "
?>