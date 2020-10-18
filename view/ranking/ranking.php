<?php
include '../_header/header.php';
require __DIR__ . '../../../controller/Moderador.php';
require __DIR__ . '../../../controller/Ranking.php';

$nomeRanking = null;
$idRankings = $_GET['idRankings'] ?? null;
$nmRankings = $_GET['nmRankings'] ?? null;
$nmRankings = strtoupper($nmRankings);
$query = new Jogador('jogador');
$registros = $query->getJogadoresRanking($idRankings);

$query2 = new Moderador('moderador');
$Ranking = new Ranking('Ranking');
$art = $Ranking->getDonoRanking($idRankings);
$dono = mysqli_fetch_assoc($art);

$op = null;
$contador = 0;
$nmJogador = $_POST['nmJogador'] ?? null;
$op = $_POST['op'] ?? null;
$qtGol = $_POST['qtGolAtual'] ?? null;

if ($op == "Criar") {
    $query->cadastrarJogador($nmJogador, $idRankings);
    $nmRankings = $_POST['nmRankings'] ?? null;
    header('LOCATION: Ranking.php?idRankings=' . $idRankings . "&nmRankings=" . $nmRankings);
}
if ($op == "+") {
    $query->adicionarGol($_POST['idJogador'], $_POST['idRankings'], $qtGol, $_SESSION['id']);
    $nmRankings = $_POST['nmRankings'] ?? null;
    header('LOCATION: Ranking.php?idRankings=' . $idRankings . "&nmRankings=" . $nmRankings);
}
if ($op == "-") {
    if ($qtGol > 0) {
        $query->tirarGol($_POST['idJogador'], $_POST['idRankings'], $qtGol, $_SESSION['id']);
        $nmRankings = $_POST['nmRankings'] ?? null;
        header('LOCATION: Ranking.php?idRankings=' . $idRankings . "&nmRankings=" . $nmRankings);
    }
}
if ($op == "Alterar") {
    $query->updateJogador($_POST['idJogadorUpdate'], $_POST['nmNomeUpdate'], $_POST['qtGolUpdate'], $qtGol, $_POST['idRankings'], $_SESSION['id']);
    $nmRankings = $_POST['nmRankings'] ?? null;
    header('LOCATION: Ranking.php?idRankings=' . $idRankings . "&nmRankings=" . $nmRankings);
}
if ($op == "Excluir") {
    $query->excluirJogador($_POST['idJogadorUpdate'], $_POST['idRankings']);
    $nmRankings = $_POST['nmRankings'] ?? null;
    header('LOCATION: Ranking.php?idRankings=' . $idRankings . "&nmRankings=" . $nmRankings);
}
if ($op == "Buscar") {
    $registros = null;
    $nmJogador = $_POST['nmJogador'] ?? null;
    $registros = $query->getJogadoresNome($idRankings, $nmJogador);
}
if ($op == "Adicionar Moderador") {
    $query2->cadastrarModerador($idRankings, $_POST['idModerador'], $dono['id_usuario']);
    header('LOCATION: Ranking.php?idRankings=' . $idRankings . "&nmRankings=" . $nmRankings, $_SESSION['id']);
}
if ($op == "Remover Moderador") {
    $query2->excluirModerador($idRankings, $_POST['idModerador']);
    header('LOCATION: Ranking.php?idRankings=' . $idRankings . "&nmRankings=" . $nmRankings, $_SESSION['id']);
}
?>
<html>

<head>
    <!-- Referência da folha de estilo do cabeçalho -->
    <link rel="stylesheet" href="../_header/header.css">
    <title>Index</title>
</head>

<body>
    <h2><?= $nmRankings ?></h2>
    <hr class="star-dark mb-5">

    <hr />
    <!-- Barra de pesquisa de jogador Start -->
    <form method="post">
        <div class="col-6">
            <div class="input-group border rounded">
                <input type="text" class="form-control border-0" placeholder="Buscar Jogador" aria-label="Buscar Jogador" aria-describedby="basic-addon2" name="nmJogador">
                <div class="input-group-append">
                    <input type="hidden" name="nmRankings" value="<?= $nmRankings ?>">
                    <input type="hidden" name="idRankings" value="<?= $idRankings ?>">
                    <input class="btn btn-primary" type="submit" name="op" value="Buscar">
                </div>
            </div>
        </div>
    </form>
    <!-- Barra de pesquisa de jogador End -->

    <?php if ($op == "Buscar") { ?>
        <a href="Ranking.php?idRankings=<?= $idRankings ?>&nmRankings=<?= $nmRankings ?>"><button class="btn btn-primary">Mostrar todos os jogadores</button></a>
        <p>Resultados de: <?= $_POST['nmJogador'] ?></p>
    <?php } ?>

    <hr />

    <!-- Habilitando botão de adicionar jogador para o dono do ranking Start -->
    <?php if ($_SESSION['id'] == $dono['fk_Usuario_id_usuario']) { ?>
        <button class="btn btn-primary" id='addJogador' data-toggle="modal" data-target="#CriarJogador">Adicionar Jogador</button>
    <?php } ?>
    <!-- Habilitando botão de adicionar jogador para o dono do ranking Start -->

    <!-- Populando ranking Start -->
    <?php
    if ($registros != null) {
        foreach ($registros as $jogador) {
            $contador++;
    ?>
            <!-- Atribuindo cor para os primeiros colocados do ranking Start -->
            <div class="card" <?php if ($contador == 1) { ?> style="background-color: #FFD700" <?php } elseif ($contador == 2) { ?> style="background-color: #C0C0C0" <?php } elseif ($contador == 3) { ?> style="background-color: #D2691E" <?php } ?>>
                <!-- Atribuindo cor para os primeiros colocados do ranking End -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <h3 class="colocacao mx-auto"><?= $jogador['colocacao'] ?>°</h3>
                        </div>
                        <div class="col-md-4 mx-auto">
                            <!--Nome do Jogador-->
                            <h5 class="nome mt-4 mx-auto" style="font-size: 30px;"><?= $jogador['nm_jogador'] ?></h5>
                        </div class="col-auto mx-auto">
                        <!--Numero de gols do jogador-->
                        <h5 class="gols"><?= $jogador['qt_ponto'] ?> </h5>
                        <?php
                        if (/*$controle == 1 ||*/$_SESSION['id'] == $dono['fk_Usuario_id_usuario']) { ?>
                            <div class="col-md-2">
                                <div class="row" mx-auto>
                                    <!--Adiciona um gol-->
                                    <form method="POST">
                                        <input type="hidden" name="nmRankings" value="<?= $nmRankings ?>">
                                        <input type="hidden" name="idRankings" value="<?= $idRankings ?>">
                                        <input type="hidden" name="qtGolAtual" value="<?= $jogador['qt_ponto'] ?>">
                                        <input type="hidden" name="idJogador" value="<?= $jogador['id_jogador'] ?>">
                                        <input type="submit" name="op" value="+" class="btn btn-primary" />
                                    </form>
                                    <!--Remove um gol-->
                                    <form method="POST">
                                        <input type="hidden" name="nmRankings" value="<?= $nmRankings ?>">
                                        <input type="hidden" name="idRankings" value="<?= $idRankings ?>">
                                        <input type="hidden" name="qtGolAtual" value="<?= $jogador['qt_ponto'] ?>">
                                        <input type="hidden" name="idJogador" value="<?= $jogador['id_jogador'] ?>">
                                        <input type="submit" name="op" value="-" class="btn btn-danger" <?php if ($jogador['qt_ponto'] == 0) { ?>disabled<?php } ?> />
                                    </form>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <button class="btn btn-secondary mx-autos" id='alteraJogador' data-toggle="modal" data-target="#AlterarJogador-<?= $jogador["id_jogador"]; ?>">...</button>
                            <?php } ?>

                            </div>
                    </div>
                </div>
            </div>
            </div>

        <?php }
    } else { ?>
        <p>Nenhum jogador neste Ranking</p>
    <?php } ?>
    <!-- Populando ranking End -->

    <!-- Modal Para Cadastro de Jogador Start -->
    <div class="modal fade" id="CriarJogador" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalLongoExemplo">Cadastro de Jogador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="Ranking.php?idRankings=<?= $idRankings ?>">
                    <div class="modal-body">
                        <p><input type="text" class="form-control  " name="nmJogador" id="Nome" placeholder="Nome do Jogador"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <input type="hidden" name="nmRankings" value="<?= $nmRankings ?>">
                        <input type="hidden" name="idRankings" value="<?= $idRankings ?>">
                        <input type="submit" class="btn btn-primary" name="op" value="Criar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Para Cadastro de Jogador End -->

    <!-- Modal Para Alteração de Jogaodr Start -->
    <div class="modal fade" id="AlterarJogador-<?= $jogador["id_jogador"]; ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalLongoExemplo"><?= $jogador['nm_jogador'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <p><input type="text" class="form-control" name="nmNomeUpdate" id="Nome" value="<?= $jogador['nm_jogador'] ?>"></p>
                        <p><input type="number" class="form-control" name="qtGolUpdate" id="Gol" value="<?= $jogador['qt_ponto'] ?>"></p>
                        <input type="hidden" name="idJogadorUpdate" value="<?= $jogador['id_jogador'] ?>">
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" name="op" value="Alterar">
                        <input type="hidden" name="nmRankings" value="<?= $nmRankings ?>">
                        <input type="hidden" name="idRankings" value="<?= $idRankings ?>">
                        <input type="hidden" name="qtGolAtual" value="<?= $jogador['qt_ponto'] ?>">
                        <input type="submit" class="btn btn-danger" name="op" value="Excluir">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Para Alteração de Jogaodr End -->

</body>
<?php
include '../_footer/footer.php'
?>

</html>