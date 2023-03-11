<?php
class Squad
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getArchiveSquad()
    {
        $sql = "SELECT s.id, s.name, u.nickname, s.score
                FROM squad s
                Inner join `user` u on u.id = s.id_user
                where 1=1; 
                ";
        return $sql;
    }

    function createSquad($name, $id_user)
    {
        $sql = "INSERT INTO fantacalcio.squad (name, id_user, score)
        VALUES ('" . $name . "','" . $id_user . "', 0); ";
        return $sql;
    }

    function getSquadByUserId($id_user)
    {
        $sql = "SELECT id
                FROM squad
                Where id_user = " . $id_user . ";";
        return $sql;
    }
    function getSquadById($id)
    {
        $sql = "
            Select name
            from squad
            where id='" . $id . "';
        ";
        return $sql;
    }

    function getPlayerOfSquad($id_squad)
    {
        $sql = "select p.id, p.surname, p.`role`  
        from squad s 
        inner join rosa r on r.id_squad = s.id  
        inner join player p on r.id_player = p.id 
        inner join league l on l.id = r.id_league 
        where l.status = 0 and s.id = '" . $id_squad . "'
        order by p.surname asc;";
        return $sql;
    }
    function updateScore($id_squad, $score)
    {
        $sql = "UPDATE fantacalcio.squad SET score= (SELECT score FROM squad WHERE id = '" . $id_squad . "') + " . $score . " where id='" . $id_squad . "';";
        return $sql;
    }
}
?>