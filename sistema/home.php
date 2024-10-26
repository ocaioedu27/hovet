<div class="container container_home" style="padding: 20px;">
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
                                    $sql = "SELECT sum(qtd) as qtd FROM dispensario";
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
                                    <h4 style="color: red;">
                                        <a href="pdf/relatorio_validade.php" target="_blank" style="color: red;">A vencer</a>
                                    </h4>
                                    <span class="icon">
                                        <ion-icon name="alert-circle-outline" style="color: red;"></ion-icon>
                                    </span>
                                </div>
                                <?php
                                    $sql = "SELECT sum(qtd) as vencidos_proxVencimento FROM dispensario where validade<=curdate() or validade <= curdate() + interval 30 day";
                                    $result = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                    $vencidos = mysqli_fetch_assoc($result);
                                ?>
                                <h2>
                                    <?php
                                        $qtdVencidos = $vencidos['vencidos_proxVencimento'];
                                        if ($qtdVencidos < 0) {
                                            echo "0";
                                        }else{
                                            echo $qtdVencidos;
                                        }
                                    ?>
                                </h2>
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
                        <div class="d-flex flex-column">
                            <div class="sub_dados">
                                <div class="titulo">
                                    <h4>Requisições</h4>
                                    <span class="icon">
                                        <ion-icon name="file-tray-full-outline"></ion-icon>
                                    </span>
                                </div>
                                <div class="d-flex">
                                    <div>
                                        <?php
                                            $sql = "SELECT 
                                                        COUNT(s.id) as pre_slc_qtd  
                                                    FROM 
                                                        pre_solicitacoes s
                                                    INNER JOIN tipos_movimentacoes tp
                                                    ON s.tp_movimentacoes_id = tp.id

                                                    INNER JOIN status_slc st
                                                    ON s.status_slc_id = st.id
                                                        
                                                    WHERE s.usuario_id = {$sessionUserID} 
                                                        AND tp.movimentacao LIKE 'Requisição%' 
                                                        AND st.status LIKE 'Aprov%'";
                                            $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                            $dados = mysqli_fetch_assoc($rs);
                                        ?>
                                        <h2><?=$dados['pre_slc_qtd']?></h2>
                                        <p>Total Aprovadas</p>
                                    </div>
                                    <div>
                                        <?php
                                            $sql = "SELECT COUNT(s.id) as pre_slc_qtd 
                                                        
                                                    FROM pre_solicitacoes s
                                                    
                                                        INNER JOIN tipos_movimentacoes tp
                                                        ON s.tp_movimentacoes_id = tp.id

                                                        INNER JOIN status_slc st
                                                        ON s.status_slc_id = st.id
                                                        
                                                    WHERE s.usuario_id = {$sessionUserID} 
                                                        AND tp.movimentacao LIKE 'Requisição%' 
                                                        AND st.status LIKE 'Pend%'";
                                            $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                            $dados = mysqli_fetch_assoc($rs);
                                        ?>
                                        <h2><?=$dados['pre_slc_qtd']?></h2>
                                        <p>Total Pendentes</p>
                                    </div>
                                    <div>
                                        <?php
                                            $sql = "SELECT 
                                                        COUNT(s.id) as pre_slc_qtd  
                                                    FROM 
                                                        pre_solicitacoes s
                                                    INNER JOIN tipos_movimentacoes tp
                                                    ON s.tp_movimentacoes_id = tp.id

                                                    INNER JOIN status_slc st
                                                    ON s.status_slc_id = st.id
                                                        
                                                    WHERE s.usuario_id = {$sessionUserID} 
                                                        AND tp.movimentacao LIKE 'Requisição%' 
                                                        AND st.status LIKE 'Recu%'";
                                            $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                            $dados = mysqli_fetch_assoc($rs);
                                        ?>
                                        <h2><?=$dados['pre_slc_qtd']?></h2>
                                        <p>Total Recusadas</p>
                                    </div>
                                </div>
                            </div>
                            <div class="sub_dados">
                                <div class="titulo">
                                    <h4>Devoluções</h4>
                                    <span class="icon">
                                        <ion-icon name="file-tray-full-outline"></ion-icon>
                                    </span>
                                </div>
                                <div class="d-flex">
                                    <div>
                                        <?php
                                            $sql = "SELECT COUNT(s.id) as pre_slc_qtd 
                                                    FROM pre_solicitacoes s
                                                    INNER JOIN tipos_movimentacoes tp
                                                    ON s.tp_movimentacoes_id = tp.id
                                                    INNER JOIN status_slc st
                                                    ON s.status_slc_id = st.id
                                                    WHERE s.usuario_id = {$sessionUserID} 
                                                        AND tp.movimentacao LIKE 'Devolução%' 
                                                        AND st.status LIKE 'Pend%'";
                                                        
                                            $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                            $dados = mysqli_fetch_assoc($rs);
                                        ?>
                                        <h2><?=$dados['pre_slc_qtd']?></h2>
                                        <p>Total Aprovadas</p>
                                    </div>
                                    <div>

                                        <?php
                                            $sql = "SELECT COUNT(s.id) as pre_slc_qtd 
                                                    FROM pre_solicitacoes s
                                                    INNER JOIN tipos_movimentacoes tp
                                                    ON s.tp_movimentacoes_id = tp.id
                                                    INNER JOIN status_slc st
                                                    ON s.status_slc_id = st.id
                                                    WHERE s.usuario_id = {$sessionUserID} 
                                                        AND tp.movimentacao LIKE 'Devolução%' 
                                                        AND st.status LIKE 'Pend%'";
                                                        
                                            $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                            $dados = mysqli_fetch_assoc($rs);
                                        ?>

                                        <h2><?=$dados['pre_slc_qtd']?></h2>
                                        <p>Total Pendentes</p>
                                    </div>
                                    <div>

                                        <?php
                                            $sql = "SELECT COUNT(s.id) as pre_slc_qtd 
                                                    FROM pre_solicitacoes s
                                                    INNER JOIN tipos_movimentacoes tp
                                                    ON s.tp_movimentacoes_id = tp.id
                                                    INNER JOIN status_slc st
                                                    ON s.status_slc_id = st.id
                                                    WHERE s.usuario_id = {$sessionUserID} 
                                                        AND tp.movimentacao LIKE 'Devolução%' 
                                                        AND st.status LIKE 'Recu%'";
                                                        
                                            $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                                            $dados = mysqli_fetch_assoc($rs);
                                        ?>
                                        <h2><?=$dados['pre_slc_qtd']?></h2>
                                        <p>Total Recusadas</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>