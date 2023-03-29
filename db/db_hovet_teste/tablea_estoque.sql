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
	id int primary key auto_increment,
    setor varchar(100) not null
);

insert into setores values
	(null, 'Clínica'),
    (null, 'Anestesia'),
    (null, 'Grandes Animais');
    
#drop table setores;
    
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

SELECT 
	count(id) as vencidos
    FROM deposito where validade<=curdate() or validade <= curdate() + interval 30 day;
    
select * from deposito;

SELECT d.id, d.nome, d.quantidade, date_format(d.validade, '%d/%m/%Y') AS validade, tpIn.tipo, s.setor
	FROM deposito AS d 
    INNER JOIN tipos_insumos AS tpIn 
    ON d.tipo_tipoInsumos_ID = tpIn.id 
    INNER JOIN setores AS s ON d.setor_setorID = s.id;

drop table deposito;
