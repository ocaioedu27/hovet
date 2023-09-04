
<?php
//include("../../db/config.php");
include("../../db/connect.php");

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
    $html .= "<title>Relatorio de Insumos Prestes a Expirar nos Próximos 30 dias</title>";
    $html .= " </head>";
    $html .= "<body>";
    $html .= "<img src='logo_hovet.jpg' >";
    $html .= "";
    $html .= "";
    $html .= "";
    $html .= "</body>";


    $html .= "<br><br><br>";
    $html .= "<h3 align='center'>Relatorio de Insumos Prestes a Expirar nos Próximos 30 dias<br></h3>";
    $html .= "<table border=1 cellspacing=3  >";
            $html .= "<thead>
            <tr>
                <th> ID </th>
                <th> Insumo </th>
                <th> Quantidade </th>
                <th> Validade </th>
                <th> Guardado em </th>
                <th> Aviso de Vencimento </th>
                
            </tr>
        </thead>";
    
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
        $html = "<DOCTYPE html>";
        $html .= "<html lang='pt-BR'>";
        $html .= "<head>"; 
        $html .= "<meta charset='UTF-8'>";
        $html .= "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
        $html .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        $html .= "<link rel='stylesheet' href='http://localhost/hovet/sistema/pdf/css/custom.css'";
        $html .= "<title>Relatorio de Insumos Prestes a Expirar nos Próximos 30 dias</title>";
        $html .= " </head>";
        $html .= "<body>";
        $html .= "<img src='logo_hovet.jpg' >";
        $html .= "";
        $html .= "";
        $html .= "";
        $html .= "</body>";


        $html .= "<br><br><br>";
        $html .= "<h3 align='center'>Relatorio de Insumos Prestes a Expirar nos Próximos 30 dias<br></h3>";
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
    
    $dompdf->render();

    //Pegar a data atual e nome do arquivo
    $data_atual = date('Y-m-d');
    $file_name = "" . $data_atual . "-relatorio_insumo_expirar.pdf";
    
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
    


