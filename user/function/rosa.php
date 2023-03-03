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


?>