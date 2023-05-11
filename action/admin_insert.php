<?php

session_start();

// DATABASE CONNECTION 
require('database/db_conn.php');

$query_lastID = 'SELECT * FROM 	registered_admin ORDER BY UserID DESC LIMIT 1';
$result_lastID = mysqli_query($conn, $query_lastID) or die(mysqli_error($conn));
$totalID = 0;


// GETTING THE LAST ID BEFORE INSERTING THE NEW ID
while ($row = mysqli_fetch_assoc($result_lastID)) {
	$totalID = $row['UserID'];
}

// LAST ID PLUS 1 FOR THE INSERTED ID
$totalID = $totalID + 1;


if (isset($_POST['submit'])) {
	// CREATE VARIABLE TO CATCH THE DATA FROM THE FORM
	$idnumber = $_POST['IDnumber'];
	$email = $_POST['email'];
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
		// HASH THE PASSWORD USING ARGON2
		$password = $_POST['password'];
		$hash = password_hash($password, PASSWORD_ARGON2I);
	

	// RETRIEVE THE USERNAME FROM THIS TABLE FOR THE GIVEN SPECIFIC IDNUMBER
	$query = "SELECT * FROM tbl_admin WHERE IDnumber = '$idnumber'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);

	//   CHECK IF THE GIVEN IDNUMBER EXISTS IN TBL_ADMIN
	if (!$row) {
		$_SESSION['validate'] = "unsuccessful";
        header("location: .?page=admin_signup");
		exit;
	}


	// GETTING THE SPECIFIC ROW FROM THE TBL_ADMIN WHICH IS THE USER_ID AND INSERT TO TABLE REGISTERED_ADMIN
	$registered_id = $row['UserID'];
	$reg_fname = $row['firstname'];
	$reg_lname = $row['lastname'];
	$mail = $row['email'];

	// CHECK THE USER THAT IS ALREADY EXISTED ON THE DATABASE FROM TABLE REGISTERED_ADMIN
	$checkUser = "SELECT * FROM registered_admin WHERE IDnumber ='$idnumber' or email='$mail'";
	$result = mysqli_query($conn, $checkUser);

	$count = mysqli_num_rows($result);
	if ($count > 0) {

		$_SESSION['validate'] = "existed";
        header("location: .?page=admin_signup");
		exit(); // Stop further PHP execution


	} else {

		//INSERTING THE DATA TO THE TABLE REGISTERED_USERS 
		$sql = "INSERT INTO registered_admin (Registered_ID, IDnumber, email, Firstname, Lastname, password, login_type)
		VALUES ('$registered_id ', '$idnumber', '$mail','$reg_fname','$reg_lname','$hash', 'ADMIN')";
	
	}

	//CHECKING IF INSERTION IS SUCCESSFUL FROM REGISTERED_USERS
	if (mysqli_query($conn, $sql)) {

        $_SESSION['validate'] = "inserted";
		header("Location: .?page=form");
		exit(); // Stop further PHP execution

	} else {
		echo "Error: " . $sql . "" . mysqli_error($conn);
	}

	//close connection
	mysqli_close($conn);
}

?>
