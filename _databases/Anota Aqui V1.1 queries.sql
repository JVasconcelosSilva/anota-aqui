use anota_aqui_v1_1;

select * from usuario;
select * from administrador;
select * from Ranking;
select * from jogadores_ranking;

delete from ranking where fk_id_administrador = 5;

INSERT INTO usuario (nm_usuario, nm_email, nm_senha) VALUES('Db Test 1','dbTest1@dbTest1','dbTest1');
INSERT INTO administrador (fk_id_usuario) VALUES ('17');

INSERT INTO administrador (fk_id_usuario) SELECT id_usuario FROM usuario WHERE nm_email = 'testSite3@testSite3';

delete from administrador where fk_id_usuario = 17;


insert into administrador (fk_id_usuario) values (1);
INSERT INTO Ranking (nm_ranking, dt_criacao, ic_privacidade, ie_modalidade, fk_id_administrador) VALUES ('Teste Database 1', curdate(), 1, 1, 1);


CREATE TRIGGER Tgr_Usuario_Admin AFTER INSERT
ON Usuario
FOR EACH ROW
BEGIN
	insert into administrador (fk_id_usuario) values (select LAST_INSERT_ID() from usuario)
WHERE Referencia = NEW.Produto;

BEGIN;
INSERT INTO usuario (nm_usuario, nm_email, nm_senha) VALUES('Db Test 1','dbTest1@dbTest1','dbTest1');
INSERT INTO administrador (fk_id_usuario) VALUES(1);
COMMIT;

CREATE TRIGGER after_members_insert
AFTER INSERT
ON members FOR EACH ROW
BEGIN
    IF NEW.birthDate IS NULL THEN
        INSERT INTO reminders(memberId, message)
        VALUES(new.id,CONCAT('Hi ', NEW.name, ', please update your date of birth.'));
    END IF;
    
START TRANSACTION;
INSERT INTO usuario (nm_usuario, nm_email, nm_senha) VALUES('Db Test 2','dbTest2@dbTest2','dbTest2');
-- INSERT INTO administrador (fk_id_usuario) VALUES (select max(LAST_INSERT_ID()) from usuario);
COMMIT;




delete from usuario where id_usuario = 3;

INSERT INTO Ranking (nm_ranking, dt_criacao, ic_privacidade, ie_modalidade, fk_id_administrador) VALUES ('Teste Ranking 1', curdate(), 0, 1, (select id_administrador from administrador where fk_id_usuario = 20));

select id_administrador from administrador where fk_id_usuario = 20;
   
SELECT id_ranking, nm_ranking, dt_criacao, ic_privacidade, ie_modalidade FROM Ranking WHERE fk_id_administrador = '20';
SELECT id_ranking, nm_ranking, dt_criacao, ic_privacidade, ie_modalidade FROM Ranking WHERE fk_id_administrador = (select id_administrador from administrador where fk_id_usuario = 20);
   
SELECT fk_id_administrador FROM Ranking WHERE id_ranking = 1;   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   