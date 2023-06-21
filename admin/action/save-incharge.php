<?php
include_once '../database/db_conn.php';

$query_lastID = 'SELECT * FROM tbl_incharge ORDER BY UserID DESC LIMIT 1';
$result_lastID = mysqli_query($conn, $query_lastID) or die(mysqli_error($conn));
$totalID = 0;

//Getting the Last ID before inserting new ID
while ($row = mysqli_fetch_assoc($result_lastID)) {
    $totalID = $row['UserID'];
}

//Last ID plus 1 for the inserted ID
$totalID = $totalID + 1;

if (isset($_POST['submit'])) {
    //Create Variable to catch the data from the form
    $idnumber = $_POST['IDnumber'];
    $fname = $_POST['firstname'];
    $mname = $_POST['middlename'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $depart = $_POST['department'];

    // CHECK IF THE USER ALREADY EXISTS IN THE DATABASE
    $checkUser = "SELECT * FROM tbl_incharge WHERE IDnumber='$idnumber' or email='$email'";
    $result = mysqli_query($conn, $checkUser);

    $count = mysqli_num_rows($result);
    if ($count > 0) {
        $_SESSION['validate'] = "existed";
        echo "<script>window.location.href='.?folder=pages/&page=add-incharge&error=1';</script>";
    } else {
        //Insert the data to table
        $sql = "INSERT INTO tbl_incharge (IDnumber, firstname, middlename, lastname,  email, department) VALUES ('$idnumber', '$fname', '$mname', '$lname', '$email', '$depart')";

        //Check if insertion
        if (mysqli_query($conn, $sql)) {
            $_SESSION['Userid'] = $totalID;
            $_SESSION['validate'] = "success";
            echo "<script>window.location.href='.?folder=pages/&page=add-incharge&success=1';</script>";

        } else {
            echo "Error: " . $sql . "" . mysqli_error($conn);
        }
    }

    //close connection
    mysqli_close($conn);
}

?>