use hovet_db;

create table tipos_movimentacoes(
	tipos_movimentacoes_id int primary key auto_increment,
    tipos_movimentacoes_movimentacao varchar(256),
    tipos_movimentacoes_descricao varchar(256)
);

insert into tipos_movimentacoes values
	(null,"Compra", "Compra de insumo(s) para o Depósito."),
    (null,"Retirada", "Retirada de insumo(s) do Depósito."),
    (null,"Doação", "Doação de insumo(s) que irão para o Depósito."),
    (null,"Permuta", "Troca de insumo(s) do Depósito com outras instituições.");
    
select * from tipos_movimentacoes;

-- drop table tipos_movimentacoes;

create table movimentacoes (
	movimentacoes_id int primary key auto_increment,
    movimentacoes_origem varchar (50),
    movimentacoes_destino varchar (50),
    movimentacoes_tipos_movimentacoes_id int,
    foreign key (movimentacoes_tipos_movimentacoes_id) references tipos_movimentacoes(tipos_movimentacoes_id) on delete set null,
    movimentacoes_usuario_id int,
    foreign key (movimentacoes_usuario_id) references usuarios(usuario_id),
    movimentacoes_insumos_id int,
    foreign key (movimentacoes_insumos_id) references insumos(insumos_id),
    data_operacao datetime not null default current_timestamp()
);

show create table test.data_teste;

insert into movimentacoes 
	(movimentacoes_origem,
    movimentacoes_destino,
    movimentacoes_tipos_movimentacoes_id,
    movimentacoes_usuario_id,
    movimentacoes_insumos_id) 
    VALUE ("","",num,nummovimentacoes,num);
    
select * from movimentacoes;

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
	sum(d.dispensario_qtd) as dispensario_qtd_insumo,
    i.insumos_nome
	FROM dispensario d
    inner join deposito dep
    on d.dispensario_id = dep.deposito_id
    inner join insumos i
    on dep.deposito_insumos_id = i.insumos_id;

select * from dispensario;

SELECT 
	sum(disp.dispensario_qtd),
	i.insumos_id, 
    i.insumos_nome 
	FROM dispensario disp
	INNER JOIN deposito dep
	ON disp.dispensario_deposito_id = dep.deposito_id
	INNER JOIN insumos i
	ON dep.deposito_insumos_id = i.insumos_id
    where
    i.insumos_nome = 'Imosec';
