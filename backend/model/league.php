<?php
class League
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function createLeague($name, $user_id)
    {
        $sql = "INSERT INTO fantacalcio.league (name, id_trustee)
                VALUES ('" . $name . "', " . $user_id . "); ";

        $result = $this->conn->query($sql);
        return $result;
    }

    function getLeagueByName($name)
    {
        $sql = "SELECT id, name, id_trustee
        FROM league
        WHERE name = '" . $name . "';";

        return $sql;
    }

    function getArchiveLeague()
    {
        $sql = "SELECT id, name, id_trustee
        FROM league
        WHERE 1=1
        order by name asc;";

        return $sql;
    }

    function getLeagueByTrustee($id_trustee)
    {
        $sql = "SELECT id, name, id_trustee
        FROM league
        where id_trustee = '" . $id_trustee . "';";
        return $sql;
    }

    function checkTrustee($id)
    {
        $sql = "SELECT id_trustee
        FROM league
        where id = " . $id . "; ";
        return $sql;
    }

    function getRanking($id)
    {
        $sql = "SELECT s.name, s.score
        FROM squad_league sl
        INNER JOIN squad s on s.id=sl.id_squad
        where sl.id_league=" . $id . ";";
        return $sql;
    }
}
?>