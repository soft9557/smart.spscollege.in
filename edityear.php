<?php
include('config.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/script.php');
include('includes/functions.php');
checkUser();
userArea();
?>

<?php
    $sql="select * from institute";
    $result=mysqli_query($con, $sql);

?>

    <script src="school.js"></script>
    <script src="jq.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

 <!-- Content Header (Page header) -->
 <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                <h5 style="color:blue" class="m-0">Edit Institute Session Year</h5> 
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Year Change</li>
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
               <h3 class="card-title">Edit Institute data </h3>
                <a href="institute_year.php" class="btn btn-primary float-right" >Back </a>
             </div>
                 <!-- /.card-header -->
            <div class="card-body">

            <form action="addinstitute.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                   <?php
                      if (isset($_GET['sid']))
                      {
                      $sid = $_GET['sid'];
                      $query = " SELECT * FROM institute WHERE id='$sid' LIMIT 1";
                      $query_run = mysqli_query($con,$query);
                      if(mysqli_num_rows($query_run) > 0)
                      {
                        foreach($query_run as $row)
                       {
                      ?>
                   <div class="row"> 
                  
                        <div class="col">
                          <label>Session<span class="red-star"></span></label>
                           <input type="text" id="ses" name="ses" value="<?php echo $row['sese'] ?>" class="form-control"  required>
                        </div>
                   
                        <input type="hidden" id="sid" name="sid" value="<?php echo $row['id'] ?>" class="form-control"  readonly>
                                             
                                              
                        </div>
                   
                         <?php
                     }
                       }
                       else
                        {
                          echo "<h4> No record found !</h4>";
                        }
                        }
                   ?>

            </div> 
                 <div class="modal-footer">
                     <button type="submit" name="edityear" class="btn btn-info">Edit Data</button>
                </div>
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
