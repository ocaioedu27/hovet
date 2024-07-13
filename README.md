
# Configuração do Projeto

Processo de configuração do projeto, detalhando os
passos necessários para sua execução em ambiente local, viabilizando assim a colaboração
entre os membros.

A.1 Pré-requisitos
- Apache Web Server
- PHP 8 +
- MySQL


A.2 Backend
Instalação do MySQL e Apache Server e interpretador do PHP: XAMMP

- Baixe o XAMMP: Você pode baixar a versão mais recente do XAMMP para o Windows ou Linux no site oficial do XAMMP: ApacheFriends.

**No Windows**:

1. Execute o Instalador: Após o download, execute o instalador utilizando os privilégios de administrador e siga as instruções na tela para concluir a instalação.

**No Linux (Ubuntu/Debian)**

1. Atualize o Gerenciador de Pacotes: Abra o terminal e atualize o gerenciador de pacotes para garantir que você tenha as informações de pacotes mais recentes:
    a) Atualize a lista de pacotes disponíveis:
        sudo apt update
    b) Atualize os pacotes instalados para as versões mais recentes:
        sudo apt upgrade
    c) Altere as permissões do instalador para torná-lo executável:
        chmod +x xampp-linux-*-installer.run
    APÊNDICE A. Configuração do Projeto 13
    d) Execute o instalador com privilégios de root no terminal:
        sudo ./xampp-linux-*-installer.run

**Pré-configuração para rodar o sistema:**

1. Vá até o diretório de instalação do XAMPP

    - No Windows: Normalmente, a pasta “htdocs” está dentro da pasta XAMPP.
        cd \xampp\htdocs
    - No Linux: A pasta fica em /opt/lampp/htdocs/
        cd /opt/lampp/htdocs/

2. Clone o projeto: Baixe ou clone o repositório onde o projeto está hospedado:
    git clone <URL_do_repositorio>

3. Navegue até o diretório do projeto clonado:
    cd hovet/

4. Configurações para o banco de dados: Dentro do arquivo config.php localizado na pasta /hovet/db/:
    define(”SERVIDOR”, ”localhost”); // url do servidor
    define(”USUARIO”, ”root”); // Usuário do banco de dados
    define(”SENHA”, ””); // Senha do usuário do banco de dados
    define(”BANCO”, ”hovet_db”); // Nome do banco de dados

Verifique se os dados de conexão com seu banco estão propriamente configurados.

5. Validar se está ativo o apache server e o banco de dados:
    -  No Windows:
        * Procurar pelo programa administrador do XAMMP na biblioteca de pro-
        gramas do windows.
        * Abrir o painel e ativar ambos os serviços, caso não estejam.

    - No Linux:
        * Abrir um terminal
        * Entrar no diretório do XAMMP
            cd /opt/lampp/
        * Abrir o painel XAMMP:
            sudo ./manager-linux-x64.run
        * Ou ativar direto com:
            sudo /opt/lampp/lampp start

6. Configurando o banco de dados da Aplicação:

    - Acesse o PHP My Admin para rodar o arquivo de build que criará
    o banco de dados, suas tabelas e outros recursos como triggers e
    stored procedures:
    - Certifique-se de que o apache server e o banco de dados estão ativos. (Abra
    o painel do XAMMP para validar se ambos estão com o status ”running”ou
    ”active”)
    - Após a validação dos serviços, você pode acessar o PHP My Admin em um
    navegador da web digitando o endereço <http://localhost/phpmyadmin/>.
    - Por padrão, o login para acessar é usuário root e senha vazia. Basta selecionar
    o usuário e prosseguir com o login.
    - Clique em ”Importar”, em seguida na área descrita como ”Arquivo a impor-
    tar:”selecione o arquivo build.sql que está no diretório do projeto em /ho-
    vet/hovet_db/
    - Vá até o final da página e clique em na opção ”Importar”. Será feito o processo
    de criação do banco e das tabelas e dependências.

A.3 Uso do sistema

1. Valide no painel do XAMMP se os serviços de banco de dados estão
ligados, se não, ative-os.

2. Acesse <http://localhost/hovet/index.php>

3. Use estes acessos para iniciar a sessão:
    - Usuário: adm@ufrahovet.com.br
    - Senha: Hovet@2023

4. Assim, conseguirá utilizar o sistema.

5. DICA: Após o primeiro acesso, troque a senha do usuário adm clicando no canto
superior direito no ícone de usuário, selecione ”Meus Dados”, por fim clique em
”Trocar a senha”.


