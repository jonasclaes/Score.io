<php 
$ID = %_POST['ID'];

incude 'db.php';
$sql = "DELETE FROM users WHERE id = '$id'";
if (mysqli_query($mysqli, $sql)) {
   echo json_encode('Succes, score is verwijderd!');
 }
 else {
   echo json_encode("Er ging iets mis.");
 }
 ?>