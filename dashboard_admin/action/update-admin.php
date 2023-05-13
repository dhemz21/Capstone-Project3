<?php
// DATABASE CONNECTION
require_once('../database/db_conn.php');
// Posted Data
$userid = $_POST['userid'];
$idnumber = $_POST['IDnumber'];
$firstname = $_POST['Firstname'];
$lastname = $_POST['Lastname'];
$mail = $_POST['email'];
$password = $_POST['password'];


  // Retrieve the hashed password from the database for the user
  $query = "SELECT password FROM registered_admin WHERE userid = '$userid'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $hashed_password = $row['password'];


// UPDATING DATA FROM THE TABLE INCHARGE
  // Verify the input password with the hashed password from the database
  if (password_verify($password, $hashed_password)) {
$update_query = "UPDATE registered_admin SET IDnumber='$idnumber', Firstname='$firstname', Lastname='$lastname', email='$mail'";

$update_result = mysqli_query($conn, $update_query);
if ($update_result) {
 
  // UPDATE SESSION VARIABLES
  $_SESSION['Userid'] = $userid;
  $_SESSION['validate'] = "update";
  echo "<script>window.location.href='.?folder=pages/&page=admin-info&success=1&userid=$userid';</script>";
} else{

  $_SESSION['validate'] = "error";
  echo "<script>window.location.href='.?folder=pages/&page=edit-admin&error=1&userid=$userid';</script>";

}

  }else {

    $_SESSION['validate'] = "not-match";
    echo "<script>window.location.href='.?folder=pages/&page=edit-admin&error=1&userid=$userid';</script>";

  }

?>


