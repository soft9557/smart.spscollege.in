<?php
include('config.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/functions.php');
checkUser();
userArea();

//adminArea();
//deniedArea();

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

 <!-- Content Header (Page header) -->
 <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                <h5 style="color:blue" class="m-0">Course Updation </h5> 
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Course Updation</li>
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
               <h3 class="card-title">Edit Course data </h3>
                <a href="manage_course.php" class="btn btn-primary float-right" >Back </a>
             </div>
                 <!-- /.card-header -->
            <div class="card-body">

            <form action="addcourse.php" method="POST" enctype="multipart/form-data">
                   <div class="modal-body">
                   <?php
                      if (isset($_GET['sid']))
                      {
                      $sid = $_GET['sid'];
                      $query = " SELECT * FROM class_data WHERE id='$sid' LIMIT 1";
                      $query_run = mysqli_query($con,$query);
                      if(mysqli_num_rows($query_run) > 0)
                      {
                        foreach($query_run as $row)
                       {
                      ?>

                        <div class="row"> 
                            <div class="col">
                              <label>Course Code<span class="red-star"> </span></label>
                              <input type="text" id="ccode" name="ccode" value="<?php echo $row['class_id'] ?>" class="form-control" readonly>
                        </div>
                        <input type="hidden" id="sid" name="sid" value="<?php echo $row['id'] ?>" class="form-control" placeholder="" readonly>
                        <div class="col">
                             <label>Course Name<span class="red-star"> </span></label>
                               <input type="text" id="cname" name="cname" value="<?php echo $row['class_name'] ?>" class="form-control" recuired>
                        </div>
                        </div> 
                    <div class="row">
                        <div class="col">
                          <label>Course Fee(Old Student)<span class="red-star"> </span></label>
                          <input type="text" id="cfeeol" name="cfeeol" value="<?php echo $row['class_fee'] ?>" class="form-control" recuired>
                        </div>
                      <div class="col">
                          <label>Course Fee(New Student)<span class="red-star"> </span></label>
                          <input type="text" id="cfeenw" name="cfeenw" value="<?php echo $row['new_fee'] ?>" class="form-control" recuired>
                           
                        </div>
                        <div class="col">
                          <label>Course Fee Type<span class="red-star"> </span></label>
                          <select name="cftype" id="cftype" class="form-control" required>
                          <option selected><?php echo $row['class_fee_type'] ?></option>
                          <option>Monthly</option>
                          <option>Quartly </option>
                          <option>Semester </option>
                          <option>Annual </option>
                          <option>2-Year </option>
                          </select>
                        </div> 
                        
                  </div>
                  <div class="col">
                          <label>Course Subjects<span class="red-star"> </span></label>
                          <input type="text" id="subject" name="subject" value="<?php echo $row['subject'] ?>" class="form-control" recuired>
                           
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
                     <button type="submit" name="editclass" class="btn btn-info">Edit Data</button>
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
