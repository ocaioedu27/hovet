
use dbhovetTeste;

create table usuarios(
	id int primary key auto_increment,
    nome varchar(100),
    mail varchar(100),
    tipo_usuario varchar(50),
    cpf varchar(11)
);

insert into usuarios values
	(null, "Caio Silva", "caiosilva@mail.com", "veterinario(a)", "11111111111"),
	(null, "Beatriz Andrade", "beaandrade@mail.com", "professor(a)", "22222222222");

select * from usuarios;

update usuarios set cpf="11111111111" where id=1;
update usuarios set cpf="22222222222" where id=2;

drop table usuarios;



