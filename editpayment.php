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
         

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

 <!-- Content Header (Page header) -->
 <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                <h5 style="color:blue" class="m-0">Payment Voucher Update </h5> 
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Payment Voucher Update</li>
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
               <h3 class="card-title">Edit Payment Voucher</h3>
                <a href="payment_bro.php" class="btn btn-primary float-right" >Back </a>
             </div>
                 <!-- /.card-header -->
                 <div class="card-body">

                 <form action="submitpay.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                <?php
                    if (isset($_GET['sid']))
                    {
                    $sid = $_GET['sid'];
                    //$query = " SELECT * FROM salary WHERE id='$sid' LIMIT 1";
                    
                    $query = " SELECT * FROM payment WHERE id='$sid' LIMIT 1";
                    $query_run = mysqli_query($con,$query);
                    if(mysqli_num_rows($query_run) > 0)
                    {
                        foreach($query_run as $row)
                    {
                    ?>
               <div class="row"> 
               
                        <input type="hidden" id="sid" name="sid" value="<?php echo $row['id'] ?>" class="form-control" placeholder="" readonly>
                        <div class="col">
                          <label>Pay To<span class="red-star"> </span></label>
                          <input type="text" id="payto" name="payto"  value="<?php echo $row['pay_to'] ?>" class="form-control" placeholder="Enter Payment To" required>
                        </div>
                        <div class="col">
                          <label>Pay For<span class="red-star"> </span></label>
                          <input type="text" id="payfor" name="payfor" value="<?php echo $row['pay_for'] ?>" class="form-control" placeholder="Enter Payment For" required>
                        </div>
                        <div class="col">
                          <label>Payment<span id="words" > </span></label>
                          <input type="number" id="payment" name="payment" value="<?php echo $row['pay_amt'] ?>" class="form-control" placeholder="Enter Payment Amt" required>
                        </div>
                    </div>
                      <div class="row"> 
                        <div class="col">
                          <label>Naretion<span class="red-star"> </span></label>
                          <input type="text" id="nar" name="nar" value="<?php echo $row['pay_nar'] ?>" class="form-control" >
                        </div>
                        <div class="col">
                          <label>Paymet Type<span class="red-star"> </span></label>
                          <select name="ptype" id="ptype" class="form-control" required>
                          <option selected><?php echo $row['pay_type'] ?></option>
                          <option>Cash</option>
                          <option>Cheqe</option>
                          </select>
                        </div>
                        <div class="col">
                          <label>Date<span class="red-star"> </span></label>
                          <input type="date" id="pdate" name="pdate" min="1970-01-01" max="2030-01-01" value="<?php echo $row['pay_date'] ?>" class="form-control" required>
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
                     <button type="submit" name="editpay" class="btn btn-info">Edit Data</button>
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
