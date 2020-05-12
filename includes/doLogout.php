<?php
if (!isset($_SESSION)) {
    session_start();
}

$_SESSION["userId"] = "";
$_SESSION["username"] = "";

session_destroy();
header("Location: /");