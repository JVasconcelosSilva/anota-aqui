<?php
include '../_header/header.php';
require __DIR__ . '../../../controller/AdicionarModerador.php';

$dados = null;
$idRankings = $_GET['idRankings'] ?? null;
$op = $_POST['op'] ?? null;

$query = new AdicionarModerador('adicionarmoderador');
$moderadoresRanking = $query->getModeradoresRanking($idRankings);

if ($op != null) {
    switch ($op) {
        case "Buscar":
            $query = new AdicionarModerador('adicionarmoderador');
            $dados_usuario = $query->selectUsuarioByEmail($_POST['emailModerador']);
            break;
        case "Adicionar Moderador":
            $query = new AdicionarModerador('adicionarmoderador');
            $query->adicionarModerador($idRankings, $_POST['idUsuarioModerador']);
            header('LOCATION: ../Ranking/Ranking.php');
            break;
    }

    // if ($op == "Buscar") {
    //     $query = new AdicionarModerador('adicionarmoderador');
    //     $dados_usuario = $query->selectUsuarioByEmail($_POST['emailModerador']);
    //     //$dados = mysqli_fetch_assoc($dados_usuario);
    // }
    // if ($op == "Adicionar Moderador") {
    //     $query = new AdicionarModerador('adicionarmoderador');
    //     $dados_usuario = $query->adicionarModerador($idRankings, $_POST['idUsuarioModerador']);

    // }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../_header/header.css">
    <title>Adicionar Moderador</title>
</head>

<body>

    <!-- Lista de moderadores vinculados ao ranking Start -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="col-md-4 mx-auto">
                    </div class="col-auto mx-auto">
                    <div class="col-md-2">
                        <div class="row" mx-auto>
                            <?php
                            if ($dados = mysqli_fetch_assoc($moderadoresRanking) != null) {
                                foreach ($moderadoresRanking as $moderadores) {
                            ?>
                                    <form method="POST">
                                        <input type="hidden" name="nmRankings" value="<?= $moderadores['id_usuario'] ?>">

                                        <?php if ($moderadores['nm_caminho_foto'] != null) { ?>
                                            <button type="button" data-toggle="modal" data-target="#UploadImageModal"><img src="../../user-uploads/images/<?= $moderadores['nm_caminho_foto'] ?>" style=" height:170px;
                                        width:auto;/*maintain aspect ratio*/
                                        max-width:180px;"></button>
                                        <?php } else { ?>
                                            <!-- TODO style mockado para manter padrão de tamanho da imagem, passar para CSS -->
                                            <button type="button" data-toggle="modal" data-target="#UploadImageModal"><img src="../../user-uploads/images/default-user.png" style=" height:170px;
                                            width:auto;/*maintain aspect ratio*/
                                            max-width:180px;"></button>
                                        <?php } ?>
                                        <p><?= $moderadores['nm_usuario'] ?></p>
                                        <p><?= $moderadores['nm_email'] ?></p>
                                        <div class="input-group-append">
                                            <input type="hidden" name="idUsuarioModerador" value="<?= $usuario['id_usuario'] ?>">
                                            <input class="btn btn-danger" type="submit" name="op" value="Remover Moderador">
                                        </div>
                                    </form>
                                <?php }
                            } else { ?>
                                <p>Nenhum resultado encontrado.</p>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Lista de moderadores vinculados ao ranking End -->

    <!-- Barra de pesquisa de moderador Start -->
    <form method="post">
        <div class="col-6">
            <div class="input-group border rounded">
                <input type="text" class="form-control border-0" placeholder="Email" aria-label="Buscar" aria-describedby="basic-addon2" name="emailModerador">
                <div class="input-group-append">
                    <input class="btn btn-primary" type="submit" name="op" value="Buscar">
                </div>
            </div>
        </div>
    </form>
    <!-- Barra de pesquisa de moderador End -->

    <?php
    if ($op == "Buscar") {
        if ($dados = mysqli_fetch_assoc($dados_usuario) != null) {
            foreach ($dados_usuario as $usuario) {
    ?>

                <div class="card">
                    <!-- Atribuindo cor para os primeiros colocados do ranking End -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-4 mx-auto">
                            </div class="col-auto mx-auto">
                            <div class="col-md-2">
                                <div class="row" mx-auto>
                                    <form method="POST">
                                        <input type="hidden" name="nmRankings" value="<?= $usuario['id_usuario'] ?>">

                                        <?php if ($usuario['nm_caminho_foto'] != null) { ?>
                                            <button type="button" data-toggle="modal" data-target="#UploadImageModal"><img src="../../user-uploads/images/<?= $usuario['nm_caminho_foto'] ?>" style=" height:170px;
                                        width:auto;/*maintain aspect ratio*/
                                        max-width:180px;"></button>
                                        <?php } else { ?>
                                            <!-- TODO style mockado para manter padrão de tamanho da imagem, passar para CSS -->
                                            <button type="button" data-toggle="modal" data-target="#UploadImageModal"><img src="../../user-uploads/images/default-user.png" style=" height:170px;
                                            width:auto;/*maintain aspect ratio*/
                                            max-width:180px;"></button>
                                        <?php } ?>
                                        <p><?= $usuario['nm_usuario'] ?></p>
                                        <p><?= $usuario['nm_email'] ?></p>
                                        <div class="input-group-append">
                                            <input type="hidden" name="idUsuarioModerador" value="<?= $usuario['id_usuario'] ?>">
                                            <input class="btn btn-primary" type="submit" name="op" value="Adicionar Moderador">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>



            <?php }
        } else { ?>
            <p>Nenhum resultado encontrado.</p>
    <?php }
    } ?>

</body>

</html>