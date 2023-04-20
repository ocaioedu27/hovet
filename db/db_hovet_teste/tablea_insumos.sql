use dbhovetTeste;
show tables;

create table tipos_insumos (
	tipos_insumos_id int primary key auto_increment,
    tipos_insumos_tipo varchar(100) not null);

insert into tipos_insumos values
	(null, "Medicamentos"),
    (null, "Material de procedimento"),
    (null, "Medicamentos controlados");
    
-- drop table tipos_insumos;
    
create table insumos(
	insumos_id int primary key auto_increment,
    insumos_nome varchar(256) not null,
    insumos_unidade varchar(150) not null,
    insumos_tipo_insumos_id int not null,
    foreign key(insumos_tipo_insumos_id) references tipos_insumos(tipos_insumos_id)
);
    
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

SELECT i.insumos_id, i.insumos_nome, i.insumos_unidade, t.tipos_insumos_tipo 
                            FROM insumos AS i
                            INNER JOIN tipos_insumos AS t
                            on i.insumos_tipo_insumos_id = t.tipos_insumos_id where i.insumos_tipo_insumos_id=2 or i.insumos_unidade="%caix%";
select * from insumos;

drop table insumos;

drop table tipos_insumos;

show tables;
