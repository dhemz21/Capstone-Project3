<?php
// DATABASE CONNECTION
require_once('../database/db_conn.php');

if (isset($_COOKIE['confirm_duplicate'])) {
  unset($_COOKIE['confirm_duplicate']);
}
// add unique index to tbl_EMPLOYEE table
$sql = "ALTER TABLE tbl_employee ADD UNIQUE INDEX `unique_IDnumber_email` (`IDnumber`, `email`)";
mysqli_query($conn, $sql);

// sets a time limit of 300 seconds (5 minutes)
set_time_limit(100); 

// parse the CSV file
if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
  $file = $_FILES['file']['tmp_name'];
  if (($handle = fopen($file, 'r')) !== false) {
    $header = fgetcsv($handle);
    $stmt = mysqli_prepare($conn, 'INSERT INTO tbl_employee (IDnumber, firstname,  middlename,  lastname, email, department, type) VALUES (?, ?, ?, ?, ?, ?, ?)');
    while (($data = fgetcsv($handle)) !== false) {
      mysqli_stmt_bind_param($stmt, 'sssssss', $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]);
      mysqli_stmt_execute($stmt);
      if (mysqli_errno($conn) == 1062) { // duplicate key error
        if (!isset($_COOKIE['confirm_duplicate'])) { // check if cookie is set
          $message = "Duplicate entry found. Do you want to continue?";
          echo "<script>if(confirm('$message')) { document.cookie = 'confirm_duplicate=true'; }</script>";
        }
        continue; // continue inserting other data
      }
    }
    fclose($handle);
  }
  mysqli_stmt_close($stmt);
}

// close the database connection
mysqli_close($conn);

// redirect back to the form page
$_SESSION['validate'] = "success-csv";
echo "<script>window.location.href='.?folder=pages/&page=add-employee&success=1';</script>";

?>