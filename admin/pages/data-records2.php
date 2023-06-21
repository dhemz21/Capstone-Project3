<!DOCTYPE html>
<html lang="en">
  
<?php
require_once("../database/db_conn.php");
include("library/call_function3.php");

?>

<body>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-light">
            <h3 class="card-title"><i class="fa fa-table"></i><strong> Employee Records</strong></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-responsive-xl table-bordered">
              <thead>
                <?php call_fields() ?>
              </thead>
              <tbody>
                <?php
                $i = 0;
                $sql = mysqli_query($conn, "SELECT * FROM tbl_employee");
                while ($getData = mysqli_fetch_array($sql)) {
                  $i++;
                ?>
                  <td><?php echo $getData['IDnumber']; ?></td>
                  <td><?php echo $getData['firstname']; ?></td>
                  <td><?php echo $getData['middlename']; ?></td>
                  <td><?php echo $getData['lastname']; ?></td>
                  <td><?php echo $getData['email']; ?></td>
                  <td><?php echo $getData['department']; ?></td>
                  <td class="text-left py-0 align-middle">
                    <div class="btn-group btn-group-sm">
                      <a href=".?page=edit-employee&UserID=<?php echo $getData['UserID']; ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
                      <a onclick="return confirm('Are you sure you want to delete this employee information?')" href=".?folder=action/&page=delete-employee&UserID=<?php echo $getData['UserID']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                    </div>
                  </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="col-12 mt-2 mb-2">
            <p class="text-start"><a href=".?page=add-employee" class="text-decoration-none">Go Back</a> </p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  </div>
  <!-- /.content -->
  
  <script src="js/colvis.js"></script>
  <?php
    if (isset($_SESSION['validate']) && $_SESSION['validate'] == 'delete') {
    ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'You successully deleted a student!'
            })
        </script>
    <?php
        unset($_SESSION['validate']);
    }
    ?>

<?php
    if (isset($_SESSION['validate']) && $_SESSION['validate'] == 'error-delete') {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'error',
                text: 'Error deleting student!'
            })
        </script>
    <?php
        unset($_SESSION['validate']);
    }
    ?>


</body>

</html>