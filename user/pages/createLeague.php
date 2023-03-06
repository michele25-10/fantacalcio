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
    <title>Fantacalcio | Crea Lega</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.svg">
</head>

<body>
    <?php require_once(__DIR__ . '\navbar.php'); ?>
    <div class="mx-auto" style="width: 50%; padding: 30px 0px">
        <h2>Crea la tua lega!</h2>
        <form method="post" style="margin-top: 20px;">
            <div class="mb-3">
                <label for="name" class="form-label"><b>Nome della lega</b></label>
                <input type="text" class="form-control" placeholder="Nome della tua lega" name="name_league" required>
            </div>
            <hr>
            <div class="mb-3">
                <label for="name" class="form-label"><b>Nome della tua squadra</b></label>
                <input type="text" class="form-control" placeholder="Nome della tua squadra" name="name_squad" required>
            </div>
            <div class="mb-3">
                <?php if (empty($_SESSION['id_league']) && empty($_SESSION['id_squad'])): ?>
                    <button class="btn btn-primary" type="submit">Invia</button>
                <?php endif ?>
                <?php if (!empty($_SESSION['id_league']) || !empty($_SESSION['id_squad'])): ?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Invia
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Sei già iscritto ad una lega!
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Non puoi creare due leghe contemporaneamente; attendi che la lega che hai
                                        creato termini il suo campionato... successivamente potrai iscriverti oppure
                                        creare la tua nuova lega di nuovo.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="homepage.php">
                                        <button type="button" class="btn btn-primary">Ok!</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </form>

        <?php

        include_once dirname(__FILE__) . '/../function/league.php';
        include_once dirname(__FILE__) . '/../function/squad.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data_league = array(
                'name' => $_POST['name_league'],
                'id_user' => $_SESSION['user_id'],
            );

            $res_league = createLeague($data_league);

            $data_squad = array(
                'name' => $_POST['name_squad'],
                'id_user' => $_SESSION['user_id'],
            );

            $res_squad = createSquad($data_squad);

            if ($res_squad != "1") {
                echo ('<p class="text-danger">Errore nella creazione della squadra</p>');
            }

            if ($res_league != "1") {
                echo ('<p class="text-danger">Errore nella creazione della lega</p>');
            }

            if ($res_squad == "1" && $res_league == "1") {
                $id_league = getLeagueByTrusteeId($_SESSION['user_id']);
                if (getSquadId($_SESSION['user_id']) != "1" && $id_league == "-1") {
                    echo ('<p class="text-danger">Errore nella creazione della squadra</p>');
                } else {
                    $_SESSION['id_league'] = $id_league;
                    $data_join = array(
                        'id_squad' => $_SESSION['id_squad'],
                        'id_league' => $_SESSION['id_league'],
                    );
                    if (joinLeague($data_join) == 1) {
                        header('location: homepage.php');
                    } else {
                        echo ('<p class="text-danger">Errore nella iscrizione della tua squadra nella lega</p>');
                    }
                }

            }
        }
        ?>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
</body>

</html>