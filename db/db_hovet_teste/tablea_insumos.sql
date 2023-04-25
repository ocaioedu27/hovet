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
    insumos_descricao varchar(256) not null,
    insumos_tipo_insumos_id int not null,
    foreign key(insumos_tipo_insumos_id) references tipos_insumos(tipos_insumos_id)
);
    
INSERT INTO insumos (insumos_id,insumos_nome,insumos_unidade,insumos_descricao,insumos_tipo_insumos_id) VALUES
(null, 'Dramin','Caixa','Dramin 50mg Com 10 Caps Gel', 1),
(null, 'Torsilax','Caixa','Torsilax 30mg Com 30 comp', 1),
(null, 'Dipirona', 'Caixa','Dipirona Sódica 500mg 10 Comprimidos Ems Genérico', 1),
(null, 'Paracetamol','Caixa','Paracetamol 750mg 12 Comprimidos', 1),
(null, 'Imosec','Caixa','Imosec 12 Cápsulas tipo C', 1),
(null, 'Melatonina','Caixa','Melatonina Raia 0,21mg 60 Comprimidos', 1),
(null, 'Alcool','Pacote','álcool etílico hidratado 70º INPM', 2),
(null, 'Pregabalina','Caixa','Cápsulas de 75 com 150mg', 1),
(null, 'Algodão','Pacote','Pacote Algodão 500g', 2),
(null, 'Esparadrapo','Caixa','Esparadrapo Impermeável Branco 5CM X 4,5M Pacote com 12', 2);

SELECT i.insumos_id, i.insumos_nome, i.insumos_unidade, t.tipos_insumos_tipo 
                            FROM insumos AS i
                            INNER JOIN tipos_insumos AS t
                            on i.insumos_tipo_insumos_id = t.tipos_insumos_id where i.insumos_tipo_insumos_id=2 or i.insumos_unidade="%caix%";
select * from insumos;

drop table insumos;

drop table tipos_insumos;

show tables;
