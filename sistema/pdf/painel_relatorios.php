<?php

$dir = __DIR__;
echo "Diretório atual: " . $dir;

?>

<div class="">
    <div class="tabelas">
        <table id="tabela_listar">
            <thead>
                <tr>
                    <th id="th_operacoes_editar_deletar">Personalizar</th>
                    <th>Nome</th>
                    <th>Parâmetros para coleta</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="operacoes" id="td_operacoes_editar_deletar">
                        <a href="index.php?menuop=personalizar_relatorios&nome=prestes_expirar" class="confirmaEdit">
                            <button class="btn">
                                <span class="icon">
                                    <ion-icon name="create-outline"></ion-icon>
                                </span>
                            </button>
                        </a>
                        <a href="pdf/relatorio_validade.php" class="confirmaDownload">
                            <button class="btn">
                                <span class="icon">
                                    <ion-icon name="download-outline"></ion-icon>
                                </span>
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="pdf/relatorio_validade.php" target="_blank">Relatório de insumos prestes a expirar (mês/ano)</a>
                    </td>
                    <td>
                        <span>A data atual somado com 30 dias.</span>
                    </td>
                </tr>
                <tr>
                    <td class="operacoes" id="td_operacoes_editar_deletar">
                        <a href="index.php?menuop=personalizar_relatorios&nome=estoque_criticos" class="confirmaEdit">
                            <button class="btn">
                                <span class="icon">
                                    <ion-icon name="create-outline"></ion-icon>
                                </span>
                            </button>
                        </a>
                        <a href="pdf/relatorio_insumo.php" class="confirmaDownload">
                            <button class="btn">
                                <span class="icon">
                                    <ion-icon name="download-outline"></ion-icon>
                                </span>
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="pdf/relatorio_insumo.php" target="_blank">Relatório de insumos com estoque crítico</a>
                    </td>
                    <td>
                        <span>Todos os insumos que estiverem com estoque abaixo do que foi definido como estoque crítico para o insumo.</span>
                    </td>
                </tr>
                <tr>
                    <td class="operacoes" id="td_operacoes_editar_deletar">
                        <a href="index.php?menuop=personalizar_relatorios&nome=todas_movimentacoes" class="confirmaEdit">
                            <button class="btn">
                                <span class="icon">
                                    <ion-icon name="create-outline"></ion-icon>
                                </span>
                            </button>
                        </a>
                        <a href="pdf/relatorio_movimentacao.php" class="confirmaDownload">
                            <button class="btn">
                                <span class="icon">
                                    <ion-icon name="download-outline"></ion-icon>
                                </span>
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="pdf/relatorio_movimentacao.php" target="_blank">Relatório de todas as movimentações</a>
                    </td>
                    <td>
                        <span>Todas as movimentações anteriores à data atual.</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>