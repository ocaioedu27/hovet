<?php
include_once("../../db/connect.php");
include_once("../../pgs_modelo/funcoes.php");

$html .= "<!DOCTYPE html>";
$html .= "<html lang='pt-BR'>";
$html .= "<head>"; 
$html .= "<meta charset='UTF-8'>";
$html .= "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
$html .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
$html .= "<link rel='stylesheet' href='http://localhost/hovet/sistema/pdf/css/custom.css'>";
$html .= "<title>Relatório de Insumos Prestes a Expirar</title>";
$html .= "</head>";
$html .= "<body>";
$html .= "<div class='container'>";
$html .= "<img src='logo_hovet.jpg'>";

//Coleta de dados caso seja personalizado
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$estoquesTipo = ['deposito', 'dispensario', 'farmacia'];
$estoquesPorGet = $_GET['op'] ? $_GET['op'] : 'all';

$arrValores = [];
    
if (isset($dados)) {
    // echo "tem post";
    $data_referencia = mysqli_real_escape_string($conexao,$_POST["data_referencia"]);
    $intervalo_dias = mysqli_real_escape_string($conexao,$_POST["intervalo_dias"]);
    $estoquePreferencia = mysqli_real_escape_string($conexao,$_POST["estoquePreferencia"]);

    $html .= "<h3 align='center'>Relatório de insumos prestes a expirar nos próximos $intervalo_dias dias<br></h3>";

    if($estoquePreferencia != 'all'){

        $arrTmp = getVencidosEstoques($conexao, $estoquePreferencia, $data_referencia, $intervalo_dias);
        
        $arrValores = $arrTmp;

    }else{
        
        for ($i=0; $i < count($estoquesTipo); $i++) { 

            $arrTmp = getVencidosEstoques($conexao, $estoquesTipo[$i], $data_referencia, $intervalo_dias);
            for ($j=0; $j < count($arrTmp); $j++) { 
                array_push($arrValores, $arrTmp[$j]);                
            }
        }
    }


} else {
    // echo 'sem post';
    $intervalo_dias = 30;
    $html .= "<h3 align='center'>Relatorio de Insumos Prestes a Expirar nos Próximos $intervalo_dias dias<br></h3>";
    $data_referencia = date('Y-m-d');

    if($estoquesPorGet != 'all'){

        $arrTmp = getVencidosEstoques($conexao, $estoquesPorGet, $data_referencia, $intervalo_dias);
        
        $arrValores = $arrTmp;

    }else{
        
        for ($i=0; $i < count($estoquesTipo); $i++) { 

            $arrTmp = getVencidosEstoques($conexao, $estoquesTipo[$i], $data_referencia, $intervalo_dias);
            for ($j=0; $j < count($arrTmp); $j++) { 
                array_push($arrValores, $arrTmp[$j]);                
            }
        }
    }
}

// echo $sql;
// exit;

date_default_timezone_set('America/Sao_Paulo');
$agora = date('d/m/Y H:i');


if(count($arrValores) > 0){

    $html .= "<table border=1 cellspacing=3>";
    $html .= "<thead><tr><th> ID </th><th> Insumo </th><th> Quantidade </th><th> Validade </th><th> Guardado em </th><th> Aviso de Vencimento </th></tr></thead>";
    $html .= "<tbody>";
    
    for ($h=0; $h < count($arrValores); $h++) {
        $id = $arrValores[$h]['id'];
        $nome = $arrValores[$h]['nome'];
        $qtd = $arrValores[$h]['qtd'];
        $validade = $arrValores[$h]['validade'];
        $diasvencimento = $arrValores[$h]['diasvencimento'];
        $estoques_nome = $arrValores[$h]['estoques_nome'];

        $html .= "<tr>";
        $html .= "<td>".$id."</td>";
        $html .= "<td>".$nome."</td>";
        $html .= "<td>".$qtd."</td>";
        $html .= "<td>".$validade."</td>";
        $html .= "<td>".$estoques_nome."</td>";
        $dias = ['30','45'];

        $mensagem_aviso = '';
        $class_to_add = '';

        if($diasvencimento <= $dias[0]){                                    
            $class_to_add = "vermelho";
        } else if($diasvencimento <= $dias[1]){
            $class_to_add = "amarelo";
        } else if($diasvencimento > $dias[1]){
            $class_to_add = "verde";
        }
            
        if ($diasvencimento <= 0){
            $mensagem_aviso = "INSUMO VENCIDO!";
        } else{
            $mensagem_aviso = $diasvencimento . " dia(s) para o vencimento";
        }
            
        $html .="<td class=". $class_to_add . ">". $mensagem_aviso;
        
        $html .= "</tr>";
    }
    
    $html .= "</tbody>";
    $html .= "</table>";
    $html .= "</div>";
    $html .= "";

}else{
    $html .="<p>Nenhum dado foi encontrado para este relatorio.</p>";
    //echo "Sem resultado";
}

$html .= "<p>Relatorio gerado em " . $agora ."</p>";
$html .= "</body>";
$html .= "</html>";

// echo $html;
// exit;

require __DIR__.'/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

//instanciar Options
$options = new Options();
$options->setChroot(__DIR__);

$options->setIsRemoteEnabled(true);

//instanciar Dompdf
$dompdf = new Dompdf($options);
//$dompdf = new Dompdf();

$dompdf->loadHtml($html);

//configurando o papel
$dompdf->setPaper('A4', 'landscape');

// $dompdf->loadHtml('Olá Html');
$dompdf->render();

//Pegar a data atual e nome do arquivo
$data_atual = date('Y-m-d');
$file_name = "" . $data_atual . "-relatorio_insumo_expirar.pdf";

// header('Content-type: application/pdf');    
header('Content-type: application/pdf');
    $dompdf->stream(
        $file_name,
        array(
            "Attachment"=>true
        )
    );

?>