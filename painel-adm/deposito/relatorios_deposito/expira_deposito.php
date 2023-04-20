<?php

    use Dompdf\Dompdf;

    require_once ('../../../dompdf/autoload.inc.php');

    $dompdf = new Dompdf();

    $dompdf->loadHtml("olá mundo");

    $dompdf->set_option('defautFont', 'sans');

    $dompdf->setPaper('A4','portrait');

    $dompdf->render();

    $dompdf->stream();

?>