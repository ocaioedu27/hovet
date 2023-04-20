
use dbhovetTeste;

create table tipo_usuario (
	tipo_usuario_id int primary key auto_increment,
    tipo_usuario_tipo varchar(100) not null
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
	usuario_id int primary key auto_increment,
    usuario_nome varchar(100) not null,
    usuario_mail varchar(100) unique not null,
    usuario_tipo_usuario_id int,
    foreign key(usuario_tipo_usuario_id) references tipo_usuario(tipo_usuario_id) on delete set null,
    usuario_siape varchar(50) unique not null,
    usuario_senha varchar(256) not null
);

insert into usuarios value
(null, "Adm", "adm@mail.com", 5, "000000000000000000000", "$2y$10$Q.86fPmUob06/fo2Jtloeu9VJf5iJqZ7upg1PP2TAQMY2Iq8OJHCC");
#usar essa senha 1234 para trocar após o primeiro login

select u.usuario_id, u.usuario_nome, u.usuario_mail, u.usuario_siape, t.tipo_usuario_tipo 
	from usuarios AS u 
    inner join tipo_usuario AS t 
    on u.usuario_tipo_usuario_id = t.tipo_usuario_id;

-- drop table usuarios;

describe usuarios;

show create table usuarios;

select * from usuarios;

