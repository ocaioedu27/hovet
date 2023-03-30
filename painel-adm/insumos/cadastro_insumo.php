<div class="container cadastro_all">
    <div class="cards cadastro_insumo">
        <div class="voltar">
            <h4>Cadastro de Insumo</h4>
            <a href="index.php?menuop=insumos" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" action="index.php?menuop=inserir_insumo" method="post">
            <div class="form-group">
                <label for="nomeInsumo">Nome</label>
                <input type="text" class="form-control" name="nomeInsumo" required>
            </div>
            <div class="form-group">
                <label for="unidadeInsumo">Unidade</label>
                <select class="form-control-sm" name="unidadeInsumo" required>
					<option>Caixa</option>
					<option>Pacote</option>
				</select>
            </div>
            <div class="form-group">
                <label for="tipoInsumo">Tipo de Insumo</label>
                <select class="form-control-sm" name="tipoInsumo" required>
                    <?php
                    
                    $sql_allTipos = "SELECT * FROM tipos_insumos ";
                    $result_allTipos = mysqli_query($conexao,$sql_allTipos) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                    
                    while($tipoInsumo = mysqli_fetch_assoc($result_allTipos)){
                    ?>
					    <option><?=$tipoInsumo["id"]?> - <?=$tipoInsumo["tipo"]?></option>
                    <?php
                        }
                    ?>
				</select>
            </div>
            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarInsumo" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>