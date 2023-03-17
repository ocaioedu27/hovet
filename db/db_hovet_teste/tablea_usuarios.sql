
use dbhovetTeste;

create table tipo_usuario (
	id int auto_increment unique not null,
    tipo varchar(100) primary key not null
);

insert into tipo_usuario values
	(null, 'Médico(a) Veterinário(a)'),
    (null, 'Responsável pelas compras'),
    (null, 'Responsável pelo estoque'),
    (null, 'Professor(a)'),
    (null, 'Diretor(a) do HOVET');
    
select * from tipo_usuario;

create table usuarios(
	id int primary key auto_increment not null,
    nome varchar(100) not null,
    mail varchar(100) unique not null,
    tipo_usuario_Tipo varchar(100) not null,
    foreign key(tipo_usuario_Tipo) references tipo_usuario(tipo),
    cpf varchar(11) unique not null,
    senha varchar(256) not null
);

insert into usuarios value
(null, "ADM", "adm@mail.com", "Diretor(a) do HOVET", "01234567891", "1234");

select * from usuarios;

drop table usuarios;



