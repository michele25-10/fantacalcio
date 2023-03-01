<?php

function createSquad($data)
{
    $url = 'http://localhost/fantacalcio/backend/api/squad/createSquad.php';

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

function getSquadId($id)
{
    $url = 'http://localhost/fantacalcio/backend/api/squad/getSquadByUserId.php?id_user=' . $id;

    $json_data = file_get_contents($url);

    if ($json_data != false) {
        $decode_data = json_decode($json_data, $assoc = true);
        $squad_data = $decode_data;
        $squads_arr = array();
        if (!empty($squad_data)) {
            foreach ($squad_data as $squad) {
                $squad_record = array(
                    'id' => $squad['id'],
                );
                array_push($squads_arr, $squad_record);
            }

            $_SESSION['id_squad'] = $squads_arr[0]['id'];
            return 1;
        } else {
            return -1;
        }
    } else {
        return -1;
    }
}

?>