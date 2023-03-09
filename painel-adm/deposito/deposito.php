
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
                        <th>Criticidade de vencimento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM deposito";
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
                        <td><?=$dados["nome_insumoNome"]?></td>
                        <td><?=$dados["quantidade"]?></td>

                        <!--pega o nome do produto a partir do id cadastrado-->
                        <?php
                            $id_produto_tipo = $dados["tipo_insumoTipo"];
                            $sql_select = "SELECT tipo FROM tipos_insumos where id=$id_produto_tipo";
                            $result = mysqli_query($conexao,$sql_select) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                            while($tipo_produto = mysqli_fetch_assoc($result)){
                                
                        ?>
                        <td><?=$tipo_produto["tipo"]?>
                        </td>
                        <?php
                            }
                        ?>
                        <td><?=$dados["setor"]?></td>
                        <td><?=$dados["validade"]?></td>
                        <td>
                            <?php
                                $d1 = new DateTime('now');
                                $d2 = new DateTime($dados["validade"]);
                                $intervalo = $d2->diff( $d1 );

                                $vencimentoDIAS = $intervalo->d;
                                $vencimentoMES = $intervalo->m;
                            
                                if (($vencimentoMES <= 1) and ($vencimentoDIAS > 0)) {
                                    echo "o produto está vencido em " . $vencimentoDIAS . " dia(s)";
                                }else{
                                    echo "Diferença de " . $vencimentoDIAS . " dia(s) ";
                                    echo "e " . $vencimentoMES . " mese(s) ";
                                    echo "e " . $intervalo->y . " ano(s).";
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