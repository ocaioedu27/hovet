#Criando o banco 
create database dbhovetTeste;

use dbhovetTeste;


######################################################

#Criando a tabela de tipos de usuários 
create table tipo_usuario (
	id int primary key auto_increment,
    tipo varchar(100) not null
);

#Inserindo os tipos de usuários
insert into tipo_usuario values
	(null, 'Médico(a) Veterinário(a)'),
    (null, 'Responsável pelas compras'),
    (null, 'Responsável pelo estoque'),
    (null, 'Professor(a)'),
    (null, 'Diretor(a) do HOVET');
    
    
# Criando a tabela de usuários
create table usuarios(
	id int primary key auto_increment not null,
    nome varchar(100) not null,
    mail varchar(100) unique not null,
    tipo_usuario_ID int not null,
    foreign key(tipo_usuario_ID) references tipo_usuario(id),
    siape varchar(50) unique not null,
    senha varchar(256) not null
);

######################################################

#Criando a tabela do depósito

create table deposito(
	deposito_id int primary key auto_increment,
    deposito_Qtd int not null,
    deposito_Validade date not null,
    deposito_InsumosID int not null,
	foreign key(deposito_InsumosID) references insumos(id)
);

# Inserção de conteúdo para o depósito
INSERT INTO `deposito` (`deposito_id`, `deposito_Qtd`, `deposito_Validade`, `deposito_InsumosID`) VALUES
(null, 'Dorflex', 10, 1, 1, '2023-03-25');

######################################################


# Criando a tabela de tipos de insumos
create table tipos_insumos (
	id int primary key auto_increment,
    tipo varchar(100) not null);

# Inserindo os tipos de insumos
insert into tipos_insumos values
	(null, "Medicamentos"),
    (null, "Material de procedimento"),
    (null, "Medicamentos controlados");
    
# Criando a tabela de insumos
create table insumos(
	id int primary key auto_increment,
    nome varchar(256) not null,
    unidade varchar(150) not null,
    insumo_tipo_ID int not null,
    foreign key(insumo_tipo_ID) references tipos_insumos(id)
);


# Inserção de conteúdo insumos
INSERT INTO `insumos` (`id`, `nome`, `unidade`, `insumo_tipo_ID`) VALUES
(null, 'Dramin', 'Caixa',  1),
(null, 'Torsilax', 'Caixa', 1),
(null, 'Dipirona', 'Caixa', 1),
(null, 'Paracetamol', 'Caixa', 1),
(null, 'Imosec', 'Caixa', 1),
(null, 'Melatonina', 'Caixa', 1),
(null, 'Acetona', 'Caixa', 2),
(null, 'Pregabalina', 'Caixa', 1),
(null, 'Algodão', 'Pacote', 2),
(null, 'Esparadrapo', 'Caixa', 2);