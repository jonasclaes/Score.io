<?php
$config = require_once "config.php";

$mysqli = new mysqli($config["MYSQL_HOST"], $config["MYSQL_USER"], $config["MYSQL_PASSWORD"], $config["MYSQL_DATABASE"], $config["MYSQL_PORT"]);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}