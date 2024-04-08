<?php
include("../../db/connect.php");
include_once("../../pgs_modelo/funcoes.php");

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
$estoquesTipo = ['deposito', 'dispensario'];
$estoquesPorGet = $_GET['op'] ? $_GET['op'] : 'all';
$arrValores = [];

if (!empty($dados)) {
    // echo "tem post";
    $valor_qtd_critica = mysqli_real_escape_string($conexao,$_POST["valor_qtd_critica"]);
    $html .= "<h3 align='center'>Relatório de insumos de estoques que estão com quantidade em estoque menor ou igual a $valor_qtd_critica<br></h3>";

    $estoquePreferencia = mysqli_real_escape_string($conexao,$_POST["tipo_estoque"]);
    
    $categoria_id = ""; 
    $str_insumos_tipo = ""; 

    foreach ($dados['categoria_insumo'] as $key => $value){
        $categoria_insumo = substr($value,3);
        $str_insumos_tipo .= " e " . $categoria_insumo;

        $id_categoria_tmp = strtok($value, " ");
        $categoria_id_tmp = "tp.id=" . $id_categoria_tmp;
        $categoria_id .= " or " . $categoria_id_tmp;
    }

    $categoria_id = substr($categoria_id, 4);
    $str_insumos_tipo = substr($str_insumos_tipo, 2);

    $where = $categoria_id;
    
    if($estoquePreferencia != 'all'){

        $arrTmp = getCriticosEstoques($conexao, $estoquePreferencia, $where);
        
        $arrValores = $arrTmp;

    }else{
        
        for ($i=0; $i < count($estoquesTipo); $i++) { 

            $arrTmp = getCriticosEstoques($conexao, $estoquesTipo[$i], $where);
            for ($j=0; $j < count($arrTmp); $j++) { 
                array_push($arrValores, $arrTmp[$j]);                
            }
        }
    }

    // var_dump($arrValores);

} else {
    $html .= "<h3 align='center'>Relatório de insumos em quantidade crítica dos estoques</h3>";

    $where = "";

    $data_referencia = date('Y-m-d');

    if($estoquesPorGet != 'all'){

        $arrTmp = getCriticosEstoques($conexao, $estoquesPorGet, $where);
        
        $arrValores = $arrTmp;

    }else{
        
        for ($i=0; $i < count($estoquesTipo); $i++) { 

            $arrTmp = getCriticosEstoques($conexao, $estoquesTipo[$i], $where);
            for ($j=0; $j < count($arrTmp); $j++) { 
                array_push($arrValores, $arrTmp[$j]);                
            }
        }
    }
}

date_default_timezone_set('America/Sao_Paulo');
$agora = date('d/m/Y H:i');

if(count($arrValores) > 0){

    $html .= "<table border=1 cellspacing=3>";
    $html .= "<thead><tr><th> Insumo </th><th> Categoria </th><th> Quantidade Em Estoque </th><th> Quantidade Crítica do Insumo </th><th> Local </th><th> Descrição </th></tr></thead>";
    $html .= "<tbody>";
    $resultado = "";
    
    for ($h=0; $h < count($arrValores); $h++) { 
        // echo '<br><br>'. ($h+1) .'a execução.';
        $id = $arrValores[$h]['id'];
        $nome = $arrValores[$h]['nome'];
        $estoque_id = $arrValores[$h]['estoque_id'];
        $tipo_insumo = $arrValores[$h]['tipo'];
        $estoqueNome = $arrValores[$h]['estoqueNome'];
        $descricao = $arrValores[$h]['descricao'];
        $qtd_critica = $arrValores[$h]['qtd_critica'];

        $estoqueNomeReal_tmp = $arrValores[$h]['estoqueNomeReal'];
        $estoqueNomeReal = substr($estoqueNomeReal_tmp, 0, -1);

        $where = $estoqueNomeReal.'.insumos_id = "'.$id.'" and estoques.nome_real = "'.$estoqueNomeReal_tmp.'"';

        // $resInsumos = selectDados($conexao, $estoqueNomeReal, "sum(qtd) as qtd_insumos", "");
        $resInsumos = selectInnnerJoin($conexao, ['sum(qtd) as qtdTotalEmEstoque'] ,$estoqueNomeReal, ['estoque_id'],['estoques'],['id'], $where);

        // var_dump($resInsumos);
        $qtdTotalEmEstoque = $resInsumos[0]['qtdTotalEmEstoque'];
        // echo $qtdTotalEmEstoque;

        if($qtdTotalEmEstoque <= $qtd_critica){
            $resultado .= "<tr>";
            $resultado .= "<td>".$nome."</td>";
            $resultado .= "<td>".$tipo_insumo."</td>";
            $resultado .= "<td>".$qtdTotalEmEstoque."</td>";
            $resultado .= "<td>".$qtd_critica."</td>";
            $resultado .= "<td>".$estoqueNome."</td>";
            $resultado .= "<td>".$descricao."</td>"; 
            $resultado .= "</tr>";
        }

    }
    // echo strlen($resultado);

    if(strlen($resultado) == 0){
        $resultado = '
        <tr class="">
            <td colspan="6" class="text-center">Nenhum registro para exibir!</td>
        </tr>';
    }

    $html .= $resultado;
    
    $html .= "</tbody>";
    $html .= "</table>";

}else{
    $html .= "<h3 align='center'>Nenhum dado foi encontrado para este relatorio.<br></h3>";
}

$html .= "<p>Relatorio gerado em $agora<p>";
$html .= "</div>";
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