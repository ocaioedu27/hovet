
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
#usar essa senha 'teste' para trocar após o primeiro login

select u.id, u.nome, u.mail, u.cpf, t.tipo 
	from usuarios AS u 
    inner join tipo_usuario AS t 
    on u.tipo_usuario_ID = t.id;

select us.id, us.nome, us.mail, tp.tipo, us.cpf from usuarios AS us, tipo_usuario as tp WHERE us.tipo_usuario_ID = tp.id;

-- drop table usuarios;

describe usuarios;

show create table usuarios;

select * from usuarios;

