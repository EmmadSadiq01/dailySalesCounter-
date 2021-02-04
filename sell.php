<?php
include 'php/database.php';
include 'php/logedin.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type']=="sell") {
    $amount = $_POST['amount'];
    $type = $_POST['type'];

    $sql = "INSERT INTO `sell` (`amount`,`type`) VAlUES ('$amount','$type')";
    $result = mysqli_query($connection,$sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type']=="payment") {
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $type = $_POST['type'];

    $sql = "INSERT INTO `sell` (`amount`,`type`,`description`) VAlUES ('$amount','$type','$description')";
    $result = mysqli_query($connection,$sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['type']=="expense") {
    $amount = $_POST['amount'];
    $exp_description = $_POST['exp_description'];
    $type = $_POST['type'];
    
    $sql = "INSERT INTO `sell` (`amount`,`type`,`description`) VAlUES ('$amount','$type','$exp_description')";
    $result = mysqli_query($connection,$sql);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sell - Counter Sell</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/form.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>

</head>

<body class="sb-nav-fixed">

    <?php
    require 'includes/navbar.php';
    require 'includes/sidebar.php';
    require 'includes/containers/sell.php';
    ?>



    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>


</body>

</html>