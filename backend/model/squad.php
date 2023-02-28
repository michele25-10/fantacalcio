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
}
?>