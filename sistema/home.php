<?php

//echo "<br>usuário da sessão: " . $sessionUserID . "<br>";

$sql_geral = "SELECT 
            tp.movimentacao,
            st.status
        FROM 
            pre_solicitacoes s
        INNER JOIN 
            tipos_movimentacoes tp
        ON 
            s.tp_movimentacoes_id = tp.id
        INNER JOIN 
            status_slc st
        ON 
            s.status_slc_id = st.id
        WHERE
            s.usuario_id = {$sessionUserID}";

$rs_geral = mysqli_query($conexao,$sql_geral) or die("Erro ao executar a consulta! " . mysqli_error($conexao));

$dados_gerais = mysqli_fetch_all($rs_geral);

$solicitacoes = processaSolicitacoes($dados_gerais);

$requisicoes = "requis";
$devolucoes = "devolu";

$aprovada = "aprovada";
$recusada = "recusada"; 
$pendente = "pendente";

$qtd_atual_req_aprov = $solicitacoes[$requisicoes][$aprovada];
$qtd_atual_req_recu = $solicitacoes[$requisicoes][$recusada];
$qtd_atual_req_pend = $solicitacoes[$requisicoes][$pendente];

/* echo "<br>Quantidade de requisições:<br>";
echo "<br>aprovadas: " . $qtd_atual_req_aprov;
echo "<br>recusadas: " . $qtd_atual_req_recu;
echo "<br>pendentes: " . $qtd_atual_req_pend; */

$qtd_atual_devol_aprov = $solicitacoes[$devolucoes][$aprovada];
$qtd_atual_devol_recu = $solicitacoes[$devolucoes][$recusada];
$qtd_atual_devol_pend = $solicitacoes[$devolucoes][$pendente];

/* echo "<br>Quantidade de devoluções:<br>";
echo "<br>aprovadas: " . $qtd_atual_devol_aprov;
echo "<br>recusadas: " . $qtd_atual_devol_recu;
echo "<br>pendentes: " . $qtd_atual_devol_pend; */
?>


<div class="container container_home" style="padding: 20px;">
    <section class="container">
        <div>
            <h1>Bem Vindo ao Sistema de Gerenciamento de Estoques do HOVET</h1>
            <hr>
        </div>
        <div class="cards_wrapper gap_home">
            <div class="group_cards">
                <div class="content_cards">
                    <div class="titulo">
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
                                    <h4 style="color: red;">A vencer</h4>
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
                        <div class="d-flex flex-column" style="width: 100%">
                            <div class="sub_dados">
                                <div class="titulo">
                                    <h4>Requisições</h4>
                                    <span class="icon">
                                        <ion-icon name="file-tray-full-outline"></ion-icon>
                                    </span>
                                </div>
                                <div class="d-flex just-content-spc-around">
                                    <div>
                                        <h2><?=$qtd_atual_req_aprov?></h2>
                                        <p>Aprovadas</p>
                                    </div>
                                    <div>
                                        <h2><?=$qtd_atual_req_pend?></h2>
                                        <p>Pendentes</p>
                                    </div>
                                    <div>
                                        <h2><?=$qtd_atual_req_recu?></h2>
                                        <p>Recusadas</p>
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
                                <div class="d-flex just-content-spc-around">
                                    <div>
                                        <h2><?=$qtd_atual_devol_aprov?></h2>
                                        <p>Aprovadas</p>
                                    </div>
                                    <div>
                                        <h2><?=$qtd_atual_devol_pend?></h2>
                                        <p>Pendentes</p>
                                    </div>
                                    <div>
                                        <h2><?=$qtd_atual_devol_recu?></h2>
                                        <p>Recusadas</p>
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