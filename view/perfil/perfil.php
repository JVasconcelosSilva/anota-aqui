<?php
include '../_header/header.php';
//require __DIR__ . '../../../controller/session.php';
require __DIR__ . '../../../controller/Ranking.php';
require __DIR__ . '../../../controller/Usuario.php';

$numRankings = 0;
$query = new Ranking('ranking');
$registros = $query->getRankingsUsuario($_SESSION['id']);
$queryUsuario = new Usuario('usuario');
$infoUsuario = $queryUsuario->selectUsuario($_SESSION['id']);

$op = $_POST['op'] ?? null;

switch ($op) {
    case "criar":
        $dtCriacao = date_default_timezone_get();
        $query->cadastrarRanking($_POST['nmRankings'], $dtCriacao, $_POST['icPrivacidade'], $_POST['ieModalidade'], $_SESSION['id']);
        header('LOCATION: perfil.php');
    case "alterar":
        $query->updateRanking($_POST['idRankings'], $_POST['nmRankings'], $_POST['icPrivacidade']);
        header('LOCATION: perfil.php');
    case "excluir":
        $query->excluirRanking($_SESSION['id'], $_POST['idRankings']);

        header('LOCATION: perfil.php');
}

// if ($op == "Excluir") {
//     $query->excluirRanking($_SESSION['id'], $_POST['idRankings']);

//     header('LOCATION: perfil.php');
// }


// if ($op == "Criar") {
//     $dtCriacao = date_default_timezone_get();
//     $query->cadastrarRanking($_POST['nmRankings'], $dtCriacao, $_POST['icPrivacidade'], $_POST['ieModalidade'], $_SESSION['id']);
//     header('LOCATION: perfil.php');
// }

// if ($op == "Alterar") {
//     $query->updateRanking($_POST['idRankings'], $_POST['nmRankings'], $_POST['icPrivacidade']);
//     header('LOCATION: perfil.php');
// }
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Referência da folha de estilo do cabeçalho -->
    <link rel="stylesheet" href="../_header/header.css">
</head>

<body>
    <h1>Test</h1>
    <?= var_dump($infoUsuario) ?>
    <?php foreach ($infoUsuario as $usuario) { ?>
        <h4>Nome: <?= $usuario['nm_usuario'] ?></h4>
        <h4>Email: <?= $usuario['nm_email'] ?></h4>
    <?php } ?>

    <?php if ($usuario['nm_caminho_foto'] != null) { ?>
        <button type="button" data-toggle="modal" data-target="#ExemploModalCentralizado"><img src="../../user-uploads/images/<?= $usuario['nm_caminho_foto'] ?>" style=" height:170px;
    width:auto;/*maintain aspect ratio*/
    max-width:180px;"></button>
    <?php } else { ?>
        <!-- TODO style mockado para manter padrão de tamanho da imagem, passar para CSS -->
        <button type="button" data-toggle="modal" data-target="#ExemploModalCentralizado"><img src="../../user-uploads/images/default-user.png" style=" height:170px;
    width:auto;/*maintain aspect ratio*/
    max-width:180px;"></button>
    <?php } ?>

    <!-- Menu do perfil start -->
    <ul>
        <li>
            <a class="dropdown-item" href="view/Publica/publica.php">Rankings</a>
        </li>
        <li>
            <a class="dropdown-item" href="view/Publica/publica.php">Conquistas</a>
        </li>
        <li>
            <a class="dropdown-item" href="view/Publica/publica.php">Informações</a>
        </li>
    </ul>
    <!-- Menu do perfil end -->


    <!-- Start Modal -->
    <div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCentralizado">Mudar foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../controller/ImageUpload.php" method="post" enctype="multipart/form-data">
                        Selecione uma imagem de perfil:
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" value="Salvar imagem" name="submit">

                        <!-- Exibe o botao de remover imagem caso o usuario ja tenha uma imagem -->
                        <?php if ($usuario['nm_caminho_foto'] != null) { ?>
                            <input type="submit" value="Remover imagem" name="remove">
                        <?php } ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- End Modal -->

</body>