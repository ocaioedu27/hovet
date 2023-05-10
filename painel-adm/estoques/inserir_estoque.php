<header>
    <h2>Inserir Insumo</h2>
</header>
<?php 

    $dados_enviados_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if (!empty($dados_enviados_array['btnAdicionarEstoque'])) {

        foreach ($dados_enviados_array['nomeNovoEstoque'] as $chave_cad_estoque => $valor_cad_estoque) {
            $nomeNovoEstoque = $valor_cad_estoque;
            $tipoNovoEstoque = $dados_enviados_array['tipoNovoEstoque'][$chave_cad_estoque];
            $descricaoNovoEstoque = $dados_enviados_array['descricaoNovoEstoque'][$chave_cad_estoque];

            echo "<br> Chave para o estoque: " . $chave_cad_estoque;
            echo "<br> Nome do novo estoque: " . $nomeNovoEstoque;
            echo "<br> Tipo: " . $tipoNovoEstoque;
            echo "<br> Descrição: " . $descricaoNovoEstoque;
            // $sql = "INSERT INTO insumos (
            //     insumos_nome,
            //     insumos_unidade,
            //     insumos_descricao,
            //     insumos_qtd_critica,
            //     insumos_tipo_insumos_id)
            //     VALUES(
            //         '{$nomeInsumo}',
            //         '{$unidadeInsumo}',
            //         '{$descricaoInsumo}',
            //         {$qtdCriticaInsumo},
            //         {$tipoInsumo}
            //     )";

            // if(mysqli_query($conexao, $sql)){
            //     echo "<script language='javascript'>window.alert('Insumo cadastrado com sucesso!'); </script>";
            //     echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=insumos';</script>";

            // } else{
            //     die("//cadastro de insumos - Erro ao cadastrar insumo: " . mysqli_error($conexao));
            // }

        }

    } else {
        echo '//Insumos/CadInsumos - nenhum formulário enviado';
    }

?>