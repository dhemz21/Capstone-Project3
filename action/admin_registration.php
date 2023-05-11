<?php
// DATABASE CONNECTION
require_once('database/db_conn.php');

session_start();

$query_lastID = 'SELECT * FROM tbl_admin ORDER BY UserID DESC LIMIT 1';
$result_lastID = mysqli_query($conn, $query_lastID) or die(mysqli_error($conn));
$totalID = 0;

// GETTING THE LAST ID BEFORE INSERTING NEW ID
while ($row = mysqli_fetch_assoc($result_lastID)) {
	$totalID = $row['UserID'];
}


// LAST ID PLUS 1 FOR THE INSERTED ID
$totalID = $totalID + 1;

if (isset($_POST['submit'])) {

	// CHECK VARIABLE TO CATCH THE DATA FROM THE FORM
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$idnumber = $_POST['IDnumber'];
    $email = $_POST['email'];


    // CHECK THE USER THAT IS ALREADY EXISTED ON THE DATABASE FROM TABLE TBL_ADMIN
	$checkUser = "SELECT * FROM tbl_admin WHERE firstname = '$firstname' && email ='$email'";
	$result = mysqli_query($conn, $checkUser);

	$count = mysqli_num_rows($result);
	if ($count > 0) {

		$_SESSION['validate'] = "existed";
        header("location: .?page=admin_register");
		exit(); // Stop further PHP execution


	} else {
    

	// INSERT THE DATA TO TABLE TBL_ADMIN
	$sql = "INSERT INTO tbl_admin (firstname, lastname, IDnumber, email)
	VALUES ('$firstname','$lastname', '$idnumber', '$email')";
    }
		   
	//CHECK IF THE INSERTION IS SUCCESSFUL
	if (mysqli_query($conn, $sql)) {

		$_SESSION['validate'] = "successful";
        header("location: .?page=admin_verification");
		exit(); // Stop further PHP execution

	} else {
		echo "Error: " . $sql . "" . mysqli_error($conn);
	}

	//close connection
	mysqli_close($conn);
}
?>