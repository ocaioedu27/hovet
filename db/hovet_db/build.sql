
#Criando o banco 
drop schema if exists hovet_db;
create database hovet_db;
use hovet_db;


######################################################

#Criando a tabela de tipos de usuários 
create table tipo_usuario (
	tipo_usuario_id int primary key auto_increment,
    tipo_usuario_tipo varchar(100) not null
);

insert into tipo_usuario values
	(null, 'Médico(a) Veterinário(a)'),
    (null, 'Responsável pelas compras'),
    (null, 'Responsável pelo estoque'),
    (null, 'Professor(a)'),
    (null, 'Diretor(a) do HOVET');
    
    
# Criando a tabela de usuários
create table usuarios(
	usuario_id int primary key auto_increment,
    usuario_nome_completo varchar(100) not null,
    usuario_primeiro_nome varchar(100) not null,
    usuario_sobrenome varchar(100) not null,
    usuario_mail varchar(100) unique not null,
    usuario_tipo_usuario_id int,
    foreign key(usuario_tipo_usuario_id) references tipo_usuario(tipo_usuario_id) on delete set null,
    usuario_siape varchar(50) unique not null,
    usuario_senha varchar(256) not null
);

insert into usuarios value
(null, "Diretor(a) do HOVET", "Diretor(a)", "do Hovet", "diretor_a@ufrahovet.com.br", 5, "000000000000000000000", "$2y$10$Q.86fPmUob06/fo2Jtloeu9VJf5iJqZ7upg1PP2TAQMY2Iq8OJHCC");
#usar essa senha 1234 para trocar após o primeiro login

######################################################

# Criando a tabela de tipos de insumos
create table tipos_insumos (
	tipos_insumos_id int primary key auto_increment,
    tipos_insumos_tipo varchar(100) not null);

#inserindo os tipos
insert into tipos_insumos values
	(null, "Medicamentos"),
    (null, "Material de procedimento"),
    (null, "Medicamentos controlados");
    
# Criando a tabela de insumos
create table insumos(
	insumos_id int primary key auto_increment,
    insumos_nome varchar(256) not null,
    insumos_unidade varchar(150) not null,
    insumos_descricao varchar(256) not null,
    insumos_qtd_critica int not null,
    insumos_tipo_insumos_id int not null,
    foreign key(insumos_tipo_insumos_id) references tipos_insumos(tipos_insumos_id)
);

# Inserção de conteúdo insumos
INSERT INTO insumos (insumos_id,insumos_nome,insumos_unidade,insumos_descricao,insumos_tipo_insumos_id, insumos_qtd_critica) VALUES
(null, 'Dramin','Caixa','Dramin 50mg Com 10 Caps Gel', 1, 20),
(null, 'Torsilax','Caixa','Torsilax 30mg Com 30 comp', 1, 30),
(null, 'Dipirona', 'Caixa','Dipirona Sódica 500mg 10 Comprimidos Ems Genérico', 1, 40),
(null, 'Paracetamol','Caixa','Paracetamol 750mg 12 Comprimidos', 1, 34),
(null, 'Imosec','Caixa','Imosec 12 Cápsulas tipo C', 1, 30),
(null, 'Melatonina','Caixa','Melatonina Raia 0,21mg 60 Comprimidos', 1, 10),
(null, 'Alcool','Pacote','álcool etílico hidratado 70º INPM', 2, 100),
(null, 'Pregabalina','Caixa','Cápsulas de 75 com 150mg', 1, 60),
(null, 'Algodão','Pacote','Pacote Algodão 500g', 2, 100),
(null, 'Esparadrapo','Caixa','Esparadrapo Impermeável Branco 5CM X 4,5M Pacote com 12', 2, 100);

######################################################

#Criando a tabela do depósito

create table deposito(
	deposito_id int primary key auto_increment,
    deposito_qtd int not null,
    deposito_validade date not null,
    deposito_insumos_id int,
	foreign key(deposito_insumos_id) references insumos(insumos_id) on delete set null
);

# Inserção de conteúdo para o depósito
insert into deposito values 
	(null, 20, '2023-08-05', 1),
    (null, 10, '2023-08-09', 3);


######################################################
##### Dispensario ####

create table setores (
	setores_id int primary key auto_increment,
    setores_setor varchar(100) not null
);

insert into setores values
	(null, 'Clínica'),
    (null, 'Anestesia'),
    (null, 'Grandes Animais');

create table local_dispensario (
	local_id int primary key not null auto_increment,
    local_nome varchar (20) not null
);
-- drop table local_dispensario;
insert into local_dispensario values
	(null, 'Armário'),
	(null, 'Estante'),
	(null, 'Gaveteiro');

create table dispensario(
	dispensario_id int primary key auto_increment,
    dispensario_qtd int not null,
    dispensario_validade date not null,
    dispensario_deposito_id int,
	foreign key(dispensario_deposito_id) references deposito(deposito_id) on delete cascade,
    dispensario_local_id int,
    foreign key(dispensario_local_id) references local_dispensario(local_id) on delete set null,
    dispensario_insumos_id int,
    foreign key (dispensario_insumos_id) references insumos(insumos_id) on delete set null
);

######################################################

create table tipos_movimentacoes(
	tipos_movimentacoes_id int primary key auto_increment,
    tipos_movimentacoes_movimentacao varchar(256),
    tipos_movimentacoes_descricao varchar(256)
);

insert into tipos_movimentacoes values
	(null,"Compra", "Compra de insumo(s) para o Depósito."),
    (null,"Retirada", "Retirada de insumo(s) do Depósito."),
    (null,"Doação", "Doação de insumo(s) que irão para o Depósito."),
    (null,"Permuta", "Troca de insumo(s) do Depósito com outras instituições."),
    (null,"Exclusão", "Exclusão de um insumo"),
    (null, "Move para o Dispensário", "Movimentação de itens do Depósito para o Dispensário");

create table movimentacoes (
	movimentacoes_id int primary key auto_increment,
    movimentacoes_origem varchar (50),
    movimentacoes_destino varchar (50),
    movimentacoes_tipos_movimentacoes_id int,
    foreign key (movimentacoes_tipos_movimentacoes_id) references tipos_movimentacoes(tipos_movimentacoes_id) on delete set null,
    movimentacoes_usuario_id int,
    foreign key (movimentacoes_usuario_id) references usuarios(usuario_id) on delete set null,
    movimentacoes_insumos_id int,
    foreign key (movimentacoes_insumos_id) references insumos(insumos_id) on delete set null,
    movimentacoes_data_operacao datetime not null default current_timestamp()
);

create table notas_fiscais (
	notas_fiscais_id int primary key auto_increment,
    notas_fiscais_nome varchar(100) not null,
    notas_fiscais_caminho varchar (100) not null,
    notas_fiscais_data_upload datetime not null default current_timestamp(),
    notas_fiscais_insumos_id int,
    foreign key(notas_fiscais_insumos_id) references insumos(insumos_id) on delete set null
);

create table fornecedores (
	fornecedores_id int primary key auto_increment,
    fornecedores_nome varchar(100) not null,
    fornecedores_cpf_cnpj varchar (14) null,
    fornecedores_rg varchar(7) null,
    fornecedores_end_logradouro varchar(100) null,
    fornecedores_end_num varchar(100) null,
    fornecedores_end_bairro varchar(100) null,
    fornecedores_end_cep varchar(100) null,
    fornecedores_end_email varchar(100) null,
    fornecedores_end_telefone varchar(50) null,
    fornecedores_end_obserevacao varchar(256) null
);


######################################################

# Trigger que atualiza a quantidade do insumom no Deposito depois de passar para o dispensario
DELIMITER $$

CREATE TRIGGER after_deposito_from_dispensario
	AFTER INSERT 
    ON dispensario
    FOR EACH ROW
    BEGIN
		UPDATE deposito as deps set
		deposito_qtd = deposito_qtd - NEW.dispensario_qtd
		WHERE deposito_id = NEW.dispensario_deposito_id;
END$$

DELIMITER ;