
<section class="painel_usuarios">
    <div class="container_painel">
        <div class="menu_user">
            <h3>Estoque de Insumos</h3>
            <a href="index.php?menuop=inserir_insumo_deposito">Inserir</a>
            <a href="#">Retirar</a>
            <a href="#">Modificar</a>
        </div>
        <div class="menu_user">
            <table id="tabela_listar">
                <thead>
                    <tr>
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
                        <td><?=$dados["id"]?></td>

                        <!--pega o nome do produto a partir do id cadastrado-->
                        <?php
                            $id_produto_nome = $dados["nome_produtoID"];
                            $sql_select = "SELECT * FROM insumos where id=$id_produto_nome";
                            $result = mysqli_query($conexao,$sql_select) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                            while($nome_produto = mysqli_fetch_assoc($result)){
                                
                        ?>
                        <td><?=$nome_produto["nome"]?></td>
                        <?php
                            }
                        ?>

                        <td><?=$dados["quantidade"]?></td>

                        <!--pega o nome do produto a partir do id cadastrado-->
                        <?php
                            $id_produto_tipo = $dados["tipo_produtoID"];
                            $sql_select = "SELECT * FROM insumos where id=$id_produto_tipo";
                            $result = mysqli_query($conexao,$sql_select) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                            while($tipo_produto = mysqli_fetch_assoc($result)){
                                
                        ?>
                        <td>
                            <?php
                            if($tipo_produto["insumo_tipo"] == 1 ){
                                echo "Medicamento";
                            }else{
                                echo "Materiais de procedimentos médicos";
                            }
                            ?>
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