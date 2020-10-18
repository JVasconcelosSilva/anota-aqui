<?php
include '../_header/header.php';
require __DIR__ . '../../../controller/Ranking.php';
$nomeRanking = $_GET['nomeRanking'] ?? null;
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
                        $query = new Ranking("ranking");
                        $rankings = $query->getRankings();
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
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<?php
include '../_footer/footer.php'
?>