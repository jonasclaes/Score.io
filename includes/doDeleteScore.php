<?php 
require_once "db.php";

$errors = array();
$json = array("errors" => &$errors, "success" => false);    // We pass the $errors array by reference, not by value;

if (isset($_POST) && !empty($_POST)) {
    $id = $_POST['id'];

    $result = $mysqli->query("DELETE FROM scores WHERE id = '$id'");

    if ($result === false || $mysqli->affected_rows === 0) {
        array_push($errors, "Fout tijdens het verwijderen van de score.");
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