<?php
require_once "db.php";

if (!isset($_SESSION)) {
    session_start();
}

$errors = array();
$json = array("errors" => &$errors, "success" => false);    // We pass the $errors array by reference, not by value;

if(isset($_POST) && !empty($_POST)) {
    $id = $_SESSION["userId"];
    $password = $_POST["password"];
    $passwordVerify = $_POST["passwordVerify"];

    if($password === $passwordVerify) {
        $result = $mysqli->query("UPDATE users SET password = '$password' WHERE id = '$id'");

        if ($result === false) {
            array_push($errors, "Fout tijdens het aanpassen van uw wachtwoord.");
            echo json_encode($json);
            return;
        }

        if ($mysqli->affected_rows === 0) {
            array_push($errors, "Wachtwoord is gelijk aan oud wachtwoord.");
            echo json_encode($json);
            return;
        }

        $json["success"] = true;
        echo json_encode($json);
    } else {
        array_push($errors, "Wachtwoorden komen niet overeen.");
        echo json_encode($json);
    }
} else {
    array_push($errors, "Foute request.");
    
    echo json_encode($json);
    return;
}