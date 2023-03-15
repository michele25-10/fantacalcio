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
    <title>Fantacalcio | Classifica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.svg">
</head>

<body>
    <?php require_once(__DIR__ . '\navbar.php'); ?>
    <?php
    include_once dirname(__FILE__) . '/../function/league.php';
    $ranking = getRanking($_SESSION['id_league']);
    $i = 1;
    ?>



    <div class="container" style="padding: 30px 10px; ">

        <?php
        include_once dirname(__FILE__) . '/../function/match.php';
        $numbermatch = getLastNumberMatch($_SESSION['id_league']);
        if ($numbermatch == -1) {
            echo ('<p class="text-danger">Non sono state ancora simulate le prime partite.</p>');
        }
        ?>
        <?php if ($numbermatch != -1): ?>
            <h2>Classifica</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Posizione</th>
                        <th scope="col">Nome Squadra</th>
                        <th scope="col">Punteggio</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($ranking as $row): ?>
                        <tr>
                            <td>
                                <?php echo $i++ ?>
                            </td>
                            <td>
                                <?php echo $row['name'] ?>
                            </td>
                            <td>
                                <?php echo $row['score'] ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <div class="container">
            <div class="container mt-3">
                <h2>Giornata numero: <b>
                        <?php echo ($numbermatch) ?>
                    </b>
                </h2>

                <div class="progress" role="progressbar" aria-label="Basic example"
                    aria-valuenow="<?php echo ($numbermatch) ?>" aria-valuemin="0" aria-valuemax="38">
                    <?php
                    $area = ($numbermatch / 38) * 100;
                    ?>
                    <div class="progress-bar" style="width: <?php echo ($area) ?>%"></div>
                </div>
            </div>
        </div>
    <?php endif ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
</body>

</html>