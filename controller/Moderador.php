<?php
include_once 'Connection.php';
include_once 'Ranking.php';

class Moderador extends connection
{

    public function __construct($nome)
    {
        $this->nome = $nome;
    }

    public function selectUsuarioByEmail($idRanking, $email)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        //$query = "SELECT id_usuario, nm_usuario, nm_email, nm_caminho_foto FROM usuario WHERE nm_email = '$email';";

        $query = "SELECT id_usuario, nm_usuario, nm_email, nm_caminho_foto 
                    FROM usuario 
                    WHERE id_usuario NOT IN (
                        SELECT u.id_usuario 
                        FROM usuario u
                        LEFT JOIN moderador m ON m.fk_id_usuario = u.id_usuario 
                        LEFT JOIN ranking_moderador rm ON rm.Moderador_id = m.id 
                        WHERE rm.Ranking_id_ranking = $idRanking)
                    AND id_usuario != (
                        SELECT fk_id_administrador 
                        FROM Ranking 
                        WHERE id_ranking = $idRanking)
                    AND nm_email = '$email'";

        $result = $con->query($query);

        // if ($result->num_rows > 0) {
        //     while ($row = $result->fetch_assoc()) {
        //         $retorno = $row;
        //     }
        // } else {
        //     $retorno = null;
        // }

        $connection->CloseCon($con);
        return $result;
    }

    public function getModeradoresRanking($idRanking)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $query = "SELECT u.id_usuario, u.nm_usuario, u.nm_email, u.nm_caminho_foto FROM ranking_moderador rm
                  INNER JOIN moderador m ON m.id = rm.Moderador_id 
                  INNER JOIN usuario u ON u.id_usuario = m.fk_id_usuario 
                  WHERE Ranking_id_ranking = $idRanking;";

        $result = $con->query($query);

        // if ($result->num_rows > 0) {
        //     while ($row = $result->fetch_assoc()) {
        //         $retorno = $row;
        //     }
        // } else {
        //     $retorno = null;
        // }

        $connection->CloseCon($con);
        return $result;
    }

    public function adicionarModerador($idRanking, $idUsuarioModerador)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $query = "INSERT INTO moderador (fk_id_usuario) VALUES($idUsuarioModerador)";

        if ($con->query($query) === FALSE) {
            throw new Exception($con->error);
        }

        // Após inserir na tabela moderador, inserir na tabela Ranking_Moderador
        $query = "INSERT INTO ranking_moderador (Ranking_id_ranking, Moderador_id) VALUES ($idRanking, (SELECT id FROM moderador WHERE fk_id_usuario = $idUsuarioModerador))";

        if ($con->query($query) === FALSE) {
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $connection->CloseCon($con);
    }

    public function removerModerador($idRanking, $idUsuarioModerador)
    {

        // throw new Exception($idRanking, $idUsuarioModerador);
        $connection = new connection();
        $con = $connection->OpenCon();

        $query = "SELECT Moderador_id FROM Ranking_Moderador WHERE Moderador_id = (SELECT id FROM moderador WHERE fk_id_usuario = $idUsuarioModerador) AND Ranking_id_ranking = $idRanking";

        if ($con->query($query) === FALSE) {
            throw new Exception($con->error);
        }

        $result = mysqli_fetch_assoc($con->query($query));
        $moderadorId = $result["Moderador_id"];

        $query = "DELETE FROM Ranking_Moderador WHERE moderador_id = $moderadorId";

        if ($con->query($query) === FALSE) {
            throw new Exception($con->error);
        }

        $query = "DELETE FROM moderador WHERE id = $moderadorId";

        if ($con->query($query) === FALSE) {
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $connection->CloseCon($con);
    }
}
