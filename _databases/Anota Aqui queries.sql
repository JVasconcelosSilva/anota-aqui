use anota_aqui_v1_1;

select * from usuario;
select * from administrador;
select * from Ranking;
select * from jogadores_ranking;
select * from Ranking_Moderador;
select * from moderador;

-- Obtendo rankings moderados
SELECT r.id_ranking, r.nm_ranking, r.dt_criacao, r.ic_privacidade, r.ie_modalidade 
FROM Ranking r
inner join ranking_moderador rm on rm.Ranking_id_ranking = r.id_ranking
inner join moderador m on m.id = rm.Moderador_id 
inner join usuario u on u.id_usuario = m.fk_id_usuario
WHERE u.id_usuario = 2;


SELECT u.id_usuario, u.nm_usuario, u.nm_email, u.nm_caminho_foto 
FROM usuario u
left join moderador m on m.fk_id_usuario = u.id_usuario 
left join ranking_moderador rm on rm.Moderador_id = m.id 
-- WHERE u.nm_email = 'testSite1@testSite1'
where rm.Ranking_id_ranking = 1;

SELECT id_usuario, nm_usuario, nm_email, nm_caminho_foto 
FROM usuario 
where id_usuario not in (
select u.id_usuario 
from usuario u
left join moderador m on m.fk_id_usuario = u.id_usuario 
left join ranking_moderador rm on rm.Moderador_id = m.id 
where rm.Ranking_id_ranking = 1)
and id_usuario != (
select fk_id_administrador from Ranking where id_ranking = 
1);

SELECT id_usuario, nm_usuario, nm_email, nm_caminho_foto FROM usuario WHERE id_usuario NOT IN ( SELECT u.id_usuario FROM usuario u LEFT JOIN moderador m ON m.fk_id_usuario = u.id_usuario LEFT JOIN ranking_moderador rm ON rm.Moderador_id = m.id WHERE rm.Ranking_id_ranking = 1) AND id_usuario != ( SELECT fk_id_administrador FROM Ranking WHERE id_ranking = 1) AND nm_email = 'testSite4@testSite4';

delete from moderador where id = 13;

SELECT Moderador_id FROM Ranking_Moderador WHERE Moderador_id = (SELECT id FROM moderador WHERE fk_id_usuario = 3) AND Ranking_id_ranking = 1;
DELETE FROM Ranking_Moderador WHERE moderador_id = SELECT Moderador_id FROM Ranking_Moderador WHERE Moderador_id = (SELECT id FROM moderador WHERE fk_id_usuario = 3) AND Ranking_id_ranking = 1;

// Obter o moderador_id antes de ser deletado
select Moderador_id from Ranking_Moderador where Moderador_id = (select id from moderador where fk_id_usuario = 3) and Ranking_id_ranking = 1;
delete from Ranking_Moderador where moderador_id = $moderadorId;
delete from moderador where id = $moderadorId;

SELECT u.id_usuario, u.nm_usuario, u.nm_email, u.nm_caminho_foto FROM ranking_moderador rm
  INNER JOIN moderador m ON m.id = rm.Moderador_id 
  INNER JOIN usuario u ON u.id_usuario = m.fk_id_usuario 
  WHERE Ranking_id_ranking = 1;

delete from moderador where fk_id_usuario = 2;
delete from ranking_moderador where Ranking_id_ranking = 1;

delete from ranking where fk_id_administrador = 5;

INSERT INTO usuario (nm_usuario, nm_email, nm_senha) VALUES('Db Test 1','dbTest1@dbTest1','dbTest1');
INSERT INTO administrador (fk_id_usuario) VALUES ('17');

INSERT INTO administrador (fk_id_usuario) SELECT id_usuario FROM usuario WHERE nm_email = 'testSite3@testSite3';

delete from administrador where fk_id_usuario = 17;

desc Ranking_Moderador;

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
   
   
   
INSERT INTO moderador (fk_id_usuario) VALUES(1);
INSERT INTO ranking_moderador (Ranking_id_ranking, Moderador_id) VALUES (1, (select ID from moderador where fk_id_usuario = 1));
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   