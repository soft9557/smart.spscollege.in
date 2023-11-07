<?php
include('config.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/functions.php');
checkUser();
userArea();
?>
  <?php
   $res1=mysqli_query($con,"select * from institute");
   if(mysqli_num_rows($res1)>0){
                
                while($row1=mysqli_fetch_assoc($res1)){
                  $imail=$row1['ins_email'];
              }
   }        
   
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
                <h5 style="color:blue" class="m-0">System Backup</h5> 
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                  
            <div class="card">
               <div class="card-header">
                <h3 class="card-title">Create Backup & Send to Registerd Email ID</h3><br><br><br>
                </div>
                 <!-- /.card-header -->
               <div class="card-body">
               <form action="createbackup.php" method="POST" enctype="multipart/form-data"> 
                      <div class="row"> 
                          <div class="col">
                             <label>Registered Email Id is :<span class="red-star"> </span></label>
                             <input type="text" id="ccode" name="ccode" value="<?php echo $imail ?>" class="form-control" readonly>
                          </div>
                       
                        <div id="loader-icon" style="display:none;"><img src="images/loader.gif" /></div>
                         </div> 

                     <div class="modal-footer">
                     <button type="submit" name="backup" class="btn btn-primary float-left">Send Backup</button>
                     </div>
                </form>
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
