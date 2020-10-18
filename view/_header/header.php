<?php
// Incluir session em todas as páginas exceto index, login e cadastro. Nestas páginas, iniciar a sessão para verificar se o mesmo "isset".
if ($_SERVER['REQUEST_URI'] != '/view/index/index.php' && $_SERVER['REQUEST_URI'] != '/view/login/login.php' && $_SERVER['REQUEST_URI'] != '/view/cadastro/cadastro.php' && $_SERVER['REQUEST_URI'] != '/view/publica/publica.php') {
    include '../../controller/Session.php';
} else if ($_SERVER['REQUEST_URI'] == '/view/index/index.php' || $_SERVER['REQUEST_URI'] == '/view/login/login.php' || $_SERVER['REQUEST_URI'] == '/view/cadastro/cadastro.php' || $_SERVER['REQUEST_URI'] == '/view/publica/publica.php') {
    session_start();
}

$nomeArtilharia = $_POST['nmRanking'] ?? null;
?>

<!-- Bootsstrap reference start -->
<!-- Referência utilizada em todas as páginas -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<!-- Bootsstrap reference end -->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- Header start -->
<!-- Cabeçalho usado em todas as páginas -->
<header>

    <!-- TODO Navbar DEV-MODE start -->
    <!-- Navbar start -->
    <ul>
        <li><a href="/">Anota Aqui</a></li>
        <li style="float:right">
            <!-- Button com dropdown start -->
            <!-- TODO style mockado, passar para CSS -->
            <div class="input-group mb-3" style="position: unset;">
                <div class="input-group-prepend">
                    <?php
                    if (isset($_SESSION)) { ?>
                        <button type="button" onclick="window.location.href = '../perfil/perfil.php'" id="user" class="btn btn-outline-secondary"><?php echo $_SESSION['nome']; ?></button>
                    <?php } else { ?>
                        <button type="button" onclick="window.location.href = '../login/login.php'" id="user" class="btn btn-outline-secondary">Login</button>
                    <?php } ?>
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>

                    <div class="dropdown-menu dropdown-menu-right">
                        <form method="get" action="../publicas/publicas.php?nomeArtilharia=<?= $nomeArtilharia ?>" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group" id="menuPesquisa">
                                <input type="text" name="nomeArtilharia" class="form-control bg-light border-0 small" placeholder="Procurar ranking..." aria-label="Search" aria-describedby="basic-addon2">
                            </div>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../publica/publica.php">Rankings Públicos</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../minhas-informacoes.php">Minhas Informações</a>
                            <a class="dropdown-item" href="../perfil/perfil.php">Perfil</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <?php if (isset($_SESSION)) { ?>
                                <a class="dropdown-item" href="../logout/logout.php">Sair</a>
                            <?php } else { ?>
                                <a class="dropdown-item" href="../login/login.php">Login</a>
                                <a class="dropdown-item" href="../cadastro/cadastro.php">Cadastro</a>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Button com dropdown end -->
        </li>
    </ul>
    <!-- TODO Navbar DEV-MODE end -->

</header>
<!-- Header end -->