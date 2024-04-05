
#Criando o banco 
drop schema if exists hovet_db_2;
create database hovet_db_2;
use hovet_db_2;


######################################################

#Criando a tabela de tipos de usuários 
create table tipo_usuario (
	id int primary key auto_increment,
    tipo varchar(100) not null
);

insert into tipo_usuario values
	(null, 'Médico(a) Veterinário(a)'),
    (null, 'Administrador(a) do Sistema'),
    (null, 'Responsável pelo estoque'),
    (null, 'Professor(a)'),
    (null, 'Diretor(a) do HOVET');
    
    
# Criando a tabela de usuários
create table usuarios(
	id int primary key auto_increment,
    nome_completo varchar(100) not null,
    primeiro_nome varchar(100) not null,
    sobrenome varchar(100) not null,
    mail varchar(100) unique not null, 
    tipo_usuario_id int,
    foreign key(tipo_usuario_id) references tipo_usuario(id) on delete set null,
    siape varchar(50) unique not null,
    senha varchar(256) not null,
    status boolean not null
);


# Usar a senha: Hovet@2023
# Trocar após o primeiro login
insert into usuarios value
(null, "Administrador", "ADM", "do Sistema", "adm@ufrahovet.com.br", 2, "12345678", "$2y$10$jf95bNw23hp4bpXb3490h.a3IGYbCdmfd.M6OjLE0VAUOnOJXr8Zu", 1);
######################################################

# Criando a tabela de tipos de insumos
create table tipos_insumos (
	id int primary key auto_increment,
    tipo varchar(100) not null,
    descricao varchar(100)
    );

#inserindo os tipos
insert into tipos_insumos values
	(null, "Medicamentos", "Medicamentos comuns"),
    (null, "Material de procedimento", "Medicamentos para procedimentos cirurgicos"),
    (null, "Medicamentos controlados", "Medicamentos para tratamentos constantes");
    
# Criando a tabela de insumos
create table insumos(
	id int primary key auto_increment,
    nome varchar(256) not null,
    unidade varchar(150) not null,
    descricao varchar(256) not null,
    qtd_critica int not null,
    tipo_insumos_id int,
    foreign key(tipo_insumos_id) references tipos_insumos(id) on delete cascade
);

# Inserção de conteúdo insumos
INSERT INTO insumos (id,nome,unidade,descricao,tipo_insumos_id, qtd_critica) VALUES
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
### Criando a tabela de tipos de estoques
create table tipos_estoques (
	id int primary key auto_increment,
    tipo varchar(50) not null
);

insert into tipos_estoques values
	(null,"Depósito"),
	(null,"Dispensário");

### Criando a tabela estoques
create table estoques (
	id int primary key auto_increment,
    nome varchar(100) not null unique,
    nome_real varchar(100) not null unique,
    tipos_estoques_id int,
    foreign key (tipos_estoques_id) references tipos_estoques(id) on delete cascade,
    descricao varchar(100) null
);

insert into estoques values 
	(null, "Depósito 1", "deposito1", 1, "Sala do depósito 1"),
	(null, "Depósito 2", "deposito2", 1, "Sala do depósito 2"),
    (null, "Dispensário 1", "dispensario1",2,"Sala do Dispensário 1"),
    (null, "Dispensário 2", "dispensario2",2,"Sala do Dispensário 2");


#Criando a tabela do depósito

create table deposito(
	id int primary key auto_increment,
    qtd int not null,
    validade date not null,
    origem_item varchar(50),
    id_origem varchar(50),
    estoque_id int,
    foreign key (estoque_id) references estoques(id) on delete cascade,
    insumos_id int,
	foreign key(insumos_id) references insumos(id) on delete set null
);

######################################################
##### Dispensario ####

create table setores (
	id int primary key auto_increment,
    setor varchar(100) not null
);

insert into setores values
	(null, 'Clínica'),
    (null, 'Anestesia'),
    (null, 'Grandes Animais');

create table local_dispensario (
	id int primary key not null auto_increment,
    nome varchar (100) not null
);

insert into local_dispensario values
	(null, 'Armário'),
	(null, 'Estante'),
	(null, 'Gaveteiro');

create table dispensario(
	id int primary key auto_increment,
    qtd int not null,
    validade date not null,
    deposito_id int,
	foreign key(deposito_id) references deposito(id) on delete cascade,
    local_id int,
    foreign key(local_id) references local_dispensario(id) on delete set null,
    insumos_id int,
    foreign key (insumos_id) references insumos(id) on delete set null,
    estoque_id int,
    foreign key (estoque_id) references estoques(id) on delete cascade
);

######################################################

create table tipos_movimentacoes(
	id int primary key auto_increment,
    movimentacao varchar(256),
    descricao varchar(256)
);

insert into tipos_movimentacoes values
	(null,"Compra", "Compra de insumo(s) para o Depósito."),
    (null,"Retirada", "Retirada de insumo(s) do Depósito."),
    (null,"Doação", "Doação de insumo(s) que irão para o Depósito."),
    (null,"Permuta", "Troca de insumo(s) do Depósito com outras instituições."),
    (null,"Exclusão", "Exclusão de um insumo"),
    (null, "Move para o Dispensário", "Movimentação de itens do Depósito para o Dispensário"),
	(null, "Requisição de insumos do Dispensário", "Quando alguém solicita a retirada de insumos do Dispensário"), 
	(null, "Devolução de insumos para o Dispensário", "Quando alguém solicita a devolução de insumos para o Dispensário"),
	(null, "Aprovação de solicitação de insumo no Dispensário", "Quando alguém aprova uma solicitação do Dispensário"),
	(null, "Negação de solicitação de insumo no Dispensário", "Quando alguém nega uma solicitação do Dispensário"),
	(null, "Solicitação de insumo no Dispensário", "Quando há o envio de uma solicitação de algum insumo do Dispensário");

create table historico_movimentacoes (
	id int primary key auto_increment,
    origem varchar (50),
    destino varchar (50),
    insumo_nome varchar(100),
    usuario_id_nome varchar(256),
    tipos_movimentacoes_id int,
    foreign key (tipos_movimentacoes_id) references tipos_movimentacoes(id) on delete set null,
    data_operacao datetime not null default current_timestamp()
);

create table categorias_fornecedores (
	id int primary key auto_increment,
    categoria varchar(100) not null,
	descricao varchar(100));
    

insert into categorias_fornecedores values
	(null, "Fornecedores", "Empresasa do ramo de medicamentos."),
    (null, "Instituições", "instituicoes que realizam permuta com o hospital veterinário."),
    (null, "Doadores", "Doadores de insumos.");


create table fornecedores (
	id int primary key auto_increment,
    razao_social varchar(100) not null,
    ctg_fornecedores_id int,
    foreign key (ctg_fornecedores_id) references categorias_fornecedores(id) on delete cascade,
    cpf_cnpj varchar (14) null,
    end_logradouro varchar(100) null,
    end_num varchar(100) null,
    end_bairro varchar(100) null,
    end_cep varchar(100) null,
    end_email varchar(100) null,
    end_telefone varchar(50) null,
    observacao varchar(256) null
);


INSERT INTO `fornecedores` (`id`, `razao_social`, `cpf_cnpj`, `end_logradouro`, `end_num`, `end_bairro`, `end_cep`, `end_email`, `end_telefone`, `observacao`, `ctg_fornecedores_id`) VALUES
(1, 'IClinic', '49234203239953', 'R. Castelo Branco', '1403', '---', '00000000', 'iclinic@mail.com', '000000000', 'Obs Teste 1', 1),
(2, 'homeobel', '94329562349693', 'Travessa dos Apinagés', '502', 'Batista Campos', '00000000', 'homeobel@mail.com', '000000000', 'Obs Teste 2', 1),
(3, 'MEM Cirúrgica', '39249239495453', 'R. Angustura', '49', '---', '00000000', 'memcirurgia@mail.com', '000000000', 'Obs Teste 3', 1),
(4, 'Sterilex', '13912343923402', 'Av. Augusto Monte Negro', '904', '---', '00000000', 'sterilex@mail.com', '40052304', 'Obs Teste 4', 1),
(5, 'VetBR Saúde Animal', '12391210213990', 'Rua Castelo Branco', '1011', '---', '00000000', 'vetbr.saude.animal@mail.com', '20320435', 'Entrar em contato para compra de medicamentos controlados', 1),
(6, 'PetLand', '91231823198239', 'Rua Ramiro Barcelos', '213', '---', '00000000', 'petland@mail.com', '34050560', 'Fornecedor de medicamentos de procedimentos', 1),
(8, 'HV-UFPA', '59201323912300', 'R. Augusto Corrêa', '01', '---', '00000000', 'hv-ufpa@mail.com', '000000000', 'Contato para permuta', 2),
(9, 'HV-UEPA', '93459203021303', 'Tv. Perebebuí', '2623', 'Guamá', '00000000', 'hv-uepa@mail.com', '000000000', 'contato para permuta', 2),
(10, 'Beatriz Andrade', '01223443276', 'Travessa Dos Apinagés', '380', 'Batista Campos', '66025002', 'bea.andrade@mail.com', '91985420199', 'Realiza doações a cada 3 meses.', 3);
    

create table status_slc (
	id int primary key auto_increment,
    status varchar(100) not null
);

insert into status_slc values 
	(null,'Aprovada'),
    (null,'Recusada'),
    (null,'Pendente');
        
create table pre_solicitacoes (
	id int primary key auto_increment,
    usuario_id int, 
    foreign key (usuario_id) references usuarios(id) on delete set null,
    setor_destino_id int,
    foreign key (setor_destino_id) references setores(id) on delete set null,
    data datetime not null default current_timestamp(),
    justificativa varchar(256) not null,
    dispensario_id int,
    foreign key (dispensario_id) references dispensario(id) on delete cascade,
    qtd_solicitada int not null,
    qtd_atendida int null,
    tp_movimentacoes_id int,
    foreign key (tp_movimentacoes_id) references tipos_movimentacoes(id) on delete set null,
    status_slc_id int,
    foreign key (status_slc_id) references status_slc(id) on delete set null,
    oid_solicitacao varchar (100)
);

create table compras (
	id int primary key auto_increment,
    num_nf varchar(100) not null,
    nome_nf varchar(100) not null,
    caminho varchar (100) not null,
    data_upload datetime not null default current_timestamp(),
    qtd_guardada int,
    usuario_id int,
    foreign key (usuario_id) references usuarios(id) on delete set null,
    tipos_movimentacoes_id int,
    foreign key (tipos_movimentacoes_id) references tipos_movimentacoes(id) on delete set null,
    fornecedor_id int,
    foreign key (fornecedor_id) references fornecedores(id) on delete set null,
    deposito_id int,
    foreign key (deposito_id) references deposito(id) on delete set null
);

create table permutas (
	id int primary key auto_increment,
    usuario_id int,
    foreign key (usuario_id) references usuarios(id) on delete set null,
    deposito_id_cadastrado int,
    foreign key (deposito_id_cadastrado) references deposito(id) on delete set null,
    deposito_id_removido int,
    foreign key (deposito_id_removido) references deposito(id) on delete set null,
    qtd_retirado int not null,
    qtd_cadastrado int not null,
    oid_operacao varchar (50) not null unique,
    fornecedor_id int,
    foreign key (fornecedor_id) references fornecedores(id) on delete set null,
    tipos_movimentacoes_id int,
    foreign key (tipos_movimentacoes_id) references tipos_movimentacoes(id) on delete set null,
    data datetime not null default current_timestamp()
);
create table doacoes (
	id int primary key auto_increment,
    data_operacao datetime not null default current_timestamp(),
    qtd_doada int not null,
    oid_operacao varchar (50) unique not null,
    tipos_movimentacoes_id int,
    foreign key (tipos_movimentacoes_id) references tipos_movimentacoes(id) on delete set null,
    usuario_id int,
    foreign key (usuario_id) references usuarios(id) on delete set null,
    fornecedor_id int,
    foreign key (fornecedor_id) references fornecedores(id) on delete set null,
    deposito_id int,
    foreign key (deposito_id) references deposito(id) on delete set null
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
		qtd = qtd - NEW.qtd
		WHERE id = NEW.deposito_id;
END$$

DELIMITER ;

######################################################

# Atualiza Dispensario depois de aprovar uma requisicao
DELIMITER $$

CREATE PROCEDURE updateDispensarioQtd(IN novaQuantidade int, IN id_dispensario int)
BEGIN
	UPDATE
		dispensario
	SET
		qtd = novaQuantidade
	WHERE id = id_dispensario;

END$$

DELIMITER ;