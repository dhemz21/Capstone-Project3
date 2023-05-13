<?php

session_start();

if(isset($_POST['submit'])){

    // DATABASE CONNECTION
    include_once('database/db_conn.php');

    // POSTED INFORMATION
    $idnumber = $_POST['IDnumber'];
    $password = $_POST['password'];

    // MYSQLI QUERY
    // PREPARE A STATEMENT TO SELECT THE DATA FROM THE REGISTERED_ADMIN TABLE
    $stmt = $conn->prepare("SELECT * FROM registered_admin WHERE IDnumber=?");

    // BIND THE PARAMETER "s" TO THE VARIABLE $idnumber
    // "s" INDICATES THAT THE PARAMETER IS A STRING
    $stmt->bind_param("s", $idnumber);
    // EXECUTE THE PREPARED STATEMENT
    $stmt->execute();
    // GET THE RESULT OF THE EXECUTED STATEMENT
    $result = $stmt->get_result();


    // CHECK IF THE QUERY RETURNED ANY ROWS
    if($result->num_rows >= 1){
        // IF THERE ARE ONE OR MORE ROWS RETURNED, ENTER THE WHILE LOOP
        while($getData = $result->fetch_array()){

            // CHECK IF THE LOGIN TYPE IF ADMIN"
           if ($getData['login_type'] === "ADMIN") {
                // Check if the password is correct
                if (password_verify($password, $getData['password'])) {
                   // REGENERATE THE SESSION ID
                   session_regenerate_id();
                    // ASSIGN THE VALUES OF EACH COLUMN IN THE RETURNED ROW TO DIFFERENT SESSION VARIABLES
                    $userid = $_SESSION['userid'] = $getData['userid'];
                    $fname = $_SESSION['Firstname'] = $getData['Firstname'];
                    $lname = $_SESSION['Lastname'] = $getData['Lastname'];
                    $type = $_SESSION['login_type'] = $getData['login_type'];
                    header("location: dashboard_admin/");
                    exit(); // Stop further PHP execution
                } else {
                    $_SESSION['validate'] = "unsuccessful";
                    header("location: .?page=form");
                    exit(); // Stop further PHP execution

                }
            }else{
                $_SESSION['validate'] = "not-employee";
                header("location: .?page=form");
                exit(); // Stop further PHP execution

            }

        }
    }else{
        $_SESSION['validate'] = "unsuccessful";
        header("location: .?page=form");
        exit(); // Stop further PHP execution

    }
}
?>
