<?php
// Include config file
require_once "../../config/db.php";
 
// Define variables and initialize with empty values
$snamee = $sdesc = "";
$sname_err = $sdesc_err = "";
$date = date('d-m-Y');
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["sname"]);
    if(empty($input_name)){
        $sname_err = "Please enter service name";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $sname_err = "Please enter a valid service name";
    } else{
        $snamee = $input_name;
    }
    
    // Validate address
    $input_address = trim($_POST["sdescription"]);
    if(empty($input_address)){
        $sdesc_err = "Please enter service description";     
    } else{
        $sdesc = $input_address;
    }
   
    
    // Check input errors before inserting in database
    if(empty($sname_err) && empty($sdesc_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO add_service (sname, sdescription,dateposted) VALUES (?, ?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_sname, $param_sdesc,$param_date);
            
            // Set parameters
            $param_sname = $snamee;
            $param_sdesc = $sdesc;
            $param_date=$date;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: ../../index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
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
 <?php include("navbar.php")?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php require("../../sidebar.php")?>

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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="card-body">
              <div class="form-group<?php echo (!empty($sname_err)) ? 'has-error' : ''; ?>">
                <label for="inputName">Service Name</label>
                <input type="text" id="inputName" name="sname" class="form-control" value="<?php echo $snamee; ?>">
                <span class="help-block" style="color: red;"><?php echo $sname_err;?></span>
              </div>
              <div class="form-group<?php echo (!empty($sdesc_err)) ? 'has-error' : ''; ?>">
                <label for="inputDescription">Service Description</label>
                <textarea id="inputDescription" name="sdescription" class="form-control" rows="4"><?php echo $sdesc; ?></textarea>
                <span class="help-block" style="color: red;"><?php echo $sdesc_err;?></span>
              </div>
             <div class="form-group">
             <a href="../../index.php" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Add new service" class="btn btn-success float-right">
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
