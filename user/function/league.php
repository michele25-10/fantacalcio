<?php
function createLeague($data)
{
    $url = 'http://localhost/fantacalcio/backend/api/league/createLeague.php';

    $curl = curl_init($url); //inizializza una nuova sessione di cUrl
    //Curl contiene il return del curl_init 

    curl_setopt($curl, CURLOPT_URL, $url); // setta l'url 
    curl_setopt($curl, CURLOPT_POST, true); // specifica che è una post request
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // ritorna il risultato come stringa


    $headers = array(
        "Content-Type: application/json",
        "Content-Lenght: 0",
    );


    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // setta gli headers della request

    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

    $responseJson = curl_exec($curl); //eseguo

    curl_close($curl); //chiudo sessione

    $response = json_decode($responseJson); //decodifico la response dal json

    if ($response->message == true) //response == true vuol dire sessione senza errori
    {
        return 1;
    } else {
        return -1;
    }
}

function getLeagueByTrusteeId($id)
{
    $url = 'http://localhost/fantacalcio/backend/api/league/getLeagueByTrustee.php?id_trustee=' . $id;

    $json_data = file_get_contents($url);
    if ($json_data != false) {
        $decode_data = json_decode($json_data, $assoc = true);
        $league_data = $decode_data;
        $leagues_arr = array();
        if (!empty($league_data)) {
            foreach ($league_data as $league) {
                $league_record = array(
                    'id' => $league['id'],
                    'name' => $league['name'],
                    'id_trustee' => $league['id_trustee'],
                );
                array_push($leagues_arr, $league_record);
            }
            return $leagues_arr[0]['id'];
        } else {
            return -1;
        }
    } else {
        return -1;
    }
}

function joinLeague($data)
{
    $url = 'http://localhost/fantacalcio/backend/api/squad_league/joinLeague.php';

    $curl = curl_init($url); //inizializza una nuova sessione di cUrl
    //Curl contiene il return del curl_init 

    curl_setopt($curl, CURLOPT_URL, $url); // setta l'url 
    curl_setopt($curl, CURLOPT_POST, true); // specifica che è una post request
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // ritorna il risultato come stringa


    $headers = array(
        "Content-Type: application/json",
        "Content-Lenght: 0",
    );


    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // setta gli headers della request

    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

    $responseJson = curl_exec($curl); //eseguo

    curl_close($curl); //chiudo sessione

    $response = json_decode($responseJson); //decodifico la response dal json

    if ($response->message == true) //response == true vuol dire sessione senza errori
    {
        return 1;
    } else {
        return -1;
    }
}

function getArchiveLeague()
{

    $url = 'http://localhost/fantacalcio/backend/api/league/getArchiveLeague.php';

    $json_data = file_get_contents($url);

    if ($json_data != false) {
        $decode_data = json_decode($json_data, $assoc = true);
        $league_data = $decode_data;
        $leagues_arr = array();
        if (!empty($league_data)) {
            foreach ($league_data as $league) {
                $league_record = array(
                    'id' => $league['id'],
                    'name' => $league['name'],
                    'id_trustee' => $league['id_trustee'],
                );
                array_push($leagues_arr, $league_record);
            }
            return $leagues_arr;
        } else {
            return -1;
        }
    } else {
        return -1;
    }
}

function getRanking($id)
{

    $url = 'http://localhost/fantacalcio/backend/api/league/getRanking.php?id_league=' . $id;

    $json_data = file_get_contents($url);

    if ($json_data != false) {
        $decode_data = json_decode($json_data, $assoc = true);
        $ranking_data = $decode_data;
        $ranking_arr = array();
        if (!empty($ranking_data)) {
            foreach ($ranking_data as $league) {
                $rank_record = array(
                    'name' => $league['name'],
                    'score' => $league['score'],
                );
                array_push($ranking_arr, $rank_record);
            }
            return $ranking_arr;
        } else {
            return -1;
        }
    } else {
        return -1;
    }
}

function getLeagueBySquad($id)
{
    $url = 'http://localhost/fantacalcio/backend/api/squad_league/getLeagueBySquad.php?id_squad=' . $id;

    $json_data = file_get_contents($url);
    $decode_data = json_decode($json_data, $assoc = true);

    if ($decode_data['message'] == "-2") {
        return -2;
    } else {
        if ($json_data != false) {
            $league_data = $decode_data;
            $league_arr = array();
            if (!empty($league_data)) {
                foreach ($league_data as $league) {
                    $league_record = array(
                        'id' => $league['id'],
                    );
                    array_push($league_arr, $league_record);
                }
                return $league_arr[0]['id'];
            } else {
                return -1;
            }

        } else {
            return -1;
        }
    }
}

function getArchiveLeagueMoreDetails()
{

    $url = 'http://localhost/fantacalcio/backend/api/league/getArchiveLeagueMoreDetails.php';

    $json_data = file_get_contents($url);

    if ($json_data != false) {
        $decode_data = json_decode($json_data, $assoc = true);
        $league_data = $decode_data;
        $leagues_arr = array();
        if (!empty($league_data)) {
            foreach ($league_data as $league) {
                $league_record = array(
                    'id' => $league['id'],
                    'name' => $league['name'],
                    'id_trustee' => $league['id_trustee'],
                );
                array_push($leagues_arr, $league_record);
            }
            return $leagues_arr;
        } else {
            return -1;
        }
    } else {
        return -1;
    }
}

function checkTrustee($id)
{
    $url = 'http://localhost/fantacalcio/backend/api/league/checkTrustee.php?id_user=' . $id;

    $json_data = file_get_contents($url);
    $decode_data = json_decode($json_data, $assoc = true);

    return $decode_data['message'];
}

?>