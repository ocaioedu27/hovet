
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

# Atualiza Deposito depois de passar insumo para o dispensario
DELIMITER $$

CREATE TRIGGER after_deposito_from_dispensario
	AFTER INSERT 
    ON dispensario
    FOR EACH ROW
    BEGIN
		UPDATE deposito as deps set
		deposito_qtd = deposito_qtd - NEW.dispensario_qtd
		WHERE deposito_id = NEW.dispensario_deposito_id;
END$$

DELIMITER ;

# Atualiza movimentacoes depois de deletar insumo do deposito
DELIMITER $$

CREATE TRIGGER before_deposito_delete
	BEFORE DELETE
    ON deposito
    FOR EACH ROW
    BEGIN
		INSERT INTO movimentacoes;
END$$

DELIMITER ;

drop trigger after_deposito_from_dispensario;

select * from deposito_audit;

show tables;