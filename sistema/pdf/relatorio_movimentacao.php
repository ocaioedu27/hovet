
<?php
//include("../../db/config.php");
include("../../db/connect.php");

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
on m.movimentacoes_insumos_id = i.insumos_id
INNER JOIN usuarios u
ON u.usuario_id = m.movimentacoes_usuario_id
INNER JOIN tipos_movimentacoes tm
ON m.movimentacoes_tipos_movimentacoes_id = tm.tipos_movimentacoes_id

    ORDER BY insumos_nome  
";
    
$res = $conexao->query($sql);
date_default_timezone_set('America/Sao_Paulo');
    $agora = date('d/m/Y H:i');

    if($res->num_rows > 0){
        $html = "<DOCTYPE html>";
        $html .= "<html lang='pt-BR'>";
        $html .= "<head>"; 
        $html .= "<meta charset='UTF-8'>";
        $html .= "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
        $html .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        $html .= "<link rel='stylesheet' href='http://localhost/hovet/sistema/pdf/css/custom.css'";
        $html .= "<title>Relatorio de Movimentações</title>";
        $html .= " </head>";
        $html .= "<body>";
        $html .= "<img src='logo_hovet.jpg' >";
        $html .= "";
        $html .= "";
        $html .= "";
        $html .= "</body>";


        $html .= "<br><br><br>";
        $html .= "<h3 align='center'>Relatorio de Movimentações <br></h3>";
        $html .= "<table border=1 cellspacing=3  >";
                $html .= "<thead>
                <tr>
                        <th>ID</th>
                        <th>Nome do Insumo</th>
                        <th>Data da Ação</th>
                        <th>Tipo</th>
                        <th>Origem</th>
                        <th>Destino</th>
                        <th>Quem Realizou</th>
                    
                </tr>
            </thead>";
        
            while($row = $res->fetch_object()){
                
                $html .= "<tr>";
                $html .= "<td>".$row->movimentacoes_id."</td>";
                $html .= "<td>".$row->insumos_nome."</td>";
                $html .= "<td>".$row->movimentacoes_data_operacao."</td>";
                $html .= "<td>".$row->tipos_movimentacoes_movimentacao."</td>";
                $html .= "<td>".$row->movimentacoes_origem."</td>";
                $html .= "<td>".$row->movimentacoes_destino."</td>";
                $html .= "<td>".$row->usuario_nome_completo."</td>";
                // $html .= "<td>".$row->deposito_insumos_id."</td>";
                    
                /* $html .="<td>".
                    
                    $dias = 30;
                    if($row["diasvencimento"] <= $dias){                                    
                        echo $row["diasvencimento"] . " dia(s) para o vencimento. INSUMENCIDO";

                    } else {                                    
                        echo $row["diasvencimento"] . " dia(s) para o vencimento nao vencido";

                    }
                    
            "</td>"; */



                $html .= "</tr>";
            }
            $html .= "</table>";
            

    }else{
        $html = "<DOCTYPE html>";
        $html .= "<html lang='pt-BR'>";
        $html .= "<head>"; 
        $html .= "<meta charset='UTF-8'>";
        $html .= "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
        $html .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        $html .= "<link rel='stylesheet' href='http://localhost/hovet/sistema/pdf/css/custom.css'";
        $html .= "<title>Relatorio de Movimentações</title>";
        $html .= " </head>";
        $html .= "<body>";
        $html .= "<img src='logo_hovet.jpg' >";
        $html .= "";
        $html .= "";
        $html .= "";
        $html .= "</body>";


        $html .= "<br><br><br>";
        $html .= "<h3 align='center'>Relatorio de Movimentaçoes<br></h3>";
        $html .="Nenhum Dado foi encontrado para este relatorio.";
    }

    $html .= "<br><br>";
    $html .= "Relatorio gerado em $agora";
    
 require __DIR__.'/vendor/autoload.php';  
    
    use Dompdf\Dompdf;
    use Dompdf\Options;
    
    //instanciar Options
    $options = new Options();
    $options->setChroot(__DIR__);
    
    $options->setIsRemoteEnabled(true);
    
    
    //instanciar Dompdf
    
    $dompdf = new Dompdf($options);
    
    
    $dompdf->load_Html($html);
    
    //$dompdf->loadHtml('Olá Html');
    //Pegar a data atual e nome do arquivo
    
    $dompdf->render();
    
    $data_atual = date('Y-m-d');
    $file_name = "" . $data_atual . "-relatorio_movimentações.pdf";
    
    header('Content-type: application/pdf');
    $dompdf->stream(
        $file_name,
        array(
            "Attachment"=>true
        )
    );
    echo $dompdf->output();
    
    echo $_SERVER['PHP_SELF'] . "<br />";
    
    
    ?>
    


