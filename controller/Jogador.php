<?php
include_once 'connection.php';

class Jogador extends connection {

    public function __construct($nome) {
        $this->nome = $nome;
    }

    public function cadastrarJogador($nmJogador, $idRanking) {
        
		$connection = new connection();
		$con = $connection->OpenCon();

        $sql = "INSERT INTO Jogador (nm_jogador, qt_ponto, fk_Ranking_id_ranking)
        VALUES ('$nmJogador', 0 ,'$idRanking')";
        
        mysqli_query($con, $sql);
		if(mysqli_errno($con)){
			throw new exception(mysqli_errno($con));
        }

        $connection->CloseCon($con);
    }

    public function getJogadoresRanking($idRanking){
        
		$connection = new connection();
		$con = $connection->OpenCon();
        
        $sql = "SELECT p.* FROM (SELECT @getJogadoresRanking:=$idRanking f) s, vw_ranking p;";
        
        $result = mysqli_query($this->OpenCon(), $sql);

        $connection->CloseCon($con);

        return $result;

    }

    public function excluirJogador($idJogador, $idRanking){
        
		$connection = new connection();
		$con = $connection->OpenCon();

        $sql = "DELETE FROM Jogador WHERE id_jogador = $idJogador";

        mysqli_query($this->OpenCon(), $sql);

        $connection->CloseCon($con);
        
    }

    public function adicionarGol($idJogador, $idRanking, $qtGolAtual, $idUsuario){
        
		$connection = new connection();
		$con = $connection->OpenCon();
        
        $sql = "UPDATE Jogador SET qt_ponto = qt_ponto + 1 WHERE id_jogador = $idJogador";

        mysqli_query($this->OpenCon(), $sql);

        $connection->CloseCon($con);
    }

    public function tirarGol($idJogador, $idRanking, $qtGolAtual, $idUsuario){
        
		$connection = new connection();
		$con = $connection->OpenCon();
        
        $sql = "UPDATE Jogador SET qt_ponto = qt_ponto - 1 WHERE id_jogador = $idJogador";

        mysqli_query($this->OpenCon(), $sql);

        $connection->CloseCon($con);
    }

    public function updateJogador($idJogador, $nmJogador , $qtPontoNovo, $qtGolAtual, $idRanking, $idUsuario){
        
		$connection = new connection();
		$con = $connection->OpenCon();

        $sql = "UPDATE Jogador SET nm_jogador = '$nmJogador', qt_ponto = '$qtPontoNovo' WHERE id_jogador = $idJogador";

        mysqli_query($this->OpenCon(), $sql);

        $connection->CloseCon($con);
    }

    public function getJogadoresNome($idRanking, $nmJogador){
        
		$connection = new connection();
		$con = $connection->OpenCon();

        $sql = "SELECT p.* FROM (SELECT @getJogadoresRanking:=$idRanking f) s, vw_ranking p WHERE p.nm_jogador LIKE '%$nmJogador%';";
        
        $result = mysqli_query($this->OpenCon(), $sql);

        $connection->CloseCon($con);

        return $result;

    }

}
