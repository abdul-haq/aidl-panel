<?php
require_once('../../config/db.php');
$upload_dir = 'images/';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from add_client where cid=" . $id;
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        $errorMsg = 'Could not Find Any Record';
    }
}

if (isset($_POST['Submit'])) {
    $name = $_POST['name'];
    $desc = $_POST['desc'];

    $imgName = $_FILES['image']['name'];
    $imgTmp = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];

    if ($imgName) {

        $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

        $allowExt  = array('jpeg', 'jpg', 'png', 'gif');

        $userPic = time() . '_' . rand(1000, 9999) . '.' . $imgExt;

        if (in_array($imgExt, $allowExt)) {

            if ($imgSize < 5000000) {
                unlink($upload_dir . $row['cimage']);
                move_uploaded_file($imgTmp, $upload_dir . $userPic);
            } else {
                $errorMsg = 'Image too large';
            }
        } else {
            $errorMsg = 'Please select a valid image';
        }
    } else {

        $userPic = $row['cimage'];
    }

    if (!isset($errorMsg)) {
        $sql = "update add_client set cname = '" . $name . "', cdesc = '" . $desc . "',cimage = '" . $userPic . "' where cid=" . $id;
        $result = mysqli_query($link, $sql);
        if ($result) {
            $successMsg = 'New record updated successfully';
            header('Location:clients.php');
        } else {
            $errorMsg = 'Error ' . mysqli_error($link);
        }
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
                            <h1>Client Add</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Client Add</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <form class="" action="" method="post" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">General</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <form class="" action="cadd.php" method="post" enctype="multipart/form-data">

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputName">Client Name</label>
                                            <input type="text" id="inputName" name="name" value="<?= $row['cname']; ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDescription">Client Description</label>
                                            <textarea id="inputDescription" name="desc" class="form-control" rows="4"><?= $row['cdesc']; ?></textarea>
                                        </div>


                                    </div>
                                    <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-md-6">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Client Image</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputEstimatedBudget">Client Image</label>
                                        <img src="<?php echo $upload_dir . $row['cimage'] ?>" width="100">

                                        <input type="file" id="inputEstimatedBudget" name="image" class="form-control">
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="btn btn-secondary">Cancel</a>
                            <input type="submit" name="Submit" value="Create new Porject" class="btn btn-success float-right">
                        </div>
                    </div>
                </form>
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