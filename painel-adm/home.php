<div class="cards_wrapper">
    <div class="group_cards">
        <div class="cards">
            <p>Insumos no depósito
                <span class="icon">
                    <ion-icon name="file-tray-full-outline"></ion-icon>
                </span>
            </p>
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
        <div class="cards">
            <p>Card Movimentações</p>
        </div>
        <div class="cards">
            <p>Card Relatórios</p>
        </div>
    </div>
</div>