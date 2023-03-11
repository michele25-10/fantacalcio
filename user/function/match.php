<?php
function getLastNumberMatch($id_league)
{
    $url = 'http://localhost/fantacalcio/backend/api/match/getLastNumberMatch.php?id_league=' . $id_league;

    $json_data = file_get_contents($url);
    $decode_data = json_decode($json_data, $assoc = true);
    $match = $decode_data['message'];
    return $match;
}
?>