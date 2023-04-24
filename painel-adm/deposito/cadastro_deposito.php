<?php

    if (isset($_FILES['nota_fiscal_deposito'])) {
        $nota_fiscal_deposito = $_FILES['nota_fiscal_deposito'];

        var_dump($nota_fiscal_deposito);

        echo "<br/>pegou a nota fiscal";

        if ($nota_fiscal_deposito['error']) {
            die("Falha ao enviar nota fiscal");
        }

        echo "<br/>passou da verificacao de erro";


        if ($nota_fiscal_deposito['size'] > 2097152) {
            die("Arquivo muito grande!! Max: 2MB.");
        }

        echo "<br/>passou da verificacao de tamanho";

        $pasta_notas_fiscais_deposito = "notas_fiscais/";

        echo "<br/>achou a pasta: $pasta_notas_fiscais_deposito";

        $nome_nota_fiscal_deposito = $nota_fiscal_deposito['name'];

        echo "<br/>Achou o nome: $nome_nota_fiscal_deposito";

        $novo_nome_nota_fiscal_deposito = uniqid();
        
        echo "<br/>gerou o novo nome: $novo_nome_nota_fiscal_deposito";

        $extensao_nota_fiscal = strtolower(pathinfo($nome_nota_fiscal_deposito, PATHINFO_EXTENSION));
        
        echo "<br/>coletou a extensao: $extensao_nota_fiscal";

        if ($extensao_nota_fiscal != "jpg" && $extensao_nota_fiscal != "png") {
            die("Tipo de arquivo não aceito");
        }

        echo "<br/>Passou da verificacao de extensao";

        try{
            $upload_feito = move_uploaded_file($nota_fiscal_deposito['tmp_name'], $pasta_notas_fiscais_deposito . $novo_nome_nota_fiscal_deposito . "." . $extensao_nota_fiscal);
            
            echo "<br/>fez o upload";

        
        } catch (Exception $e){
            echo '//realiza_upload - Exceção capturada: ',  $e->getMessage(), "\n";
        }


        // if ($upload_feito) { 
        //     echo "<script language='javascript'>window.alert('Nota fiscal enviada com sucesso!!'); </script>";
        // } else {
        //     echo "<script language='javascript'>window.alert('Nota fiscal não foi salva!!'); </script>";
        // }
    }

?>


<div class="container cadastro_all">
    <div class="cards cadastro_deposito">
        <div class="voltar">
            <h4>Inserindo no Depósito</h4>
            <a href="index.php?menuop=deposito" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <!-- <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=inserir_deposito" method="post"> -->
        <form class="form_cadastro" enctype="multipart/form-data" action="" method="post">
            <div class="form-group">
                <label for="insumoID_Insumodeposito">Nome</label>
                <select class="form-control-sm" name="insumoID_Insumodeposito" required>
                    <?php
                    
                    $sql = "SELECT insumos_id, insumos_nome FROM insumos";
                    $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                    
                    while($dados = mysqli_fetch_assoc($result)){
                    ?>
					<option><?=$dados["insumos_id"]?> - <?=$dados["insumos_nome"]?></option>

                    <?php
                        }
                    ?>
				</select>
            </div>
            <div class="form-group">
                <label for="tipo_insercao_deposito">Operação</label>
                <select class="form-control-sm" name="tipo_insercao_deposito" required>
                    <?php
                    
                    $sql = "SELECT * FROM tipos_movimentacoes";
                    $result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                    
                    while($dados = mysqli_fetch_assoc($result)){
                    ?>
					<option><?=$dados["tipos_movimentacoes_id"]?> - <?=$dados["tipos_movimentacoes_movimentacao"]?></option>

                    <?php
                        }
                    ?>
				</select>
            </div>

            <div class="form-group">
                <label for="nota_fiscal_deposito">Nota fiscal</label>
                <input type="file" class="form-control" name="nota_fiscal_deposito" required>
            </div>

            <div class="form-group">
                <label for="quantidadeInsumodeposito">Quantidade</label>
                <input type="text" class="form-control" name="quantidadeInsumodeposito" required>
            </div>

            <div class="form-group">
                <label for="validadeInsumoDeposito">Validade</label>
                <input type="date" class="form-control" name="validadeInsumodeposito" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarInsumoDeposito" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>