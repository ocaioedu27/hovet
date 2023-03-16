use dbhovetTeste;
show tables;

create table tipos_insumos(
	id int primary key auto_increment,
    tipo varchar(256)
);

insert into tipos_insumos values
	(null, "Medicamentos"),
    (null, "Materiais de procedimentos médicos");

create table categorias_teste (
	id int auto_increment unique not null,
    categoria varchar(100) primary key not null);

insert into categorias_teste values
	(null, "Medicamentos"),
    (null, "Materiais de procedimentos médicos");
    
create table insumos_teste (
	id int primary key not null auto_increment unique,
    nome varchar(50),
    categoria_nome varchar(100),
    foreign key(categoria_nome) references categorias_teste(categoria));
    
insert into insumos_teste values
	(null, "imosec", "Medicamentos"),
    (null, "Touca Cirurgica", "Materiais de procedimentos médicos");
    
drop tables insumos_teste, categorias_teste;

select * from insumos_teste;
    
select * from tipos_insumos;
    
create table insumos(
	id int primary key auto_increment,
    nome varchar(256) not null,
    unidade varchar(150) not null,
    insumo_tipo int,
    foreign key(insumo_tipo) references tipos_insumos(id)
);

insert into insumos values
	(null, "Dipirona", "Caixa", 1),
	(null, "Dorflex", "Caixa", 1),
	(null, "Luva cirúrgica", "Pacote", 2),
	(null, "Touca corúrgica", "Caixa", 2);

select tipo from tipos_insumos where id=2;

select * from insumos;

SELECT * FROM (SELECT nome,
    CASE
        WHEN insumo_tipo='1' THEN 'Medicamento'
        WHEN insumo_tipo='2' THEN 'Materiais de procedimentos médicos'
    ELSE
        'NÃO ESPECIFICADO'
    END AS insumo_tipo FROM insumos) ims;

delete from insumos where id=4;

drop table insumos;
