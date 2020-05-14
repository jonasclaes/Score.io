<?php
$ID = $_POST['ID'];
$timestamp = $_POST['timestamp'];
$name = $_POST['name'];
$destription = $_POST['destription'];
$score = $_POST['score'];
$maxScore = $_POST['maxScore'];
include 'db.php';
$sql = "UPDATE scores SET timestamp = '$timestamp', name = '$name', description = '$description', score = '$score', maxScore = '$maxScore' WHERE id = '$id';"
if (mysqli_query($mysqli, $sql)) {
    echo json_encode('Succes, score is geüpdate.');
}
else {
    echo json_encode("Er ging iets fout.")
}
?>