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
    include_once dirname(__FILE__) . '/../function/squad.php';
    include_once dirname(__FILE__) . '/../function/player.php';
    $squad = getSquadById($_SESSION['id_squad']);
    ?>

    <div class="container pt-3 px-5">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 g-2">
            <div class="col mb-3">
                <h2 class="mb-3">La tua squadra:
                    <b>
                        <?php echo $squad ?>
                    </b>
                </h2>
                <?php
                $player = getPlayerOfSquad($_SESSION['id_squad']);
                ?>
                <ul class="list-group">
                    <?php foreach ($player as $row): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo ($row['surname']) ?>
                            <span class="badge bg-primary px-3 py-3">
                                <?php echo ($row['role']) ?>
                            </span>
                        </li>
                    <?php endforeach ?>
                </ul>

            </div>
            <div class="col d-flex justify-content-center">
                <img src="../assets/img/campoDaCalcio.webp" class="img-fluid" alt="Campo da calcio">
            </div>
        </div>
    </div>

    <?php require_once(__DIR__ . '\footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
</body>

</html>