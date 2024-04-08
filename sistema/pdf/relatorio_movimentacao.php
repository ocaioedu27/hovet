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
$html .= "<title>Relatório de Todas as Movimentações</title>";
$html .= "</head>";
$html .= "<body>";
$html .= "<div class='container'>";
$html .= "<img src='logo_hovet.jpg'>";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
// var_dump($dados);
$sql = "SELECT
            m.id,
            m.origem,
            m.destino,
            m.usuario_id_nome,
            date_format(m.data_operacao, '%d/%m/%Y %H:%i:%s') AS data_operacao,
            m.insumo_nome,
            m.usuario_id_nome,
            tm.movimentacao
        FROM 
            historico_movimentacoes m
        INNER JOIN 
            tipos_movimentacoes tm
        ON 
            m.tipos_movimentacoes_id = tm.id";
    
if (!empty($dados)) {
    // echo "tem post";
    $data_referencia = mysqli_real_escape_string($conexao,$_POST["data_referencia"]);
    $intervalo_dias = mysqli_real_escape_string($conexao,$_POST["intervalo_dias"]);
    $tipoMovimentacao = $_POST["tipo_movimentacao"];

    $str_filter = ""; 
    $movimentacoes_str = ""; 

    foreach ($tipoMovimentacao as $key => $value){
        $nome_mov = substr($value,3);
        $movimentacoes_str .= " e " . $nome_mov;

        $id_mov_tmp = strtok($value, " ");
        $filter_id_tmp = "tm.id=" . $id_mov_tmp;
        $str_filter .= " or " . $filter_id_tmp;
    }

    $str_filter = substr($str_filter, 4);
    $movimentacoes_str = substr($movimentacoes_str, 2);
    $dataFormatada = date("d/m/Y", strtotime($data_referencia));

    $html .= "<h3 align='center'>Relatório de movimentações referentes à data $dataFormatada somada a $intervalo_dias dias<br></h3>";

    $sql .= " WHERE m.data_operacao <= '{$data_referencia}' + interval {$intervalo_dias} day and ($str_filter)

        ORDER BY m.insumo_nome  
    ";

} else {
    $html .= "<h3 align='center'>Relatorio de todas as movimentações anteriores ou iguais à data atual<br></h3>";

    $sql .= " WHERE m.data_operacao <= curdate()

        ORDER BY m.insumo_nome  
    ";
}
// echo '<br><br>'.$sql.'<br><br>';
// exit;
    
try {
    $res = mysqli_query($conexao, $sql) or die("<br>//relatorio_movimentacao - Erro ao realizar a consulta: " . mysqli_error($conexao));
} catch (\Throwable $th) {
    echo $th;
}

date_default_timezone_set('America/Sao_Paulo');
$agora = date('d/m/Y H:i');

if($res->num_rows > 0){

    $html .= "<table border=1 cellspacing=3  >";
    $html .= "<thead><tr><th>ID</th><th>Nome do Insumo</th><th>Data da Ação</th><th>Tipo</th><th>Origem</th><th>Destino</th><th>Quem Realizou</th></tr></thead>";
    $html .= "<tbody>";
    
        while($row = $res->fetch_object()){
            
            $html .= "<tr>";
            $html .= "<td>".$row->id."</td>";
            $html .= "<td>".$row->insumo_nome."</td>";
            $html .= "<td>".$row->data_operacao."</td>";
            $html .= "<td>".$row->movimentacao."</td>";
            $html .= "<td>".$row->origem."</td>";
            $html .= "<td>".$row->destino."</td>";
            $html .= "<td>".$row->usuario_id_nome."</td>";
            $html .= "</tr>";
        }

    $html .= "</tbody>";
    $html .= "</table>";
    $html .= "</div>";
        

}else{
    $html .= "<h3 align='center'>Relatorio de Movimentaçoes<br></h3>";
    $html .="Nenhum Dado foi encontrado para este relatorio.";
}
$html .= "<p>Relatorio gerado em $agora</p>";
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

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'landscape');

//$dompdf->loadHtml('Olá Html');
$dompdf->render();

//Pegar a data atual e nome do arquivo
$data_atual = date('Y-m-d');
$file_name = "" . $data_atual . "-relatorio_movimentações.pdf";

header('Content-type: application/pdf');
    $dompdf->stream(
        $file_name,
        array(
            "Attachment"=>true
        )
    );

?>