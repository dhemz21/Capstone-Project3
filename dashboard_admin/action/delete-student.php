<?php
// DATABASE CONNECTION
require_once('../database/db_conn.php');
//  Get User ID
$userID = $_GET['UserID'];

// Query
// SELECTING THE DATA FROM TABLE TBL_STUDENT
$query = "SELECT * FROM tbl_student WHERE UserID = '$userID'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($result);


// DELETING THE DATA FROM TABLE TBL_STUDENT
$query = "DELETE FROM tbl_student WHERE UserID = '$userID'";
if(mysqli_query($conn,$query)){

    $_SESSION['validate'] = "delete";
    echo "<script>window.location.href='.?folder=pages/&page=data-records&successrem=1';</script>"; 

}else{
    
    $_SESSION['validate'] = "error-delete";
    echo "<script>window.location.href='.?folder=pages/&page=data-records&errorrem=1';</script>";
}
?>