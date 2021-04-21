use anota_aqui;

select * from usuario;
select * from administrador;
select * from Ranking;
select * from jogadores_ranking;
select * from Ranking_Moderador;
select * from moderador;

-- Consultar um ranking passando o id do ranking para a function
select p.* from (select @getJogadoresRanking:=1 f) s, vw_ranking p;
-- Consultar um jogador no ranking
select p.* from (select @getJogadoresRanking:=1 f) s, vw_ranking p where p.nm_jogador = 'testJogador4';

-- Obtendo rankings moderados
SELECT r.id_ranking, r.nm_ranking, r.dt_criacao, r.ic_privacidade, r.ie_modalidade 
FROM Ranking r
inner join ranking_moderador rm on rm.Ranking_id_ranking = r.id_ranking
inner join moderador m on m.id = rm.Moderador_id 
inner join usuario u on u.id_usuario = m.fk_id_usuario
WHERE u.id_usuario = 2;

select fk_id_administrador from ranking where id_ranking = 1;

SELECT distinct u.id_usuario
FROM ranking r
inner join ranking_moderador rm on rm.Ranking_id_ranking = r.id_ranking
inner join moderador m on m.id = rm.Moderador_id 
inner join administrador a on a.id_administrador = r.fk_id_administrador  
inner join usuario u on u.id_usuario = m.fk_id_usuario or u.id_usuario = a.fk_id_usuario  
where r.id_ranking = 1;

SELECT DISTINCT u.id_usuario 
FROM ranking r 
inner join ranking_moderador rm ON rm.Ranking_id_ranking = r.id_ranking 
inner join moderador m ON m.id = rm.Moderador_id 
inner join administrador a ON a.id_administrador = r.fk_id_administrador 
inner join usuario u ON u.id_usuario = m.fk_id_usuario OR u.id_usuario = a.fk_id_usuario 
where r.id_ranking = 1;

SELECT u.id_usuario, u.nm_usuario, u.nm_email, u.nm_caminho_foto 
FROM ranking r
inner join administrador a on a.id_administrador = r.fk_id_administrador  
inner join usuario u on u.id_usuario = a.fk_id_usuario
where r.id_ranking = 1;


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
   
   
-- Consultas da classe Campeonato

alter table campeonato 
modify column 
id_campeonato INT PRIMARY KEY auto_increment;
commit;

alter table times add constraint fk_Times_Campeonato
    FOREIGN KEY (fk_id_campeonato)
    REFERENCES Campeonato (id_campeonato);
   
   CREATE TABLE IF NOT EXISTS Times (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nome VARCHAR(50) NULL);
 
 alter table ranking_campeonato add column fk_times_id INT NOT NULL;
 
 alter table ranking_campeonato add constraint fk_Ranking_campeonato_Times
    FOREIGN KEY (fk_times_id)
    REFERENCES Times (id);
 

select * from campeonato;
select * from ranking_campeonato;
select * from partida;
select * from pontos_partida;
select * from jogadores_times;

insert into ranking_campeonato (nome, pontos, vitorias, empates, derrotas, gols_feitos, gols_sofridos, saldo_gols, fk_id_campeonato, Partida_id_partida)
 values ('testTime1', 0, 0, 0, 0, 0, 0, 0, 4, null);

-- Criar campeonato -- ok
INSERT INTO campeonato (nm_campeonato, dt_criacao, ic_privacidade, ie_modalidade, fk_id_administrador) 
        VALUES ('$nmRanking', curdate(), $icPrivacidade, $ieModalidade, (select id_administrador from administrador where fk_id_usuario = $idUsuario));
  
-- getCampeonatosUsuario -- ok
SELECT id_campeonato, nm_campeonato, dt_criacao, ic_privacidade, ie_modalidade FROM campeonato WHERE fk_id_administrador = (select id_administrador from administrador where fk_id_usuario = $idUsuario);




-- excluirCampeonato
-- Dependente de outras classes


-- updateCampeonato
UPDATE campeonato SET nm_campeonato = '$nmRanking', ic_privacidade = $icPrivacidade WHERE id_campeonato = $idCampeonato;


-- getCampeonatos
SELECT c.id_campeonato, c.nm_campeonato, c.dt_criacao, c.ic_privacidade, c.ie_modalidade, u.nm_usuario FROM campeonato c, Usuario u WHERE c.fk_Usuario_id_usuario = u.id_usuario AND c.ic_privacidade = 0;

-- TODO fk_usuario_id_usuario n�o reconhecido
-- getCampeonatosByName
SELECT c.id_ranking, c.nm_ranking, c.dt_criacao, r.ic_privacidade, r.ie_modalidade, u.nm_usuario FROM Ranking r, Usuario u WHERE r.fk_Usuario_id_usuario = u.id_usuario AND c.ic_privacidade = 0 AND r.nm_ranking LIKE '$name%';

SELECT fk_id_administrador FROM campeonato WHERE fk_id_administrador = $sessionId;

-- getRankingCampeonato
select t.nome, rc.* from ranking_campeonato rc
inner join campeonato c on c.id_campeonato = rc.fk_id_campeonato
inner join administrador a on a.id_administrador = c.fk_id_administrador 
inner join usuario u on u.id_usuario = a.fk_id_usuario
inner join times t on t.fk_id_ranking_campeonato = rc.id
where rc.fk_id_campeonato = 4
and u.id_usuario = $idUsuario;


-- Criar ranking campeonato
insert into ranking_campeonato (fk_id_campeonato) values (5);
-- Adicionar um time ao ranking campeonato
insert into times (nome, fk_id_ranking_campeonato) values ("testTime5", 4);
delete from ranking_campeonato where id = 5;
delete from times;

select * from ranking_campeonato rc;
select * from campeonato c;
select * from times t;
   
ALTER TABLE anota_aqui.ranking_campeonato MODIFY COLUMN Partida_id_partida int(11) DEFAULT NULL;

   alter table times add column
 fk_id_ranking_campeonato int not null;
 
 
  alter table times add CONSTRAINT fk_id_ranking_campeonato
    FOREIGN KEY (fk_id_ranking_campeonato)
    REFERENCES ranking_campeonato (id)  
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   