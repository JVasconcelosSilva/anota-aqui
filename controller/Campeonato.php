<?php
include_once 'Jogador.php';

class Campeonato extends connection
{

    public function __construct($nome)
    {
        $this->nome = $nome;
    }

    public function cadastrarCampeonato($nmCampeonato, $icPrivacidade, $ieModalidade, $idUsuario)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $sql = "INSERT INTO campeonato (nm_campeonato, dt_criacao, ic_privacidade, ie_modalidade, fk_id_administrador) 
        VALUES ('$nmCampeonato', curdate(), $icPrivacidade, $ieModalidade, (select id_administrador from administrador where fk_id_usuario = $idUsuario));
  ";

        mysqli_query($con, $sql);

        $connection->CloseCon($con);
    }

    public function getCampeonatosUsuario($idUsuario)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $sql = "SELECT id_campeonato, nm_campeonato, dt_criacao, ic_privacidade, ie_modalidade FROM campeonato WHERE fk_id_administrador = (select id_administrador from administrador where fk_id_usuario = $idUsuario)";

        $result = mysqli_query($con, $sql);

        $connection->CloseCon($con);

        return $result;
    }

    // TODO
    public function excluirCampeonato($idUsuario, $idCampeonato)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $query = new Jogador("jogador");

        $jogadores = $query->getJogadoresRanking($idCampeonato);

        foreach ($jogadores as $jogador) {
            $query->excluirJogador($jogador['id_jogador'], $idCampeonato);
        }

        $sql = "DELETE FROM Ranking WHERE id_ranking = $idCampeonato";

        //mysqli_query($con, $sql);

        $connection->CloseCon($con);
    }

    public function updateCampeonato($idCampeonato, $nmCampeonato, $icPrivacidade)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $sql = "UPDATE campeonato SET nm_campeonato = '$nmCampeonato', ic_privacidade = $icPrivacidade WHERE id_campeonato = $idCampeonato;";

        mysqli_query($con, $sql);

        $connection->CloseCon($con);
    }

    // TODO
    public function getCampeonatos()
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        //$sql = "SELECT a.id_ranking, a.nm_ranking, a.dt_criacao, a.ic_privacidade, u.nm_usuario FROM ranking a, usuario u WHERE a.id_usuario = u.id_usuario AND a.ic_privacidade = '1'";
        $sql = "SELECT r.id_ranking, r.nm_ranking, r.dt_criacao, r.ic_privacidade, r.ie_modalidade, u.nm_usuario FROM Ranking r, Usuario u WHERE r.fk_Usuario_id_usuario = u.id_usuario AND r.ic_privacidade = 0";

        $result = mysqli_query($con, $sql);

        $connection->CloseCon($con);

        return $result;
    }

    public function getCampeonatosByName($name)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $sql = "SELECT r.id_ranking, r.nm_ranking, r.dt_criacao, r.ic_privacidade, r.ie_modalidade, u.nm_usuario FROM Ranking r, Usuario u WHERE r.fk_Usuario_id_usuario = u.id_usuario AND r.ic_privacidade = 0 AND r.nm_ranking LIKE '$name%'";

        $result = mysqli_fetch_assoc($result = mysqli_query($con, $sql));

        $connection->CloseCon($con);

        return $result;
    }

    // Functions de Ranking Campeonato
    public function getRankingCampeonato()
    {
        $connection = new connection();
        $con = $connection->OpenCon();

        // $sql = "SELECT r.id_ranking, r.nm_ranking, r.dt_criacao, r.ic_privacidade, r.ie_modalidade, u.nm_usuario FROM Ranking r, Usuario u WHERE r.fk_Usuario_id_usuario = u.id_usuario AND r.ic_privacidade = 0 AND r.nm_ranking LIKE '$name%'";

        $result = mysqli_fetch_assoc($result = mysqli_query($con, $sql));

        $connection->CloseCon($con);

        return $result;
    }

    // Functions de Equipes Campeonato

    // Functions de Configurações Campeonato

    // functions de moderador, não aplicavel para campeonato
    // public function verifyDonoCampeonato($sessionId, $idRanking)
    // {

    //     $connection = new connection();
    //     $con = $connection->OpenCon();

    //     $sql = "SELECT fk_id_administrador FROM ranking WHERE id_ranking = $idRanking";

    //     // $result = mysqli_query($con, $sql);
    //     $result = mysqli_fetch_assoc($result = mysqli_query($con, $sql));

    //     $isDono = false;

    //     if ($sessionId == $result["fk_id_administrador"]) {
    //         $isDono = true;
    //     }

    //     $connection->CloseCon($con);

    //     return $isDono;
    // }

    // public function verifyIsAdmCampeonato($sessionId, $idRanking)
    // {

    //     $connection = new connection();
    //     $con = $connection->OpenCon();

    //     $sql = "SELECT DISTINCT u.id_usuario
    //             FROM ranking r
    //             inner join ranking_moderador rm ON rm.Ranking_id_ranking = r.id_ranking
    //             inner join moderador m ON m.id = rm.Moderador_id 
    //             inner join administrador a ON a.id_administrador = r.fk_id_administrador  
    //             inner join usuario u ON u.id_usuario = m.fk_id_usuario OR u.id_usuario = a.fk_id_usuario  
    //             where r.id_ranking = $idRanking";

    //     $result = mysqli_query($con, $sql);

    //     $isAdm = false;

    //     foreach ($result as $ids) {
    //         if ($sessionId == $ids['id_usuario']) {
    //             $isAdm = true;
    //         }
    //     }

    //     $connection->CloseCon($con);

    //     return $isAdm;
    // }

    // public function getCampeonatosModerados($idUsuario)
    // {

    //     $connection = new connection();
    //     $con = $connection->OpenCon();

    //     $sql = "SELECT r.id_ranking, r.nm_ranking
    //             FROM Ranking r
    //             INNER JOIN ranking_moderador rm ON rm.Ranking_id_ranking = r.id_ranking
    //             INNER JOIN moderador m ON m.id = rm.Moderador_id 
    //             INNER JOIN usuario u ON u.id_usuario = m.fk_id_usuario
    //             WHERE u.id_usuario = $idUsuario";

    //     $result = mysqli_query($con, $sql);

    //     $connection->CloseCon($con);

    //     return $result;
    // }

    // public function sairModeradorCampeonato($idUsuario, $idCampeonato)
    // {

    //     $connection = new connection();
    //     $con = $connection->OpenCon();

    //     $query = new Jogador("jogador");

    //     $jogadores = $query->getJogadoresRanking($idRanking);

    //     foreach ($jogadores as $jogador) {
    //         $query->excluirJogador($jogador['id_jogador'], $idRanking);
    //     }

    //     $sql = "DELETE FROM Ranking WHERE id_ranking = $idRanking";

    //     mysqli_query($con, $sql);

    //     $connection->CloseCon($con);
    // }
}
