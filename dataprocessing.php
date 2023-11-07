<?php
include('config.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/functions.php');
checkUser();
userArea();
$classfee='';
$sub_sql1='';
$sub_sql='';
$from='';
$to='';

?>


<?php
    $sql="select distinct cl_cd from student_data order by cl_cd asc";
    $result=mysqli_query($con, $sql);

    $sql2="select class_id from class_data order by class_id asc";
    $result2=mysqli_query($con, $sql2);

?>


<?php
    $sql1="select * from institute";
    $result1=mysqli_query($con, $sql1);
    while($rows1 = mysqli_fetch_array($result1)){
    $sess = $rows1['sese'];
    
    }

 ?>
 <script src="school.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  
     
  <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
                            <div class="row mb-2">
                                      <div class="col-sm-6">
                                        <h5 style="color:blue" class="m-0">Data Processing</h5>
                                      </div><!-- /.col -->
                                      <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                                          <li class="breadcrumb-item active">Student Reports</li>
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
                 <!-- Student Report -->
                         <form action="process.php" method="POST" >
                                                 
                              <div class="row"> 
                                  <div class="col">
                                  <label>Course Code</label>
                                     <select name="sid" id="sid"  value="<?php echo $corsid?>" class="form-control" onchange="fetchcl()" >
                                        <option value=""> Select course Code </option>
                                          <?php
                                         while($rows = mysqli_fetch_array($result)){
                                         $c = $rows['cl_cd'];
                                          echo'<option value ="'.$c.'">'.$c.'</option>';
                                                  }
                                              ?>
                                              </select>
                                    </div>
                                    <div class="col">
                                 <label>Fee<span class="red-star"> </span></label>
                                      <input type="text" id="fee" name="fee" class="form-control" readonly>
                                 </div>
                                 <div class="col">
                                 <label>Count<span class="red-star"> </span></label>
                                      <input type="text" id="cou" name="cou" class="form-control" readonly>
                                 </div>
                                <div class="col">
                                 <label>Session<span class="red-star"> </span></label>
                                      <input type="text" id="ses" name="ses" class="form-control" readonly>
                                 </div>

                                      
                          
                                  
                                </div>
                            <div class="row"> 
                               <div class="col">
                                     <label>---To---</label>
                                     <select name="chsid" id="chsid"  value="<?php echo $corsid?>" class="form-control" >
                                     <option value=""> Select course Code </option>
                                          <?php
                                       while($rows = mysqli_fetch_array($result2)){
                                         $c = $rows['class_id'];
                                          echo'<option value ="'.$c.'">'.$c.'</option>';
                                                  }
                                              ?>
                                              </select>
                                 </div>

                                 <div class="col">
                                 <label>fee<span class="red-star"> </span></label>
                                      <input type="text" id="chfee" name="chfee" class="form-control" >
                                 </div>
                                 <div class="col">
                                 <label>Count<span class="red-star"> </span></label>
                                      <input type="text" id="chcou" name="chcou" class="form-control" readonly>
                                 </div>
                                <div class="col">
                                    <label>---To---<span class="red-star"> </span></label>
                                    <select name="chses" id="chses" class="form-control">
                                    <option value="" selected>Select Category</option>
                                    <option value="2022-23">2022-23</option>
                                    <option value="2023-24">2023-24</option>
                                    <option value="2024-25">2024-25</option>
                                    </select>
                                 </div>
                              
                                      
                                 
                     
                                 </div>

                                 <div class="row"> 
                                    <div class="col">
                                      
                                      <button type="submit" name="process" class="btn btn-info">Process Data</button>
                                    </div>
                                </div>
                            </form>
                            <br>
                    
               
                 <!-- /.card-header -->
                 
              </div> 
             </div>      
            </div>
          </div>
        </section>
   </div>
<?php include('includes/script.php'); ?>
 
<?php include('includes/footer.php'); ?>
