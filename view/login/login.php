<?php
$email = $_POST['email'] ?? null;
$senha = $_POST['senha'] ?? null;
$nomeArtilharia = $_GET['nomeArtilharia'] ?? null;
$e = null;

session_start();
if (isset($_SESSION['id'], $_SESSION['nome'], $_SESSION['email'])) {
    header('LOCATION: ../../../index.php');
}

if (!is_null($email)) {
    try {
        require_once __DIR__ . '../../../controller/Usuario.php';

        $query = new Usuario('usuarios');
        $select = $query->loginUsuario($email);

        if (is_null($select)) {
            $e = 'Falha ao efetuar login';
        } else {

            var_dump(hash('md5', $senha), $select);
            if ((hash('md5', $senha) == $select["nm_senha"])) {

                //var_dump($select["nm_senha"], hash('md5', $senha));

                $id = $select["id_usuario"];
                $dados_usuario = $query->selectUsuario($id);
                $dado = mysqli_fetch_assoc($dados_usuario);

                $_SESSION['id'] = $dado['id_usuario'];
                $_SESSION['nome'] = $dado['nm_usuario'];
                $_SESSION['email'] = $dado['nm_email'];

                header('LOCATION: ../perfil/perfil.php');
            } else {
                $e = 'Falha ao efetuar login';
            }
        }
    } catch (Exception $e) {
    }
}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="estilologin.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>


    <!----------------------------------------Navbar------------------------------------------>

    <div class="login">
        <img src="img/user.png" class="usuario" width="100" height="100" alt="">
        <h1>Login</h1>
        <form method="POST">
            <p>E-mail</p>
            <input type="text" name="email" placeholder="Insira o e-mail" required>
            <p>Senha</p>
            <input type="password" name="senha" placeholder="Insira a senha" required>
            <input type="submit" name="login" value="Login">
            <a href="../Recuperar/recuperar.php">Esqueci a Senha</a>
            |
            <a href="../Cadastro/cadastro.php">Cadastre-se</a>
        </form>
        <?php if (!is_null($e)) { ?>
            <div class="alert alert-danger" id="alerta" role="alert">
                <?= $e ?>
            </div>
        <?php } ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>