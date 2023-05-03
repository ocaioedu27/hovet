<header>
    <h2>Inserir Insumo</h2>
</header>
<?php 

    $dados_enviados_array = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if (!empty($dados_enviados_array['btnAdicionarInsumo'])) {

        foreach ($dados_enviados_array['nomeInsumo'] as $chave_cad_insumos => $valor_cad_insumos) {
            $nomeInsumo = $valor_cad_insumos;
            $unidadeInsumo = $dados_enviados_array['unidadeInsumo'][$chave_cad_insumos];
            $descricaoInsumo = $dados_enviados_array['descricaoInsumo'][$chave_cad_insumos];
            $qtdCriticaInsumo = $dados_enviados_array['qtdCriticaInsumo'][$chave_cad_insumos];
            $tipoInsumo = $dados_enviados_array['tipoInsumo'][$chave_cad_insumos];
            $tipoInsumo = strtok($tipoInsumo, " ");

            $sql = "INSERT INTO insumos (
                insumos_nome,
                insumos_unidade,
                insumos_descricao,
                insumos_qtd_critica,
                insumos_tipo_insumos_id)
                VALUES(
                    '{$nomeInsumo}',
                    '{$unidadeInsumo}',
                    '{$descricaoInsumo}',
                    {$qtdCriticaInsumo},
                    {$tipoInsumo}
                )";

            if(mysqli_query($conexao, $sql)){
                echo "<script language='javascript'>window.alert('Insumo cadastrado com sucesso!'); </script>";
                echo "<script language='javascript'>window.location='/hovet/painel-adm/index.php?menuop=insumos';</script>";

            } else{
                die("//cadastro de insumos - Erro ao cadastrar insumo: " . mysqli_error($conexao));
            }

        }

    } else {
        echo '//Insumos/CadInsumos - nenhum formulário enviado';
    }

?>