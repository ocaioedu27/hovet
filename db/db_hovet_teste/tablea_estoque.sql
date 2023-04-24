use hovet_db;

create table tipos_movimentacoes(
	tipos_movimentacoes_id int primary key auto_increment,
    tipos_movimentacoes_movimentacao varchar(256),
    tipos_movimentacoes_descricao varchar(256)
);

insert into tipos_movimentacoes values
	(null,"Inserção", "Inserção de insumo(s) no estoque."),
    (null,"Retirada", "Retirada de insumo(s) do estoque."),
    (null,"Doação", "Doação de insumo(s) que irão para o estoque."),
    (null,"Permuta", "Troca de insumo(s) do estoque com outras instituições.");
    
select * from tipos_movimentacoes;

drop table tipos_movimentacoes;

#################################################################################

## Depósito ##

create table setores (
	setores_id int primary key auto_increment,
    setores_setor varchar(100) not null
);

insert into setores values
	(null, 'Clínica'),
    (null, 'Anestesia'),
    (null, 'Grandes Animais');
    
drop table setores;
    
create table deposito(
	deposito_id int primary key auto_increment,
    deposito_qtd int not null,
    deposito_validade date not null,
    deposito_insumos_id int,
	foreign key(deposito_insumos_id) references insumos(insumos_id) on delete set null
);

insert into deposito values 
	(null, 20, '2023-04-05', 1),
    (null, 10, '2023-04-09', 3);


SELECT 
	count(id) as vencidos
    FROM deposito where validade<=curdate() or validade <= curdate() + interval 30 day;
    
select * from deposito;

SELECT
	d.deposito_id,
	i.nome,
    d.deposito_Qtd,
    date_format(d.deposito_Validade, '%d/%m/%Y') AS validade,
    datediff(d.deposito_Validade, curdate()) as diasParaVencimento
	FROM deposito AS d 
    INNER JOIN insumos AS i
    ON d.deposito_id = i.id;

drop table deposito;


##### Dispensario ####

create table local_dispensario (
	local_id int primary key not null auto_increment,
    local_nome varchar (20) not null
);
-- drop table local_dispensario;
insert into local_dispensario values
	(null, 'Armário'),
	(null, 'Estante'),
	(null, 'Gaveteiro');

create table dispensario(
	dispensario_id int primary key auto_increment,
    dispensario_qtd int not null,
    dispensario_validade date not null,
    dispensario_deposito_id int,
	foreign key(dispensario_deposito_id) references deposito(deposito_id) on delete cascade,
    dispensario_local_id int not null,
    foreign key(dispensario_local_id) references local_dispensario(local_id)
);

drop table dispensario;

insert into dispensario values 
	(null, 10, '2023-04-06', 2, 2);

delete from dispensario where dispensario_id = 2;


SELECT
	d.dispensario_id,
	d.dispensario_Qtd,
	date_format(d.dispensario_Validade, '%d/%m/%Y') as validadeDispensario,
    i.nome,
    datediff(d.dispensario_Validade, curdate()) as diasParaVencimentoDispensario,
    lcd.local_nome
	FROM dispensario d 
    INNER JOIN insumos i 
    #ON d.dispensario_depositoId = i.id
    INNER JOIN deposito deps
    ON deps.deposito_InsumosID = i.id
    INNER JOIN local_dispensario lcd 
    ON d.dispensario_localId = lcd.local_id;
    
SELECT 
	disp.dispensario_id,
	disp.dispensario_Qtd,
	date_format(disp.dispensario_Validade, '%d/%m/%Y') AS validadeDispensario,
    i.nome,
    datediff(disp.dispensario_Validade, curdate()) AS diasParaVencimentoDispensario,
    lcd.local_nome
    FROM dispensario disp
	INNER JOIN deposito deps
    ON disp.dispensario_depositoId = deps.deposito_id
    INNER JOIN insumos i
    ON deps.deposito_InsumosID = i.id
    INNER JOIN local_dispensario lcd 
    ON disp.dispensario_localId = lcd.local_id;


select * from dispensario;

delete from dispensario where dispensario_id=4;


SELECT
	dep.deposito_validade,
	dep.deposito_qtd,
	dep.deposito_id,
	ins.insumos_nome 
	FROM deposito dep 
	INNER JOIN insumos ins 
	ON dep.deposito_insumos_id = ins.insumos_id;
    
select * from deposito;

-- update deposito dep 
-- 	inner join dispensario disp 
--     set 
-- 		dep.deposito_Qtd = dep.deposito_Qtd-disp;
        
select distinct i.insumos_id, i.insumos_nome 
	from deposito d
    inner join insumos i
    on d.deposito_insumos_id = i.insumos_id;
    
SELECT DISTINCT i.insumos_id, i.insumos_nome 
                            FROM dispensario disp
                            INNER JOIN insumos i
                            INNER JOIN deposito dep
                            ON dep.deposito_insumos_id = i.insumos_id;

SELECT 
	sum(d.dispensario_qtd) as dispensario_qtd_insumo
	FROM dispensario d
    inner join deposito dep
    inner join insumos i
    on dep.deposito_insumos_id = i.insumos_id;

select * from dispensario;

select sum(deposito_qtd) from deposito where deposito_insumos_id=1;


select sum(quantidade) from deposito WHERE nome like '%mela%' or id=2;
