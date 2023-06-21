<?php
include_once '../database/db_conn.php';

$query_lastID = 'SELECT * FROM tbl_student ORDER BY UserID DESC LIMIT 1';
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
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $year = $_POST['year'];
    $course = $_POST['course'];
    $depart = $_POST['department'];

    // CHECK IF THE USER ALREADY EXISTS IN THE DATABASE
    $checkUser = "SELECT * FROM tbl_student WHERE IDnumber='$idnumber' or email='$email'";
    $result = mysqli_query($conn, $checkUser);

    $count = mysqli_num_rows($result);
    if ($count > 0) {
        $_SESSION['validate'] = "existed";
        echo "<script>window.location.href='.?folder=pages/&page=add-students&error=1';</script>";
    } else {
        //Insert the data to table
        $sql = "INSERT INTO tbl_student (IDnumber, firstname, middlename, lastname, email, year, course, department, type) VALUES ('$idnumber', '$firstname', '$middlename', '$lastname', '$email', '$year', '$course', '$depart', 'STUDENT')";

        //Check if insertion
        if (mysqli_query($conn, $sql)) {
            $_SESSION['Userid'] = $totalID;
            $_SESSION['validate'] = "success";
            echo "<script>window.location.href='.?folder=pages/&page=add-students&success=1';</script>";


        } else {
            echo "Error: " . $sql . "" . mysqli_error($conn);
        }
    }

    //close connection
    mysqli_close($conn);
}

?>