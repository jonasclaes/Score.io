
<?php
require_once "db.php";

if (!isset($_SESSION)) {
    session_start();
}

$id = $_SESSION["id"];/* userid of the user */

if(count($_POST)>0) {
$result = mysqli_query($mysqli,"SELECT *from student WHERE id='" . $id . "'");
$row=mysqli_fetch_array($result);

if($_POST["currentPassword"] == $row["password"] && $_POST["newPassword"] == $row["confirmPassword"] ) {
mysqli_query($mysqli,"UPDATE student set password='" . $_POST["newPassword"] . "' WHERE id='" . $id . "'");
$message = "Password has updated";
} 
else{
 $message = "Password is not correct";
}
}
?>