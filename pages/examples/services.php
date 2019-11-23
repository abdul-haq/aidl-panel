<?php require_once('../../config/db.php');


$sql = "SELECT * FROM add_service";




?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Gallery</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="../../plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


  <link rel="stylesheet" href="../services.css">
</head>

<body class="hold-transition sidebar-mini">
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
              <h1>Services</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Services</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Prducts</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>

            </div>
          </div>

          <div class="card-body p-0">
            <?php
            if ($result = mysqli_query($link, $sql)) {
              if (mysqli_num_rows($result) > 0) {
                ?>
                <table class="table table-striped projects">
                  <thead>
                    <tr>
                      <th style="width: 1%">
                        SID
                      </th>
                      <th style="width: 20%">
                        Service Name
                      </th>
                      <th style="width: 50%">
                        Service Description
                      </th>


                      <th style="width: 20%">
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                      <tr>
                        <td>
                          <?= $row['sid'] ?>
                        </td>
                        <td>
                          <a>
                            <?= $row['sname'] ?>
                          </a>
                          <br />
                          <small>
                            Created <?= $row['dateposted'] ?>
                          </small>
                        </td>
                        <td>
                          <p><?= $row['sdescription'] ?></p>
                        </td>

                        <td class="project-actions text-right">

                          <a class="btn btn-info btn-sm" href="services_update.php?id=<?= $row['sid'] ?>">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                          </a>
                          <a style="color: white;" class="btn btn-danger btn-sm" class="delbutton" id="<?= $row['sid'] ?>" onclick="dlt(this)">
                            <i class="fas fa-trash">
                            </i>
                            Delete
                          </a>
                        </td>
                      </tr>
                <?php
                    }
                    mysqli_free_result($result);
                  } else {
                    echo "No records matching your query were found.";
                  }
                } else {
                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }
                ?>

                  </tbody>
                </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

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
  <!-- Bootstrap -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- jQuery UI -->
  <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Ekko Lightbox -->
  <script src="../../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- Filterizr-->
  <script src="../../plugins/filterizr/jquery.filterizr.min.js"></script>
  <!-- Page specific script -->
  <script type="text/javascript">
  function dlt(e){
  
      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {

          if (willDelete) {
           
            
            window.location = `delete_entry.php?id=${e.id}`;
          } else {
            swal("Your file is safe!", {
              icon: "success",
            });
          }
        });
    // })
  }
 
  </script>
  <script>
    $(function() {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });

      $('.filter-container').filterizr({
        gutterPixels: 3
      });
      $('.btn[data-filter]').on('click', function() {
        $('.btn[data-filter]').removeClass('active');
        $(this).addClass('active');
      });
    });
  </script>


</body>

</html>