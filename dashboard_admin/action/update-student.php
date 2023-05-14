<?php
// DATABASE CONNECTION
require_once('../database/db_conn.php');
// Posted Data
$userID = $_POST['UserID'];
$idnumber = $_POST['IDnumber'];
$fname = $_POST['firstname'];
$mname = $_POST['middlename'];
$lname = $_POST['lastname'];
$mail = $_POST['email'];
$year = $_POST['year'];
$course = $_POST['course'];
$depart = $_POST['department'];


// UPDATING DATA FROM THE TABLE TBL_STUDENT
$query = "UPDATE tbl_student SET IDnumber='$idnumber', firstname='$fname', middlename='$mname', lastname='$lname', email='$mail', year='$year', course='$course', department='$depart' WHERE UserID = '$userID'";

if(mysqli_query($conn, $query)){

   $_SESSION['validate'] = "update";
     echo "<script>window.location.href='.?folder=pages/&page=edit-student&success=1&UserID=$userID';</script>";
 }else{
   $_SESSION['validate'] = "error";
    echo "<script>window.location.href='.?folder=pages/&page=edit-student&error=1&UserID=$userID';</script>";
 }

?>

