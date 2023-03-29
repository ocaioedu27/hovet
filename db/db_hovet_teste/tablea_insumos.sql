use dbhovetTeste;
show tables;

create table tipos_insumos (
	id int primary key auto_increment,
    tipo varchar(100) not null);

insert into tipos_insumos values
	(null, "Medicamentos"),
    (null, "Materiais de procedimentos médicos");
    
select * from tipos_insumos;
    
create table insumos(
	id int primary key auto_increment,
    nome varchar(256) not null,
    unidade varchar(150) not null,
    insumo_tipo_ID int not null,
    foreign key(insumo_tipo_ID) references tipos_insumos(id)
);
    
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

SELECT i.id, i.nome, i.unidade, t.tipo 
                            FROM insumos AS i
                            INNER JOIN tipos_insumos AS t
                            on i.insumo_tipo_ID = t.id;
select * from insumos;

drop table insumos;

drop table tipos_insumos;

show tables;
