<?php
function getLastNumberMatch($id_league)
{
    $url = 'http://localhost/fantacalcio/backend/api/match/getLastNumberMatch.php?id_league=' . $id_league;

    $json_data = file_get_contents($url);
    $decode_data = json_decode($json_data, $assoc = true);
    $match = $decode_data['message'];

    if ($match == NULL) {
        return -1;
    } else {
        return $match;
    }
}

function getLastMatch($id_league, $number_match)
{
    $url = 'http://localhost/fantacalcio/backend/api/match/getLastMatch.php?id_league=' . $id_league . '&number_match=' . $number_match;

    $json_data = file_get_contents($url);
    $decode_data = json_decode($json_data, $assoc = true);
    $match = $decode_data;
    return $match;
}

function simulateMatch($id_league)
{
    $url = 'http://localhost/fantacalcio/backend/api/match/createDayMatch.php?id_league=' . $id_league;

    $json_data = file_get_contents($url);
    $decode_data = json_decode($json_data, $assoc = true);
    $res = $decode_data;
    return $res;
}
?>