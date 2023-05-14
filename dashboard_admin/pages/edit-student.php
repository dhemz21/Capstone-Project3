<!DOCTYPE html>
<html lang="en">

<?php
include_once('action/display-profile.php');
?>

<body>
    <div class="container-fluid pb-2">

        <?php
        if (isset($_GET['success']) >= 1) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Successully updated student Information!
                        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                            <span aria-hidden='true'>&times</span>
                        </button>
                </div>";
        } elseif (isset($_GET['error']) >= 1) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Error updating student Information!
                        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                            <span aria-hidden='true'>&times</span>
                        </button>
                </div>";
        } else {
        }
        ?>
        <div class="card shadow-sm rounded-0">
            <div class="card-header text-dark">
                <h3 class="card-title"><strong>Edit student Information</strong></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body ">
                <?php
                   $userID = $_GET['UserID'];
                 $sql = mysqli_query($conn, "SELECT * FROM tbl_student WHERE UserID = '$userID'");
                 while ($getData = mysqli_fetch_array($sql)) {
                
                ?>
                <form action=".?folder=action/&page=update-student" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <input type="hidden" name="UserID" value="<?php echo $getData['UserID']; ?>">
                            <label for="IDnumber">ID number</label>
                            <input type="text" class="form-control" name="IDnumber" value="<?php echo $getData['IDnumber']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Firstname">First name</label>
                            <input type="text" class="form-control" name="firstname" value="<?php echo $getData['firstname']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Middle name">Middle name</label>
                            <input type="text" class="form-control" name="middlename" value="<?php echo $getData['middlename']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Lastname">Last name</label>
                            <input type="text" class="form-control" name="lastname" value="<?php echo $getData['lastname']; ?>"required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $getData['email']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="year">Department</label>
                        <select id="year" class="form-control" name="year" required>
                            <option selected><?php echo $getData['year']; ?></option>
                            <option>1st</option>
                            <option>2nd</option>
                            <option>3rd</option>
                            <option>4th</option>
                        </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputState">Course</label>
                        <select id="inputState" class="form-control" name="course" required>
                            <option selected><?php echo $getData['course']; ?></option>
                            <option>BSIT</option>
                            <option>BSME</option>
                            <option>BSCE</option>
                            <option>BSEE</option>
                            <option>BEED</option>
                            <option>BPED</option>
                            <option>BSED MATH</option>
                            <option>BSED SCIENCE</option>
                            <option>BTVTED FSM</option>
                            <option>Bs Ind. Tech.CA</option>
                            <option>Bs Ind. Tech.ELX</option>
                            <option>BSHM</option>
                        </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="inputState">Department</label>
                        <select id="inputState" class="form-control" name="department" required>
                            <option selected><?php echo $getData['department']; ?></option>
                            <option>COMPUTER STUDIES</option>
                            <option>ENGINEERING</option>
                            <option>EDUCATION</option>
                            <option>TECHNOLOGY</option>
                        </select>
                        </div>
                    </div>
                    <?php } ?>
                    <button type="submit" name="submit" class="btn text-white" id="save">Update</button>
                    <button type="reset" class="btn btn-secondary" onclick="window.location.href='.?page=add-students'">Close</button>
                </form>
            </div>
            <div class="col-12 mt-3 mb-2">
                <p class="text-start"><a href=".?page=add-students" class="text-decoration-none">Go Back</a> </p>
            </div>
        </div>
    </div>
    </div>
    </div>

    <?php
    if (isset($_SESSION['validate']) && $_SESSION['validate'] == 'update') {
    ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Student updated',
                text: 'You successully updated the student info!'
            })
        </script>
    <?php
        unset($_SESSION['validate']);
    }
    ?>

    <?php
    if (isset($_SESSION['validate']) && $_SESSION['validate'] == 'error') {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'error',
                text: 'Error updating student info!'
            })
        </script>
    <?php
        unset($_SESSION['validate']);
    }
    ?>

    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>

</body>

</html>