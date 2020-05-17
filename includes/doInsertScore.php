<?php
require_once "db.php";

$errors = array();
$json = array("errors" => &$errors, "success" => false);    // We pass the $errors array by reference, not by value;

if (isset($_POST) && !empty($_POST)) {
    $timestamp = $_POST['timestamp'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $score = $_POST['score'];
    $maxScore = $_POST['maxScore'];

    $result = $mysqli->query("INSERT INTO scores (id, timestamp, name, description, score, maxScore) VALUES (NULL, '$timestamp', '$name', '$description', '$score', '$maxScore')");

    if ($result === false || $mysqli->affected_rows === 0) {
        array_push($errors, "Fout tijdens het toevoegen van de score.");
        echo json_encode($json);
        return;
    }

    $json["success"] = true;
    echo json_encode($json);
} else {
    array_push($errors, "Foute request.");
    echo json_encode($json);
    return;
}