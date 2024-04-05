<?php
include("../../db/connect.php");

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
$estoquesTipo = ['deposito', 'dispensario'];
$estoquesPorGet = $_GET['estoque'] ? $_GET['estoque'] : 'all';

// echo $estoquesPorGet;
// exit;

$sql = "";
$arrValores = [];
    
if (isset($dados)) {
    // echo "tem post";
    $data_referencia = mysqli_real_escape_string($conexao,$_POST["data_referencia"]);
    $intervalo_dias = mysqli_real_escape_string($conexao,$_POST["intervalo_dias"]);
    $estoquePreferencia = mysqli_real_escape_string($conexao,$_POST["estoquePreferencia"]);

    $html .= "<h3 align='center'>Relatório de insumos prestes a expirar nos próximos $intervalo_dias dias<br></h3>";

    for ($i=0; $i < count($estoquesTipo); $i++) { 

        $sql= "SELECT 
                    d.id, 
                    d.qtd,
                    date_format(d.validade, '%d/%m/%Y') as validade,
                    i.nome,
                    i.unidade,
                    datediff(d.validade, curdate()) as diasvencimento,
                    es.nome as estoques_nome
                FROM 
                    ". $estoquesTipo[$i] ." d 
                INNER JOIN 
                    insumos i 
                ON
                    d.insumos_id = i.id
                INNER JOIN 
                    estoques es
                ON
                    es.id = d.estoque_id
                WHERE 
                    d.validade<='{$data_referencia}' + interval {$intervalo_dias} day ORDER BY i.nome ASC";
                    
        echo '<br>' . $sql;
        $result = $conexao->query($sql);
        if ($result->num_rows > 0){
            $dados_tmp = $result->fetch_assoc();

            var_dump($dados_tmp);
            array_push($arrValores, $dados_tmp);
        }
    }

    var_dump($arrValores);

} else {
    echo 'sem post';
    $html .= "<h3 align='center'>Relatorio de Insumos Prestes a Expirar nos Próximos 30 dias<br></h3>";

    $sql = "SELECT 
                d.id, 
                d.qtd,
                date_format(d.validade, '%d/%m/%Y') as validade,
                i.nome,
                i.unidade,
                datediff(d.validade, curdate()) as diasvencimento,
                es.nome as estoques_nome
            FROM ";

    if($estoquesPorGet != "all"){

        $sql .= "$estoquesPorGet d 
        inner join insumos i 
        on d.insumos_id = i.id
        inner join estoques es
        on es.id = d.estoque_id
        where d.validade<=curdate() + interval 30 day ORDER BY i.nome ASC";

    } else{
        $sql .= " $estoquePorGet d 
        inner join insumos i 
        on d.insumos_id = i.id
        inner join estoques es
        on es.id = d.estoque_id
        where d.validade<=curdate() + interval 30 day ORDER BY i.nome ASC";
    }
}

// echo $sql;
exit;

$res = $conexao->query($sql);
date_default_timezone_set('America/Sao_Paulo');
$agora = date('d/m/Y H:i');

if($res->num_rows > 0){
    $html .= "<table border=1 cellspacing=3>";
    $html .= "<thead><tr><th> ID </th><th> Insumo </th><th> Quantidade </th><th> Validade </th><th> Guardado em </th><th> Aviso de Vencimento </th></tr></thead>";
    $html .= "<tbody>";
    
    while($row = $res->fetch_object()){
        
        $html .= "<tr>";
        $html .= "<td>".$row->id."</td>";
        $html .= "<td>".$row->nome."</td>";
        $html .= "<td>".$row->qtd."</td>";
        $html .= "<td>".$row->validade."</td>";
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