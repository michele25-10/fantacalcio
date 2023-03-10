<?php

require __DIR__ . "/base.php";
require __DIR__ . " /../common/errorHandler.php";

set_exception_handler("errorHandler::handleException");
set_error_handler("errorHandler::handleError");

class User extends BaseController
{
    function login($nickname, $pw)
    {
        $sql = sprintf("SELECT nickname, pw, id
        FROM `user`
        where 1=1 ");
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            if ($this->conn->real_escape_string($nickname) == $this->conn->real_escape_string($row["nickname"]) && $this->conn->real_escape_string($row["pw"]) == $this->conn->real_escape_string($pw)) {
                return $this->conn->real_escape_string($row["id"]);
            }
        }

        return false;
    }

    function registration($nickname, $pw)
    {
        $sql = sprintf(
            "INSERT INTO user (nickname, pw, active)
        VALUES ('%s', '%s', 1)",
            $this->conn->real_escape_string($nickname),
            $this->conn->real_escape_string($pw),
        );

        $result = $this->conn->query($sql);
        return $result;
    }
    function infoHomePage($id)
    {
        $sql = "select distinct u.nickname, s.name
                from user u
                inner join squad s on s.id_user = u.id
                inner join squad_league sl on s.id = sl.id_squad
                inner join league l on l.id = sl.id_league
                where u.id = '" . $id . "' and l.status = 0;";
        return $sql;

    }
}
?>