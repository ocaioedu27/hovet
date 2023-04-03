
use dbhovetTeste;

create table tipo_usuario (
	id int primary key auto_increment,
    tipo varchar(100) not null
);

insert into tipo_usuario values
	(null, 'Médico(a) Veterinário(a)'),
    (null, 'Responsável pelas compras'),
    (null, 'Responsável pelo estoque'),
    (null, 'Professor(a)'),
    (null, 'Diretor(a) do HOVET');
    
select * from tipo_usuario;

drop table tipo_usuario;

create table usuarios(
	id int primary key auto_increment not null,
    nome varchar(100) not null,
    mail varchar(100) unique not null,
    tipo_usuario_ID int not null,
    foreign key(tipo_usuario_ID) references tipo_usuario(id),
    siape varchar(50) unique not null,
    senha varchar(256) not null
);

alter table usuarios DROP foreign key usuarios_ibfk_1;

alter table usuarios drop column tipo_usuario_Tipo;

alter table usuarios add column tipo_usuario_ID int not null;

alter table usuarios add constraint usuarios_fk
	foreign key (tipo_usuario_Tipo)
    references tipo_usuario(id);

insert into usuarios value
(null, "ADM", "adm@mail.com", "5", "00000000000", "teste");
#usar essa senha 'teste' para trocar após o primeiro login

select * from dbhovetTeste.usuarios;

select u.id, u.nome, u.mail, u.cpf, t.tipo 
	from usuarios AS u 
    inner join tipo_usuario AS t 
    on u.tipo_usuario_ID = t.id;

select us.id, us.nome, us.mail, tp.tipo, us.cpf from usuarios AS us, tipo_usuario as tp WHERE us.tipo_usuario_ID = tp.id;

drop table usuarios;

describe usuarios;

show create table usuarios;


