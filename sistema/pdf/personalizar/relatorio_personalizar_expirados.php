<?php

$dir = __DIR__;
echo "Diretório antes: " . $dir;
$dir = substr($dir, 0,-12);
echo "<br>Diretório depois: " . $dir;

?>

<div class="container cadastro_all">
    <div class="cards cadastro_insumo">
        <div class="voltar">
            <h4>Personalização</h4>
            <a href="index.php?menuop=listar_relatorios" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" enctype="multipart/form-data" action="index.php?menuop=relatorio_expirados" method="post">

            <div id="dados_insumos_cad">
                <hr>
                <div>
                    <div class="form-group valida_movimentacao">
                        <div class="display-flex-cl">
                            <label>Data de referência</label>
                            <input type="date" class="form-control" name="data_referencia[]" required>
                        </div>
                    </div>

                    <div class="form-group valida_movimentacao">
                        <div class="display-flex-cl">
                            <label>Intervalo de dias</label>
                            <input type="number" class="form-control" name="intervalo_dias[]" required>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group valida_movimentacao">
                <label for="valida_dados_insercao_insumos">Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="valida_dados_insercao_insumos" required>
            </div>

            
            <div class="form-group" id="confirmaDownload">
                <input type="submit" value="Gerar" name="btn_gerar" class="btn btn_cadastrar">
            </div>
        </form>
    </div>
</div>