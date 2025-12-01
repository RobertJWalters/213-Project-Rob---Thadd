<?php
class db {
    public static function getDB() {
        $mysqli = new mysqli("localhost", "rute", "password", "proj");

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
        $mysqli->set_charset("utf8mb4");

        return $mysqli;
    }
}