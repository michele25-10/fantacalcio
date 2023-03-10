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
}
?>