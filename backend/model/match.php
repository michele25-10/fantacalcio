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
        where 1 = 1";
        return $sql;
    }
}
?>