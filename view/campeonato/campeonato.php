<?php
include '../_header/header.php';
require __DIR__ . '../../../controller/Moderador.php';
require __DIR__ . '../../../controller/Campeonato.php';

$nomeCampeonato = null;
$idCampeonato = $_GET['idCampeonato'] ?? null;
$nmCampeonato = $_GET['nmCampeonato'] ?? null;
$nmCampeonato = strtoupper($nmCampeonato);
// $query = new Jogador('jogador');
// $registros = $query->getJogadoresCampeonato($idCampeonato);

$Campeonato = new Campeonato('Campeonato');
// $isDono = $Campeonato->verifyDono($_SESSION['id'], $idCampeonato);
// $isAdm = $Campeonato->verifyIsAdm($_SESSION['id'], $idCampeonato);

$op = null;
$contador = 0;
$nmJogador = $_POST['nmJogador'] ?? null;
$op = $_POST['op'] ?? null;
$qtGol = $_POST['qtGolAtual'] ?? null;

if ($op != null) {
    if ($op == "Criar") {
        $query->cadastrarJogador($nmJogador, $idCampeonato);
        $nmCampeonato = $_POST['nmCampeonato'] ?? null;
        header('LOCATION: Campeonato.php?idCampeonato=' . $idCampeonato . "&nmCampeonato=" . $nmCampeonato);
    } else if ($op == "+") {
        $query->adicionarGol($_POST['idJogador'], $_POST['idCampeonato'], $qtGol, $_SESSION['id']);
        $nmCampeonato = $_POST['nmCampeonato'] ?? null;
        header('LOCATION: Campeonato.php?idCampeonato=' . $idCampeonato . "&nmCampeonato=" . $nmCampeonato);
    } else if ($op == "-") {
        if ($qtGol > 0) {
            $query->tirarGol($_POST['idJogador'], $_POST['idCampeonato'], $qtGol, $_SESSION['id']);
            $nmCampeonato = $_POST['nmCampeonato'] ?? null;
            header('LOCATION: Campeonato.php?idCampeonato=' . $idCampeonato . "&nmCampeonato=" . $nmCampeonato);
        }
    } else if ($op == "Alterar") {
        $query->updateJogador($_POST['idJogadorUpdate'], $_POST['nmNomeUpdate'], $_POST['qtGolUpdate'], $qtGol, $_POST['idCampeonato'], $_SESSION['id']);
        $nmCampeonato = $_POST['nmCampeonato'] ?? null;
        header('LOCATION: Campeonato.php?idCampeonato=' . $idCampeonato . "&nmCampeonato=" . $nmCampeonato);
    } else if ($op == "Excluir") {
        $query->excluirJogador($_POST['idJogadorUpdate'], $_POST['idCampeonato']);
        $nmCampeonato = $_POST['nmCampeonato'] ?? null;
        header('LOCATION: Campeonato.php?idCampeonato=' . $idCampeonato . "&nmCampeonato=" . $nmCampeonato);
    } else if ($op == "Buscar") {
        $registros = null;
        $nmJogador = $_POST['nmJogador'] ?? null;
        $registros = $query->getJogadoresNome($idCampeonato, $nmJogador);
    }
}

?>
<html>

<head>
    <!-- Referência da folha de estilo do cabeçalho -->
    <link rel="stylesheet" href="../_header/header.css">
    <title>Index</title>
</head>

<body>
    <h2><?= $nmCampeonato ?></h2>
    <hr class="star-dark mb-5">

    <!-- Menu do perfil Start -->
    <ul class="menu">
        <li class="opção1">
            <a class="dropdown-item" href="view/Publica/publica.php">Ranking</a>
        </li>
        <li class="opção2">
            <a class="dropdown-item" href="view/Publica/publica.php">Equipes</a>
        </li>
        <li class="opção3">
            <a class="dropdown-item" href="view/Publica/publica.php">Configurações</a>
        </li>
    </ul>

    <hr>
    <!-- Menu do perfil End -->

    <!-- TODO Tabela ranking campeonato Start -->
    <table style="width:100%">
        <tr>
            <th>Equipe</th>
            <th>Pts.</th>
            <th>Jogos</th>
            <th>Vit.</th>
            <th>D</th>
        </tr>
        <!-- TODO for Start -->
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <!-- TODO for End -->
    </table>
    <!-- TODO Tabela ranking campeonato Start -->

    <hr />
    <!-- Barra de pesquisa de jogador Start -->
    <form method="post">
        <div class="col-6">
            <div class="input-group border rounded">
                <input type="text" class="form-control border-0" placeholder="Buscar Jogador" aria-label="Buscar Jogador" aria-describedby="basic-addon2" name="nmJogador">
                <div class="input-group-append">
                    <input type="hidden" name="nmCampeonato" value="<?= $nmCampeonato ?>">
                    <input type="hidden" name="idCampeonato" value="<?= $idCampeonato ?>">
                    <input class="btn btn-primary" type="submit" name="op" value="Buscar">
                </div>
            </div>
        </div>
    </form>
    <!-- Barra de pesquisa de jogador End -->


    <!-- TODO Botão de adicionar moderador Start -->
    <?php if ($isDono) { ?>
        <h2>Moderadores</h2>
        <a href="../moderador/moderador.php?idCampeonato=<?= $idCampeonato ?>">
            <button type="button" class="btn btn-primary" data-toggle="modal">Moderadores</button>
        </a>
    <?php } ?>
    <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#Moderadores">Moderadores</button> -->
    <!-- Botão de adicionar moderador End -->

    <!-- Botão para mostar todos os jogadores (vai aparecer apenas quando tiver uma pesquisa feita) Start -->
    <?php if ($op == "Buscar") { ?>
        <a href="Campeonato.php?idCampeonato=<?= $idCampeonato ?>&nmCampeonato=<?= $nmCampeonato ?>"><button class="btn btn-primary">Mostrar todos os jogadores</button></a>
        <p>Resultados de: <?= $_POST['nmJogador'] ?></p>
    <?php } ?>
    <!-- Botão para mostar todos os jogadores (vai aparecer apenas quando tiver uma pesquisa feita) End -->

    <hr />

    <!-- Habilitando botão de adicionar jogador para o dono do ranking Start -->
    <?php if ($isDono) { ?>
        <button class="btn btn-primary" id='addJogador' data-toggle="modal" data-target="#CriarJogador">Adicionar Jogador</button>
    <?php } ?>
    <!-- Habilitando botão de adicionar jogador para o dono do ranking End -->

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
                            <!-- Colocação do jogador -->
                            <h3 class="colocacao mx-auto"><?= $jogador['colocacao'] ?>°</h3>
                        </div>
                        <div class="col-md-4 mx-auto">
                            <!--Nome do Jogador-->
                            <h5 class="nome mt-4 mx-auto" style="font-size: 30px;"><?= $jogador['nm_jogador'] ?></h5>
                        </div class="col-auto mx-auto">
                        <!--Numero de gols do jogador-->
                        <h5 class="gols"><?= $jogador['qt_ponto'] ?> </h5>
                        <?php
                        if ($isDono || $isAdm) { ?>
                            <div class="col-md-2">
                                <div class="row" mx-auto>
                                    <!--Adiciona um gol-->
                                    <form method="POST">
                                        <input type="hidden" name="nmCampeonato" value="<?= $nmCampeonato ?>">
                                        <input type="hidden" name="idCampeonato" value="<?= $idCampeonato ?>">
                                        <input type="hidden" name="qtGolAtual" value="<?= $jogador['qt_ponto'] ?>">
                                        <input type="hidden" name="idJogador" value="<?= $jogador['id_jogador'] ?>">
                                        <input type="submit" name="op" value="+" class="btn btn-primary" />
                                    </form>
                                    <!--Remove um gol-->
                                    <form method="POST">
                                        <input type="hidden" name="nmCampeonato" value="<?= $nmCampeonato ?>">
                                        <input type="hidden" name="idCampeonato" value="<?= $idCampeonato ?>">
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

            <!-- Modal Para Alteração de Jogador Start (Tem que ficar dentro do foreach para pegar a referência do ID do jogador) -->
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
                                <input type="hidden" name="nmCampeonato" value="<?= $nmCampeonato ?>">
                                <input type="hidden" name="idCampeonato" value="<?= $idCampeonato ?>">
                                <input type="hidden" name="qtGolAtual" value="<?= $jogador['qt_ponto'] ?>">
                                <?php if ($isDono) { ?>
                                    <input type="submit" class="btn btn-danger" name="op" value="Excluir">
                                <?php } ?>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Para Alteração de Jogador End (Tem que ficar dentro do foreach para pegar a referência do ID do jogador) -->

        <?php }
    } else { ?>
        <p>Nenhum jogador neste Campeonato</p>
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
                <form method="POST" action="Campeonato.php?idCampeonato=<?= $idCampeonato ?>">
                    <div class="modal-body">
                        <p><input type="text" class="form-control  " name="nmJogador" id="Nome" placeholder="Nome do Jogador"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <input type="hidden" name="nmCampeonato" value="<?= $nmCampeonato ?>">
                        <input type="hidden" name="idCampeonato" value="<?= $idCampeonato ?>">
                        <input type="submit" class="btn btn-primary" name="op" value="Criar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Para Cadastro de Jogador End -->
</body>
<?php
include '../_footer/footer.php'
?>

</html>