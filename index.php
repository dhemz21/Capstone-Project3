<!DOCTYPE html>
<html lang="en">
<!-- INCLUDE HEAD -->
<?php include('include/head.php'); ?>
<!-- HEAD END -->

<body>
    <!-- DYNAMIC PAGES -->
    <?php
    $include_folder = isset($_GET['folder']) ? $_GET['folder'] : 'pages/';
    $page = isset($_GET['page']) ? $_GET['page'] : 'form';
    require_once($include_folder . $page . '.php');
    ?>
    <!-- END -->

</body>

</html>