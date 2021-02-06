<?php
//session_start();
if (isset($_SESSION['id'], $_SESSION['nome'], $_SESSION['email'])) {
    header('LOCATION: ../../index.php');
}
include '../_header/header.php';
$email = $_POST['email'] ?? null;
$senha = $_POST['senha'] ?? null;
$nomeArtilharia = $_GET['nomeArtilharia'] ?? null;
$e = null;

// session_start();
// if (isset($_SESSION['id'], $_SESSION['nome'], $_SESSION['email'])) {
//     header('LOCATION: ../../../index.php');
// }

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

                session_start();
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
    <!-- Referência da folha de estilo do cabeçalho -->
    <link rel="stylesheet" href="../_header/header.css">
    <title>Login</title>

    <link rel="stylesheet" href="login.css" type="text/css">
    <link rel="stylesheet" href="fontes/font-awesome.min.css">


</head>

<body>


    <!----------------------------------------Navbar------------------------------------------>
    
    
    <div class="container">
        <div class="row">
            <div class="imagem">
                <img src="teste.jpg">
            </div>

                <div class="login">
                    <h1 class="h1">Login</h1>
                    <form method="POST" class="form">
                        <p>E-mail</p>
                        <input type="text" name="email" placeholder="Insira o e-mail" required>
                        <p>Senha</p>
                        <input type="password" name="senha" placeholder="Insira a senha" required>
                        <br>
                        <input type="submit" name="login" value="Login">
                        <br>
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
            </div>
</div>

<?php
include '../_footer/footerLogin.php'
?>
</body>

</html>