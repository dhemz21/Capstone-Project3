<!DOCTYPE html>
<html lang="en">

<?php
include_once('action/display-profile.php');
?>

<body>
    <div class="button">
<div class="row">
      <div class="col-12">
        <a href=".?page=upload-csv" class="btn text-white" id="generate"><i class="fas fa-upload"></i> Upload CSV</a>
        <a href=".?page=data-records" class="btn text-white" id="records"><i class="fas fa-table"></i> Records</a>

      </div>
</div>
</div>
    <div class="container-fluid pb-2">

        <?php
        if (isset($_GET['success']) >= 1) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Student Successully Added!
                        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                            <span aria-hidden='true'>&times</span>
                        </button>
                </div>";
        } elseif (isset($_GET['error']) >= 1) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Error adding Student!
                        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                            <span aria-hidden='true'>&times</span>
                        </button>
                </div>";
        } else {
        }
        ?>
        <div class="card shadow-sm rounded-0">
            <div class="card-header text-dark">
                <h3 class="card-title"><strong>Add Student</strong></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body ">
                <form action=".?folder=action/&page=save-students" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="user">ID number</label>
                            <input type="text" class="form-control" name="IDnumber" placeholder="Enter your student ID" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Firstname">First name</label>
                            <input type="text" class="form-control" name="firstname" placeholder="Enter your first name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Middlename">Middle name</label>
                            <input type="text" class="form-control" name="middlename" placeholder="Enter your middle name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Lastname">Last name</label>
                            <input type="text" class="form-control" name="lastname" placeholder="Enter your last name" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="year">Year</label>
                        <select id="year" class="form-control" name="year" required>
                            <option selected>Choose Year</option>
                            <option>1st</option>
                            <option>2nd</option>
                            <option>3rd</option>
                            <option>4th</option>
                        </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="course">Course</label>
                        <select id="course" class="form-control" name="course" required>
                            <option selected>Choose course</option>
                            <option>BSIT</option>
                            <option>BSME</option>
                            <option>BSCE</option>
                            <option>BSEE</option>
                            <option>BEED</option>
                            <option>BPED</option>
                            <option>BSED MATH</option>
                            <option>BSED SCIENCE</option>
                            <option>BTVTED FSM</option>
                            <option>BS IND. TECH.CA</option>
                            <option>BS IND. TECH.ELX</option>
                            <option>BSHM</option>
                        </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="department">Department</label>
                        <select id="department" class="form-control" name="department" required>
                            <option selected>Choose department</option>
                            <option>COMPUTER STUDIES</option>
                            <option>ENGINEERING</option>
                            <option>EDUCATION</option>
                            <option>TECHNOLOGY</option>
                        </select>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn text-white" id="save">Add</button>
                    <button type="reset" class="btn btn-secondary" onclick="window.location.href='index.php'">Close</button>
                </form>
            </div>
            <div class="col-12 mt-3 mb-2">
                <p class="text-start"><a href="index.php" class="text-decoration-none">Back to Homepage</a> </p>
            </div>
        </div>
    </div>
    </div>
    </div>

    <?php
    if (isset($_SESSION['validate']) && $_SESSION['validate'] == 'success') {
    ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Student added',
                text: ' You successully added a student!'
            })
        </script>
    <?php
        unset($_SESSION['validate']);
    }
    ?>

    <?php
    if (isset($_SESSION['validate']) && $_SESSION['validate'] == 'existed') {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Student existed',
                text: 'Please check your information!'
            })
        </script>
    <?php
        unset($_SESSION['validate']);
    }
    ?>
<?php
    if (isset($_SESSION['validate']) && $_SESSION['validate'] == 'success-csv') {
    ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Successfully uploaded!'
            })
        </script>
    <?php
        unset($_SESSION['validate']);
    }
    ?>

<?php
    if (isset($_SESSION['validate']) && $_SESSION['validate'] == 'error-csv') {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error uploading',
                text: 'Please check your information!'
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