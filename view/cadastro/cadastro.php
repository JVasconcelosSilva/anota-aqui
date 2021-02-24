<?php
session_start();
if (isset($_SESSION['id'], $_SESSION['nome'], $_SESSION['email'])) {
    header('LOCATION: ../../index.php');
}

$e = null;
$nmUsuario = $_POST['nmUsuario'] ?? null;
$nmSenha = $_POST['nmSenha'] ?? null;
$nmSenha2 = $_POST['nmSenha2'] ?? null;
$nmEmail = $_POST['nmEmail'] ?? null;
$options = ['cost' => 12,];
if (!is_null($nmEmail)) {
    require __DIR__ . '../../../controller/Usuario.php';
    
    try{
            if(strlen($nmSenha) >= 8){
                if($nmSenha == $nmSenha2){
                // if(preg_match('/^[A-Za-z0-9-]+$/', $nmUsuario)){
                        $nmSenha = hash('md5', $nmSenha);
                        $query = new Usuario('usuarios');
                        $query->cadastrarUsuario($nmUsuario, $nmSenha, $nmEmail);
                        header('LOCATION: ../Login/login.php');
                    // }else{
                    //     $e = 'Nome invalido, só é permitido letras.';
                    // }
                }else{
                  $e = 'As senhas não coincidem.';
                }
                
                }else{
                    $e = 'A senha precisa ter no mínimo 8 caracteres.';
                }
    }catch(Exception $e){
      $e = "Ocorreu um erro inesperado, tente novamente. <br> $e";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="estiloCadastro.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Cadastro</title>

    <link rel="stylesheet" href="cadastro.css" type="text/css">
    <link rel="stylesheet" href="fontes/font-awesome.min.css">
    
  </head>
  <body>
    
    <div class="cadastro">
        <h1>Cadastro</h1>
        <form method="POST">
            <p>Usuário</p>
            <input type="text" name="nmUsuario" placeholder="Insira o nome" required>
            <p>E-mail</p>
            <input type="text" name="nmEmail" placeholder="Insira o e-mail" required>
            <p>Senha</p>
            <input type="password" name="nmSenha" placeholder="Insira a senha" required>
            <p>Confirme a Senha</p>
            <input type="password" name="nmSenha2" placeholder="Confime a senha" required>
            <input type="submit" name="cadastro" value="Cadastrar">
            <p> Já possui uma conta? <a href="../Login/login.php" id="entrar">Entrar</a> </p>
        </form>
        <?php if(!is_null($e)) { ?>
                <div class="alert alert-danger" id="alerta" role="alert">
                    <?=$e?>
            </div>
            <?php }?>
    </div>

    <?php
    include '../_footer/footerCadastro.php'
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
