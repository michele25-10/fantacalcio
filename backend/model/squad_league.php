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
                where s.id_user = " . $id . ";";
        return $sql;
    }
}
?>