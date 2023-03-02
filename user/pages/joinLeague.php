<?php

session_start();
if (empty($_SESSION['user_id'])) {
    header('location: ../index.php');
}
if (!empty($_SESSION['id_league'])) {
    header('location: homepage.php');
}
if (!empty($_SESSION['id_squad'])) {
    header('location: homepage.php');
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
        <h2>Iscriviti ad una lega!</h2>
        <?php
        include_once dirname(__FILE__) . '/../function/league.php';
        $league = getArchiveLeague();
        ?>
        <form method="post" style="margin-top: 20px;">
            <div class="mb-3">
                <div class="form-floating">
                    <select class="form-select" name="id_league" id="inputGroupSelect02">
                        <option selected disabled>Seleziona la tua lega!</option>
                        <?php foreach ($league as $row): ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <hr>
            <div class="mb-3">
                <label for="name" class="form-label"><b>Nome della tua squadra</b></label>
                <input type="text" class="form-control" placeholder="Nome della tua squadra" name="name_squad" required>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Invia</button>
            </div>
        </form>

        <?php
        include_once dirname(__FILE__) . '/../function/squad.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['id_league'] != "") {
                $data_squad = array(
                    'name' => $_POST['name_squad'],
                    'id_user' => $_SESSION['user_id'],
                );

                $res_squad = createSquad($data_squad);
                ?>

                <?php if ($res_squad != "1"): ?>
                    <p class="text-danger">Errore nella creazione della squadra</p>
                <?php endif ?>
                <?php
                if ($res_squad == "1") {
                    if (getSquadId($_SESSION['user_id']) != "1") {
                        echo ('<p class="text-danger">Errore nella creazione della squadra</p>');
                    } else {
                        $data_join = array(
                            'id_squad' => $_SESSION['id_squad'],
                            'id_league' => $_POST['id_league'],
                        );

                        if (joinLeague($data_join) == 1) {
                            $_SESSION['id_league'] = $_POST['id_league'];
                            header('location: homepage.php');
                        } else {
                            echo ('<p class="text-danger">Errore nella iscrizione della tua squadra nella lega</p>');
                        }
                    }

                }
            } else {
                echo ('<p class="text-danger">Inserisci la lega alla quale ti vuoi iscrivere!</p>');
            }
        }
        ?>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
</body>

</html>