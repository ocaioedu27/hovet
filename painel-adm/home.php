<div class="cards_wrapper">
    <div class="group_cards">
        <div class="cards">
            <div class="insumosDeposito">
                <h2>Depósito</h2>
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
            <h4>Card Movimentações</h4>
            <div class="movimentacoes">
                <div>
                    <h5>Inserções</h5>
                </div>
                <div>
                    <h5>Retiradas</h5>
                </div>
                <div>
                    <h5>Doações</h5>
                </div>
                <div>
                    <h5>Permutas</h5>
                </div>
            </div>
        </div>
        <div class="cards">
            <p>Card Relatórios</p>
        </div>
    </div>
</div>