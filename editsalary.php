<?php
include('config.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/functions.php');
checkUser();
userArea();
?>

    <script src="school.js"></script>
    <script src="jq.js"></script>

    <script>
        function feetot(){
        var balfee = document.getElementById("balan").value;
        var cfee = document.getElementById("cfee").value;
        var subfee = document.getElementById("subfee").value;
        var submitedf = document.getElementById("submitedf").value;

        var totfee = parseFloat(subfee)-parseFloat(balfee);
        var stfee = parseFloat(submitedf)-parseFloat(totfee);
        document.getElementById("nextfee").value = stfee;
         
         }
    </script>
       

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

 <!-- Content Header (Page header) -->
 <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                <h5 style="color:blue" class="m-0">Staff Salary Update </h5> 
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Staff Salary Update</li>
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
               <h3 class="card-title">Edit Staff Salary </h3>
                <a href="staffsalary.php" class="btn btn-primary float-right" >Back </a>
             </div>
                 <!-- /.card-header -->
                 <div class="card-body">

            <form action="paysalary.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                <?php
                    if (isset($_GET['sid']))
                    {
                    $sid = $_GET['sid'];
                    //$query = " SELECT * FROM salary WHERE id='$sid' LIMIT 1";
                    
                    $query = " SELECT * FROM salary WHERE id='$sid' LIMIT 1";
                    $query_run = mysqli_query($con,$query);
                    if(mysqli_num_rows($query_run) > 0)
                    {
                        foreach($query_run as $row)
                    {
                    ?>
               <div class="row"> 

                        <div class="col">
                        <label>Salary Id<span class="red-star"> </span></label>
                        <input type="text" id="slid" name="slid" value="<?php echo $row['id'] ?>" class="form-control" readonly>
                        </div>
                        
                        <div class="col">
                            <label>Satff Code<span class="red-star"></span></label>
                            <input type="text" id="stid" name="stid" value="<?php echo $row['stf_code'] ?>" class="form-control" readonly>
                        </div>
                        
                        <div class="col">
                        <label>Satff Name<span class="red-star"> </span></label>
                        <input type="text" id="stfname" name="stfname" value="<?php echo $row['stf_name'] ?>" class="form-control" readonly>
                        </div>
                        <div class="col">
                        <label>Job Type<span class="red-star"> </span></label>
                        <input type="text" id="coname" name="coname" value="<?php echo $row['stf_job'] ?>" class="form-control" readonly>
                        </div>
                        <div class="col">
                        <label>Staff Category<span class="red-star"> </span></label>
                        <input type="text" id="ses" name="ses" value="<?php echo $row['stf_cat'] ?>" class="form-control" readonly>
                        </div>
                </div>
                
                 <div class="row"> 
                  <div class="col">
                          <label>Month Of<span class="red-star"> *</span></label>
                          <select name="monthof" id="monthof" class="form-control" required>
                          <option selected><?php echo $row['monthof'] ?></option>
                          <option>January</option>
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
                    <label>Working Days<span class="red-star"> </span></label>
                    <input type="text" id="wday" name="wday" value="<?php echo $row['wo_day'] ?>" class="form-control" >
                    </div>
                    <div class="col">
                    <label>Salary/Payment<span class="red-star"> </span></label>
                    <input type="text" id="sal" name="sal" value="<?php echo $row['sal_paid'] ?>" class="form-control" >
                    </div>
                    

                    <div class="col">
                    <label>Paymet Type<span class="red-star">*</span></label>
                    <select name="ptype" id="ptype"  class="form-control" required>
                    <option selected><?php echo $row['pay_type'] ?></option>
                    <option>Cash</option>
                    <option>Cheque</option>
                    <option>On-Line</option>
                    </select>
                    </div>
                                    
                <div class="col">
                <label>Date<span class="red-star"> </span></label>
                <input type="date" id="pdate" name="pdate" min="1970-01-01" max="2030-01-01"  value="<?php echo $row['paid_date'] ?>" class="form-control" required>
                </div>
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
                     <button type="submit" name="paysubmit" class="btn btn-info">Edit Data</button>
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
          url: "addstudent.php",
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
