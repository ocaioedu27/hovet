#Criando o banco 
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
    usuario_nome varchar(100) not null,
    usuario_mail varchar(100) unique not null,
    usuario_tipo_usuario_id int,
    foreign key(usuario_tipo_usuario_id) references tipo_usuario(tipo_usuario_id) on delete set null,
    usuario_siape varchar(50) unique not null,
    usuario_senha varchar(256) not null
);

# Inserindo conteúdo na tabela usuários
insert into usuarios value
(null, "Adm", "adm@mail.com", 5, "000000000000000000000", "$2y$10$Q.86fPmUob06/fo2Jtloeu9VJf5iJqZ7upg1PP2TAQMY2Iq8OJHCC");
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
    insumos_tipo_insumos_id int not null,
    foreign key(insumos_tipo_insumos_id) references tipos_insumos(tipos_insumos_id)
);

# Inserção de conteúdo insumos
INSERT INTO insumos VALUES
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
	(null, 20, '2023-04-05', 1),
    (null, 10, '2023-04-09', 3);


######################################################
##### Dispensario ####

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
    dispensario_local_id int not null,
    foreign key(dispensario_local_id) references local_dispensario(local_id)
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
    (null,"Exclusão", "Exclusão de um insumo");

create table movimentacoes (
	movimentacoes_id int primary key auto_increment,
    movimentacoes_origem varchar (50),
    movimentacoes_destino varchar (50),
    movimentacoes_tipos_movimentacoes_id int,
    foreign key (movimentacoes_tipos_movimentacoes_id) references tipos_movimentacoes(tipos_movimentacoes_id) on delete set null,
    movimentacoes_usuario_id int,
    foreign key (movimentacoes_usuario_id) references usuarios(usuario_id),
    movimentacoes_insumos_id int,
    foreign key (movimentacoes_insumos_id) references insumos(insumos_id),
    data_operacao datetime not null default current_timestamp()
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


DELIMITER ;

# Atualiza movimentacoes depois de deletar insumo do deposito
DELIMITER $$

CREATE TRIGGER before_deposito_delete
	BEFORE DELETE
    ON deposito
    FOR EACH ROW
    BEGIN
		INSERT INTO movimentacoes  
					(movimentacoes_origem,
					movimentacoes_destino,
					movimentacoes_tipos_movimentacoes_id,
					movimentacoes_insumos_id)
                    value
                    ('Depósito', 'Lixo', 5, OLD.deposito_insumos_id);
END$$

DELIMITER ;