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
$depart = $_POST['department'];


// UPDATING DATA FROM THE TABLE TBL_EMPLOYEE
$query = "UPDATE tbl_employee SET IDnumber='$idnumber', firstname='$fname', middlename='$mname', lastname='$lname', email='$mail', department='$depart' WHERE UserID = '$userID'";

if(mysqli_query($conn, $query)){

   $_SESSION['validate'] = "update";
     echo "<script>window.location.href='.?folder=pages/&page=edit-employee&success=1&UserID=$userID';</script>";
 }else{
   $_SESSION['validate'] = "error";
    echo "<script>window.location.href='.?folder=pages/&page=edit-employee&error=1&UserID=$userID';</script>";
 }

?>

