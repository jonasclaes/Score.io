<?php
require_once "db.php";

if (!isset($_SESSION)) {
    session_start();
}

$ID = $_POST['ID'];
$sql = "DELETE FROM users WHERE id = '$id'";

if (musqli_query($mysqli, $sql)) {
    echo json_encode('User verwijderd');
}
else{
    echo json_encode('Error');