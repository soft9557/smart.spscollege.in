<?php
include('config.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/functions.php');
checkUser();
adminArea();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

 <!-- Content Header (Page header) -->
 <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                <h5 style="color:blue" class="m-0">Login User Updation </h5> 
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Login User Updation</li>
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
               <h3 class="card-title">Edit User data </h3>
                <a href="manage_users.php" class="btn btn-primary float-right" >Back </a>
             </div>
                 <!-- /.card-header -->
            <div class="card-body">

            <form action="addusers.php" method="POST" enctype="multipart/form-data">
                   <div class="modal-body">
                   <?php
                      if (isset($_GET['sid']))
                      {
                      $sid = $_GET['sid'];
                      $query = " SELECT * FROM users WHERE id='$sid' LIMIT 1";
                      $query_run = mysqli_query($con,$query);
                      if(mysqli_num_rows($query_run) > 0)
                      {
                        foreach($query_run as $row)
                       {
                      ?>

                          <div class="row"> 
                            <div class="col">
                              <label>Username<span class="red-star"> </span></label>
                              <input type="text" id="uname" name="uname" value="<?php echo $row['username'] ?>" class="form-control" recuired>
                            </div>
                                <input type="hidden" id="sid" name="sid" value="<?php echo $row['id'] ?>" class="form-control" placeholder="" readonly>
                            <div class="col">
                             <label>Password<span class="red-star"> </span></label>
                              <input type="text" id="upass" name="upass" value="<?php echo $row['password'] ?>" class="form-control" recuired>
                             </div>

                             <div class="col">
                             <label>Role<span class="red-star"> </span></label>
                              <select name="urole" id="urole" class="form-control" required>
                              <option selected><?php echo $row['role'] ?></option>
                              <option value="Admin">Admin</option>
                              <option value="User">User </option>
                              <option value="Manager">Manager </option>
                              <option value="Super">Super </option>
                              </select>
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
                     <button type="submit" name="editusers" class="btn btn-info">Edit Data</button>
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
