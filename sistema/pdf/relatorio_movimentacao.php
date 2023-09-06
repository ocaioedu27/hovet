<?php
include("../../db/connect.php");

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
$sql = "";
    
if (!empty($dados)) {
    // echo "tem post";
    $data_referencia = mysqli_real_escape_string($conexao,$_POST["data_referencia"]);
    $intervalo_dias = mysqli_real_escape_string($conexao,$_POST["intervalo_dias"]);

    $str_filter = ""; 
    $movimentacoes_str = ""; 

    foreach ($dados['tipo_movimentacao'] as $key => $value){
        $nome_mov = substr($value,3);
        $movimentacoes_str .= " e " . $nome_mov;

        $id_mov_tmp = strtok($value, " ");
        $filter_id_tmp = "tm.tipos_movimentacoes_id=" . $id_mov_tmp;
        $str_filter .= " or " . $filter_id_tmp;
    }

    $str_filter = substr($str_filter, 4);
    $movimentacoes_str = substr($movimentacoes_str, 2);
    $html .= "<h3 align='center'>Relatório da(s) movimentação(ões) $movimentacoes_str anterior(es) à data atual somada a $intervalo_dias dias<br></h3>";

    $sql= "SELECT
            i.insumos_nome,
            i.insumos_descricao,
            m.movimentacoes_id,
            m.movimentacoes_origem,
            m.movimentacoes_destino,
            tm.tipos_movimentacoes_movimentacao,
            m.movimentacoes_usuario_id,
            date_format(m.movimentacoes_data_operacao, '%d/%m/%Y %H:%i:%s') AS movimentacoes_data_operacao,
            u.usuario_nome_completo
        
        FROM movimentacoes m
        
        INNER JOIN insumos i
        ON m.movimentacoes_insumos_id = i.insumos_id
        INNER JOIN usuarios u
        ON u.usuario_id = m.movimentacoes_usuario_id
        INNER JOIN tipos_movimentacoes tm
        ON m.movimentacoes_tipos_movimentacoes_id = tm.tipos_movimentacoes_id
        
        WHERE m.movimentacoes_data_operacao <= '{$data_referencia}' + interval {$intervalo_dias} day and ($str_filter)

        ORDER BY insumos_nome  
    ";

} else {
    $html .= "<h3 align='center'>Relatorio de todas as movimentações anteriores à data atual<br></h3>";

    $sql= "SELECT
            i.insumos_nome,
            i.insumos_descricao,
            m.movimentacoes_id,
            m.movimentacoes_origem,
            m.movimentacoes_destino,
            tm.tipos_movimentacoes_movimentacao,
            m.movimentacoes_usuario_id,
            date_format(m.movimentacoes_data_operacao, '%d/%m/%Y %H:%i:%s') AS movimentacoes_data_operacao,
            u.usuario_nome_completo
        
        FROM movimentacoes m
        
        INNER JOIN insumos i
        ON m.movimentacoes_insumos_id = i.insumos_id
        INNER JOIN usuarios u
        ON u.usuario_id = m.movimentacoes_usuario_id
        INNER JOIN tipos_movimentacoes tm
        ON m.movimentacoes_tipos_movimentacoes_id = tm.tipos_movimentacoes_id
        
        WHERE m.movimentacoes_data_operacao <= curdate()

        ORDER BY insumos_nome  
    ";
}
    
$res = mysqli_query($conexao, $sql) or die("<br>//relatorio_movimentacao - Erro ao realizar a consulta: " . mysqli_error($conexao));

date_default_timezone_set('America/Sao_Paulo');
$agora = date('d/m/Y H:i');

if($res->num_rows > 0){

    $html .= "<table border=1 cellspacing=3  >";
    $html .= "<thead><tr><th>ID</th><th>Nome do Insumo</th><th>Data da Ação</th><th>Tipo</th><th>Origem</th><th>Destino</th><th>Quem Realizou</th></tr></thead>";
    $html .= "<tbody>";
    
        while($row = $res->fetch_object()){
            
            $html .= "<tr>";
            $html .= "<td>".$row->movimentacoes_id."</td>";
            $html .= "<td>".$row->insumos_nome."</td>";
            $html .= "<td>".$row->movimentacoes_data_operacao."</td>";
            $html .= "<td>".$row->tipos_movimentacoes_movimentacao."</td>";
            $html .= "<td>".$row->movimentacoes_origem."</td>";
            $html .= "<td>".$row->movimentacoes_destino."</td>";
            $html .= "<td>".$row->usuario_nome_completo."</td>";
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