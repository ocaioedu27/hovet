use dbhovetTeste;

create table tipos_movimentacao(
	id int primary key auto_increment,
    tipo varchar(256),
    Descricao varchar(256)
);

insert into tipos_movimentacao values
	("Inserção", "Inserção de insumo(s) no estoque."),
    ("Retirada", "Retirada de insumo(s) do estoque."),
    ("Doação", "Doação de insumo(s) que irão para o estoque."),
    ("Permuta", "Troca de insumo(s) do estoque com outras instituições.");
    
select * from tipos_movimentacao;
    
create table deposito(
	id int primary key auto_increment,
    nome_insumoNome varchar(256) not null,
    quantidade int not null,
    tipo_insumoTipo int not null,
    foreign key(tipo_insumoTipo) references tipos_insumos(id),
    setor varchar(100) not null,
    validade date not null
);

insert into deposito values
	(null, 1, 21, 1, "Setor 1", "2023-03-01"),
	(null, 2, 22, 2, "Setor 3", "2023-11-18"),
	(null, 3, 6, 3, "Setor 2", "2023-09-10"),
	(null, 4, 43, 4, "Setor 4", "2023-11-04");

select * from deposito;

SELECT validade, DATEDIFF(DAY, validade, GETDATE()) AS dayToVencimento from deposito;

select * from (select nome from insumos) ism;

delete from deposito where id=4;

drop table deposito;
