<?php

include_once dirname(__FILE__) . '/../function/league.php';

session_start();
if (empty($_SESSION['user_id'])) {
    header('location: ../login.php');
} else {
    $res = checkTrustee($_SESSION['user_id']);
    if ($res == "-1") {
        header('location: homepage.php');
    }
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

    <?php
    include_once dirname(__FILE__) . '/../function/squad.php';
    include_once dirname(__FILE__) . '/../function/player.php';
    $squad = getSquadById($_GET['id_squad']);
    $player = getArchivePlayer();
    ?>
    <div class="mx-auto" style="width: 50%; padding: 30px 0px">
        <h2>Crea la tua lega!</h2>
        <form method="post" style="margin-top: 20px;">
            <div class="mb-3">
                <label for="name" class="form-label">Squadra: <b>
                        <?php echo ($squad) ?>
                    </b></label>
            </div>
            <hr>
            <div class="mb-3">
                <label for="name" class="form-label">Calciatore</label>
                <div class="form-floating">
                    <select class="form-select" name="id_player" id="inputGroupSelect02" required>
                        <option selected disabled>Seleziona calciatore!</option>
                        <?php foreach ($player as $row): ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['surname'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Invia</button>
            </div>
        </form>

        <?php

        include_once dirname(__FILE__) . '/../function/rosa.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['id_player'] != "") {
                $data = array(
                    "id_squad" => $_GET['id_squad'],
                    "id_league" => $_SESSION['id_league'],
                    "id_player" => $_POST['id_player'],
                );

                $res = addPlayerToSquad($data);

                var_dump($res);

                if ($res == -1) {
                    echo ('<p class="text-danger">Errore, riprova più tardi!</p>');
                } elseif ($res == 1) {
                    echo ('<p class="text-success">Giocatore aggiunto alla squadra!</p>');
                } else {
                    echo ('<p class="text-bold">' . $res . '</p>');
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