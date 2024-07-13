
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
    (null, 'Administrador(a) do Sistema'),
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
    usuario_senha varchar(256) not null,
    usuario_status boolean not null
);


# Usar a senha: Hovet@2023
# Trocar após o primeiro login
insert into usuarios value
(null, "Administrador", "ADM", "do Sistema", "adm@ufrahovet.com.br", 2, "12345678", "$2y$10$jf95bNw23hp4bpXb3490h.a3IGYbCdmfd.M6OjLE0VAUOnOJXr8Zu", 1);

######################################################

# Criando a tabela de tipos de insumos
create table tipos_insumos (
	tipos_insumos_id int primary key auto_increment,
    tipos_insumos_tipo varchar(100) not null,
    tipos_insumos_descricao varchar(100)
    );

#inserindo os tipos
insert into tipos_insumos values
	(null, "Medicamentos", "Medicamentos comuns"),
    (null, "Material de procedimento", "Medicamentos para procedimentos cirurgicos"),
    (null, "Medicamentos controlados", "Medicamentos para tratamentos constantes");
    
# Criando a tabela de insumos
create table insumos(
	insumos_id int primary key auto_increment,
    insumos_nome varchar(256) not null,
    insumos_unidade varchar(150) not null,
    insumos_descricao varchar(256) not null,
    insumos_qtd_critica int not null,
    insumos_tipo_insumos_id int,
    foreign key(insumos_tipo_insumos_id) references tipos_insumos(tipos_insumos_id) on delete cascade
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
### Criando a tabela de tipos de estoques
create table tipos_estoques (
	tipos_estoques_id int primary key auto_increment,
    tipos_estoques_tipo varchar(50) not null
);

insert into tipos_estoques values
	(null,"Depósito"),
	(null,"Dispensário");

### Criando a tabela estoques
create table estoques (
	estoques_id int primary key auto_increment,
    estoques_nome varchar(100) not null unique,
    estoques_nome_real varchar(100) not null unique,
    estoques_tipos_estoques_id int,
    foreign key (estoques_tipos_estoques_id) references tipos_estoques(tipos_estoques_id) on delete set null,
    estoques_descricao varchar(100) null
);

insert into estoques values 
	(null, "Depósito 1", "deposito1", 1, "Sala do depósito 1"),
	(null, "Depósito 2", "deposito2", 1, "Sala do depósito 2"),
    (null, "Dispensário 1", "dispensario1",2,"Sala do Dispensário 1"),
    (null, "Dispensário 2", "dispensario2",2,"Sala do Dispensário 2");


#Criando a tabela do depósito

create table deposito(
	deposito_id int primary key auto_increment,
    deposito_qtd int not null,
    deposito_validade date not null,
    deposito_origem_item varchar(50),
    deposito_id_origem varchar(50),
    deposito_estoque_id int,
    foreign key (deposito_estoque_id) references estoques(estoques_id) on delete cascade,
    deposito_insumos_id int,
	foreign key(deposito_insumos_id) references insumos(insumos_id) on delete set null
);

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
    foreign key (dispensario_insumos_id) references insumos(insumos_id) on delete set null,
    dispensario_estoques_id int,
    foreign key (dispensario_estoques_id) references estoques(estoques_id) on delete cascade
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
    (null, "Move para o Dispensário", "Movimentação de itens do Depósito para o Dispensário"),
	(null, "Requisição de insumos do Dispensário", "Quando alguém solicita a retirada de insumos do Dispensário"), 
	(null, "Devolução de insumos para o Dispensário", "Quando alguém solicita a devolução de insumos para o Dispensário"),
	(null, "Aprovação de solicitação de insumo no Dispensário", "Quando alguém aprova uma solicitação do Dispensário"),
	(null, "Negação de solicitação de insumo no Dispensário", "Quando alguém nega uma solicitação do Dispensário"),
	(null, "Solicitação de insumo no Dispensário", "Quando há o envio de uma solicitação de algum insumo do Dispensário");

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

create table categorias_fornecedores (
	cf_id int primary key auto_increment,
    cf_categoria varchar(100) not null,
	cf_descricao varchar(100));
    

insert into categorias_fornecedores values
	(null, "Fornecedores", "Empresasa do ramo de medicamentos."),
    (null, "Instituições", "instituicoes que realizam permuta com o hospital veterinário."),
    (null, "Doadores", "Doadores de insumos.");


create table fornecedores (
	fornecedores_id int primary key auto_increment,
    fornecedores_razao_social varchar(100) not null,
    fornecedores_ctg_fornecedores_id int,
    foreign key (fornecedores_ctg_fornecedores_id) references categorias_fornecedores(cf_id) on delete cascade,
    fornecedores_cpf_cnpj varchar (14) null,
    fornecedores_end_logradouro varchar(100) null,
    fornecedores_end_num varchar(100) null,
    fornecedores_end_bairro varchar(100) null,
    fornecedores_end_cep varchar(100) null,
    fornecedores_end_email varchar(100) null,
    fornecedores_end_telefone varchar(50) null,
    fornecedores_observacao varchar(256) null
);


INSERT INTO `fornecedores` (`fornecedores_id`, `fornecedores_razao_social`, `fornecedores_cpf_cnpj`, `fornecedores_end_logradouro`, `fornecedores_end_num`, `fornecedores_end_bairro`, `fornecedores_end_cep`, `fornecedores_end_email`, `fornecedores_end_telefone`, `fornecedores_observacao`, `fornecedores_ctg_fornecedores_id`) VALUES
(1, 'IClinic', '49234203239953', 'R. Castelo Branco', '1403', '---', '00000000', 'iclinic@mail.com', '000000000', 'Obs Teste 1', 1),
(2, 'homeobel', '94329562349693', 'Travessa dos Apinagés', '502', 'Batista Campos', '00000000', 'homeobel@mail.com', '000000000', 'Obs Teste 2', 1),
(3, 'MEM Cirúrgica', '39249239495453', 'R. Angustura', '49', '---', '00000000', 'memcirurgia@mail.com', '000000000', 'Obs Teste 3', 1),
(4, 'Sterilex', '13912343923402', 'Av. Augusto Monte Negro', '904', '---', '00000000', 'sterilex@mail.com', '40052304', 'Obs Teste 4', 1),
(5, 'VetBR Saúde Animal', '12391210213990', 'Rua Castelo Branco', '1011', '---', '00000000', 'vetbr.saude.animal@mail.com', '20320435', 'Entrar em contato para compra de medicamentos controlados', 1),
(6, 'PetLand', '91231823198239', 'Rua Ramiro Barcelos', '213', '---', '00000000', 'petland@mail.com', '34050560', 'Fornecedor de medicamentos de procedimentos', 1),
(8, 'HV-UFPA', '59201323912300', 'R. Augusto Corrêa', '01', '---', '00000000', 'hv-ufpa@mail.com', '000000000', 'Contato para permuta', 2),
(9, 'HV-UEPA', '93459203021303', 'Tv. Perebebuí', '2623', 'Guamá', '00000000', 'hv-uepa@mail.com', '000000000', 'contato para permuta', 2);
    

create table status_slc (
	status_slc_id int primary key auto_increment,
    status_slc_status varchar(100) not null
);

insert into status_slc values 
	(null,'Aprovada'),
    (null,'Recusada'),
    (null,'Pendente');
        
create table pre_solicitacoes (
	pre_slc_id int primary key auto_increment,
    pre_slc_solicitante int, 
    foreign key (pre_slc_solicitante) references usuarios(usuario_id) on delete set null,
	pre_slc_dips_solicitado int,
    foreign key (pre_slc_dips_solicitado) references estoques(estoques_id) on delete set null,
    pre_slc_setor_destino int,
    foreign key (pre_slc_setor_destino) references setores(setores_id) on delete set null,
    pre_slc_data datetime not null default current_timestamp(),
    pre_slc_justificativa varchar(256) not null,
    pre_slc_dispensario_id int,
    foreign key (pre_slc_dispensario_id) references dispensario(dispensario_id) on delete cascade,
    pre_slc_qtd_solicitada int not null,
    pre_slc_qtd_atendida int null,
    pre_slc_tp_movimentacoes_id int,
    foreign key (pre_slc_tp_movimentacoes_id) references tipos_movimentacoes(tipos_movimentacoes_id) on delete set null,
    pre_slc_status_slc_id int,
    foreign key (pre_slc_status_slc_id) references status_slc(status_slc_id) on delete set null,
    pre_slc_oid_solicitacao varchar (100)
);

create table solicitacoes (
	slc_id int primary key auto_increment,
    slc_pre_slc_id int,
    foreign key (slc_pre_slc_id) references pre_solicitacoes(pre_slc_id) on delete set null
);

create table compras (
	compras_id int primary key auto_increment,
    compras_num_nf varchar(100) not null,
    compras_nome varchar(100) not null,
    compras_caminho varchar (100) not null,
    compras_data_upload datetime not null default current_timestamp(),
    compras_qtd_guardada int,
    compras_quem_guardou_id int,
    foreign key (compras_quem_guardou_id) references usuarios(usuario_id) on delete set null,
    compras_tipos_movimentacoes_id int,
    foreign key (compras_tipos_movimentacoes_id) references tipos_movimentacoes(tipos_movimentacoes_id) on delete set null,
    compras_fornecedor_id int,
    foreign key (compras_fornecedor_id) references fornecedores(fornecedores_id) on delete set null
);

create table permutas (
	permutas_id int primary key auto_increment,
    permutas_operador int,
    foreign key (permutas_operador) references usuarios(usuario_id) on delete set null,
    permutas_deposito_id int,
    foreign key (permutas_deposito_id) references deposito(deposito_id) on delete set null,
    permutas_qtd_retirado int,
    permutas_oid_operacao varchar (50),
    permutas_instituicao_id int,
    foreign key (permutas_instituicao_id) references instituicoes(instituicoes_id) on delete set null,
    permutas_validade_retirado date,
    permutas_estoques_id_retirado int,
    foreign key (permutas_estoques_id_retirado) references estoques(estoques_id) on delete set null,
    permutas_insumos_id_cadastrado int,
    foreign key (permutas_insumos_id_cadastrado) references insumos(insumos_id) on delete set null,
    permutas_insumos_validade_cadastrado date not null,
    permutas_insumos_qtd_cadastrado int not null,
    permutas_estoques_id_cadastrado int,
    foreign key (permutas_estoques_id_cadastrado) references estoques(estoques_id) on delete set null,
    permutas_data datetime not null default current_timestamp()
);

create table doacoes (
	doacoes_id int primary key auto_increment,
    doacoes_data_operacao datetime not null default current_timestamp(),
    doacoes_qtd_doada int not null,
    doacoes_oid_operacao varchar (50),
    doacoes_tipos_movimentacoes_id int,
    foreign key (doacoes_tipos_movimentacoes_id) references tipos_movimentacoes(tipos_movimentacoes_id) on delete set null,
    doacoes_quem_guardou_id int,
    foreign key (doacoes_quem_guardou_id) references usuarios(usuario_id) on delete set null,
    doacoes_insumos_id int,
    foreign key(doacoes_insumos_id) references insumos(insumos_id) on delete set null,
    doacoes_fornecedor_id int,
    foreign key (doacoes_fornecedor_id) references fornecedores(fornecedores_id) on delete set null,
    doacoes_estoque_id int,
    foreign key (doacoes_estoque_id) references estoques(estoques_id) on delete set null
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

######################################################

# Atualiza Dispensario depois de aprovar uma requisicao
DELIMITER $$

CREATE PROCEDURE updateDispensarioQtd(IN novaQuantidade int, IN id_dispensario int)
BEGIN
	UPDATE
		dispensario
	SET
		dispensario_qtd = novaQuantidade
	WHERE dispensario_id = id_dispensario;

END$$

DELIMITER ;