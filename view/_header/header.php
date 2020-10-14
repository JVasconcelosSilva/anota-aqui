<?php
// session_start();
include '../../controller/Session.php';
?>

<!-- Bootsstrap reference start -->
<!-- Referência utilizada em todas as páginas -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<!-- Bootsstrap reference end -->
<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
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
        <li style="float:right">
            <!-- Button com dropdown start -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button type="button" onclick="window.location.href = '/view/minhas-informacoes.php'" id="user" class="btn btn-outline-secondary"><?php echo $_SESSION['nome']; ?></button>
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>

                    <div class="dropdown-menu dropdown-menu-right">
                        <form method="get" action="/view/publicas.php?nomeArtilharia=<?= $nomeArtilharia ?>" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group" id="menuPesquisa">
                                <input type="text" name="nomeArtilharia" class="form-control bg-light border-0 small" placeholder="Procurar artilharia..." aria-label="Search" aria-describedby="basic-addon2">
                            </div>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href="view/Publica/publica.php">Rankings Públicos</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href="view/minhas-informacoes.php">Minhas Informações</a>
                            <a class="dropdown-item" href="view/Perfil/perfil.php">Perfil</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href="view/login/login.php">Login</a>
                            <a class="dropdown-item" href="view/logout/logout.php">Sair</a>
                    </div>
                </div>
            </div>
            <!-- Button com dropdown end -->
        </li>
    </ul>

    <!-- TODO Navbar DEV-MODE end -->

    <!-- Navbar start -->
    <!-- Navbar end -->
</header>
<!-- Header end -->