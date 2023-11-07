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
    $sql="select * from class_data";
    $result=mysqli_query($con, $sql);

    $sql1="select distinct class_name from class_data";
    $result1=mysqli_query($con, $sql1);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  
     
  <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
                            <div class="row mb-2">
                                      <div class="col-sm-6">
                                        <h5 style="color:blue" class="m-0">Student Fee Report(Class)</h5>
                                      </div><!-- /.col -->
                                      <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                                          <li class="breadcrumb-item active">Student Fee Report (Class)</li>
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
                         <form action="fee_pdfrepo_class.php" method="POST" >
                              <div class="row"> 
                                      <div class="col">
                                              <label>Course Code</label>
                                              <select name="corsid" id="corsid"  value="<?php echo $corsid?>" class="form-control" >
                                              <option value=""> Select course Code </option>
                                              <?php
                                                  while($rows = mysqli_fetch_array($result)){
                                                      $c = $rows['class_id'];
                                                      echo'<option value ="'.$c.'">'.$c.'</option>';
                                                  }
                                              ?>
                                              </select>
                                        </div>
                                       <div class="col">
                                                <label>Course Name</label>
                                                <select name="stid" id="stid" value="<?php echo $stid?>"  class="form-control" >
                                                <option value=""> Select course Name </option>
                                                <?php
                                                    while($rows = mysqli_fetch_array($result1)){
                                                        $c = $rows["class_name"];
                                                        echo'<option value ="'.$c.'">'.$c.'</option>';
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
                              <th>ID</th>
                              <th>AdmId</th>
                              <th>StName</th>
                              <th>Father</th>
                              <th>Co.Code</th>
                              <th>Co.Name</th>
                              <th>Session</th>
                              <th>Sub.Fee</th>
                              <th>Type</th>
                              <th>Date</th>
                            </tr>
                        </thead>
                    <tbody>
                    

                    <?php
                                $get_data = "SELECT fee_data.*,date_format(paid_date,'%d-%m-%Y') as date FROM fee_data";
                                $run_data = mysqli_query($con,$get_data);
                                //$i = 0; 
                                if (mysqli_num_rows($run_data) > 0)
                                {
                                  foreach($run_data as $row)
                                  {
                                  //$sl = ++$i;
                                ?>
                                 
                                <tr>
                                <td class="stu_id"><?php echo $row['id']; ?></td>
                                <td><?php echo $row['adm_no']; ?></td>
                                <td><?php echo $row['st_name']; ?></td>
                                <td><?php echo $row['st_fath']; ?></td>
                                <td><?php echo $row['course']; ?></td>
                                <td><?php echo $row['cl_name']; ?></td>
                                <td><?php echo $row['sess']; ?></td>
                                <td><?php echo $row['paid_fee']; ?></td>
                                <td><?php echo $row['pay_type']; ?></td>
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
