<?php

session_start();
// DATABASE CONNECTION
require_once('database/db_conn.php');

// GET THE POSTED PASSWORD AND IDNUMBER
$password = $_POST['password'];
$idnumber = $_POST['IDnumber'];

// CHECK IF THE ID NUMBER EXISTS IN THE REGISTERED_ADMIN TABLE
$query = "SELECT COUNT(*) FROM registered_admin WHERE IDnumber = '$idnumber' AND login_type = 'ADMIN'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$count = $row[0];

if ($count == 0) {
    // ID NUMBER DOES NOT EXIST, SHOW ERROR
    $_SESSION['validate'] = "not-match";
    echo "<script>window.location.href='.?folder=pages/&page=admin_reset&error=2';</script>";
} else {
    // ID NUMBER EXISTS, HASH THE PASSWORD AND UPDATE THE REGISTERED_ADMIN TABLE
    $hash = password_hash($password, PASSWORD_ARGON2I);
    $query = "UPDATE registered_admin SET password='$hash' WHERE IDnumber = '$idnumber' AND login_type = 'ADMIN'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['validate'] = "successful";
        echo "<script>window.location.href='.?folder=pages/&page=form&success=1';</script>"; 
    } else {
        $_SESSION['validate'] = "error";
        echo "<script>window.location.href='.?folder=pages/&page=admin_reset&error=1';</script>";
    }
}

?>
