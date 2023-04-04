<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fantacalcio | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" type="image/x-icon" href="assets/img/logo.svg">
</head>

<body>
    <form class="form-signin" method="post">
        <div class="row">
            <div class="col-7 mx-auto">
                <img class="mb-4" src="assets/img/logo.svg" alt="" width="100%" height="">
            </div>
        </div>
        <h1 class="h3 mb-3 fw-bold">Inserisci le credenziali</h1>
        <label for="inputEmail" class="sr-only mb-2">Nickname</label>
        <input type="text" id="inputEmail" class="form-control mb-4" placeholder="nickname" name="nickname" required
            autofocus>
        <label for="inputPassword" class="sr-only mb-2">Password</label>
        <input type="password" id="inputPassword" class="form-control mb-4" placeholder="Password" name="password"
            required>

        <?php
        session_start();
        error_reporting(0);

        include_once dirname(__FILE__) . '\function\user.php';
        include_once dirname(__FILE__) . '\function\squad.php';
        include_once dirname(__FILE__) . '\function\league.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['nickname']) && !empty($_POST['password'])) { //se la variabile mail o password che devono essere inviate non sono vuote all'ora si invia
        
                $pw = hash("sha256", $_POST['password']);

                $data = array(
                    //Immetto i dati all'interno di data
                    "nickname" => $_POST['nickname'],
                    "pw" => $pw,
                );

                if (login($data) == -1) {
                    echo ('<p class=text-danger>Email o password errata</p>');
                } else {
                    $id_squad = getSquadIdLogin($_SESSION['user_id']);
                    var_dump($id_squad); 
                    if ($id_squad == -1) {
                        echo '<p class="text-danger">Errore squadra riprova più tardi!</p>';
                    } elseif ($id_squad == -2) {
                        header('Location: pages/homepage.php');

                    } else {
                        $_SESSION['id_squad'] = $id_squad;
                        $id_league = getLeagueBySquad($_SESSION['id_squad']);
                        if ($id_league == -1) {
                            echo '<p class="text-danger">Errore riprova più tardi!</p>';
                        } elseif ($id_league == -2) {
                            header('Location: pages/homepage.php');
                        } else {
                            $_SESSION['id_league'] = $id_league;
                            header('Location: pages/homepage.php');
                        }
                    }
                }
            } else {
                echo ('<p class="text-danger">Campo richiesto</p>');
            }
        }
        ?>

        <div class="row">
            <button class="btn btn-lg btn-primary btn-block mx-auto" type="submit">Accedi</button>
            <div class="row">
                <a class="text-dark" href="pages/registration.php" style="text-decoration: none; font-size:13px;">
                    <u>Non hai ancora un account, registrati ora!</u>
                </a>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>

<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        -ms-flex-align: center;
        -ms-flex-pack: center;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }

    .form-signin .form-control:focus {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        /* border-bottom-right-radius: 0; */
        /* border-bottom-left-radius: 0; */
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        /* border-top-left-radius: 0; */
        /* border-top-right-radius: 0; */
    }
</style>