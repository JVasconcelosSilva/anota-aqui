<?php

include_once 'Jogador.php';

class Ranking extends connection {

    public function __construct($nome) {
        $this->nome = $nome;
    }

    public function cadastrarRanking($nmRanking, $dtCriacao, $icPrivacidade, $ieModalidade, $idUsuario) {
        
		$connection = new connection();
		$con = $connection->OpenCon();

        // $sql = "INSERT INTO ranking (nm_ranking, dt_criacao, ic_privacidade, id_usuario)
        // VALUES ('$nmRanking', '$dtCriacao', '$icPrivacidade', '$idUsuario')";

        $sql = "INSERT INTO Ranking (nm_ranking, dt_criacao, ic_privacidade, ie_modalidade, fk_Usuario_id_usuario) 
        VALUES ('$nmRanking', curdate(), $icPrivacidade, $ieModalidade, $idUsuario)";
        
         mysqli_query($con, $sql);
		// if(mysqli_errno($con)){
		// 	throw new exception(mysqli_errno($con));
        // }
        
        //throw Exception("INSERT INTO Ranking (nm_ranking, dt_criacao, ic_privacidade, ie_modalidade, fk_Usuario_id_usuario) VALUES ('$nmRanking', curdate(), $icPrivacidade, $ieModalidade, $idUsuario)");

        // if ($con->query($sql) === FALSE){
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // }

        $connection->CloseCon($con);

        


        // $connection = new connection();
        // $con = $connection->OpenCon();

        // $query = "INSERT INTO usuario (nm_login, nm_senha, nm_email, nm_usuario) VALUES('','$nmSenha','$nmEmail','$nmUsuario');";
        
        // if ($con->query($query) === FALSE){
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // }

        // $connection->CloseCon($con);

    }

    public function getRankingsUsuario($idUsuario){
        
		$connection = new connection();
		$con = $connection->OpenCon();

        //$sql = "SELECT id_ranking, nm_ranking, dt_criacao, ic_privacidade FROM Ranking WHERE id_usuario = '$idUsuario'";
        $sql = "SELECT id_ranking, nm_ranking, dt_criacao, ic_privacidade, ie_modalidade FROM Ranking WHERE fk_Usuario_id_usuario = '$idUsuario'";
        
        $result = mysqli_query($con, $sql);

        $connection->CloseCon($con);

        return $result;

    }

    public function excluirRanking($idUsuario, $idRanking){
        
		$connection = new connection();
		$con = $connection->OpenCon();

        $query = new Jogador("jogador");

        $jogadores = $query->getJogadoresRanking($idRanking);

        foreach ($jogadores as $jogador){
            $query->excluirJogador($jogador['id_jogador'], $idRanking);
        }

        $sql = "DELETE FROM Ranking WHERE fk_Usuario_id_usuario = $idUsuario AND id_ranking = $idRanking";

        mysqli_query($con, $sql);

        $connection->CloseCon($con);
        
    }

    public function updateRanking($idRanking, $nmRanking ,$icPrivacidade){
        
		$connection = new connection();
		$con = $connection->OpenCon();

        $sql = "UPDATE Ranking SET nm_ranking = '$nmRanking', ic_privacidade = $icPrivacidade WHERE id_ranking = $idRanking";

        mysqli_query($con, $sql);

        $connection->CloseCon($con);
    }

    public function getRankings(){

		$connection = new connection();
		$con = $connection->OpenCon();

        //$sql = "SELECT a.id_ranking, a.nm_ranking, a.dt_criacao, a.ic_privacidade, u.nm_usuario FROM ranking a, usuario u WHERE a.id_usuario = u.id_usuario AND a.ic_privacidade = '1'";
        $sql = "SELECT r.id_ranking, r.nm_ranking, r.dt_criacao, r.ic_privacidade, r.ie_modalidade, u.nm_usuario FROM Ranking r, Usuario u WHERE r.fk_Usuario_id_usuario = u.id_usuario AND r.ic_privacidade = 0";

        $result = mysqli_query($con, $sql);

        $connection->CloseCon($con);

        return $result;

    }
    
    public function getRankingsByName($name){

		$connection = new connection();
		$con = $connection->OpenCon();

        //$sql = "SELECT a.id_ranking, a.nm_ranking, a.dt_criacao, a.ic_privacidade, u.nm_usuario FROM ranking a, usuario u WHERE a.id_usuario = u.id_usuario AND a.ic_privacidade = '1' AND a.nm_ranking LIKE '$name%'";
        $sql = "SELECT r.id_ranking, r.nm_ranking, r.dt_criacao, r.ic_privacidade, r.ie_modalidade, u.nm_usuario FROM Ranking r, Usuario u WHERE r.fk_Usuario_id_usuario = u.id_usuario AND r.ic_privacidade = 0 AND r.nm_ranking LIKE '$name%'";
        
        $result = mysqli_fetch_assoc($result = mysqli_query($con, $sql));

        $connection->CloseCon($con);

        return $result;

    }

    public function getDonoRanking($idRanking){
        
		$connection = new connection();
		$con = $connection->OpenCon();

        //$sql = "SELECT id_usuario FROM ranking WHERE id_ranking = '$idRanking'";

        $sql = "SELECT fk_Usuario_id_usuario FROM Ranking WHERE id_ranking = $idRanking";

        $result = mysqli_query($con, $sql);

        $connection->CloseCon($con);

        return $result;

    }

}
