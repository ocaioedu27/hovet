<?php
$idInstituicao = $_GET["idInstituicao"];

$sql = "SELECT * 
            FROM instituicoes
            WHERE instituicoes_id={$idInstituicao}";
$result = mysqli_query($conexao,$sql) or die("Erro ao realizar a consulta. " . mysqli_error($conexao));
$dados = mysqli_fetch_assoc($result);
?>

<div class="container cadastro_all">
    <div class="cards cadastro_fornecedor">
        <div class="voltar">
            <h4>Editar Instituição</h4>
            <a href="index.php?menuop=instituicoes" class="confirmaVolta">
                <button class="btn">
                    <span class="icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </span>
                </button>
            </a>
        </div>
        <form class="form_cadastro" action="index.php?menuop=atualizar_instituicoes" method="post">
                <div class="display-flex-row">
                    <div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>ID da Instituição</label>
                                <input type="text" class="form-control largura_metade" name="idInstituicao" value="<?=$dados['instituicoes_id']?>" readonly>
                            </div>

                            <div class="display-flex-cl">
                                <label>Razão Social</label>
                                <input type="text" class="form-control" name="razaoSocialFornecedor" placeholder="Informe a Razão Social..." value="<?=$dados['instituicoes_razao_social']?>" required>
                            </div>

                            <div class="display-flex-cl">
                                <label>Logradouro</label>
                                <input type="text" class="form-control" name="logradouroFornecedor" placeholder="Informe o Logradouro..." value="<?=$dados['instituicoes_end_logradouro']?>">
                            </div>

                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>CNPJ ou CPF</label>
                                <input type="text" class="form-control" maxlength="14" name="cnpjCpfFornecedor" placeholder="Informe somente números..." min="1" value="<?=$dados['instituicoes_cpf_cnpj']?>">
                            </div>

                            <div class="display-flex-cl">
                                <label>E-mail</label>
                                <input type="text" class="form-control" name="emailFornecedor" placeholder="Informe o E-mail..." value="<?=$dados['instituicoes_end_email']?>">
                            </div>

                            <div class="display-flex-cl">
                                <label>Fone ou FAC</label>
                                <input type="text" class="form-control" name="foneFacFornecedor" placeholder="Informe o contato..." maxlength="14" value="<?=$dados['instituicoes_end_telefone']?>">
                            </div>

                        </div>

                        <div class="form-group valida_movimentacao">

                            <div class="display-flex-cl">
                                <label>Observação</label>
                                <input type="text" class="form-control " name="observacaoFornecedor" rows="3" value="<?=$dados['instituicoes_observacao']?>">
                            </div>

                        </div>
                    </div>

                </div>

        
            <div class="form-group valida_movimentacao">
                <label>Confirmo que os dados estão validados</label>
                <input type="checkbox" class="form-control-sm" name="valida_dados_insercao_fornecedor" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Atualizar" name="btnAtualizarUsuario" class="btn_cadastrar">
            </div>
        </form>
    </div>
</div>