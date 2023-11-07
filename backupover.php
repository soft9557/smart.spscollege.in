<?php
include('config.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/functions.php');
checkUser();
userArea();

?>

<!DOCTYPE html>
<!--=== Coding by SoftLabTech | www.softlabtech.com === -->
<html lang="en">
<head>
</head>
<body>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   
  <!-- Content Header (Page header) -->
  <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                <h5 style="color:red" class="m-0">System Backup</h5> 
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">System Backup</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
      <!-- /.content-header -->
      <section class="container">
      <div class="container">
        <div class="row">
          <div class="col-md 12">
                  <?php
                  if(isset($_SESSION['status']))
                  {
                      echo "<h4>".$_SESSION['status']."</h4>";
                      unset($_SESSION['status']);
                  }
                  ?>

            <div class="card">
               <div class="card-header">
                 <h3></h3>

                <img src="images/backup_animation.gif" alt="Computer man" style="width:600px;height:250px;">

                </div>
                 <!-- /.card-header -->
               <div class="card-body">
                  
              </div> 
             </div>      
            </div>
          </div>
        </div>
      </section>
   </div>
<?php include('includes/script.php'); ?>
 <?php include('includes/footer.php'); ?>
</body>
</html>


