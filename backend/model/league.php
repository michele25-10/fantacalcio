<?php
class League
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function createLeague($name, $user_id)
    {
        $sql = "INSERT INTO fantacalcio.league (name, id_trustee)
                VALUES ('" . $name . "', " . $user_id . "); ";

        $result = $this->conn->query($sql);
        return $result;
    }
}
?>