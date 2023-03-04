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
        $sql = "SELECT id_user
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
}
?>