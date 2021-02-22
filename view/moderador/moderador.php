<?php
include '../_header/header.php';
require __DIR__ . '../../../controller/Moderador.php';

$dados = null;
$idRankings = $_GET['idRankings'] ?? null;
$op = $_POST['op'] ?? null;

$query = new AdicionarModerador('adicionarmoderador');

if ($op != null) {
    switch ($op) {
        case "Buscar":
            $dados_usuario = $query->selectUsuarioByEmail($idRankings, $_POST['emailModerador']);
            break;
        case "Adicionar":
            $query->adicionarModerador($idRankings, $_POST['idUsuarioModerador']);
            break;
        case "Remover":
            $query->removerModerador($idRankings, $_POST['idUsuarioModerador']);
            break;
    }
}

$moderadoresRanking = $query->getModeradoresRanking($idRankings);

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

                                    <!-- Lista de moderadores Start -->
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
                                        <input type="hidden" name="idUsuarioModerador" value="<?= $moderadores['id_usuario'] ?>">
                                        <!-- <input class="btn btn-danger" type="submit" name="op" value="Remover Moderador"> -->
                                        <button class="btn btn-danger mx-autos" id='removeModerador' data-toggle="modal" data-target="#RemoverModerador-<?= $moderadores['id_usuario'] ?>">Remover Moderador</button>
                                    </div>
                                    <!-- Lista de moderadores End -->

                                    <!-- Modal Para remoção de moderadores Start (Tem que ficar dentro do foreach para pegar a referência do ID)-->
                                    <div class="modal fade" id="RemoverModerador-<?= $moderadores['id_usuario'] ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="TituloModalLongoExemplo">Remover <?= $moderadores['nm_usuario'] ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST">
                                                    <p>Deseja remover <?= $moderadores['nm_usuario'] ?> como moderador?</p>
                                                    <input type="hidden" name="idUsuarioModerador" value="<?= $moderadores['id_usuario'] ?>">
                                                    <input type="hidden" name="op" value="Remover">
                                                    <div class="input-group-append">
                                                        <input class="btn btn-success" type="submit" value="Sim">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Para remoção de moderadores End -->
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-4 mx-auto">
                            </div class="col-auto mx-auto">
                            <div class="col-md-2">
                                <div class="row" mx-auto>
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
                                        <button class="btn btn-primary mx-autos" id='adicionaModerador' data-toggle="modal" data-target="#AdicionarModerador-<?= $usuario['id_usuario'] ?>">Adicionar Moderador</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <!-- Modal Para adição de moderadores Start (Tem que ficar dentro do foreach para pegar a referência do ID) -->
                <div class="modal fade" id="AdicionarModerador-<?= $usuario['id_usuario'] ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TituloModalLongoExemplo">Adicionar <?= $usuario['nm_usuario'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST">
                                <p>Deseja adicionar <?= $usuario['nm_usuario'] ?> como moderador?</p>
                                <input type="hidden" name="idUsuarioModerador" value="<?= $usuario['id_usuario'] ?>">
                                <input type="hidden" name="op" value="Adicionar">
                                <div class="input-group-append">
                                    <input class="btn btn-success" type="submit" value="Sim">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Para adição de moderadores End -->

            <?php }
        } else { ?>
            <p>Nenhum resultado encontrado.</p>
    <?php }
    } ?>



</body>
<?php
include '../_footer/footer.php'
?>

</html>