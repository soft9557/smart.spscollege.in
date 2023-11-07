<?php
include('config.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/script.php');
include('includes/functions.php');
checkUser();
//userArea();

//checkManager();
managerArea();
?>
<script>
   setTitle("Dashboard");
   selectLink('dashboard_link');
</script>

<?php
            $res=mysqli_query($con,"select COUNT(*) AS stud from student_data");
            if(mysqli_num_rows($res)>0){
             while($row=mysqli_fetch_assoc($res)){
              $st = $row['stud']; 
              }
            }
            
            $res1=mysqli_query($con,"select COUNT(distinct adm_no) AS fstud from fee_data");
            if(mysqli_num_rows($res1)>0){
             while($row1=mysqli_fetch_assoc($res1)){
              $fst = $row1['fstud']; 
              }
            }              
    
            ?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">Access Denied</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                      <li class="breadcrumb-item active">Access Denied </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
         <!-- /.content-header -->

         <?php
          if(isset($_SESSION['status']))
          {
              echo "<h4>".$_SESSION['status']."</h4>";
              unset($_SESSION['status']);
          }
          
          ?>

<style>
img2 {
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.center {
  display: block;
  margin-top: -15px;
  margin-bottom: auto;
  margin-left: auto;
  margin-right: 1.5px;
  padding: 1px;
  
}

</style>


<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">


        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <!DOCTYPE html>
<html>
<body>

<img src="images/accden.jpg" alt="acess" width="600" height="550"  class="center">

</body>
</html>
            
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            
          <!-- ./col -->
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
     </section>

</div>
<?php
include('includes/footer.php');
?>
