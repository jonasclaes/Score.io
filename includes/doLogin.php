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

    if (sizeof($errors) > 0) {
        echo json_encode($json);
        return;
    }

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = $mysqli->query("SELECT * FROM users WHERE username = '$username'");

    if ($result->num_rows === 0) {
        array_push($errors, "Gebruiker niet gevonden.");
        echo json_encode($json);
        return;
    }

    $user = $result->fetch_assoc();
    
    if ($user["password"] !== $password) {
        array_push($errors, "Wachtwoord niet correct.");
        echo json_encode($json);
        return;
    }

    $_SESSION["userId"] = $user["id"];
    $_SESSION["username"] = $user["username"];

    header("Location: /");
} else {
    array_push($errors, "Foute request.");
    
    echo json_encode($json);
    return;
}