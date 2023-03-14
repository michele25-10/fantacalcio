<?php
class Matches
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getArchieveMatch()
    {
        $sql = "Select * 
        from match
        where 1 = 1
        order by id desc";
        return $sql;
    }
    function getLastMatch($id_league, $number_match)
    {
        $sql = "SELECT s.name, m.score
        FROM fantacalcio.`match` m
        inner join fantacalcio.squad s on s.id = m.id_squad         
        WHERE number_match = '" . $number_match . "' and id_league='" . $id_league . "';";
        return $sql;
    }
    function getLastNumberMatch($id_league)
    {
        $sql = "SELECT max(number_match) as 'numbermatch' FROM fantacalcio.`match` where id_league='" . $id_league . "';";
        return $sql;
    }
    function createMatch($number_match, $id_squad, $score, $id_league)
    {
        $sql = "insert into fantacalcio.match(number_match, id_squad, score, id_league)
                values('" . $number_match . "', '" . $id_squad . "','" . $score . "','" . $id_league . "');";
        return $sql;
    }
    function statsSquad($id_league, $id_squad)
    {
        $sql = "SELECT m.number_match , m.score  
        from `match` m  
        inner join league l on l.id = m.id_league 
                WHERE m.id_league='" . $id_league . "' and l.status = '0' and m.id_squad = '" . $id_squad . "';";
        return $sql;
    }
}
?>