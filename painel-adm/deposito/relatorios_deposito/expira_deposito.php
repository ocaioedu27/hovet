<?php

// echo $_SERVER['PHP_SELF'] . "<br />";
    // use \Dompdf\Dompdf;

    // require_once '../dompdf/autoload.inc.php';

    // $dompdf = new Dompdf();

    require '../../../db/connect.php';

    
    $slq_teste='SELECT * FROM deposito';

    $resultado_teste = mysqli_query($conexao,$slq_teste) or die("//gera pdf - erro ao realizar a consulta " . mysqli_error($conexao));

    $dados_resut = mysqli_fetch_assoc($resultado_teste);

    echo $dados_resut['deposito_id'];

?>