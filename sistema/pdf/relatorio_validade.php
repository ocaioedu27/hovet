<?php
// ob_start();
// $html = ob_get_clean();
// echo "end";
// exit;
include("../../db/connect.php");

$html .= "<!DOCTYPE html>";
$html .= "<html lang='pt-BR'>";
$html .= "<head>"; 
$html .= "<meta charset='UTF-8'>";
$html .= "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
$html .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
$html .= "<link rel='stylesheet' href='http://localhost/hovet/sistema/pdf/css/custom.css'";
$html .= "<title>Relatorio de Insumos Prestes a Expirar</title>";
$html .= "</head>";
$html .= "<body>";
$html .= "<img src='logo_hovet.jpg'>";
$html .= "";
$html .= "";
$html .= "";
$html .= "</body>";
$html .= "<br><br><br>";


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
// var_dump($dados);

$sql = "";
    
if (!empty($dados)) {
    // echo "tem post";
    $data_referencia = mysqli_real_escape_string($conexao,$_POST["data_referencia"]);
    $intervalo_dias = mysqli_real_escape_string($conexao,$_POST["intervalo_dias"]);

    $html .= "<h3 align='center'>Relatorio de Insumos Prestes a Expirar nos Próximos $intervalo_dias dias<br></h3>";

    $sql= "SELECT 
                d.deposito_id, 
                d.deposito_qtd,
                date_format(d.deposito_validade, '%d/%m/%Y') as validadedeposito,
                i.insumos_nome,
                i.insumos_unidade,
                datediff(d.deposito_validade, curdate()) as diasvencimento,
                es.estoques_nome
            FROM 
                deposito d 
            INNER JOIN 
                insumos i 
            ON
                d.deposito_insumos_id = i.insumos_id
            INNER JOIN 
                estoques es
            ON
                es.estoques_id = d.deposito_estoque_id
            WHERE 
                deposito_validade<='{$data_referencia}' + interval {$intervalo_dias} day ORDER BY insumos_nome ASC";

} else {
    $html .= "<h3 align='center'>Relatorio de Insumos Prestes a Expirar nos Próximos 30 dias<br></h3>";

    $sql= "SELECT 
            d.deposito_id, 
            d.deposito_qtd,
            date_format(d.deposito_validade, '%d/%m/%Y') as validadedeposito,
            i.insumos_nome,
            i.insumos_unidade,
            datediff(d.deposito_validade, curdate()) as diasvencimento,
            es.estoques_nome
        FROM deposito d 
        inner join insumos i 
        on d.deposito_insumos_id = i.insumos_id
        inner join estoques es
        on es.estoques_id = d.deposito_estoque_id
        where deposito_validade<=curdate() + interval 30 day ORDER BY insumos_nome ASC";
}

$res = $conexao->query($sql);
date_default_timezone_set('America/Sao_Paulo');
$agora = date('d/m/Y H:i');

if($res->num_rows > 0){
    $html .= "<table border=1 cellspacing=3>";
    $html .= "<thead><tr><th> ID </th><th> Insumo </th><th> Quantidade </th><th> Validade </th><th> Guardado em </th><th> Aviso de Vencimento </th></tr></thead>";
    
    while($row = $res->fetch_object()){
        
        $html .= "<tr>";
        $html .= "<td>".$row->deposito_id."</td>";
        $html .= "<td>".$row->insumos_nome."</td>";
        $html .= "<td>".$row->deposito_qtd."</td>";
        $html .= "<td>".$row->validadedeposito."</td>";
        $html .= "<td>".$row->estoques_nome."</td>";
        $dias = ['30','45'];

        $mensagem_aviso = '';
        $class_to_add = '';

        if($row->diasvencimento <= $dias[0]){                                    
            $class_to_add = "vermelho";
        } else if($row->diasvencimento <= $dias[1]){
            $class_to_add = "amarelo";
        } else if($row->diasvencimento > $dias[1]){
            $class_to_add = "verde";
        }
            
        if ($row->diasvencimento <= 0){
            $mensagem_aviso = "INSUMO VENCIDO!";
        } else{
            $mensagem_aviso = $row->diasvencimento . " dia(s) para o vencimento";
        }
            
        $html .="<td class=". $class_to_add . ">". $mensagem_aviso;
        
        $html .= "</tr>";
    }
    $html .= "</table>";
    $html .= "<br><br>";

}else{
    $html .="Nenhum Dado foi encontrado para este relatorio.";
    //echo "Sem resultado";
}
$html .= "<br><br>";
$html .= "Relatorio gerado em " . $agora ."";
$html .= "</html>";


// echo "<br>Conteudo gerado<br><br><br><br><br><br>" . $html;

require __DIR__.'/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

//echo "<br>passou do dom";

//instanciar Options
$options = new Options();
$options->setChroot(__DIR__);

//echo "<br>setou as opcoes";

$options->setIsRemoteEnabled(true);

//echo "<br>passou do remote";

//instanciar Dompdf
$dompdf = new Dompdf($options);
//$dompdf = new Dompdf();

$dompdf->loadHtml($html);

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
// echo $dompdf->output();
// $dompdf->stream($file_name,array("Attachment"=>true));

?>