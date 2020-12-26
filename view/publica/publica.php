<?php
include '../_header/header.php';
require __DIR__ . '../../../controller/Ranking.php';
$nomeRanking = $_GET['nomeRanking'] ?? null;
$op = $_POST['op'] ?? null;

if ($op == "Buscar") {
    $registros = null;
    $nmRanking = $_POST['nmRanking'] ?? null;
    $query = new Ranking('Ranking');
    if ($nmRanking != null && !empty($nmRanking)) {
        $rankings = $query->getRankingsByName($nmRanking);
    } else {
        $rankings = $query->getRankings();
    }
} else {
    $query = new Ranking("Ranking");
    $rankings = $query->getRankings();
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Referência da folha de estilo do cabeçalho -->
    <link rel="stylesheet" href="../_header/header.css">
    <title>Rankings Públicos</title>
</head>

<body>
    <!---------------------------------------------Card's---+------------------------------------------------->
    <br>
    <br>
    <section class="testimonials">
        <div class="container">
            <br>
            <br>
            <h1 id="nome">Rankings Públicos</h1>

            <!-- Barra de pesquisa de jogador Start -->
            <form method="post">
                <div class="col-6">
                    <div class="input-group border rounded">
                        <input type="text" class="form-control border-0" placeholder="Buscar Ranking" aria-label="Buscar Ranking" aria-describedby="basic-addon2" name="nmRanking">
                        <div class="input-group-append">
                            <input type="hidden" name="nmRankings" value="<?= $nmRanking ?>">
                            <input type="hidden" name="idRankings" value="<?= $idRanking ?>">
                            <input class="btn btn-primary" type="submit" name="op" value="Buscar">
                        </div>
                    </div>
                </div>
            </form>
            <!-- Barra de pesquisa de jogador End -->

            <div class="wrap">
                <div class="box one">
                    <div class="date">
                    </div>
                    <h1>Ranking</h1>
                    <div class="date">
                    </div>
                    <h1 id="dono">Dono</h1>

                    <div class="date">
                    </div>
                    <h1 id="esporte">Esporte</h1>

                    <br>



                    <div class="container" id="lista">

                        <?php
                        if (is_null($rankings)) { ?>
                            <p>Nenhum resultado encontrado</p>
                            <?php } else {
                            foreach ($rankings as $ranking) {
                            ?>
                                <div class="row">
                                    <div class="col-sm">
                                        <a href="ranking.php?idRanking=<?= $ranking['id_ranking'] ?>&nmRanking=<?= $ranking['nm_ranking'] ?>"><?= $ranking['nm_ranking'] ?></a>
                                    </div>
                                    |
                                    <div class="col-sm">
                                        <?= $ranking['nm_usuario'] ?>
                                    </div>
                                    |
                                    <div class="col-sm">
                                        <?php
                                        if ($ranking['ie_modalidade'] == 0) { ?>
                                            Basquete
                                        <?php } else if ($ranking['ie_modalidade'] == 1) { ?>
                                            Futebol
                                        <?php } ?>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<?php
include '../_footer/footer.php'
?>