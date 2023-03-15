<section class="painel_usuarios">
    <div class="container_painel">
        <div class="menu_header">
            <div class="menu_user">
                <h3>Estoque de Insumos</h3>
                <a href="index.php?menuop=cadastro_deposito">
                    <button class="btn">Inserir</button>
                </a>
                <a href="#">
                    <button class="btn">Retirar</button>
                </a>
            </div>
            <div>
                <form action="index.php?menuop=deposito" method="post" class="form_buscar">
                    <input type="text" name="txt_pesquisa_deposito" placeholder="Buscar">
                    <button type="submit" class="btn">
                        <span class="icon">
                            <ion-icon name="search-outline"></ion-icon>
                        </span>
                    </button>
                </form>
            </div>
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
                        $quantidade_registros = 15;

                        $pagina = (isset($_GET['pagina']))?(int)$_GET['pagina']:1;

                        $txt_pesquisa_deposito = (isset($_POST["txt_pesquisa_deposito"]))?$_POST["txt_pesquisa_deposito"]:"";

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
                                    datediff(validade, curdate()) as diasParaVencimento 
                                    FROM deposito 
                                    WHERE
                                        id='{$txt_pesquisa_deposito}' or
                                        nome_insumoNome LIKE '%{$txt_pesquisa_deposito}%' or
                                        tipo_insumoTipo LIKE '%{$txt_pesquisa_deposito}%'
                                        ORDER BY nome_insumoNome ASC";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr>
                        <td class="operacoes">
                            <a href="index.php?menuop=editar_deposito&idInsumoDeposito=<?=$dados["id"]?>"
                                class="confirmaEdit">
                                <button class="btn">
                                    <span class="icon">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                            <a href="index.php?menuop=excluir_deposito&idInsumoDeposito=<?=$dados["id"]?>"
                                class="confirmaDelete">
                                <button class="btn">

                                    <span class="icon">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </span>
                                </button>
                            </a>
                        </td>
                        <td><?=$dados["id"]?></td>
                        <td><?=$dados["nome"]?></td>
                        <td><?=$dados["quantidade"]?></td>
                        <td><?=$dados["tipo"]?></td>
                        <td><?=$dados["setor"]?></td>
                        <td><?=$dados["validade"]?></td>
                        <td <?php 
                                $dias = ['30','45'];
 
                                if($dados["diasParaVencimento"] <= $dias[0]){                                    
                                ?> class="vermelho" <?php
                                } else if($dados["diasParaVencimento"] <= $dias[1]){
                                    ?> class="amarelo" <?php
                                } else if($dados["diasParaVencimento"] > $dias[1]){
                                    ?> class="verde" <?php
                                } 
                                ?>><?php if ($dados["diasParaVencimento"] <= 0){
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