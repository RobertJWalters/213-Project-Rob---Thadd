<?php

class db{
    public static function getDB()
    {
        $mysqli = new mysqli("localhost", "usr", "a", "project");
        if ($mysqli->connect_error) {
            return null;
        }
        $mysqli->set_charset('utf8mb4');

        return $mysqli;
    }
}
