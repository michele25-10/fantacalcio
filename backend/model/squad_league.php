<?php
class Squad_League
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function getLeagueByUserId($id)
    {
        $sql = "SELECT sl.id_league as 'id'
                FROM squad s
                inner join squad_league sl on sl.id_squad = s.id
                where s.id_user = " . $id . " and ;";
        return $sql;
    }
    function joinLeague($id_squad, $id_league)
    {
        $sql = "INSERT INTO fantacalcio.squad_league(id_squad, id_league)
                VALUES ('" . $id_squad . "','" . $id_league . "');";
        return $sql;
    }
    function getLeagueBySquad($id)
    {
        $sql = "select l.id
        from squad_league sl
        inner join league l on l.id = sl.id_league
        where sl.id_squad='" . $id . "' and l.status = 0; 
        ";
        return $sql;
    }
}
?>