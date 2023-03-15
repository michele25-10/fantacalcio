<?php
session_start();
error_reporting(0);
if (empty($_SESSION['user_id'])) {
    header('location: ../login.php');
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fantacalcio | Leghe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.svg">
</head>

<body>
    <?php require_once(__DIR__ . '\navbar.php'); ?>

    <?php
    include_once dirname(__FILE__) . '/../function/league.php';
    $league = getArchiveLeagueMoreDetails();
    ?>

    <div class="container" style="padding: 10px 10px; ">

        <h2>Elenco leghe:</h2>


        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-2">
            <?php foreach ($league as $row): ?>
                <div class="col">
                    <div class="card mb-3" style="max-width: 80%;">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="../assets/img/Stemma_League.png" class="img-thumbnail" alt="..."
                                    style="width: 100px; height:100px; ">
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo ($row['name']) ?>
                                    </h5>
                                    <p class="card-text"><small class="text-muted">
                                            <?php echo ($row['id_trustee']) ?>
                                        </small></p>
                                </div>
                            </div>
                            <div class="col-md-3 mt-4">
                                <?php if (empty($_SESSION['id_league'])): ?>
                                    <a
                                        href="joinLeague.php?id_league=<?php echo ($row['id']) ?>&name=<?php echo ($row['name']) ?>">
                                        <button class="btn btn-outline-primary">Iscriviti</button>
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
</body>

</html>