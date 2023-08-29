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
            <h1>Bem Vindo ao Sistem de Gerenciamento de Estoques do HOVET</h1>
            <hr>
        </div>
        <div class="cards_wrapper gap_home">
            <div class="group_cards">
                <div class="content_cards">
                    <div class="titulo">
                        <!-- <h2 title="Informações de todos os Dispensários">Dispensários</h2> -->
                        <h2 title="Informações de todos os Dispensários">
                            <a href="index.php?menuop=estoques">Dispensários</a>
                        </h2>
                        <span class="info">
                            <ion-icon name="help-circle-outline"></ion-icon>
                        </span>
                    </div>
                    <div class="cards cards_info">
                        <div class="display-flex-row just-content-spc-around">
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
                    <div class="titulo">
                        <h2 title="Informações de todas as solicitações">
                            <a href="index.php?menuop=minhas_solicitacoes&Pendente">Minhas Solicitações</a>
                        </h2>
                        <span class="info">
                            <ion-icon name="help-circle-outline"></ion-icon>
                        </span>
                    </div>
                    <div class="cards cards_info">
                        <div class="display-flex-row just-content-spc-around">
                            <div class="sub_dados">
                                <div class="titulo">
                                    <h4>Requisições</h4>
                                    <span class="icon">
                                        <ion-icon name="file-tray-full-outline"></ion-icon>
                                    </span>
                                </div>
                                <?php
                                    $sql = "SELECT COUNT(s.pre_slc_id) as pre_slc_qtd 
                                                
                                            FROM pre_solicitacoes s
                                            
                                                INNER JOIN tipos_movimentacoes tp
                                                ON s.pre_slc_tp_movimentacoes_id = tp.tipos_movimentacoes_id

                                                INNER JOIN status_slc st
                                                ON s.pre_slc_status_slc_id = st.status_slc_id
                                                
                                            WHERE s.pre_slc_solicitante = {$sessionUserID} 
                                                AND tp.tipos_movimentacoes_movimentacao LIKE 'Requisição%' 
                                                AND st.status_slc_status LIKE 'Pend%'";
                                    $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                    $dados = mysqli_fetch_assoc($rs);
                                ?>
                                <h2><?=$dados['pre_slc_qtd']?></h2>
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
                                    $sql = "SELECT COUNT(s.pre_slc_id) as pre_slc_qtd 
                                                
                                            FROM pre_solicitacoes s
                                            
                                                INNER JOIN tipos_movimentacoes tp
                                                ON s.pre_slc_tp_movimentacoes_id = tp.tipos_movimentacoes_id

                                                INNER JOIN status_slc st
                                                ON s.pre_slc_status_slc_id = st.status_slc_id
                                                
                                            WHERE s.pre_slc_solicitante = {$sessionUserID} 
                                                AND tp.tipos_movimentacoes_movimentacao LIKE 'Requisição%' 
                                                AND st.status_slc_status LIKE 'Devolu%'";
                                                
                                    $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                    $dados = mysqli_fetch_assoc($rs);
                                ?>
                                <h2><?=$dados['pre_slc_qtd']?></h2>
                                <p>Total Pendentes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>