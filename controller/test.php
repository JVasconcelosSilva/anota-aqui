<?php
// TODO
include_once 'connection.php';
// class Test extends connection
// {

//     public function __construct($nome)
//     {
//         $this->nome = $nome;
//     }

// public function adicionarGol($idJogador, $idRanking, $qtGolAtual, $idUsuario)
// {

$connection = new connection();
$con = $connection->OpenCon();

$isAdm = $_POST['isAdm'] ?? null;
$idRanking = $_POST['idRanking'] ?? null;
$idJogador = $_POST['idJogador'] ?? null;

$sql = "UPDATE Jogadores_Ranking SET qt_ponto = qt_ponto + 1 WHERE id_jogador = $idJogador";
mysqli_query($con, $sql);

$sql = "SELECT p.* FROM (SELECT @getJogadoresRanking:=$idRanking f) s, vw_ranking p;";
$query = mysqli_query($con, $sql);
//$qtd = mysqli_num_rows($query);
// throw new Exception($sql);

$connection->CloseCon($con);
// }
// }



?>

<?php
$contador = 0;
$contador++;



while ($jogador = mysqli_fetch_assoc($query)) {
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
                <h5 class="gols" id="pontos"><?= $jogador['qt_ponto'] ?> </h5>
                <?php
                if ($isAdm) { ?>
                    <div class="col-md-2">
                        <div class="row" mx-auto>
                            <!--Adiciona um gol-->
                            <!-- TODO Atualizando valores com jquery -->
                            <!-- <a onclick="addItemToUsersList()"> Add </a> -->
                            <script>
                                var pontos = document.getElementsByTagName("pontos");
                            </script>
                            <input type="submit" onclick="addItemToUsersList(<?= $jogador['id_jogador'], $idRanking ?>)" value="Add" class="btn btn-primary" />
                            <form method="POST">
                                <input type="hidden" name="idRankings" value="<?= $idRanking ?>">
                                <input type="hidden" name="qtGolAtual" value="<?= $jogador['qt_ponto'] ?>">
                                <input type="hidden" name="idJogador" value="<?= $jogador['id_jogador'] ?>">
                                <input type="submit" name="op" value="+" class="btn btn-primary" />
                            </form>
                            <!--Remove um gol-->
                            <form method="POST">
                                <input type="hidden" name="idRankings" value="<?= $idRanking ?>">
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

// return json_encode(array("status" => true, "added" => true));
?>