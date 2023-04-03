#Criando o banco 
create database dbhovetTeste;

use dbhovetTeste;

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
	id int primary key auto_increment,
    nome varchar(256) not null,
    quantidade int not null,
    tipo_tipoInsumos_ID int not null,
    foreign key(tipo_tipoInsumos_ID) references tipos_insumos(id),
    setor_setorID int not null,
    foreign key(setor_setorID) references setores(id),
    validade date not null
);

# Inserção de conteúdo para o depósito
INSERT INTO `deposito` (`id`, `nome`, `quantidade`, `tipo_tipoInsumos_ID`, `setor_setorID`, `validade`) VALUES
(null, 'Dorflex', 10, 1, 1, '2023-03-25'),
(null, 'Luva cirúrgica', 5, 2, 1, '2023-03-01'),
(null, 'Touca corúrgica', 8, 1, 2, '2023-04-24'),
(null, 'Paracetamol', 2, 1, 1, '2023-05-10'),
(null, 'Dipirona', 5, 1, 2, '2023-04-14'),
(null, 'Torsilax', 12, 1, 3, '2023-04-01'),
(null, 'Paracetamol', 8, 1, 1, '2023-04-27'),
(null, 'Acetona', 12, 2, 2, '2023-05-24'),
(null, 'Melatonina', 5, 1, 3, '2023-05-12'),
(null, 'Imosec', 8, 1, 2, '2023-07-06'),
(null, 'Pregabalina', 12, 1, 1, '2023-04-05'),
(null, 'Acetona', 5, 2, 3, '2023-06-09'),
(null, 'Melatonina', 8, 1, 2, '2023-06-14');

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