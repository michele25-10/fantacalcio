<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('location: ../index.php');
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
    <?php require_once(__DIR__ . '\navbar.php');
    include_once dirname(__FILE__) . '/../function/league.php';
    $squad = getSquadJoinLeague($_GET['id_league']);
    ?>

    <div class="container mt-3">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 g-2">
            <div class="col">
                <h2>Lega: <b>
                        <?php echo ($_GET['name']) ?>
                    </b></h2>
                <?php if ($squad != -1): ?>
                    <ul class="list-group mt-3">
                        <?php foreach ($squad as $row): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo ($row['name']) ?>
                                <span class="badge bg-primary px-3 py-3">
                                    <?php echo ($row['nickname']) ?>
                                </span>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
                <?php if ($squad == -1): ?>
                    <p class="text-danger">Non ci sono squadre iscritte a questa lega</p>
                <?php endif ?>
            </div>
            <div class="col">
                <form method="post" class="mt-3 px-5 py-5">
                    <div class="mb-3">
                        <label for="name" class="form-label"><b>Nome della tua squadra</b></label>
                        <input type="text" class="form-control" placeholder="Nome della tua squadra" name="name_squad"
                            required>
                    </div>
                    <div class="mb-3">
                        <?php if (empty($_SESSION['id_league']) && empty($_SESSION['id_squad'])): ?>
                            <button class="btn btn-primary" type="submit">Invia</button>
                        <?php endif ?>
                        <?php if (!empty($_SESSION['id_league']) || !empty($_SESSION['id_squad'])): ?>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Invia
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Sei già iscritto ad una
                                                lega!
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Non puoi iscriverti a due leghe contemporaneamente; attendi che la lega alla
                                                quale
                                                sei iscritto termini il suo campionato... successivamente potrai iscriverti
                                                oppure
                                                creare la tua nuova lega.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
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
            </div>
        </div>
    </div>

    <?php
    include_once dirname(__FILE__) . '/../function/squad.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data_squad = array(
            'name' => $_POST['name_squad'],
            'id_user' => $_SESSION['user_id'],
        );
        $res_squad = createSquad($data_squad);

        if ($res_squad != "1") {
            echo ('<p class="text-danger">Errore nella creazione della squadra</p>');
        }
        if ($res_squad == "1") {
            $id_squad = getSquadId($_SESSION['user_id']);
            if ($id_squad == "-1") {
                echo ('<p class="text-danger">Errore nella creazione della squadra</p>');
            } else {
                $_SESSION['id_squad'] = $id_squad;
                $data_join = array(
                    'id_squad' => $_SESSION['id_squad'],
                    'id_league' => $_GET['id_league'],
                );

                if (joinLeague($data_join) == 1) {
                    $_SESSION['id_league'] = $_GET['id_league'];
                    echo ('<p class="text-success">La tua squadra è stata iscritta alla lega</p>');
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