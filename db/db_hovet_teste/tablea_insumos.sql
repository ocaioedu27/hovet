use dbhovetTeste;
show tables;

create table tipos_insumos (
	id int auto_increment unique not null,
    tipo varchar(100) primary key not null);

insert into tipos_insumos values
	(null, "Medicamentos"),
    (null, "Materiais de procedimentos médicos");
    
select * from tipos_insumos;
    
create table insumos(
	id int primary key auto_increment,
    nome varchar(256) not null,
    unidade varchar(150) not null,
    insumo_tipo varchar(100),
    foreign key(insumo_tipo) references tipos_insumos(tipo)
);
    
INSERT INTO `insumos` (`id`, `nome`, `unidade`, `insumo_tipo`) VALUES
(null, 'Dramin', 'Caixa',  'Medicamentos'),
(null, 'Torsilax', 'Caixa', 'Medicamentos'),
(null, 'Dipirona', 'Caixa', 'Medicamentos'),
(null, 'Paracetamol', 'Caixa', 'Medicamentos'),
(null, 'Imosec', 'Caixa', 'Medicamentos'),
(null, 'Melatonina', 'Caixa', 'Medicamentos'),
(null, 'Acetona', 'Caixa', 'Materiais de procedimentos médicos'),
(null, 'Pregabalina', 'Caixa', 'Medicamentos'),
(null, 'Algodão', 'Pacote', 'Materiais de procedimentos médicos'),
(null, 'Esparadrapo', 'Caixa', 'Materiais de procedimentos médicos');


drop table insumos;

drop table tipos_insumos;

show tables;
