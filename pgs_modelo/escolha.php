<?php
    include_once "include/menu.php";
    ?>
<div class="container">

    <div class="row">

        <div class="coluna_row">
            <h3>Cadastro de Veterinário</h3>
            <form class="form_cadastro">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" placeholder="Informe o Nome">
                </div>
                <div class="form-group">
                    <label for="sobrenome">Sobrenome</label>
                    <input type="text" class="form-control" id="sobrenome" placeholder="Informe o Sobrenome">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control" id="email" placeholder="Informe o E-mail">
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" id="cpf" placeholder="Informe o CPF">
                </div>
                <div class="form-group">
                    <label for="crm">CRM</label>
                    <input type="text" class="form-control" id="crm" placeholder="Informe o CRM">
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="senha" placeholder="Informe a senha">
                </div>

                <button type="button" class="btn btn-primary" id="cadastrar" onclick="cadastrar">Cadastrar</button>
            </form>

            <div id=status></div>
        </div>
        <div class="col"></div>
    </div>
</div>