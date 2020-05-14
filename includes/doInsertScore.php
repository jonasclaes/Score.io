<?php

$timestamp = $_POST['timestamp']
$name = $_POST['name']
$description = $_POST['description']
$score = $_POST['score']
$maxScore = $_POST['maxScore']


include "db.php";
$sql = "INSERT INTO scores (id, timestamp, name, description, score, maxScore) VALUES (NULL, '$timestamp', '$name', '$description', '$score', '$maxScore')";
if (musqli_query($mysqli, $sql)) {
    echo json_encode('Score toegevoegd');
}
else{
    echo json_encode('Error');

}
?>


