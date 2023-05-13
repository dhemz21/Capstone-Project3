<?php
require_once('../database/db_conn.php');
// Fetch image file name from the database

$userid = $_SESSION['userid'];
$query = "SELECT profile_picture FROM registered_admin WHERE userid = '$userid'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$image = $row['profile_picture'];
?>