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
                                        <h5 style="color:blue" class="m-0">Fee Report Cash/OnLine Wise</h5>
                                      </div><!-- /.col -->
                                      <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                                          <li class="breadcrumb-item active">Fee Reports</li>
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
                 
                         <form action="fee_repocashonlinepdf.php" method="POST" >
                         <div class="row"> 
                                      <div class="col">
                                        <label>From</label>
                                        <input type="date" name="from" value="<?php echo $from?>" min="1970-01-01" max="2030-01-01" onchange="set_to_date()" id="from_date" class="form-control w250" required >
                                      </div>
                                      <div class="col">
                                      <label>To</label> 
                                        <input type="date" name="to"  value="<?php echo $to?>" min="1970-01-01" max="2030-01-01"  id="to_date" class="form-control w250" required>
                                      </div>
                                      <div class="col">
                                        <label>Paymet Type<span class="red-star"> </span></label>
                                        <select name="ptype" id="ptype" class="form-control" required>
                                        <option selected value=""> Select PayType.. </option>
                                        <option value="Cash">Cash</option>
                                        <option  value="On-Line">On-Line</option>
                                        </select>
                                      </div>
                                      </form>
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
                              <th>Sub.Fee</th>
                              <th>PayType</th>
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
