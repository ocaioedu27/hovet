### Enviando arquivos para o git para um novo diretório

# Requisitos

- ter o git instalado localmente

- Entrar no diretório onde estão os arquivos do projeto.

- Iniciar o git dentro do diretório:

    - git init 

- Realizar um git pull para atualizar o projeto localmente:

    - git pull https://github.com/projhovet/hovet.git main

- Adicionar o url do projeto caso ainda não esteja, nesse caso, use para confirmar se está ou não:

    - git remote add origin https://github.com/projhovet/hovet.git


# Passo a passo

- Adicionar o arquivo desejado:

    - Para adicionar todos os arquivos que foram editados: 
        - git add .

    - Para arquivo específico:
        - git add <nome_do_arquivo_desejado>

- Adicionar o commit:

    - git commit -m "mensegem referente ao commit"

- Se as configurações de user e email ainda não estiverem definidas, o git bash irá solicitá-las:

    - git config --global user.email "seu_email@mail_dominio.com"
    - git config --global user.name "seu_nome"

    - O commit será necessário novamente, portanto, use-o novamente:
        - git commit -m "teste de commit"

- Envio das atualizações para o git:

    - git push -u origin <nome_da_branch_que_ira_atualizar>
