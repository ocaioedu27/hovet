<div class="cards_wrapper">
    <div class="group_cards">
        <div class="content_cards">
            <div class="top_cards">
                <h2>Depósito</h2>
            </div>
            <div class="cards">
                <div class="sub_dados">
                    <div class="titulo">
                        <h4>Insumos</h4>
                        <span class="icon">
                            <ion-icon name="file-tray-full-outline"></ion-icon>
                        </span>
                    </div>
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
                    <div class="titulo">
                        <h4 style="color: red;">Vencimento</h4>
                        <span class="icon">
                            <ion-icon name="alert-circle-outline" style="color: red;"></ion-icon>
                        </span>
                    </div>
                    <?php
                        $sql = "SELECT count(id) as vencidos_proxVencimento FROM deposito where validade<=curdate() or validade <= curdate() + interval 30 day";
                        $result = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($vencidos = mysqli_fetch_assoc($result)){
                     ?>
                    <h2><?=$vencidos['vencidos_proxVencimento']?></h2>
                    <?php
                        }
                    ?>
                    <p>Próximos ou Vencidos</p>
                </div>
            </div>
        </div>
    </div>
    <div class="group_cards">
        <div class="content_cards">
            <div class="top_cards">
                <h2>Movimentacoes</h2>
            </div>
            <div class="cards">
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
    </div>
    <div class="group_cards">
        <div class="content_cards">
            <div class="top_cards">
                <h2>Relatórios</h2>
            </div>
            <div class="cards re">
                <div class="relatorios">
                    <div class="relatorio">
                        <a href="index.php?menuop=#">Relatório de Cadastro de Insumos</a>
                    </div>
                    <div class="relatorio">
                        <a href="index.php?menuop=#">Relatório de Retirada de Insumos</a>
                    </div>
                    <div class="relatorio">
                        <a href="index.php?menuop=#">Relatório de Doações de Insumos</a>
                    </div>
                    <div class="relatorio">
                        <a href="index.php?menuop=#">Relatório de Permutas de Insumos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>