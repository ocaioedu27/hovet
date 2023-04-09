
use dbhovetTeste;

CREATE TABLE deposito_audit (
	id int PRIMARY KEY NOT NULL auto_increment,
    insumo_id int not null,
    old_quantidade int not null,
    new_quantidade int not null,
    dataAlteracao datetime DEFAULT NULL,
    action varchar(50) DEFAULT NULL
    );
    
drop table deposito_audit;
    
DELIMITER $$

CREATE TRIGGER before_insumo_update
	BEFORE UPDATE ON deposito FOR EACH ROW BEGIN
    INSERT INTO deposito_audit
    SET action = 'update',
    insumo_id = OLD.id,
    old_quantidade = OLD.quantidade,
    new_quantidade = NEW.quantidade,
    dataAlteracao = NOW();
END$$

DELIMITER ;

# Atualiza Deposito
DELIMITER $$

CREATE TRIGGER before_deposito_to_dispensario_update
	BEFORE UPDATE ON dispensario FOR EACH ROW BEGIN
    UPDATE Deposito set
    deposito_Qtd
END$$

DELIMITER ;

drop trigger before_insumo_update;

select * from deposito_audit;

show tables;