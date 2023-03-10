<?php

function login($data)
{
    $url = 'http://localhost/fantacalcio/backend/api/user/login.php';

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

    if ($response->response == true) //response == true vuol dire sessione senza errori
    {
        $_SESSION['user_id'] = $response->userID;
    } else {
        return -1;
    }
}

function logon($data)
{
    $url = 'http://localhost/fantacalcio/backend/api/user/registration.php';

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

    if ($response->message == "1") //response == true vuol dire sessione senza errori
    {
        header('Location: ../login.php');
    } else {
        return -1;
    }
}

function infoHomePage($id_user)
{
    $url = 'http://localhost/fantacalcio/backend/api/user/infoHomePage.php?id_user=' . $id_user;

    $json_data = file_get_contents($url);
    $decode_data = json_decode($json_data, $assoc = true);
    if ($decode_data != "-1") {
        $info_data = $decode_data;
        $info_arr = array();
        if (!empty($info_data)) {
            foreach ($info_data as $info) {
                $info_record = array(
                    'nickname' => $info['nickname'],
                    'name' => $info['name'],
                );
                array_push($info_arr, $info_record);
            }
            return $info_arr;
        } else {
            return -1;
        }
    } else {
        return -1;
    }

}

?>