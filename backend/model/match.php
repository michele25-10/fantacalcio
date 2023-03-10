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
    function getLastMatch()
    {
        $sql = "SELECT * FROM match
        WHERE number_match = ( SELECT max(number_match) FROM match )";
        return $sql;
    }
    function getLastNumberMatch($id_league)
    {
        $sql = "SELECT max(number_match) as 'numbermatch' FROM fantacalcio.`match` where id_league='" . $id_league . "';";
        return $sql;
    }
    function createMatch($number_match, $id_squad1, $id_squad2, $score1, $score2, $id_league)
    {
        $sql = "insert into fantacalcio.match(number_match, id_squad1, id_squad2, score1, score2, league)
                values('" . $number_match . "', '" . $id_squad1 . "', '" . $id_squad2 . "', '" . $score1 . "', '" . $score2 . "', '" . $id_league . "');";
        return $sql;
    }
}
?>