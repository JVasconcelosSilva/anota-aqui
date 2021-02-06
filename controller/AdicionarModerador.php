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
}
