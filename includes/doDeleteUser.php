<?php
require_once "db.php";

if (!isset($_SESSION)) {
    session_start();
}

$errors = array();
$json = array("errors" => &$errors);    // We pass the $errors array by reference, not by value;

if (isset($_SESSION) && !empty($_SESSION)) {
    $id = $_SESSION["userId"];

    $result = $mysqli->query("DELETE FROM users WHERE id = '$id'");

    if ($result === false || $mysqli->affected_rows === 0) {
        array_push($errors, "Fout tijdens het verwijderen van uw account.");
        echo json_encode($json);
        return;
    }

    $_SESSION["userId"] = "";
    $_SESSION["username"] = "";

    session_destroy();
    header("Location: /");
} else {
    array_push($errors, "Session bestaat niet of is leeg.");
    
    echo json_encode($json);
    return;
}