<?php 

$stringList = array();

if ( isset( $_GET['menuop'] ) && ! empty( $_GET['menuop'] )) {
	// Cria variáveis dinamicamente
    // $contador = 0;
	foreach ( $_GET as $chave => $valor ) {
        $valor_tmp = $chave;
        $position = strpos($valor_tmp, "menuop");
        $valor_est = strstr($valor_tmp,$position);
        array_push($stringList, $valor_est);

	}
    // var_dump($stringList);

    $chave = $stringList[1];
    $tipo_relatorio = $_GET[$chave];
    $dir = __DIR__;


    if ($tipo_relatorio == "prestes_expirar") {
        $tipo_relatorio = "Insumos prestes a expirar ou expirados";

        echo "<header><h4>Relatório: " . $tipo_relatorio . "</h4></header>";
        include_once($dir . '/personalizar_expirados.php');

    }else if ($tipo_relatorio == "estoque_criticos") {
        $tipo_relatorio = "Todos os insumos em estoque crítico";

        echo "<header><h4>Relatório: " . $tipo_relatorio . "</h4></header>";
        include_once($dir . '/personalizar_criticos.php');

    }else if ($tipo_relatorio == "todas_movimentacoes") {
        $tipo_relatorio = "Todas as movimentações";

        echo "<header><h4>Relatório: " . $tipo_relatorio . "</h4></header>";
        include_once($dir . '/personalizar_movimentacoes.php');
    }

}

?>

