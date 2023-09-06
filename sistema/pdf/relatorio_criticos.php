<?php
include("../../db/connect.php");

$html .= "<!DOCTYPE html>";
$html .= "<html lang='pt-BR'>";
$html .= "<head>"; 
$html .= "<meta charset='UTF-8'>";
$html .= "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
$html .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
$html .= "<link rel='stylesheet' href='http://localhost/hovet/sistema/pdf/css/custom.css'>";
$html .= "<title>Relatório de Insumos em Estoque Crítico</title>";
$html .= "</head>";
$html .= "<body>";
$html .= "<div class='container'>";
$html .= "<img src='logo_hovet.jpg'>";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$var_estoque_table = "deposito";
$var_estoque_id = "deposito_id";
$var_estoque_qtd = "deposito_qtd";
$var_estoque_validade = "deposito_validade";
$var_estoque_insumos_id = "deposito_insumos_id";
$var_estoque_id_estoque = "deposito_estoque_id";


if (!empty($dados)) {
    // echo "tem post";
    $tipo_de_estoque_tmp = mysqli_real_escape_string($conexao,$_POST["tipo_estoque"]);
    
    if (!strpos(strtolower($tipo_de_estoque_tmp), "selecione")){
        if (strpos(strtolower($tipo_de_estoque_tmp), "dispe")) {
            // echo "<br>é dispensario";
            $var_estoque_table = "dispensario";
            $var_estoque_id = "dispensario_id";
            $var_estoque_qtd = "dispensario_qtd";
            $var_estoque_validade = "dispensario_validade";
            $var_estoque_insumos_id = "dispensario_insumos_id";
            $var_estoque_id_estoque = "dispensario_estoques_id";
        }

    }else{
        echo "<script language='javascript'>window.alert('Atenção! Você não selecionou um estoque para se coletar os dados!'); </script>";
        echo "<script language='javascript'>window.location='/hovet/sistema/index.php?menuop=personalizar_relatorios&nome=estoque_criticos';</script>";
    }

    $id_tipo_de_estoque = strtok($tipo_de_estoque_tmp, " ");
    $tipo_de_estoque = substr($tipo_de_estoque_tmp, 4);
    $valor_qtd_critica = mysqli_real_escape_string($conexao,$_POST["valor_qtd_critica"]);

    $filter_id = ""; 
    $str_insumos_tipo = ""; 

    foreach ($dados['categoria_insumo'] as $key => $value){
        $categoria_insumo = substr($value,3);
        $str_insumos_tipo .= " e " . $categoria_insumo;

        $id_categoria_tmp = strtok($value, " ");
        $filter_id_tmp = "tp.tipos_insumos_id=" . $id_categoria_tmp;
        $filter_id .= " or " . $filter_id_tmp;
    }

    $filter_id = substr($filter_id, 4);
    $str_insumos_tipo = substr($str_insumos_tipo, 2);

    // echo "<br>ID do estoque: " . $tipo_de_estoque;
    // echo "<br>Valor da quantidade crítica: " . $valor_qtd_critica;
    // echo "<br>Filtro gerado: " . $filter_id;

    $html .= "<h3 align='center'>Relatório de insumos do $tipo_de_estoque com quantidade em estoque menor ou igual a $valor_qtd_critica<br></h3>";

    $sql= "SELECT 
                d.{$var_estoque_validade},
                d.{$var_estoque_qtd},
                d.{$var_estoque_id}, 
                i.insumos_descricao,
                i.insumos_nome,
                i.insumos_unidade,
                i.insumos_qtd_critica,
                date_format(d.{$var_estoque_validade}, '%d/%m/%Y') as validade,
                es.estoques_nome,
                tp.tipos_insumos_tipo
                
            FROM {$var_estoque_table} d 

            INNER JOIN insumos i
            ON d.{$var_estoque_insumos_id} = i.insumos_id
            INNER JOIN tipos_insumos tp
            ON tp.tipos_insumos_id = i.insumos_tipo_insumos_id
            INNER JOIN estoques es
            ON es.estoques_id = d.{$var_estoque_id_estoque}

            WHERE d.{$var_estoque_qtd} <= {$valor_qtd_critica} AND ({$filter_id}) AND es.estoques_id={$id_tipo_de_estoque}";

} else {
    $html .= "<h3 align='center'>Relatório de insumos em quantidade crítica nos Depósitos</h3>";

    $sql= "SELECT 
                d.{$var_estoque_validade},
                d.{$var_estoque_qtd},
                d.{$var_estoque_id}, 
                i.insumos_descricao,
                i.insumos_nome,
                i.insumos_unidade,
                i.insumos_qtd_critica,
                date_format(d.{$var_estoque_validade}, '%d/%m/%Y') as validade,
                es.estoques_nome,
                tp.tipos_insumos_tipo
                
            FROM deposito d 
            
            INNER JOIN insumos i
            ON d.deposito_insumos_id = i.insumos_id
            INNER JOIN tipos_insumos tp
            ON tp.tipos_insumos_id = i.insumos_tipo_insumos_id
            INNER JOIN estoques es
            ON es.estoques_id = d.deposito_estoque_id
    
            WHERE d.deposito_qtd <= i.insumos_qtd_critica";
}
// echo "<br>sql_gerado<br><br>" . $sql;
// $res = $conexao->query($sql);
$res = mysqli_query($conexao, $sql) or die("<br>//relatorio_criticos - Erro ao realizar a consulta: " . mysqli_error($conexao));

date_default_timezone_set('America/Sao_Paulo');
$agora = date('d/m/Y H:i');

if($res->num_rows > 0){

    $html .= "<table border=1 cellspacing=3>";
    $html .= "<thead><tr><th> ID </th><th> Insumo </th><th> Categoria </th><th> Quantidade Em Estoque </th><th> Quantidade Crítica do Insumo </th><th> Validade </th><th> Guardado em </th><th> Descrição </th></tr></thead>";
    $html .= "<tbody>";
    
    while($row = $res->fetch_object()){
        
        $html .= "<tr>";
        $html .= "<td>".$row->$var_estoque_id."</td>";
        $html .= "<td>".$row->insumos_nome."</td>";
        $html .= "<td>".$row->tipos_insumos_tipo."</td>";
        $html .= "<td>".$row->$var_estoque_qtd."</td>";
        $html .= "<td>".$row->insumos_qtd_critica."</td>";
        $html .= "<td>".$row->validade."</td>";
        $html .= "<td>".$row->estoques_nome."</td>";
        $html .= "<td>".$row->insumos_descricao."</td>"; 

        $html .= "</tr>";
    }
    $html .= "</tbody>";
    $html .= "</table>";
    $html .= "</div>";

}else{
    $html .= "<h3 align='center'>Nenhum dado foi encontrado para este relatorio.<br></h3>";
}

$html .= "<p>Relatorio gerado em $agora<p>";
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

//fazendo o load
$dompdf->loadHtml($html);

//configurando o papel
$dompdf->setPaper('A4', 'landscape');

//$dompdf->loadHtml('Olá Html');

$dompdf->render();

//Pegar a data atual e nome do arquivo
$data_atual = date('Y-m-d');
$file_name = "" . $data_atual . "-relatorio_insumo_critico.pdf";

header('Content-type: application/pdf');
    $dompdf->stream(
        $file_name,
        array(
            "Attachment"=>true
        )
    );

?>