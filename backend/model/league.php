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
        $sql = "INSERT INTO fantacalcio.league (name, id_trustee, status)
                VALUES ('" . $name . "', " . $user_id . ", 0); ";

        $result = $this->conn->query($sql);
        return $result;
    }

    function getLeagueByName($name)
    {
        $sql = "SELECT id, name, id_trustee
        FROM league
        WHERE name = '" . $name . "' AND status = 0;";

        return $sql;
    }

    function getArchiveLeague()
    {
        $sql = "SELECT id, name, id_trustee
        FROM league
        WHERE status=0
        order by name asc;";

        return $sql;
    }

    function getLeagueByTrustee($id_trustee)
    {
        $sql = "SELECT id, name, id_trustee
        FROM league
        where id_trustee = '" . $id_trustee . "' AND status=0;";
        return $sql;
    }

    function checkTrustee($id)
    {
        $sql = "SELECT id_trustee
        FROM league
        where id = " . $id . " and status=0; ";
        return $sql;
    }

    function getRanking($id)
    {
        $sql = "SELECT s.name, s.score
        FROM squad_league sl
        INNER JOIN squad s on s.id=sl.id_squad
        inner join league l on l.id = sl.id_league
        where sl.id_league=" . $id . " and l.status=0
        order by s.score desc;";
        return $sql;
    }

    function getArchiveLeagueMoreDetails()
    {
        $sql = "SELECT l.id, l.name, u.nickname as 'id_trustee'
        FROM league l
        inner join user u on u.id=l.id_trustee
        WHERE status=0
        order by name asc;";
        return $sql;
    }
}
?>