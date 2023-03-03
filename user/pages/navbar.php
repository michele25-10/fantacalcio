<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="homePage.php">
                <img src="../assets/img/logo.svg" alt="Logo" width="30" height="24"
                    class="d-inline-block align-text-top me-2">
                Fantacalcio
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="archiveLeague.php">Leghe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Giornate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewOrder.php">Squadra</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="getRanking.php">Classifica</a>
                    </li>
                    <?php
                    include_once dirname(__FILE__) . '/../function/league.php';
                    $res = checkTrustee($_SESSION['user_id']);
                    ?>
                    <?php if ($res == 0): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="squadOnLeague.php">Asta</a>
                        </li>
                    <?php endif ?>
                </ul>
                <a href="../function/logout.php">
                    <button type="button" class="btn btn-outline-danger">Esci
                    </button>
                </a>
            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>