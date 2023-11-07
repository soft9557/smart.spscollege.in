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
                <h5 style="color:blue" class="m-0">Student Fee Updation </h5> 
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Fee Updation</li>
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
               <h3 class="card-title">Edit Student Fee </h3>
                <a href="feecollection.php" class="btn btn-primary float-right" >Back </a>
             </div>
                 <!-- /.card-header -->
                 <div class="card-body">

            <form action="submitfee.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                <?php
                    if (isset($_GET['sid']))
                    {
                    $sid = $_GET['sid'];
                    //$query = " SELECT * FROM fee_data WHERE id='$sid' LIMIT 1";
                    
                    $query = " SELECT fee_data.*, student_data.st_adm_no as stid,student_data.bal_fee as bfee,student_data.st_fee as cfee
                    FROM fee_data, student_data WHERE fee_data.adm_no=student_data.id and fee_data.id='$sid' LIMIT 1";
                    $query_run = mysqli_query($con,$query);
                    if(mysqli_num_rows($query_run) > 0)
                    {
                        foreach($query_run as $row)
                    {
                    ?>


               <div class="row"> 

                
                <div class="col">
                  <label>Fee Id<span class="red-star"> </span></label>
                  <input type="text" id="fid" name="fid" value="<?php echo $row['id'] ?>" class="form-control" readonly>
                </div>
                
                <div class="col">
                    <label>StudentID<span class="red-star"></span></label>
                    <input type="text" id="stid" name="stid" value="<?php echo $row['adm_no'] ?>" class="form-control" readonly>
                </div>
                
                <div class="col">
                <label>Course Code<span class="red-star"> </span></label>
                <input type="text" id="cors" name="cors" value="<?php echo $row['course'] ?>" class="form-control" readonly>
                </div>
                <div class="col">
                <label>Course Name<span class="red-star"> </span></label>
                <input type="text" id="coname" name="coname" value="<?php echo $row['cl_name'] ?>" class="form-control" readonly>
                </div>
                <div class="col">
                <label>Session<span class="red-star"> </span></label>
                <input type="text" id="ses" name="ses" value="<?php echo $row['sess'] ?>" class="form-control" readonly>
                </div>
                </div>
                
                <div class="row"> 
                    <div class="col">
                    <label>Student Name<span class="red-star"> </span></label>
                    <input type="text" id="stname" name="stname" value="<?php echo $row['st_name'] ?>" class="form-control" readonly>
                    </div>
                    <div class="col">
                    <label>Father Name<span class="red-star"> </span></label>
                    <input type="text" id="stfath" name="stfath" value="<?php echo $row['st_fath'] ?>" class="form-control" readonly>
                    </div>
                    
                    <div class="col">
                    <label>Mobile N0<span class="red-star"> </span></label>
                    <input type="text" id="mobil" name="mobil" value="<?php echo $row['mob'] ?>" class="form-control" readonly>
                    </div>
                  </div>
                <div class="row">
                <div class="col">
                   <label>Submited Fee<span class="red-star"> </span></label>
                   <input type="text" id="submitedf" name="submitedf" value="<?php echo $row['paid_fee'] ?>" class="form-control" readonly>
                 </div>  
                 
                 <div class="col">
                   <label>Course Fee<span class="red-star"> </span></label>
                   <input type="text" id="cfee" name="cfee" value="<?php echo $row['course_fee'] ?>" class="form-control" readonly>
                 </div> 
                 
                <div class="col">
                    <label>Address<span class="red-star"> </span></label>
                    <input type="text" id="addrs1" name="addrs1" value="<?php echo $row['addr1'] ?>" class="form-control" readonly>
                    </div>
                
                </div>

                <div class="row"> 
                <div class="col">
                <label>Submit Fees<span id="words" > </span></label>
                <input type="number" id="subfee" name="subfee" value="<?php echo $row['paid_fee'] ?>" onchange="feetot();" class="form-control" placeholder="Enter Submit Fee" required>
                </div>
                
                <div class="col">
                <label>Fee Head<span class="red-star"> </span></label>
                <select name="fhead" id="fhead" class="form-control" required>
                <option selected><?php echo $row['fee_head'] ?></option>  
                <option>Admission Fee</option>
                <option>Education Fee</option>
                <option>Practical Fee</option>
                <option>Exam Fee</option>
                <option>ReExam Fee</option>
                <option>Composite Fee</option>
                <option>Old Balance Fee</option>
                </select>
                </div>
                <div class="col">
                <label>Paymet Type<span class="red-star"> </span></label>
                <select name="ptype" id="ptype"  class="form-control" required>
                <option selected><?php echo $row['pay_type'] ?></option>
                <option>Cash</option>
                <option>On-Line</option>
                </select>
                </div>
                <div class="col">
                <label>Date<span class="red-star"> </span></label>
                <input type="date" id="fdate" name="fdate" value="<?php echo $row['paid_date'] ?>"  min="1970-01-01" max="2030-01-01" class="form-control" required>
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
                     <button type="submit" name="editfee" class="btn btn-info">Edit Data</button>
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
