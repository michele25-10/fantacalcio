<?php
class Rosa
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function addPlayerToSquad($id_squad, $id_league, $id_player)
    {
        $sql = "INSERT INTO fantacalcio.rosa (id_squad, id_league, id_player)
        VALUES ('" . $id_squad . "', '" . $id_league . "', '" . $id_player . "');";
        return $sql;
    }

    function getNumberPlayer($id_squad)
    {
        $sql = "SELECT count(id) as 'count_player'
                FROM rosa
                WHERE id_squad = '" . $id_squad . "';";
        return $sql;
    }
}
?>