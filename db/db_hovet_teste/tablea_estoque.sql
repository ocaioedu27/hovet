use dbhovetTeste;

create table tipos_movimentacao(
	id int primary key auto_increment,
    tipo varchar(256),
    Descricao varchar(256)
);

insert into tipos_movimentacao values
	(null,"Inserção", "Inserção de insumo(s) no estoque."),
    (null,"Retirada", "Retirada de insumo(s) do estoque."),
    (null,"Doação", "Doação de insumo(s) que irão para o estoque."),
    (null,"Permuta", "Troca de insumo(s) do estoque com outras instituições.");
    
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


select 
	id,
    nome_insumoNome as nome,
    quantidade,
    CASE
        WHEN tipo_insumoTipo='1' THEN 'Medicamento'
        WHEN tipo_insumoTipo='2' THEN 'Materiais de procedimentos médicos'
    ELSE
        'NÃO ESPECIFICADO'
    END AS tipo,
    setor,
    date_format(validade, "%d/%m/%Y") as validade,
    datediff(validade, curdate()) as diasParaVencimento from deposito;
    
    
Select datediff(validade, curdate()) as diaVencimento from deposito where id=2;

SELECT 
	count(id) as vencidos
    FROM deposito where validade<=curdate() or validade <= curdate() + interval 30 day;
    
select * from deposito;

select * from (select tipo from tipos_insumos) ism;

delete from deposito where id=4;

drop table deposito;
