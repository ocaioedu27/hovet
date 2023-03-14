<section class="painel_usuarios">
    <div class="container_painel">
        <div class="menu_user">
            <h3>Todos os usuários</h3>
        </div>
        <div class="menu_user">
            <table id="tabela_listar">
                <thead>
                    <tr>
                        <th>Operações</th>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Tipo de usuario</th>
                        <th>CPF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM usuarios";
                        $rs = mysqli_query($conexao,$sql) or die("Erro ao executar a consulta! " . mysqli_error($conexao));
                        while($dados = mysqli_fetch_assoc($rs)){
                        
                    ?>
                    <tr>
                        <td class="operacoes">
                            <a href="#">
                                <button class="btn">
                                    <ion-icon name="create-outline"></ion-icon>
                                </button>
                            </a>
                            <a href="#">
                                <button class="btn">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </button>
                            </a>
                        </td>
                        <td><?=$dados["id"]?></td>
                        <td><?=$dados["nome"]?></td>
                        <td><?=$dados["mail"]?></td>
                        <td><?=$dados["tipo_usuario"]?></td>
                        <td><?=$dados["cpf"]?></td>
                    </tr>
                    <?php
                        }
                    ?>

                    <!-- Estrutura modal, acrescentar logo a baixo da tabela -->


                    <!-- Modal -->
                    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Veterinário</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Nome</label>
                                                    <input type="text" class="form-control" id=""
                                                        placeholder="Insira o Nome" nome="nome">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Especialidade</label>
                                                    <select class="form-control" id="" nome="especialidade">
                                                        <option>1</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">CRM</label>
                                                    <input type="text" class="form-control" id="crm" nome="crm"
                                                        placeholder="Insira o CRM">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">CPF</label>
                                                    <input type="text" class="form-control" id="cpf" nome="cpf"
                                                        placeholder="Insira o CPF">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Telefone</label>
                                                    <input type="text" class="form-control" id="telefone"
                                                        nome="telefone" placeholder="Insira o Telefone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Email</label>
                                            <input type="email" class="form-control" id="" placeholder="Insira o Email">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancelar</button>
                                    <form method="post">
                                        <button type="submit" name="btn-salvar" class="btn btn-primary">Salvar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </tbody>
            </table>
        </div>
    </div>
    <!--MASCARA NO FORMULÁRIO -->
    <script srt="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#telefone').mask('(00)00000-0000');
        $('#cpf').mask('000.000.000-00');
    });
    </script>
</section>