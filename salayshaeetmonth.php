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
    $sql="select * from salary";
    $result=mysqli_query($con, $sql);
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  
     
  <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
                            <div class="row mb-2">
                                      <div class="col-sm-6">
                                        <h5 style="color:blue" class="m-0">Salary Shaeet</h5>
                                      </div><!-- /.col -->
                                      <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                                          <li class="breadcrumb-item active">Salary Shaeet</li>
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
                           <form action="salarysheetmonthpdf.php" method="POST" >
                              <div class="row"> 
                                 <div class="col">
                                       <label>Month Of<span class="red-star"> *</span></label>
                                        <select name="monthof" id="monthof" class="form-control" required>
                                        <option selected>January</option>
                                        <option>February</option>
                                        <option>March</option>
                                        <option>April</option>
                                        <option>May</option>
                                        <option>June</option>
                                        <option>July</option>
                                        <option>August</option>
                                        <option>September</option>
                                        <option>October</option>
                                        <option>November</option>
                                        <option>December</option>
                                        </select>
                                    </div>
                                       
                                    <div class="col">
                                              <label>Employee Name</label>
                                              <select name="emp" id="emp"  value="<?php echo $corsid?>" class="form-control" >
                                              <option value=""> Select Emplyee</option>
                                              <?php
                                                  while($rows = mysqli_fetch_array($result)){
                                                      $c = $rows['stf_name'].' ('.$rows['stf_code'].')';
                                                      $e = $rows['stf_name'];
                                                      echo'<option value ="'.$e.'">'.$c.'</option>';
                                                  }
                                              ?>
                                              </select>
                                        </div>
                                       
                                      <div class="col">
                                       <label>Press Submit to Download Report</label>
                                       
                                        <input type="submit" name="submit" value="Submit"  class="form-control btn btn-primary ">
                                   </div>
                            </form>
                            </div>
                            <br>
                    
               
                 <!-- /.card-header -->
                  <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                              <th>Sr.</th>
                              <th>EmpId</th>
                              <th>EmpName</th>
                              <th>Designation</th>
                              <th>Month</th>
                              <th>Wo.Days</th>
                              <th>Salary</th>
                              <th>Date</th>
                             
                           </tr>
                        </thead>
                    <tbody>


                    <?php
                     
                                $get_data = "SELECT salary.*, date_format(paid_date,'%d-%m-%Y') as date FROM salary ORDER BY monthof ASC";
                                $run_data = mysqli_query($con,$get_data);
                                $i = 0; 
                                if (mysqli_num_rows($run_data) > 0)
                                {
                                  foreach($run_data as $row)
                                  {
                                  $sl = ++$i;
                                ?>
                                 
                                <tr>
                                <td class="stu_id"><?php echo $sl; ?></td>
                                <td><?php echo $row['stf_code']; ?></td>
                                <td><?php echo $row['stf_name']; ?></td>
                                <td><?php echo $row['stf_cat']; ?></td>
                                <td><?php echo $row['monthof']; ?></td>
                                <td><?php echo $row['wo_day']; ?></td>
                                <td><?php echo $row['sal_paid']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                                           
                              </tr>
                                <?php
                                }
                                }
                                else
                                {
                                ?>
                                  <tr>
                                      <td> No Record Found</td>
                                  </tr>
                                <?php
                                  }
                                ?>
                   </tbody>
                  </table>
              </div> 
             </div>      
            </div>
          </div>
        </section>
   </div>
<?php include('includes/script.php'); ?>
 
<?php include('includes/footer.php'); ?>
