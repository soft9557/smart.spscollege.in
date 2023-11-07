<?php
include('config.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/functions.php');
checkUser();
userArea();
?>
<?php
    $sql="select * from class_data";
    $result=mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<!--=== Coding by SoftLabTech | www.softlabtech.com === -->
<html lang="en">
<head>
</head>
<body>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Student Add Modal -->
              <div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-lg">
                  <div class="modal-content">
                          <div class="modal-header">
                          <h5 style="" class="modal-title" id="exampleModalLabel">Course Addition</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                    <form action="addcourse.php" method="POST" enctype="multipart/form-data">
                     <div class="modal-body">


                       <div class="row"> 
                        <div class="col">
                          <label>Course Code<span class="red-star">*</span></label>
                          <input type="text" id="ccode" name="ccode" class="form-control" required>
                        </div>
                        <div class="col">
                          <label>Course Name<span class="red-star">*</span></label>
                          <input type="text" id="cname" name="cname" class="form-control" required>
                        </div>
                        </div> 
                    <div class="row">
                        <div class="col">
                          <label>Course Fee(Old Student)<span class="red-star">*</span></label>
                          <input type="text" id="cfeeol" name="cfeeol" class="form-control" required>
                        </div>
                      <div class="col">
                          <label>Course Fee(New Student)<span class="red-star">* </span></label>
                          <input type="text" id="cfeenw" name="cfeenw" class="form-control" required>
                           
                        </div> 
                        <div class="col">
                          <label>Course Fee Type<span class="red-star">*</span></label>
                          <select name="cftype" id="cftype" class="form-control" required>
                          <option value="" selected>Select Fee Type</option>
                          <option value="Monthly">Monthly</option>
                          <option value="Quartly">Quartly </option>
                          <option value="Semester">Semester </option>
                          <option value="Annual">Annual </option>
                          <option value="2-Year">2-Year </option>
                          </select>
                  </div>  
                  </div>
                  <div class="col">
                          <label>Course Subjects<span class="red-star">* </span></label>
                          <input type="text" id="subject" name="subject" class="form-control">
                           
                        </div>   
                  
                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="corsubmit" class="btn btn-primary">Submit</button>
                </div>
          </div>  
            </form>
          </div>
        </div>
      </div>
      <!----End modal--------->
     
      <!-- Student Edit Modal -->
     
      <!----End modal--------->


      <!------View modal---->
      
  <!----End modal--------->

      <!------DELETE modal---->
      <div class="modal fade" id="DeletSt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Course</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   </div>
                  <form action="addcourse.php" method="POST">
                    <div class="modal-body">
                   
                    <input type="hidden" name="delete_cid" class="delet_co_id" >
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
                <h5 style="color:blue" class="m-0">Course Add</h5> 
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Course Add</li>
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
                <h3 class="card-title">Course Table</h3>
                 <a href="#" data-toggle="modal" data-target="#addStudent" class="btn btn-primary float-right" >Add Course</a>
               </div>
                 <!-- /.card-header -->
               <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                              <th>ID</th>
                              <th>CourseId</th>
                              <th>CourseName</th>
                              <th>Subject</th>
                              <th>Co.Fee</th>
                              <th>Fee Type</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                    <tbody>


                    <?php
                                $get_data = "SELECT * FROM class_data ORDER BY class_name ASC";
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
                                <td><?php echo $row['class_id']; ?></td>
                                <td><?php echo $row['class_name']; ?></td>
                                <td><?php echo $row['subject']; ?></td>
                                <td><?php echo $row['class_fee']; ?></td>
                                <td><?php echo $row['class_fee_type']; ?></td>
                                
                               
                                <td>    
                                <a href ="editclass.php?sid=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>   
                                <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deletebtn">Delete</button>                      
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
         $('.delet_co_id').val(stu_id);
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
