<?php

include_once 'Ranking.php';

class Usuario extends connection
{

    public function __construct($nome)
    {
        $this->nome = $nome;
    }

    /**
     * cadastrarUsuario
     *
     * @param  mixed $nmUsuario
     * @param  mixed $nmSenha
     * @param  mixed $nmEmail
     * @return void
     */
    public function cadastrarUsuario($nmUsuario, $nmSenha, $nmEmail)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $query = "INSERT INTO usuario (nm_usuario, nm_email, nm_senha) VALUES('$nmUsuario','$nmEmail','$nmSenha')";
        
        if ($con->query($query) === FALSE) {
            throw new Exception($con->error);
        }

        // Após inserir na tabela usuario, inserir na tabela administrador
        $query = "INSERT INTO administrador (fk_id_usuario) SELECT id_usuario FROM usuario WHERE nm_email = '$nmEmail'";

        if ($con->query($query) === FALSE) {
            echo "Error: " . $query . "<br>" . $con->error;
        }

        $connection->CloseCon($con);
    }

    /**
     * loginUsuario
     * @param  mixed $email 
     * @return $retorno
     */
    public function loginUsuario($email)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $query = "SELECT id_usuario, nm_senha FROM usuario WHERE nm_email = '$email';";

        $result = $con->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $retorno = $row;
            }
        } else {
            $retorno = null;
        }

        $connection->CloseCon($con);
        return $retorno;
    }

    public function selectUsuario($id)
    {
        // Consulta todas as informações do usuario para efetuar o login
        $connection = new connection();
        $con = $connection->OpenCon();

        $query = "SELECT * FROM usuario WHERE id_usuario = $id";

        $result = mysqli_query($con, $query);

        $connection->CloseCon($con);

        return $result;
    }

    public function updateUsuario($id, $nome, $email)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $sql = "UPDATE usuario SET nm_usuario = '$nome', nm_email = '$email' WHERE id_usuario = $id";

        mysqli_query($con, $sql);

        $connection->CloseCon($con);
    }

    public function updateSenhaUsuario($id, $senha)
    {

        $connection = new connection();
        $con = $connection->OpenCon();

        $query = "UPDATE usuario SET nm_senha = '$senha' WHERE id_usuario = $id";

        //mysqli_query($con, $sql);
        $con->query($query);

        $connection->CloseCon($con);
    }

    /**
     * excluirUsuario
     *
     * @param  mixed $id
     * @return void
     */
    public function excluirUsuario($id)
    {

        $connection = new connection();
        $con = $connection->OpenCon();
        // Pega todas as rankings da conta
        $query = new Ranking('Ranking');
        $rankings = $query->getRankingsUsuario($id);
        // Deleta todos os jogadores e rankings dessa conta
        foreach ($rankings as $ranking) {
            $query->excluirRanking($id, $ranking['id_ranking']);
        }
        // Deleta a conta
        $sql = "DELETE FROM usuario WHERE id_usuario = $id";
        mysqli_query($con, $sql);

        $connection->CloseCon($con);
    }

    /**
     * uploadImage
     *
     * @param  mixed $id
     * @return void
     */
    public function uploadImage($id, $caminhoFoto)
    {

        $connection = new connection();
        $con = $connection->OpenCon();
        // Deleta todos os jogadores e rankings dessa conta

        // Deleta a conta
        $sql = "UPDATE Usuario set nm_caminho_foto = '$caminhoFoto' where id_usuario = $id";
        mysqli_query($con, $sql);
        var_dump($id, $caminhoFoto, $sql);
        $connection->CloseCon($con);
    }

    /**
     * uploadImage
     *
     * @param  mixed $id
     * @return void
     */
    public function removeImageReference($id)
    {

        $connection = new connection();
        $con = $connection->OpenCon();
        // Deleta todos os jogadores e rankings dessa conta

        // Deleta a conta
        $sql = "UPDATE Usuario set nm_caminho_foto = null where id_usuario = $id";
        mysqli_query($con, $sql);
        $connection->CloseCon($con);
    }
}
