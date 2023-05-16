<div class="container container_home" style="padding: 20px;">
    <!-- <section class="menu_lateral">
        <div class="">
            <div class="menu_op menu lateral">
                <div>
                    <p>teste</p>
                    <ul>
                        <li>teste</li>
                        <li>teste</li>
                        <li>teste</li>
                        <li>teste</li>
                    </ul>
                </div>
            </div>
        </div>
    </section> -->

    <section>
        <div>
            <h1>Informações Gerais do Sistema</h1>
            <hr>
        </div>
        <div class="cards_wrapper gap_home">
            <div class="group_cards">
                <div class="content_cards">
                    <div class="top_cards">
                        <h2>Depósitos</h2>
                    </div>
                    <div class="cards cards_info">
                        <div class="display-flex-row">

                            <div class="sub_dados">
                                <div class="titulo">
                                    <h4>Insumos</h4>
                                    <span class="icon">
                                        <ion-icon name="file-tray-full-outline"></ion-icon>
                                    </span>
                                </div>
                                <?php
                                    $sql = "SELECT COUNT(*) as deposito_Qtd FROM deposito";
                                    $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                    while($dados = mysqli_fetch_assoc($rs)){
                                ?>
                                <h2><?=$dados['deposito_Qtd']?></h2>
                                <?php
                                    }
                                ?>
                                <p>Total de insumos</p>
                            </div>
                            <div class="vencimentoProx">
                                <div class="titulo">
                                    <h4 style="color: red;">A vencer</h4>
                                    <span class="icon">
                                        <ion-icon name="alert-circle-outline" style="color: red;"></ion-icon>
                                    </span>
                                </div>
                                <?php
                                    $sql = "SELECT count(deposito_id) as vencidos_proxVencimento FROM deposito where deposito_Validade<=curdate() or deposito_Validade <= curdate() + interval 30 day";
                                    $result = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                    ($vencidos = mysqli_fetch_assoc($result));
                                ?>
                                <h2><?=$vencidos['vencidos_proxVencimento']?></h2>
                                <p>Próximos ou Vencidos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="group_cards">
                <div class="content_cards">
                    <div class="top_cards">
                        <h2>Dispensários</h2>
                    </div>
                    <div class="cards cards_info">
                        <div class="display-flex-row">
                            
                            <div class="sub_dados">
                                <div class="titulo">
                                    <h4>Insumos</h4>
                                    <span class="icon">
                                        <ion-icon name="file-tray-full-outline"></ion-icon>
                                    </span>
                                </div>
                                <?php
                                    $sql = "SELECT COUNT(*) as dispensario_Qtd FROM dispensario";
                                    $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                    while($dados = mysqli_fetch_assoc($rs)){
                                ?>
                                <h2><?=$dados['dispensario_Qtd']?></h2>
                                <?php
                                    }
                                ?>
                                <p>Total de insumos</p>
                            </div>
                            <div class="vencimentoProx">
                                <div class="titulo">
                                    <h4 style="color: red;">A vencer</h4>
                                    <span class="icon">
                                        <ion-icon name="alert-circle-outline" style="color: red;"></ion-icon>
                                    </span>
                                </div>
                                <?php
                                    $sql = "SELECT count(dispensario_id) as vencidos_proxVencimento FROM dispensario where dispensario_Validade<=curdate() or dispensario_Validade <= curdate() + interval 30 day";
                                    $result = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                    $vencidos = mysqli_fetch_assoc($result);
                                ?>
                                <h2><?=$vencidos['vencidos_proxVencimento']?></h2>
                                <p>Próximos ou Vencidos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="group_cards">
                <div class="content_cards">
                    <div class="top_cards">
                        <h2>Usuários</h2>
                    </div>
                    <div class="cards cards_info">
                        <div class="sub_dados">
                            <div class="titulo">
                                <h4>Cadastrados</h4>
                                <span class="icon">
                                    <ion-icon name="file-tray-full-outline"></ion-icon>
                                </span>
                            </div>
                            <?php
                                $sql = "SELECT COUNT(usuario_id) as usuarios_qtd FROM usuarios";
                                $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                $dados = mysqli_fetch_assoc($rs);
                            ?>
                            <h2><?=$dados['usuarios_qtd']?></h2>
                            <p>Total de Funcionários</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cards_wrapper gap_home">
            <div class="group_cards">
                <div class="content_cards">
                    <div class="top_cards">
                        <h2>Movimentações</h2>
                    </div>
                    <div class="cards cards_info">
                        <div class="display-flex-row">
                            <div>
                                <?php
                                    $sql = "SELECT count(*) AS quantidade_compras FROM movimentacoes WHERE movimentacoes_tipos_movimentacoes_id=1";
                                    $result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));
                                    $dados = mysqli_fetch_assoc($result);
                                ?>
                                <h4>Compras</h5>
                                    <h5><?=$dados['quantidade_compras']?></h5>

                                <?php
                                    $sql = "SELECT count(*) AS quantidade_retiradas FROM movimentacoes WHERE movimentacoes_tipos_movimentacoes_id=6";
                                    $result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));
                                    $dados = mysqli_fetch_assoc($result);
                                ?>
                                <h4>Retiradas</h5>
                                    <h5><?=$dados['quantidade_retiradas']?></h5>
                            </div>
                            <div>
                                <?php
                                    $sql = "SELECT count(*) AS quantidade_doacoes FROM movimentacoes WHERE movimentacoes_tipos_movimentacoes_id=3";
                                    $result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));
                                    $dados = mysqli_fetch_assoc($result);
                                ?>
                                <h4>Doações</h5>
                                    <h5><?=$dados['quantidade_doacoes']?></h5>
                        
                                <?php
                                    $sql = "SELECT count(*) AS quantidade_permutas FROM movimentacoes WHERE movimentacoes_tipos_movimentacoes_id=4";
                                    $result = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));
                                    $dados = mysqli_fetch_assoc($result);
                                ?>
                                <h4>Permutas</h5>
                                    <h5><?=$dados['quantidade_permutas']?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="group_cards">
                <div class="content_cards">
                    <div class="top_cards">
                        <h2>
                            <a href="index.php?menuop=solicitacoes">Solicitações</a>
                        </h2>
                    </div>
                    <div class="cards cards_info">
                        <div class="display-flex-row">
                            <div class="sub_dados">
                                <div class="titulo">
                                    <h4>Requisições</h4>
                                    <span class="icon">
                                        <ion-icon name="file-tray-full-outline"></ion-icon>
                                    </span>
                                </div>
                                <?php
                                    $sql = "SELECT COUNT(s.solicitacoes_id) as solicitacoes_qtd 
                                                FROM solicitacoes s
                                                INNER JOIN tipos_movimentacoes tp
                                                ON s.solicitacoes_tp_movimentacoes_id = tp.tipos_movimentacoes_id
                                                WHERE tp.tipos_movimentacoes_movimentacao LIKE 'Requisição%'";
                                    $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                    $dados = mysqli_fetch_assoc($rs);
                                ?>
                                <h2><?=$dados['solicitacoes_qtd']?></h2>
                                <p>Total Pendentes</p>
                            </div>
                            <div class="sub_dados">
                                <div class="titulo">
                                    <h4>Devolução</h4>
                                    <span class="icon">
                                        <ion-icon name="file-tray-full-outline"></ion-icon>
                                    </span>
                                </div>
                                <?php
                                    $sql = "SELECT COUNT(s.solicitacoes_id) as solicitacoes_qtd 
                                                FROM solicitacoes s
                                                INNER JOIN tipos_movimentacoes tp
                                                ON s.solicitacoes_tp_movimentacoes_id = tp.tipos_movimentacoes_id
                                                WHERE tp.tipos_movimentacoes_movimentacao LIKE 'Devolução%'";
                                    $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                    $dados = mysqli_fetch_assoc($rs);
                                ?>
                                <h2><?=$dados['solicitacoes_qtd']?></h2>
                                <p>Total Pendentes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="group_cards">
                <div class="content_cards">
                    <div class="top_cards">
                        <h2>Relatórios</h2>
                    </div>
                    <div class="cards cards_info">
                        <div class="display-flex-row">
                            <div class="relatorio">
                                <a href="pdf/relatorio_validade.php" target="_blank"><strong>Depósito</strong> - Relatório de insumos prestes a expirar (mês/ano)</a>
                            </div>
                            <div class="relatorio">
                                <a href="pdf/relatorio_insumo.php" target="_blank"><strong>Depósito</strong> - Relatório de insumos com estoque crítico</a>
                            </div>
                            <div class="relatorio">
                                <a href="pdf/relatorio_movimentacao.php" target="_blank"><strong>Depósito</strong> - Relatório de insercão e retiradas de certo insumo</a>
                            </div>
                            <!-- <div class="relatorio">
                                <a href="pdf/pdf.php" target="_blank"><strong>Dispensario</strong> - Relatório de insercão e retiradas de certo insumo</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>