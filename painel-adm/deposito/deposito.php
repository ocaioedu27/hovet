
<section class="painel_usuarios">
    <div class="container_painel">
        <div class="menu_user">
            <h3>Estoque de Insumos</h3>
            <a href="index.php?menuop=cadastro_deposito">
                <button class="btn">Inserir</button>
            </a>
            <a href="#">
                <button class="btn">Retirar</button>
            </a>
        </div>
        <div class="menu_user">
            <table id="tabela_listar">
                <thead>
                    <tr>
                        <th>Operações</th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Tipo de Insumo</th>
                        <th>Setor</th>
                        <th>Validade</th>
                        <th>Dias para o vencimento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT 
                                    id,
                                    nome_insumoNome as nome,
                                    quantidade,
                                    CASE
                                        WHEN tipo_insumoTipo='1' THEN 'Medicamento'
                                        WHEN tipo_insumoTipo='2' THEN 'Materiais de procedimentos médicos'
                                    ELSE
                                        'Não especificado'
                                    END as tipo,
                                    setor,
                                    date_format(validade, '%d/%m/%Y') as validade,
                                    datediff(validade, curdate()) as diasParaVencimento FROM deposito";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr>
                        <td class="operacoes">
                            <a href="index.php?menuop=editar_deposito&idInsumoDeposito=<?=$dados["id"]?>">
                                <button class="btn">Editar</button>
                            </a>
                            <a href="index.php?menuop=excluir_deposito&idInsumoDeposito=<?=$dados["id"]?>">
                                <button class="btn">Excluir</button>
                            </a>
                        </td>
                        <td><?=$dados["id"]?></td>
                        <td><?=$dados["nome"]?></td>
                        <td><?=$dados["quantidade"]?></td>
                        <td><?=$dados["tipo"]?></td>
                        <td><?=$dados["setor"]?></td>
                        <td><?=$dados["validade"]?></td>
                        <td 
                            <?php 
                                $cores = ['30','45'];
 
                                if($dados["diasParaVencimento"] <= $cores[0]){                                    
                                ?>
                                    class="vermelho"
                                <?php
                                } else if($dados["diasParaVencimento"] <= $cores[1]){
                                    ?>
                                    class="amarelo"
                                <?php
                                } else if($dados["diasParaVencimento"] > $cores[1]){
                                    ?>
                                    class="verde"
                                <?php
                                } 
                                ?>
                                ><?php if ($dados["diasParaVencimento"] <= 0){
                                    echo "INSUMO VENCIDO!";
                                } else{
                                    echo $dados["diasParaVencimento"] . " dia(s) para o vencimento";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>