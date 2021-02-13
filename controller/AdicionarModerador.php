<?php
include_once 'Ranking.php';

class AdicionarModerador extends connection
{

    public function __construct($nome)
    {
        $this->nome = $nome;
    }

    public function selectUsuarioByEmail($email)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $query = "SELECT id_usuario, nm_usuario, nm_email, nm_caminho_foto FROM usuario WHERE nm_email = '$email';";

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
}
