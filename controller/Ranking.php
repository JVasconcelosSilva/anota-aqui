<?php
include_once 'Jogador.php';

class Ranking extends connection
{

    public function __construct($nome)
    {
        $this->nome = $nome;
    }

    public function cadastrarRanking($nmRanking, $icPrivacidade, $ieModalidade, $idUsuario)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $sql = "INSERT INTO Ranking (nm_ranking, dt_criacao, ic_privacidade, ie_modalidade, fk_id_administrador) 
        VALUES ('$nmRanking', curdate(), $icPrivacidade, $ieModalidade, (select id_administrador from administrador where fk_id_usuario = $idUsuario))";

        mysqli_query($con, $sql);

        $connection->CloseCon($con);

    }

    public function getRankingsUsuario($idUsuario)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $sql = "SELECT id_ranking, nm_ranking, dt_criacao, ic_privacidade, ie_modalidade FROM Ranking WHERE fk_id_administrador = (select id_administrador from administrador where fk_id_usuario = $idUsuario)";

        $result = mysqli_query($con, $sql);

        $connection->CloseCon($con);

        return $result;
    }

    public function getRankingsModerados($idUsuario)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $sql = "SELECT r.id_ranking, r.nm_ranking
                FROM Ranking r
                INNER JOIN ranking_moderador rm ON rm.Ranking_id_ranking = r.id_ranking
                INNER JOIN moderador m ON m.id = rm.Moderador_id 
                INNER JOIN usuario u ON u.id_usuario = m.fk_id_usuario
                WHERE u.id_usuario = $idUsuario";

        $result = mysqli_query($con, $sql);

        $connection->CloseCon($con);

        return $result;
    }

    public function sairModerador($idUsuario, $idRanking)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $query = new Jogador("jogador");

        $jogadores = $query->getJogadoresRanking($idRanking);

        foreach ($jogadores as $jogador) {
            $query->excluirJogador($jogador['id_jogador'], $idRanking);
        }

        $sql = "DELETE FROM Ranking WHERE id_ranking = $idRanking";

        mysqli_query($con, $sql);

        $connection->CloseCon($con);
    }

    public function excluirRanking($idUsuario, $idRanking)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $query = new Jogador("jogador");

        $jogadores = $query->getJogadoresRanking($idRanking);

        foreach ($jogadores as $jogador) {
            $query->excluirJogador($jogador['id_jogador'], $idRanking);
        }

        $sql = "DELETE FROM Ranking WHERE id_ranking = $idRanking";

        mysqli_query($con, $sql);

        $connection->CloseCon($con);
    }

    public function updateRanking($idRanking, $nmRanking, $icPrivacidade)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $sql = "UPDATE Ranking SET nm_ranking = '$nmRanking', ic_privacidade = $icPrivacidade WHERE id_ranking = $idRanking";

        mysqli_query($con, $sql);

        $connection->CloseCon($con);
    }

    public function getRankings()
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        //$sql = "SELECT a.id_ranking, a.nm_ranking, a.dt_criacao, a.ic_privacidade, u.nm_usuario FROM ranking a, usuario u WHERE a.id_usuario = u.id_usuario AND a.ic_privacidade = '1'";
        $sql = "SELECT r.id_ranking, r.nm_ranking, r.dt_criacao, r.ic_privacidade, r.ie_modalidade, u.nm_usuario FROM Ranking r, Usuario u WHERE r.fk_Usuario_id_usuario = u.id_usuario AND r.ic_privacidade = 0";

        $result = mysqli_query($con, $sql);

        $connection->CloseCon($con);

        return $result;
    }

    public function getRankingsByName($name)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        //$sql = "SELECT a.id_ranking, a.nm_ranking, a.dt_criacao, a.ic_privacidade, u.nm_usuario FROM ranking a, usuario u WHERE a.id_usuario = u.id_usuario AND a.ic_privacidade = '1' AND a.nm_ranking LIKE '$name%'";
        $sql = "SELECT r.id_ranking, r.nm_ranking, r.dt_criacao, r.ic_privacidade, r.ie_modalidade, u.nm_usuario FROM Ranking r, Usuario u WHERE r.fk_Usuario_id_usuario = u.id_usuario AND r.ic_privacidade = 0 AND r.nm_ranking LIKE '$name%'";

        $result = mysqli_fetch_assoc($result = mysqli_query($con, $sql));

        $connection->CloseCon($con);

        return $result;
    }

    public function getDonoRanking($idRanking)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        //$sql = "SELECT id_usuario FROM ranking WHERE id_ranking = '$idRanking'";

        $sql = "SELECT fk_id_administrador FROM Ranking WHERE id_ranking = $idRanking";

        $result = mysqli_query($con, $sql);

        $connection->CloseCon($con);

        return $result;
    }
}
