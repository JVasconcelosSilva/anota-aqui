<?php
include '../_header/header.php';
//require __DIR__ . '../../../controller/session.php';
require __DIR__ . '../../../controller/Moderador.php';
require __DIR__ . '../../../controller/Campeonato.php';
// require __DIR__ . '../../../controller/Ranking.php';
require __DIR__ . '../../../controller/Usuario.php';

$numRankings = 0;
$numCampeonatos = 0;
$query = new Ranking('ranking');
$campeonato = new Campeonato('campeonato');
$registros = $query->getRankingsUsuario($_SESSION['id']);
$campeonatosUsuario = $campeonato->getCampeonatosUsuario($_SESSION['id']);
$queryUsuario = new Usuario('usuario');
$infoUsuario = $queryUsuario->selectUsuario($_SESSION['id']);
$rankingsModerados = $query->getRankingsModerados($_SESSION['id']);

$op = $_POST['op'] ?? null;

if ($op != null) {
    switch ($op) {
        case "Criar":
            $query->cadastrarRanking($_POST['nmRankings'], $_POST['icPrivacidade'], $_POST['ieModalidade'], $_SESSION['id']);
            header('LOCATION: perfil.php');
            break;
        case "Alterar":
            $query->updateRanking($_POST['idRanking'], $_POST['nmRanking'], $_POST['icPrivacidade']);
            header('LOCATION: perfil.php');
            break;
        case "Excluir":
            $query->excluirRanking($_SESSION['id'], $_POST['idRanking']);
            header('LOCATION: perfil.php');
            break;
        case "SairModerador":
            $classModerador = new Moderador('moderador');
            $classModerador->removerModerador($_POST['idRanking'], $_SESSION['id']);
            header('LOCATION: perfil.php');
            break;
        case "CriarCampeonato":
            $campeonato->cadastrarCampeonato($_POST['nmCampeonato'], $_POST['icPrivacidade'], $_POST['ieModalidade'], $_SESSION['id']);
            header('LOCATION: perfil.php');
            break;
        case "AlterarCampeonato":
            $campeonato->updateCampeonato($_POST['idCampeonato'], $_POST['nmCampeonato'], $_POST['icPrivacidade']);
            header('LOCATION: perfil.php');
            break;
        case "ExcluirCampeonato":
            $campeonato->excluirCampeonato($_SESSION['id'], $_POST['idCampeonato']);
            header('LOCATION: perfil.php');
            break;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Referência da folha de estilo do cabeçalho -->
    <link rel="stylesheet" href="../_header/header.css">
    <link rel="stylesheet" href="estiloPerfil.css" type="text/css">
    <link rel="stylesheet" href="fontes/font-awesome.min.css">

    <title>Perfil</title>
</head>

<body>
    <h1 class="perfil">Perfil</h1>

    <?php foreach ($infoUsuario as $usuario) { ?>

        <div class="imag">

<<<<<<< HEAD
        <?php if ($usuario['nm_caminho_foto'] != null) { ?>
            <button type="button" data-toggle="modal" data-target="#UploadImageModal"><img src="../../user-uploads/images/<?= $usuario['nm_caminho_foto'] ?>" class="estilo"></button>
        <?php } else { ?>
            <!-- TODO style mockado para manter padrão de tamanho da imagem, passar para CSS -->
            <button type="button" data-toggle="modal" data-target="#UploadImageModal"><img src="../../user-uploads/images/default-user.png" class="estilo"></button>
        <?php } ?>
=======
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
>>>>>>> master

        </div>

        <div class="nomeuser">
            <h4><?= $usuario['nm_usuario'] ?></h4>
        <?php } ?>
        </div>

<<<<<<< HEAD

    <!-- Menu do perfil Start -->
    <!-- -->
    <ul class="menu">
        <li class="opção1">
            <hr class="hr3">
            <a class="dropdown-item" href="view/Publica/publica.php">Rankings</a> 
            <hr class="hr3">
        </li>
        <li class="opção2">
            <hr class="hr3">
            <a class="dropdown-item" href="view/Publica/publica.php">Conquistas</a>
            <hr class="hr3">
        </li>
        <li class="opção3">
            <hr class="hr3">
            <a class="dropdown-item" href="view/Publica/publica.php">Informações</a>
            <hr class="hr3">
        </li>
    </ul>
    -->
    <!-- Menu do perfil End -->
=======
        <hr>
        <!-- Menu do perfil Start -->
        <ul class="menu">
            <li class="opção1">
                <a class="dropdown-item" href="view/Publica/publica.php">Rankings</a>
            </li>
            <li class="opção2">
                <a class="dropdown-item" href="view/Publica/publica.php">Conquistas</a>
            </li>
            <li class="opção3">
                <a class="dropdown-item" href="view/Publica/publica.php">Informações</a>
            </li>
        </ul>

        <hr>
        <!-- Menu do perfil End -->
>>>>>>> master

        <!-- TODO incluír uma "página" dento dessa pode ser feita da seguinte forma,
         porém, elementos como o header e classes chamadas na página original não
         podem ser chamadas aqui, criar uma página sem esses elementos. -->
        <?php /*include '../publica/publica.php';*/ ?>

<<<<<<< HEAD
    <!-- Lista de rankings Start -->

<!--    
<div class="container-teste">
  <div class="row">
    <div class="teste1">
      Uma de três colunas
    </div>
    <div class="teste2">
      Uma de três colunas
    </div>
    <div class="teste3">
      Uma de três colunas
    </div>
  </div>
</div>
-->

    <div class="ranking">
    <h1 class="nomerank">Meus Rankings</h1>
    <hr class="hr3">
        <?php
        if (is_null(mysqli_fetch_assoc($registros))) {
        ?>
            <p class="rankmens">Você ainda não tem rankings</p>
=======
        <!-- Lista de rankings Start -->
        <h1 id="nome">Meus Rankings</h1>

        <div class="wrap">
>>>>>>> master
            <?php
            if (is_null(mysqli_fetch_assoc($registros))) {
            ?>
<<<<<<< HEAD
                <div class="box one">
                    <div class="date">
                    </div>
                    <h1 class="rankcriado"><?= $rankings['nm_ranking'] ?></h1>
                    <br>
                    <div class="text-box">
                        <div class="container">
                            <div class="rankentrar">
                                <a href="../ranking/ranking.php?idRankings=<?= $rankings['id_ranking'] ?>&nmRankings=<?= strtoupper($rankings['nm_ranking']) ?>">
                                    <button type="button" class="btn btn-primary" data-toggle="modal">Entrar</button>
                                </a>
                            </div>
                            <div class="rankalterar">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AlterarRankingModal">
                                    Alterar
                                </button>
                            </div>
                            <div class="rankexcluir">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ExcluirRankingModal">
                                    Excluir
                                </button>
                            </div>
                        </div>
=======
                <p>Você ainda não tem rankings</p>
>>>>>>> master
                <?php
            } else {
                foreach ($registros as $rankings) {
                    $numRankings++;
                ?>
                    <div class="box one">
                        <div class="date">
                        </div>
                        <h1><?= $rankings['nm_ranking'] ?></h1>
                        <br>
                        <div class="text-box">
                            <div class="container">
                                <div class="center">
                                    <a href="../ranking/ranking.php?idRankings=<?= $rankings['id_ranking'] ?>&nmRankings=<?= strtoupper($rankings['nm_ranking']) ?>">
                                        <button type="button" class="btn btn-primary" data-toggle="modal">Entrar</button>
                                    </a>
                                </div>
                                <div class="center">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AlterarRankingModal">
                                        Alterar
                                    </button>
                                </div>
                                <div class="center">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ExcluirRankingModal">
                                        Excluir
                                    </button>
                                </div>
                            </div>
                    <?php
                }
            }
                    ?>
                        </div>
                    </div>
        </div>
        <!-- Lista de rankings End -->

<<<<<<< HEAD
    <hr>
    
    <!-- Sessão para criar ranking Start -->
    <div class="criar">
    <?php
    if ($numRankings  < 3) { ?>
        <div class="box one">
            <div class="date">
            </div>
            <h4 class="nomecriar">Criar Ranking</h4>
            <hr class="hr3">
            <br>
            <div class="text-box">
                <div class="container">
                    <div class="center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CriarRankingModal">
                            Criar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>
    <!-- Sessão para criar ranking End -->
    <hr>
    <div class="moderadores">
    <h4 class="nomemoderados">Rankings Moderados</h4>
    <hr class="hr3">
    <!-- Lista de rankings Start -->
    <h1 id="nome">Meus Rankings</h1>
=======
        <hr>
        <!-- Sessão para criar ranking Start -->
        <?php
        if ($numRankings  < 3) { ?>
            <div class="box one">
                <div class="date">
                </div>
                <h4>CRIAR RANKING</h4>
                <br>
                <div class="text-box">
                    <div class="container">
                        <div class="center">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CriarRankingModal">
                                Criar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- Sessão para criar ranking End -->
        <hr>
        <!-- Lista de Campeonatos Start -->
        <h1 id="nome">Meus Campeonatos</h1>
>>>>>>> master

        <div class="wrap">
            <?php
            if (is_null(mysqli_fetch_assoc($campeonatosUsuario))) {
            ?>
                <p>Você ainda não tem campeonatos</p>
                <?php
            } else {
                foreach ($campeonatosUsuario as $campeonatoUsuario) {
                    $numCampeonatos++;
                ?>
                    <div class="box one">
                        <div class="date">
                        </div>
                        <h1><?= $campeonatoUsuario['nm_campeonato'] ?></h1>
                        <br>
                        <div class="text-box">
                            <div class="container">
                                <div class="center">
                                    <a href="../campeonato/campeonato.php?idCampeonato=<?= $campeonatoUsuario['id_campeonato'] ?>&nmCampeonato=<?= strtoupper($campeonatoUsuario['nm_campeonato']) ?>">
                                        <button type="button" class="btn btn-primary" data-toggle="modal">Entrar</button>
                                    </a>
                                </div>
                                <div class="center">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AlterarCampeonatoModal">
                                        Alterar
                                    </button>
                                </div>
                                <div class="center">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ExcluirCampeonatoModal">
                                        Excluir
                                    </button>
                                </div>
                            </div>
                    <?php
                }
            }
                    ?>
                        </div>
                    </div>
        </div>
        <!-- Lista de Campeonatos End -->
        <hr>
        <!-- Sessão para criar campeonato Start -->
        <?php
        if ($numRankings  < 3) { ?>
            <div class="box one">
                <div class="date">
                </div>
<<<<<<< HEAD
    </div>
    </div>
    <!-- Lista de rankings End -->


    <!-- TODO Uma boa opção seria passar esses modals para um arquivo .php separado, diminuindo o tamando desse arquivo e facilitando na chamada e manutenção -->
    <!-- Modals Start -->
    <!-- Upload Image Modal Start -->
    <div class="modal fade" id="UploadImageModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
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
                        <p class="arquivoescrita">Selecione uma imagem de perfil:</p>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input class="arquivo" type="submit" value="Salvar imagem" name="submit">

                        <!-- Exibe o botao de remover imagem caso o usuario ja tenha uma imagem -->
                        <?php if ($usuario['nm_caminho_foto'] != null) { ?>
                            <input type="submit" value="Remover imagem" name="remove">
                        <?php } ?>

                    </form>
=======
                <h4>CRIAR CAMPEONATO</h4>
                <br>
                <div class="text-box">
                    <div class="container">
                        <div class="center">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CriarCampeonatoModal">
                                Criar
                            </button>
                        </div>
                    </div>
>>>>>>> master
                </div>
            </div>
        <?php } ?>
        <!-- Sessão para criar campeonato End -->
        <hr>
        <h4>RANKINGS MODERADOS</h4>
        <!-- Lista de rankings Start -->
        <h1 id="nome">Meus Rankings</h1>

        <div class="wrap">
            <?php
            if (is_null(mysqli_fetch_assoc($rankingsModerados))) {
            ?>
                <p>Você ainda não tem rankings</p>
                <?php
            } else {
                foreach ($rankingsModerados as $rankingModerado) {
                ?>
                    <div class="box one">
                        <div class="date">
                        </div>
                        <h1><?= $rankingModerado['nm_ranking'] ?></h1>
                        <br>
                        <div class="text-box">
                            <div class="container">
                                <div class="center">
                                    <a href="../ranking/ranking.php?idRankings=<?= $rankingModerado['id_ranking'] ?>&nmRankings=<?= strtoupper($rankingModerado['nm_ranking']) ?>">
                                        <button type="button" class="btn btn-primary" data-toggle="modal">Entrar</button>
                                    </a>
                                </div>
                                <div class="center">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#SairModeradorModal-<?= $_SESSION['id'] ?>">
                                        Sair
                                    </button>
                                </div>
                            </div>

                            <!-- Modal Para remoção de moderadores Start (Tem que ficar dentro do foreach para pegar a referência do ID)-->
                            <div class="modal fade" id="SairModeradorModal-<?= $_SESSION['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="TituloModalLongoExemplo">Sair do ranking <?= $rankingModerado['nm_ranking'] ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST">
                                            <p>Deseja sair do ranking <?= $rankingModerado['nm_ranking'] ?>?</p>
                                            <input type="hidden" name="idUsuarioModerador" value="<?= $_SESSION['id'] ?>">
                                            <input type="hidden" name="idRanking" value="<?= $rankingModerado['id_ranking'] ?>">
                                            <div class="input-group-append">
                                                <input type="hidden" name="op" value="SairModerador">
                                                <input class="btn btn-success" type="submit" value="Sim">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Para remoção de moderadores End -->
                    <?php
                }
            }
                    ?>
                        </div>
                    </div>
        </div>
        <!-- Lista de rankings End -->


        <!-- TODO Uma boa opção seria passar esses modals para um arquivo .php separado, diminuindo o tamando desse arquivo e facilitando na chamada e manutenção -->
        <!-- Modals Start -->
        <!-- Upload Image Modal Start -->
        <div class="modal fade" id="UploadImageModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
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
        <!-- Upload Image Modal End -->

        <!-- Criar Ranking Modal Start -->
        <div class="modal fade" id="CriarRankingModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TituloModalCentralizado">Criar Ranking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nome</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="colFormLabel" placeholder="Nome do Ranking" name="nmRankings">
                                </div>
                            </div>
                            <div class="form-row align-items-center">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Esporte</label>
                                <div class="col-auto my-1">
                                    <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Privacidade</label>
                                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="ieModalidade">
                                        <option value="0" selected>Basquete</option>
                                        <option value="1">Futebol</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Privacidade:</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input1" type="radio" name="icPrivacidade" id="gridRadios1" value="0" checked>
                                            <label class="form-check-label" for="gridRadios1">
                                                Pública
                                            </label>
                                            <input class="form-check-input2" type="radio" name="icPrivacidade" id="gridRadios2" value="1">
                                            <label class="form-check-label" for="gridRadios2">
                                                Privada
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-primary" value="Criar" name="op">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Criar Ranking Modal End -->

        <?php
        if ($numRankings > 0) {
        ?>
            <!-- Alterar Ranking Modal Start -->
            <div class="modal fade" id="AlterarRankingModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="TituloModalCentralizado">Alterar Ranking</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Nome</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" class="form-control" id="colFormLabel" name="idRanking" value="<?= $rankings["id_ranking"] ?>">
                                        <input type="text" class="form-control" id="colFormLabel" placeholder="Nome do Ranking" name="nmRanking" value="<?= $rankings["nm_ranking"] ?>">
                                    </div>
                                </div>
                                <div class="form-row align-items-center">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Esporte</label>
                                    <div class="col-auto my-1">
                                        <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Privacidade</label>
                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="ieModalidade">
                                            <option value="0" selected>Basquete</option>
                                            <option value="1">Futebol</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <fieldset class="form-group">
                                    <div class="row">
                                        <legend class="col-form-label col-sm-2 pt-0">Privacidade</legend>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input1" type="radio" name="icPrivacidade" id="gridRadios1" value="0" checked>
                                                <label class="form-check-label" for="gridRadios1">
                                                    Pública
                                                </label>
                                                <input class="form-check-input2" type="radio" name="icPrivacidade" id="gridRadios2" value="1">
                                                <label class="form-check-label" for="gridRadios2">
                                                    Privada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <input type="submit" class="btn btn-primary" value="Alterar" name="op">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Alterar Ranking Modal End -->

            <!-- Excluir Ranking Modal Start -->
            <div class="modal fade" id="ExcluirRankingModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="TituloModalCentralizado">Excluir Ranking?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <input type="hidden" value="<?= $rankings['id_ranking'] ?>" name="idRanking">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-danger" value="Excluir" name="op">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Excluir Ranking Modal End -->
        <?php
        }
        ?>

        <!-- Modals campeonato Start -->
        <!-- Criar Campeonato Modal Start -->
        <div class="modal fade" id="CriarCampeonatoModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TituloModalCentralizado">Criar Campeonato</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <div class="form-group row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nome</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="colFormLabel" placeholder="Nome do Campeonato" name="nmCampeonato">
                                </div>
                            </div>
                            <div class="form-row align-items-center">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Esporte</label>
                                <div class="col-auto my-1">
                                    <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Privacidade</label>
                                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="ieModalidade">
                                        <option value="0" selected>Basquete</option>
                                        <option value="1">Futebol</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Privacidade:</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input1" type="radio" name="icPrivacidade" id="gridRadios1" value="0" checked>
                                            <label class="form-check-label" for="gridRadios1">
                                                Pública
                                            </label>
                                            <input class="form-check-input2" type="radio" name="icPrivacidade" id="gridRadios2" value="1">
                                            <label class="form-check-label" for="gridRadios2">
                                                Privada
                                            </label>
                                        </div>
                                        <input type="hidden" class="btn btn-primary" value="CriarCampeonato" name="op">
                                    </div>
                                </div>
                            </fieldset>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-primary" value="Criar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Criar Campeonato Modal End -->

        <?php
        if ($numCampeonatos > 0) {
        ?>
            <!-- Alterar Campeonato Modal Start -->
            <div class="modal fade" id="AlterarCampeonatoModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="TituloModalCentralizado">Alterar Campeonato</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Nome</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" class="form-control" id="colFormLabel" name="idCampeonato" value="<?= $campeonatoUsuario["id_campeonato"] ?>">
                                        <input type="text" class="form-control" id="colFormLabel" placeholder="Nome do Campeonato" name="nmCampeonato" value="<?= $campeonatoUsuario["nm_campeonato"] ?>">
                                    </div>
                                </div>
                                <div class="form-row align-items-center">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Esporte</label>
                                    <div class="col-auto my-1">
                                        <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Privacidade</label>
                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="ieModalidade">
                                            <option value="0" selected>Basquete</option>
                                            <option value="1">Futebol</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <fieldset class="form-group">
                                    <div class="row">
                                        <legend class="col-form-label col-sm-2 pt-0">Privacidade</legend>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input1" type="radio" name="icPrivacidade" id="gridRadios1" value="0" checked>
                                                <label class="form-check-label" for="gridRadios1">
                                                    Pública
                                                </label>
                                                <input class="form-check-input2" type="radio" name="icPrivacidade" id="gridRadios2" value="1">
                                                <label class="form-check-label" for="gridRadios2">
                                                    Privada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="btn btn-primary" value="AlterarCampeonato" name="op">
                                </fieldset>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <input type="submit" class="btn btn-primary" value="Alterar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Alterar Campeonato Modal End -->

            <!-- Excluir Campeonato Modal Start -->
            <div class="modal fade" id="ExcluirCampeonatoModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="TituloModalCentralizado">Excluir Campeonato?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <input type="hidden" value="<?= $campeonatoUsuario['id_campeonato'] ?>" name="idCampeonato">
                                <input type="hidden" class="btn btn-danger" value="ExcluirCampeonato" name="op">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-danger" value="Excluir">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Excluir Campeonato Modal End -->
            <!-- Modals campeonato End -->
        <?php
        }
        ?>
        <!-- Modals End -->
</body>