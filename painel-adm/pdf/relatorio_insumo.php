
<?php

    include("../../db/connect.php");


    $sql= "SELECT 
                d.deposito_id, 
                i.insumos_nome,
                d.deposito_qtd,
                i.insumos_descricao,
                i.insumos_unidade,
                i.insumos_qtd_critica,
                date_format(d.deposito_validade, '%d/%m/%Y') as deposito_validade,
                es.estoques_nome
                            
            FROM deposito d 
            inner join insumos i
            on d.deposito_insumos_id = i.insumos_id
            inner join estoques es
            on es.estoques_id = d.deposito_estoque_id
            where d.deposito_qtd <= i.insumos_qtd_critica";
    $res = $conexao->query($sql);
    date_default_timezone_set('America/Sao_Paulo');
    $agora = date('d/m/Y H:i');

    // $qualEstoque = "";
    

    if($res->num_rows > 0){
        $html = "<DOCTYPE html>";
        $html .= "<html lang='pt-BR'>";
        $html .= "<head>"; 
        $html .= "<meta charset='UTF-8'>";
        $html .= "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
        $html .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        $html .= "<link rel='stylesheet' href='http://localhost/hovet/painel-adm/pdf/css/custom.css'";
        $html .= "<title>Relatorio de Insumos Hovet</title>";
        $html .= " </head>";
        $html .= "<body>";
        $html .= "<img src='logo_hovet.jpg' >";
        $html .= "";
        $html .= "";
        $html .= "";
        $html .= "</body>";
        
        
        $html .= "<br><br><br>";
        $html .= "<h3 align='center'>Relatorio de Insumos Com Estoque Crítico no(s) Depósito(s)<br></h3>";
        $html .= "<table border=1 cellspacing=1 >";
                $html .= "<thead>
                <tr>
                    <th> ID </th>
                    <th> Insumo </th>
                    <th> Quantidade Em Estoque </th>
                    <th> Quantidade Crítica do Insumo </th>
                    <th> Validade </th>
                    <th> Guardado em </th>
                    <th> Descrição </th>
                    
                </tr>
            </thead>";
        
            while($row = $res->fetch_object()){
                
                $html .= "<tr>";
                $html .= "<td>".$row->deposito_id."</td>";
                $html .= "<td>".$row->insumos_nome."</td>";
                $html .= "<td>".$row->deposito_qtd."</td>";
                $html .= "<td>".$row->insumos_qtd_critica."</td>";
                $html .= "<td>".$row->deposito_validade."</td>";
                $html .= "<td>".$row->estoques_nome."</td>";
                $html .= "<td>".$row->insumos_descricao."</td>"; 

                $html .= "</tr>";
            }
            $qualEstoque = $row->estoques_nome;
            $html .= "</table>";
            $html .= "<br><br>";

        }else{
            $html = "<DOCTYPE html>";
            $html .= "<html lang='pt-BR'>";
            $html .= "<head>"; 
            $html .= "<meta charset='UTF-8'>";
            $html .= "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
            $html .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            $html .= "<link rel='stylesheet' href='http://localhost/hovet/painel-adm/pdf/css/custom.css'";
            $html .= "<title>Relatorio de Insumos Críticos</title>";
            $html .= " </head>";
            $html .= "<body>";
            $html .= "<img src='logo_hovet.jpg' >";
            $html .= "";
            $html .= "";
            $html .= "";
            $html .= "</body>";


            $html .= "<br><br><br>";
            $html .= "<h3 align='center'>Relatorio de Insumos Com Estoque Crítico no(s) Depósito(s)<br></h3>";
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
    
    header('Content-type: application/pdf');
    $dompdf->stream(
        "relatorio_insumo_critico.pdf",
        array(
            "Attachment"=>true
        )
    );
    echo $dompdf->output();
    
    echo $_SERVER['PHP_SELF'] . "<br />";
    
    
    ?>
    


