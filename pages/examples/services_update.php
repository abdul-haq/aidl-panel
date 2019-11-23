<?php
error_reporting(0);
// Include config file
require_once "../../config/db.php";

// Define variables and initialize with empty values
$snamee = $sdesc = "";
$sname_err = $sdesc_err = $msg = "";
$date = date('d-m-Y');

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];
    // Validate name
    $input_name = trim($_POST["sname"]);
    if (empty($input_name)) {
        $sname_err = "Please enter service name";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $sname_err = "Please enter a valid service name";
    } else {
        $snamee = $input_name;
    }

    // Validate address
    $input_address = trim($_POST["sdescription"]);
    if (empty($input_address)) {
        $sdesc_err = "Please enter service description";
    } else {
        $sdesc = $input_address;
    }


    // Check input errors before inserting in database
    if (empty($sname_err) && empty($sdesc_err)) {
        // Prepare an insert statement
        $sql = "UPDATE add_service SET sname=?, sdescription=?, dateposted=? WHERE sid=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_sname, $param_sdesc, $param_date, $param_id);

            // Set parameters
            $param_sname = $snamee;
            $param_sdesc = $sdesc;
            $param_date = $date;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                $msg = "Succesfully Updated";
                header('Refresh: 5; URL=services.php');
                // header("location: services.php");
                // exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM add_service WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $snamee = $row["sname"];
                    $sdesc = $row["sdescription"];
                    $date = $row["dateposted"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: 500.html");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Project Edit</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php include("navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require("../../sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Service Add</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Service Add</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                                <div class="card-body">
                                <?php 
                                if(!empty($msg)) { 
                                ?>
                                    <div class="alert alert-success" role="alert">
                                       <?=$msg;?>
                                    </div>
                                <?php } ?>

                                    <div class="form-group<?php echo (!empty($sname_err)) ? 'has-error' : ''; ?>">
                                        <label for="inputName">Service Name</label>
                                        <input type="text" id="inputName" name="sname" class="form-control" value="<?php echo $snamee; ?>">
                                        <span class="help-block" style="color: red;"><?php echo $sname_err; ?></span>
                                    </div>
                                    <div class="form-group<?php echo (!empty($sdesc_err)) ? 'has-error' : ''; ?>">
                                        <label for="inputDescription">Service Description</label>
                                        <textarea id="inputDescription" name="sdescription" class="form-control" rows="4"><?php echo $sdesc; ?></textarea>
                                        <span class="help-block" style="color: red;"><?php echo $sdesc_err; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <a href="../../index.php" class="btn btn-secondary">Cancel</a>
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <input type="submit" value="Update Service" class="btn btn-success float-right">
                                    </div>

                                </div>
                                <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                </div>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->



        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
</body>

</html>