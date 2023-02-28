<?php
class Player
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getArchivePlayer()
    {
        $sql = "SELECT id, name, surname, `role`
              FROM player
              WHERE 1=1
              order by surname ASC;
                ";
        return $sql;
    }
}
?>