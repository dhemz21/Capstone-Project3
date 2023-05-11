<!DOCTYPE html>
<html lang="en">

<?php
session_start();

?>

<head>
  <script type="text/javascript">
    function preventBack() {
      window.history.forward()
    };
    setTimeout("preventBack()", 0);
    window.onunload - function() {
      null;
    }
  </script>

</head>

<body>
  <div class="container-fluid">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
            </div>
          </div>
          <div class="col-lg-4 d-flex flex-column align-items-center justify-content-center shadow" id="main-container" style="min-height: 450px;">
            <div class="container-title w-100">
                <h4 class="card-title w-100 p-3 text-center text-white rounded-0" id="top-color">Registration</h4>
              </div>
              
              <div class="admin-form">
                <div class="profile-image">
                    <img src="assets/img/evsu.png" alt="">
                </div>
                <div class="header-form">
                <h4 class="card-title pb-2 text-center">Admin Maintenance<br>System</h4>
                </div>
                <div class="header-information">
                  <h4>admin Registration</h4>
                </div>
              <form class="row g-3 needs-validation" method="post" action=".?folder=action/&page=admin_registration" novalidate>
             
                <div class="col-md-6">
                  <div class="input-group mb-2">
                    <input type="text" class="input form-control rounded-0" name="firstname" placeholder="Firstname" aria-label="firstname" aria-describedby="basic-addon1" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-group mb-2">
                    <input type="text" class="input form-control rounded-0" name="lastname" placeholder="Lastname" aria-label="lastname" aria-describedby="basic-addon1" required />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="input-group mb-2">
                    <input type="text" class="input form-control rounded-0" name="IDnumber" placeholder="IDnumber" aria-label="IDnumber" aria-describedby="basic-addon1" required />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="input-group mb-2">
                    <input type="email" class="input form-control rounded-0" name="email" placeholder="Email" aria-label="email" aria-describedby="basic-addon1" required />
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn btn-se text-white w-100 rounded-0" id="btn" type="submit" name="submit">Continue</button>
                </div>
             
                <div class="col-12 mt-5">
                <p class="text-start"><a href=".?page=form" class="text-decoration-none">Go Back</a> </p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
  </div>

  <script src="js/form-validation.js"></script>

  <?php
  if (isset($_SESSION['validate']) && $_SESSION['validate'] == 'existed') {
  ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Data Existed ',
        text: 'Please check your information!'
      })
    </script>
  <?php
    unset($_SESSION['validate']);
  }
  ?>
</body>

</html>