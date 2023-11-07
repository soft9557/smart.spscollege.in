<?php
include('config.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/functions.php');
checkUser();
userArea();
$sysdate=date('Y-m-d');
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
                                        <h5 style="color:blue" class="m-0">Day Book</h5>
                                      </div><!-- /.col -->
                                      <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                                          <li class="breadcrumb-item active">Day Book</li>
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
                 
                         <form action="daybookpdf_date.php" method="POST" >
                         <div class="row"> 
                                      <div class="col">
                                        <label>From</label>
                                        <input type="date" name="from" value="<?php echo $sysdate?>" min="1970-01-01" max="2030-01-01" id="from_date" class="form-control w250" required>
                                      </div>
                                      <div class="col">
                                      <label>To</label> 
                                        <input type="date" name="to"  value="<?php echo $sysdate?>" min="1970-01-01" max="2030-01-01"  id="to_date" class="form-control w250" required>
                                      </div>
                                      <div class="col">
                                      <label>Type</label> 
                                            <select name="ptype" id="ptype" class="form-control" required>
                                            <option selected>Select Pay Type</option>
                                            <option>Cash</option>
                                            <option>On-Line</option>
                                            <option>Cheqe</option>
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
                              <th>Date</th>
                              <th>Ledger</th>
                              <th>Narration</th>
                              <th>Vou./Slip No.</th>
                              <th>Crdit</th>
                              <th>Debit</th>
                              <th>Type</th>
                             
                              </tr>
                        </thead>
                    <tbody>
                 
                         <?php
                                $get_data = "SELECT date_format(paid_date,'%d-%m-%Y') as date,fee_from as ledger,st_name as narr,id as slip,paid_fee as credit,pay_amt as debit,pay_type as ptype FROM fee_data 
                                UNION SELECT date_format(rece_date,'%d-%m-%Y') as date,rece_from as ledger,rece_nar as narr,id as slip,rece_amt as credit,pay_amt as debit,rece_type as ptype FROM received 
                                UNION SELECT date_format(pay_date,'%d-%m-%Y') as date,pay_to as ledger,pay_nar as narr,id as slip,rec_amt as credit,pay_amt as debit,pay_type as pytpe FROM payment 
                                UNION SELECT date_format(paid_date,'%d-%m-%Y') as date,ledger as ledger,stf_name as narr,id as slip,sal_rec as credit,sal_paid as debit,pay_type as ptype FROM salary ORDER BY  date,ledger  " ;
                                $run_data = mysqli_query($con,$get_data);
                                //$i = 0; 
                                if (mysqli_num_rows($run_data) > 0)
                                {
                                  foreach($run_data as $row)
                                  {
                                  //$sl = ++$i;
                                ?>
                                 
                                <tr>
                                
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['ledger']; ?></td>
                                <td><?php echo $row['narr']; ?></td>
                                <td><?php echo $row['slip']; ?></td>
                                <td><?php echo $row['credit']; ?>
                                <td><?php echo $row['debit']; ?></td>
                                <td><?php echo $row['ptype']; ?></td>
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
