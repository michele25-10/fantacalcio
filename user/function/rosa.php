<?php
function getSquadJoinLeague($id_league)
{
    $url = 'http://localhost/fantacalcio/backend/api/squad_league/getSquadJoinLeague.php?id_league=' . $id_league;

    $json_data = file_get_contents($url);
    $decode_data = json_decode($json_data, $assoc = true);

    if ($decode_data["message"] != "-1") {
        $squad_data = $decode_data;
        $squads_arr = array();
        if (!empty($squad_data)) {
            foreach ($squad_data as $squad) {
                $squad_record = array(
                    'id' => $squad['id'],
                    'name' => $squad['name'],
                    'nickname' => $squad['nickname'],
                );
                array_push($squads_arr, $squad_record);
            }

            return $squads_arr;
        } else {
            return -1;
        }

    } else {
        return -1;
    }
}

function addPlayerToSquad($data)
{
    $url = 'http://localhost/fantacalcio/backend/api/rosa/addPlayerToSquad.php';

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

    return $response->message;
}

function getNumberPlayer($id_squad)
{
    $url = 'http://localhost/fantacalcio/backend/api/rosa/getNumberPlayer.php?id_squad=' . $id_squad;

    $json_data = file_get_contents($url);
    $decode_data = json_decode($json_data, $assoc = true);

    $player_data = $decode_data;
    $player_arr = array();
    if (!empty($player_data)) {
        foreach ($player_data as $player) {
            $player_record = array(
                'number' => $player['number'],
            );
            array_push($player_arr, $player_record);
        }

        return $player_arr[0]['number'];
    } else {
        return -1;
    }
}
?>