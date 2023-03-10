<?php

session_start();
if (empty($_SESSION['user_id'])) {
    header('location: ../login.php');
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fantacalcio | Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.svg">
</head>

<body>
    <?php require_once(__DIR__ . '\navbar.php'); ?>
    <?php
    include_once dirname(__FILE__) . '/../function/user.php';
    if (!empty($_SESSION['id_squad']) && !empty($_SESSION['id_league'])) {
        $info = infoHomePage($_SESSION['user_id']);
    }
    ?>
    <?php if (!empty($_SESSION['id_squad']) && !empty($_SESSION['id_league'])): ?>
        <div class="container px-3 mt-3">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-2">
                <div class="col">
                    <h2>Benvenuto: <b>
                            <?php echo ($info[0]['nickname']) ?>
                        </b></h2>
                </div>
                <div class="col">
                    <h2>La tua squadra è: <b>
                            <?php echo $info[0]['name'] ?>
                        </b></h2>
                </div>
            </div>
        <?php endif ?>

        <div class="container px-3 pt-4 mb-5 pb-5">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-2">
                <div class="col">
                    <div class="card w-auto h-100 bg-primary-subtle">
                        <div class="card-body">
                            <h5 class="card-title">Lega</h5>
                            <p class="card-text">Iscriviti o crea la tua prima lega, potrai giocare in compagnia dei
                                tuoi amici!<br>
                                Sfidali e scoprirai chi è quello che di calcio in fin dei conti ne sa di più.
                            </p>
                            <a href="archiveLeague.php" class="btn btn-outline-success">Iscriviti</a>
                            <a href="createLeague.php" class="btn btn-outline-success">Crea</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card w-auto h-100 bg-primary-subtle">
                        <div class="card-body">
                            <h5 class="card-title">Squadra</h5>
                            <p class="card-text">Visualizza la tua squadra, se non la hai neancora creata, iscriviti ad
                                una
                                lega ed inizia a giocare!
                                <br>
                                Che Aspetti inizia ora?!
                            </p>
                            <?php if (empty($_SESSION['id_league']) && empty($_SESSION['id_squad'])): ?>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Visualizza
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Non sei iscritto ad
                                                    una
                                                    lega!
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Non puoi visualizzare il campionato se non sei iscritto ad una lega.
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                            <?php if (!empty($_SESSION['id_league']) || !empty($_SESSION['id_squad'])): ?>
                                <a href="getMySquad.php" class="btn btn-outline-success">Visualizza</a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card w-auto h-100 bg-primary-subtle">
                        <div class="card-body">
                            <h5 class="card-title">Campionato</h5>
                            <p class="card-text">Visualizza il tuo campionato, e scopri quale squadra stai sfidando, chi
                                avrà fatto le scelte tattiche migliori?
                                <br>
                                Che Aspetti inizia ora?!
                            </p>
                            <?php if (empty($_SESSION['id_league']) && empty($_SESSION['id_squad'])): ?>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Visualizza
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Non sei iscritto ad
                                                    una
                                                    lega!
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Non puoi visualizzare il campionato se non sei iscritto ad una lega.
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                            <?php if (!empty($_SESSION['id_league']) || !empty($_SESSION['id_squad'])): ?>
                                <a href="#" class="btn btn-outline-success">Visualizza</a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card w-auto h-100 bg-primary-subtle">
                        <div class="card-body">
                            <h5 class="card-title">Classifica</h5>
                            <p class="card-text">Scopri chi è in vetta al tuo campionato, e fissati dei nuovi obiettivi
                                da
                                superare.
                                <br>
                                Sarai un allenatore all'altezza!?
                            </p>
                            <?php if (empty($_SESSION['id_league']) && empty($_SESSION['id_squad'])): ?>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Visualizza
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Non sei iscritto ad
                                                    una
                                                    lega!
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Non puoi visualizzare la classifica se non sei iscritto ad una lega.
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                            <?php if (!empty($_SESSION['id_league']) || !empty($_SESSION['id_squad'])): ?>
                                <a href="getRanking.php" class="btn btn-outline-success">Visualizza</a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once(__DIR__ . '\footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
</body>

</html>