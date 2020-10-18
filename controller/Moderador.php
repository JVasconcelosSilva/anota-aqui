<?php

include_once 'Connection.php';
include_once 'Ranking.php';

class Moderador extends connection {

    public function __construct($nome) {
        $this->nome = $nome;
    }

    public function cadastrarModerador($idArtilharia, $idUsuario, $idDono) {
        
		$connection = new connection();
		$con = $connection->OpenCon();

        $sql = "INSERT INTO moderador (id_artilharia, id_usuario, id_dono)
        VALUES ('$idArtilharia', '$idUsuario', $idDono)";
        
        mysqli_query($con, $sql);
		if(mysqli_errno($con)){
			throw new exception(mysqli_errno($con));
		}

        $connection->CloseCon($con);
    }

    public function getModeradores($idArtilharia, $idDono){
        
		$connection = new connection();
		$con = $connection->OpenCon();

        $sql = "SELECT m.id_moderador, m.id_usuario, u.nm_usuario FROM usuario u, moderador m WHERE m.id_usuario = u.id_usuario AND m.id_artilharia = $idArtilharia AND m.id_dono = $idDono";

        $result = mysqli_query($con, $sql);

        $connection->CloseCon($con);

        return $result;

    }

    public function excluirModerador($idArtilharia, $idModerador){
        
		$connection = new connection();
		$con = $connection->OpenCon();

        $sql = "DELETE FROM moderador WHERE id_moderador = $idModerador AND id_artilharia = $idArtilharia";

        mysqli_query($con, $sql);

        $connection->CloseCon($con);
        
    }

}
