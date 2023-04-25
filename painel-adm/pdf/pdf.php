
<?php
   

   require '../../db/connect.php';


    require __DIR__.'/vendor/autoload.php';
    
    use Dompdf\Dompdf;
    use Dompdf\Options;
    
    //instanciar Options
    $options = new Options();
    $options->setChroot(__DIR__);
    
    $options->setIsRemoteEnabled(true);
    
    
    //instanciar Dompdf
    
    $dompdf = new Dompdf($options);

    // $dompdf->load_Html('
    
    // <!DOCTYPE html>
    //     <html lang="pt-BR">
    //     <head>
    //         <meta charset="UTF-8">
    //         <meta http-equiv="X-UA-Compatible" content="IE=edge">
    //         <meta name="viewport" content="width=device-width, initial-scale=1.0">
    //         <title>Relatorio Hovet</title>
    //     </head>
    //     <body>
    //         <h1>Relatorio Teste Hovet</h1>
    //         <hr>

    //         <img src="ufra.jpg" alt="">

    //     </body>
    //     </html>
    
    // ');

    // $slq_teste='SELECT 
	//             count(deposito_id) as vencidos
    //             FROM deposito 
    //             where 
    //             deposito_validade<=curdate() 
    //             or deposito_validade <= curdate() + interval 30 day;';

    // $slq_teste='SELECT * FROM deposito LIMIT 10';

    // $resultado_teste = mysqli_query($conexao,$slq_teste) or die("//gera pdf - erro ao realizar a consulta " . mysqli_error($conexao));

    // while($linha_teste = mysqli_fetch_assoc($resultado_teste)){
    //     var_dump($linha_teste);
    // }
    
    $conteudo_teste = '
    
    <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Relatorio Hovet</title>
        </head>
        <body>
            <h1>Relatorio Teste Hovet</h1>
            <h1></h1>
            <hr>

            <img src="ufra.jpg" alt="">


        </body>
        </html>
    
    ';
    
    $dompdf->load_Html($conteudo_teste);
    
    //$dompdf->loadHtml('Olá Html');
    
    $dompdf->render();
    
    header('Content-type: application/pdf');
    echo $dompdf->output();
    
    // echo $_SERVER['PHP_SELF'] . "<br />";
    
    
    ?>
    

?>
