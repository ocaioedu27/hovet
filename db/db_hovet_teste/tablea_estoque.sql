use dbhovetTeste;

create table tipos_movimentacao(
	id int primary key auto_increment,
    tipo varchar(256),
    Descricao varchar(256)
);

insert into tipos_movimentacao values
	(null,"Inserção", "Inserção de insumo(s) no estoque."),
    (null,"Retirada", "Retirada de insumo(s) do estoque."),
    (null,"Doação", "Doação de insumo(s) que irão para o estoque."),
    (null,"Permuta", "Troca de insumo(s) do estoque com outras instituições.");
    
select * from tipos_movimentacao;

#################################################################################

## Depósito ##

create table setores (
	id int auto_increment not null unique,
    setor varchar(100) primary key not null
);

insert into setores values
	(null, 'Clínica'),
    (null, 'Anestesia'),
    (null, 'Grandes Animais');
    
create table deposito(
	id int primary key auto_increment,
    nome varchar(256) not null,
    quantidade int not null,
    tipo_insumoTipo varchar(100) not null,
    foreign key(tipo_insumoTipo) references tipos_insumos(tipo),
    setor_Setor varchar(100) not null,
    foreign key(setor_Setor) references setores(setor),
    validade date not null
);

INSERT INTO `deposito` (`id`, `nome`, `quantidade`, `tipo_insumoTipo`, `setor_Setor`, `validade`) VALUES
(null, 'Dorflex', 10, 'Medicamentos', 'Clínica', '2023-03-25'),
(null, 'Luva cirúrgica', 5, 'Materiais de procedimentos médicos', 'Clínica', '2023-03-01'),
(null, 'Touca corúrgica', 8, 'Medicamentos', 'Anestesia', '2023-04-24'),
(null, 'Paracetamol', 2, 'Medicamentos', 'Clínica', '2023-05-10'),
(null, 'Dipirona', 5, 'Medicamentos', 'Anestesia', '2023-04-14'),
(null, 'Torsilax', 12, 'Medicamentos', 'Grandes Animais', '2023-04-01'),
(null, 'Paracetamol', 8, 'Medicamentos', 'Clínica', '2023-04-27'),
(null, 'Acetona', 12, 'Materiais de procedimentos médicos', 'Anestesia', '2023-05-24'),
(null, 'Melatonina', 5, 'Medicamentos', 'Grandes Animais', '2023-05-12'),
(null, 'Imosec', 8, 'Medicamentos', 'Anestesia', '2023-07-06'),
(null, 'Pregabalina', 12, 'Medicamentos', 'Clínica', '2023-04-05'),
(null, 'Acetona', 5, 'Materiais de procedimentos médicos', 'Grandes Animais', '2023-06-09'),
(null, 'Melatonina', 8, 'Medicamentos', 'Anestesia', '2023-06-14');

SELECT 
	count(id) as vencidos
    FROM deposito where validade<=curdate() or validade <= curdate() + interval 30 day;
    
select * from deposito;

drop table deposito;
