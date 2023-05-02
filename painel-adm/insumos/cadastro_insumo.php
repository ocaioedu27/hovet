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

            <div class="form-group valida_movimentacao">

                <div class="display-flex-cl">
                    <label for="nomeInsumo">Nome</label>
                    <input type="text" class="form-control" name="nomeInsumo" required>
                </div>

                <div class="display-flex-cl">
                    <label for="qtdCriticaInsumo">Quantidade Crítica</label>
                    <input type="number" class="form-control" name="qtdCriticaInsumo" required>
                </div>

            </div>

            <div class="form-group valida_movimentacao">
                
                <div class="display-flex-cl">    
                    <label for="unidadeInsumo">Unidade</label>
                    <select class="form-control-sm" name="unidadeInsumo" required>
                        <option>Caixa</option>
                        <option>Pacote</option>
                    </select>
                </div>

                <div class="display-flex-cl">
                    <label for="tipoInsumo">Tipo de Insumo</label>
                    <select class="form-control-sm" name="tipoInsumo" required>
                        <?php
                        
                        $sql_allTipos = "SELECT * FROM tipos_insumos ";
                        $result_allTipos = mysqli_query($conexao,$sql_allTipos) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
                        
                        while($tipoInsumo = mysqli_fetch_assoc($result_allTipos)){
                        ?>
                            <option><?=$tipoInsumo["tipos_insumos_id"]?> - <?=$tipoInsumo["tipos_insumos_tipo"]?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>

            </div>
            <div class="form-group valida_movimentacao">

                <div class="display-flex-cl">
                    <label for="descricaoInsumo">Descrição</label>
                    <textarea class="form-control" name="descricaoInsumo" rows="4" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="Cadastrar" name="btnAdicionarInsumo" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>