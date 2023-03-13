<div class="cards_wrapper">
    <div class="group_cards">
        <div class="cards">
            <div class="insumosDeposito">
                <div class="top_card">
                    <h2>Depósito</h2>
                </div>
                <h4>Insumos
                    <span class="icon">
                        <ion-icon name="file-tray-full-outline"></ion-icon>
                    </span>
                </h4>
                <?php
                    $sql = "SELECT COUNT(*) as qtd FROM deposito";
                    $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                    while($dados = mysqli_fetch_assoc($rs)){
                ?>
                <h2><?=$dados['qtd']?></h2>
                <?php
                    }
                ?>
                <p>Total de insumos</p>
            </div>
            <div class="vencimentoProx">
                    <h4>Vencimento
                        <span class="icon">
                            <ion-icon name="alert-circle-outline" style="color: red;"></ion-icon>
                        </span>
                    </h4>
                    <h2>2</h2>
                    <p>Próximos ou Vencidos</p>
            </div>
        </div>
        <div class="cards">
            <div class="top_card">
                <h2>Movimentacoes</h2>
            </div>
            <div class="movimentacoes">
                <div>
                    <h4>Inserções</h5>
                    <h5>7</h5>
                </div>
                <div>
                    <h4>Retiradas</h4>
                    <h5>2</h5>
                </div>
                <div>
                    <h4>Doações</h4>
                    <h5>3</h5>
                </div>
                <div>
                    <h4>Permutas</h4>
                    <h5>4</h5>
                </div>
            </div>
        </div>
        <div class="cards">
            <div class="top_card">
                <h2>Relatórios</h2>
            </div>
            <div class="relatorios">
                <div class="relatorioInserts">
                    <a href="#">Visualizar Relatório de Cadastro de Insumos</a>
                </div>
                <div class="relatorioRetiradas">
                    <a href="#">Visualizar Relatório de Retirada de Insumos</a>
                </div>
                <div class="relatorioDoacoes">
                    <a href="#">Visualizar Relatório de Doações de Insumos</a>
                </div>
                <div class="relatorioPermutas">
                    <a href="#">Visualizar Relatório de Permutas de Insumos</a>
                </div>
            </div>
        </div>
    </div>
</div>