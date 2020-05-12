<?php
require_once "db.php";

if (!isset($_SESSION)) {
    session_start();
}

$errors = array();
$json = array("errors" => &$errors);    // We pass the $errors array by reference, not by value;

if (isset($_POST) && !empty($_POST)) {
    if (!isset($_POST["username"]) || empty($_POST["username"])) {
        array_push($errors, "Gebruikersnaam ontbreekt.");
    }

    if (!isset($_POST["password"]) || empty($_POST["password"])) {
        array_push($errors, "Wachtwoord ontbreekt.");
    }

    if (!isset($_POST["passwordVerify"]) || empty($_POST["passwordVerify"])) {
        array_push($errors, "Wachtwoord verificatie ontbreekt.");
    }

    if (sizeof($errors) > 0) {
        echo json_encode($json);
        return;
    }

    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordVerify = $_POST["passwordVerify"];

    if ($password !== $passwordVerify) {
        array_push($errors, "Wachtwoorden komen niet overeen.");
        echo json_encode($json);
        return;
    }

    $result = $mysqli->query("SELECT * FROM users WHERE username = '$username'");

    if ($result->num_rows !== 0) {
        array_push($errors, "Gebruiker bestaat al.");
        echo json_encode($json);
        return;
    }

    $result = $mysqli->query("INSERT INTO users (id, username, password) VALUES (NULL, '$username', '$password')");

    if ($mysqli->num_affected_rows === 0) {
        array_push($errors, "Kon gebruiker niet aanmaken.");
        echo json_encode($json);
        return;
    }
    
    $_SESSION["userId"] = $mysqli->insert_id;
    $_SESSION["username"] = $username;

    header("Location: /");
} else {
    array_push($errors, "Foute request.");
    echo json_encode($json);
    return;
}