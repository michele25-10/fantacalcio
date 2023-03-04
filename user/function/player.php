<?php
function getArchivePlayer()
{
    $url = 'http://localhost/fantacalcio/backend/api/player/getArchivePlayer.php';

    $json_data = file_get_contents($url);

    if ($json_data != false) {
        $decode_data = json_decode($json_data, $assoc = true);
        $player_data = $decode_data;
        $players_arr = array();
        if (!empty($player_data)) {
            foreach ($player_data as $player) {
                $player_record = array(
                    'id' => $player['id'],
                    'surname' => $player['surname'],
                    'role' => $player['role'],
                );
                array_push($players_arr, $player_record);
            }
            return $players_arr;
        } else {
            return -1;
        }
    } else {
        return -1;
    }
}
?>