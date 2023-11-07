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
    <script src="school.js"></script>
    <script src="jq.js"></script>

    
</head>
<body>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Student Add Modal -->
              <div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-lg">
                  <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Receipt Voucher</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                        </div>
                    <form action="submitrec.php" method="POST" enctype="multipart/form-data">
                   <div class="modal-body">

                <div class="row"> 

                          
                        <div class="col">
                          <label>Receive from<span class="red-star"> </span></label>
                          <input type="text" id="recfrom" name="recfrom" class="form-control" placeholder="Enter Receipt To" required>
                        </div>
                        <div class="col">
                          <label>Receive For<span class="red-star"> </span></label>
                          <input type="text" id="recfor" name="recfor" class="form-control" placeholder="Enter Receipt For" required>
                        </div>
                        <div class="col">
                          <label>Receipt Amt<span id="words" > </span></label>
                          <input type="number" id="recamt" name="recamt" class="form-control" placeholder="Enter Receipt Amt" required>
                        </div>
                        
                 </div>
                 <div class="row"> 
                       

                        <div class="col">
                          <label>Naretion<span class="red-star"> </span></label>
                          <input type="text" id="nar" name="nar" class="form-control" >
                        </div>
                        
                        <div class="col">
                          <label>Rec Amt Type<span class="red-star"> </span></label>
                          <select name="rtype" id="rtype" class="form-control" required>
                          <option value=""selected>Select Pay Type</option>
                          <option value="Cash">Cash</option>
                          <option value="On-Line">On-Line</option>
                          <option value="Cheqe">Cheqe</option>
                          </select>
                        </div>
                        <div class="col">
                          <label>Date<span class="red-star"> </span></label>
                          <input type="date" id="rdate" name="rdate" min="1970-01-01" max="2030-01-01" class="form-control" required>
                        </div>
               </div>

                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="recsubmit" onclick="return confirm('Are you sure?')" class="btn btn-primary">Submit</button>
                </div>
          </div>
            </form>
          </div>
        </div>
      </div>
      <!----End modal--------->
      <!------View modal---->
      <div class="modal fade" id="viewStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Receipt Slip</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   </div>
                  
                    <div class="modal-body">
                    <div class="student_view">
                    </div>
                    
                     </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="Deletstubtn" class="btn btn-primary">Print/Download</button>
                </div>
                
        </div>
      </div>
      </div>
  <!----End modal--------->

      <!------DELETE modal---->
      <div class="modal fade" id="DeletSt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Receipt</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   </div>
                  <form action="submitrec.php" method="POST">
                    <div class="modal-body">
                   
                    <input type="hidden" name="delete_sid" class="delet_stu_id" >
                  <p>
                    Are you sure want to delete this data? 
                  </p>     
                     </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="Deletstubtn" class="btn btn-primary">Yes,Delete.!</button>
                </div>
                </form>
        </div>
      </div>
      </div>
  <!----End modal--------->
  
  <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                <h5 style="color:blue" class="m-0">Receipt Voucher </h5> 
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Receipt Voucher</li>
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
                <h3 class="card-title">Received Voucher</h3>
                 <a href="#" data-toggle="modal" data-target="#addStudent" class="btn btn-primary float-right" >Receipt</a>
               </div>
                 <!-- /.card-header -->
               <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                              <th>VouId.</th>
                              <th>From</th>
                              <th>For</th>
                              <th>Type</th>
                              <th>RecAmt</th>
                              <th>Date</th>
                              <th>Naretion</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                    <tbody>


                    <?php
                                $get_data = "SELECT received.*,date_format(rece_date,'%d-%m-%Y') as date FROM received";
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
                                <td><?php echo $row['rece_from']; ?></td>
                                <td><?php echo $row['rece_for']; ?></td>
                                <td><?php echo $row['rece_type']; ?></td>
                                <td><?php echo $row['rece_amt']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['rece_nar']; ?></td>
                               
                                <td> 
                                <a href ="receiptvou.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a>   
                                <a href ="editreceipt.php?sid=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a> 
                                <a href="javascript:void(0)" onclick="delete_confir('<?php echo $row['id'];?>','submitrec.php')"class="btn btn-danger btn-sm">Delete</a>
                                
                                </td>
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
        </div>
      </section>
   </div>
<?php include('includes/script.php'); ?>
  <script>
     $(document).ready(function () {
      $('.deletebtn').click(function (e) { 
        e.preventDefault();
        var stu_id = $(this).val();
        //console.log(stu_id);
         $('.delet_stu_id').val(stu_id);
         $('#DeletSt').modal('show');

      });


      $('.updatebtn').click(function (e) { 
        e.preventDefault();
        var stu_id = $(this).val();
        //console.log(stu_id);
         $('.delet_stu_id').val(stu_id);
         $('#editStudent').modal('show');

      });


      });
   </script>

<script>
     $(document).ready(function () {
      $('.viewbtn').click(function (e) { 
        e.preventDefault();
        var stu_id = $(this).closest('tr').find('.stu_id').text();
        //console.log(stu_id);
        // $('.delet_stu_id').val(stu_id);
        // $('#DeletSt').modal('show');
        $.ajax({
          type: "POST",
          url: "submitfee.php",
          data: {
            'checking_viewbtn':true,
            'student_id':stu_id,
          },
          success: function (response) {
          //console.log(response);
          $('.student_view').html(response);
          $('#viewStudent').modal('show');
          }
        });
      });
      });
   </script>
<?php include('includes/footer.php'); ?>
</body>
</html>
