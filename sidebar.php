
<?php

//  $protocol = 'http'.(!empty($_SERVER['HTTPS']) ? 's' : '');
$currURL = substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
$chkk="/AIDL/pages/examples" 


?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src=<?php
          if($currURL==$chkk)
          {
            echo "../../dist/img/AdminLTELogo.png";
          }
          else 
          {
            echo "dist/img/AdminLTELogo.png";
          }
          ?> alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AIDL </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        
          <img src=<?php
          if($currURL==$chkk)
          {
            echo "../../dist/img/avatar.png";
          }
          else 
          {
            echo "dist/img/avatar.png";
          }
          ?> class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Haider</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href=<?php echo ($currURL==$chkk?"../../index.php":"index.php") ?> class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
           
          </li>
          
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              
              <li class="nav-item">
                <a href=<?php echo ($currURL==$chkk?"projects.php":$chkk."/projects.php") ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Products</p>
                </a>
              </li>
              <li class="nav-item">

                <a href=<?php echo ($currURL==$chkk?"project_add.php":$chkk."/project_add.php") ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Products</p>
                </a>
              </li>
             
             
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="./pages/services.html" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Services
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              
              <li class="nav-item">
                <a href=<?php echo ($currURL==$chkk?"services.php":$chkk."/services.php") ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Services</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=<?php echo ($currURL==$chkk?"services_add.php":$chkk."/services_add.php") ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Services</p>
                </a>
              </li>
             
             
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Clients
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              
              <li class="nav-item">
                <a href=<?php echo ($currURL==$chkk?"clients.php":$chkk."/clients.php") ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Clients</p>
                </a>
              </li>
              <li class="nav-item">
                <a href=<?php echo ($currURL==$chkk?"clients_add.php":$chkk."/clients_add.php") ?> class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Client</p>
                </a>
              </li>
             
             
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href=<?php echo ($currURL==$chkk?"blogg.php":$chkk."/blogg.php") ?> class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
              Blog
                
              </p>
            </a>
           
          </li>
         
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Logout
                
              </p>
            </a>
           
          </li>
         
         
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>