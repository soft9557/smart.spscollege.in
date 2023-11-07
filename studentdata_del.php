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

<?php
    $sql1="select * from institute";
    $result1=mysqli_query($con, $sql1);
    while($rows1 = mysqli_fetch_array($result1)){
    $sess = $rows1['sese'];
   
    }
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
                <div class="modal-dialog  modal-xl">
                  <div class="modal-content">
                        <div class="modal-header">
                          <h5 style="" class="modal-title" id="exampleModalLabel">Student Admission</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                        </div>
                    <form action="addstudent.php" method="POST" enctype="multipart/form-data">
                   <div class="modal-body">

                   <div class="row"> 
                        
                     <div class="col">
                          <label>Session<span class="red-star">*</span></label>
                           <input type="text" id="ses" name="ses" value="<?php echo $sess?>" class="form-control" required>
                        </div>
                   
                      <div class="col">
                            <label>Course Code<span class="red-star">*</span></label>
                            <select name="cors" id="cors"  value="<?php echo $class_id?>" class="form-control" onchange="fetchco()" required>
                            <option  value=""> Select course/Trade </option>
                            <?php
                                while($rows = mysqli_fetch_array($result)){
                                    $c = $rows['class_id'];
                                    echo'<option value ="'.$c.'">'.$c.'</option>';
                                }
                            ?>
                            </select>
                        </div>

                        <div class="col">
                          <label>Course Name<span class="red-star"></span></label>
                           <input type="text" id="coname" name="coname" class="form-control" readonly>
                        </div>
                        
                        
                        <input type="hidden" id="ssid" name="ssid" value="<?php echo $row['id'] ?>" class="form-control" placeholder="" readonly>
                       
                        
                        
                        
                        <div class="col">
                            <label>Student Photo(Less Than 100KB-.jpeg)</label>
                            <!-- Preview-->
                            <div id="preview"></div>
                            <input type="file" name="image" id="image" value="" accept=".jpg" id="image" style="float:left" onchange="getImagePreview(event)">
                         </div>

                         <div class="col">
                            <label>Student Sign(Less Than 100KB-.jpeg)</label>
                            <!-- Preview-->
                            <div id="preview2"></div>
                            <input type="file" name="image2" id="image2" value="" accept=".jpg" id="image2" style="float:left" onchange="getImagePreview2(event)">
                         </div>
                        </div>
                        <div class="row"> 
                       <div class="col">
                          <label>Course Fees<span class="red-star"> </span></label>
                          <input type="number" id="cofee" name="cofee" class="form-control">
                        </div>
                        <div class="col">
                          <label>Subject<span class="red-star"></span></label>
                           <input type="text" id="sub" name="sub" size="50" >
                        </div>

                        <div class="col">
                        <label>Admiss.Time Fee<span class="red-star"> </span></label>
                          <input type="number" id="adt_fee" name="adt_fee" class="form-control" placeholder="Enter Admision Time Fee">
                        </div>
                       
                        <div class="col">
                          <label>Paymet Type<span class="red-star"> </span></label>
                          <select name="ptype" id="ptype" class="form-control">
                          <option value=""selected>Select Pay Type</option>
                          <option value="Cash">Cash</option>
                          <option value="On-Line">On-Line</option>
                          </select>
                        </div>
                        <div class="col">
                          <label>Date<span class="red-star"> </span></label>
                          <input type="date" id="fdate" name="fdate" placeholder="dd/mm/yyyy" class="form-control">
                        </div>

                        <div class="col">
                          <label>Admission By<span class="red-star"> </span></label>
                          <input type="text" id="ismfee" name="ismfee" class="form-control" placeholder="Admission By ">
                        </div>
                
                        </div>
                   <div class="row"> 
                        <div class="col">
                          <label>Registration No.<span class="red-star">*</span></label>
                          <input type="text" id="admn" name="admn" class="form-control" required>
                        </div>
                        
                        <div class="col">
                          <label>Reg.Date<span class="red-star">*</span></label>
                          <input type="date" id="admdate" name="admdate" min="1970-01-01" max="2030-01-01" class="form-control" required>
                        </div>

                        <div class="col">
                          <label>Student Aadhar No<span class="red-star"> </span></label>
                          <input type="text" id="stadh" name="stadh" class="form-control" >
                        </div>

                        <div class="col">
                          <label>Scholarshio Reg. No.<span class="red-star"> </span></label>
                          <input type="text" id="scrgn" name="scrgn" class="form-control" >
                        </div>
                                          
                        

              </div>
              <div class="row"> 
                        <div class="col">
                          <label>Student Name<span class="red-star">* </span></label>
                          <input type="text" id="stname" name="stname" class="form-control" required>
                        </div>
                        <div class="col">
                          <label>Father Name<span class="red-star"> </span></label>
                          <input type="text" id="stfath" name="stfath" class="form-control" >
                        </div>
                   
                        <div class="col">
                          <label>Father Ocupation<span class="red-star"> </span></label>
                          <input type="text" id="fathocc" name="fathocc" class="form-control" >
                        </div>

                        <div class="col">
                          <label>Mother Name<span class="red-star"> </span></label>
                          <input type="text" id="stmoth" name="stmoth" class="form-control" >
                        </div>
                        
              </div>
              <div class="row"> 
              <div class="col">
                          <label>Complete Address : <span class="red-star"> </span></label>
                          <input type="text" id="addr1" name="addr1" class="form-control" >
                        </div>
                   
                        <div class="col">
                          <label>City<span class="red-star"> </span></label>
                          <input type="text" id="addr2" name="addr2" class="form-control" >
                        </div>


                        <div class="col">
                          <label>Pincode<span class="red-star"> </span></label>
                          <input type="text" id="addr3" name="addr3" class="form-control" >
                        </div>

                        <div class="col">
                          <label>State<span class="red-star"> </span></label>
                          <input type="text" id="addr4" name="addr4" class="form-control" >
                        </div>
                                              
              </div>
              <div class="row">
              <div class="col">
                          <label>Gender<span class="red-star">*</span></label>
                          <select name="stsex" id="stsex" class="form-control" required>
                          <option value="" selected>Select Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="Transgender ">Transgender </option>
                          </select>
                        </div>
                        <div class="col">
                          <label>Date of Birth<span class="red-star"> </span></label>
                          <input type="date" id="stdob" name="stdob" min="1970-01-01" max="2030-01-01" class="form-control">
                        </div>
                        
                        
                   
                        <div class="col">
                          <label>Religion<span class="red-star"> </span></label>
                          <select name="strel" id="strel" class="form-control">
                          <option value="" selected>Select Religion</option>
                                <option value="Hindu">Hindu</option>
                                <option value="">Muslim</option>
                                <option value="Muslim">Sikhism</option>
                                <option value="Christianity">Christianity</option>
                                <option value="Buddhism">Buddhism</option>
                                <option value="Jainism">Jainism</option>
                                <option value="Islam">Islam</option>
                                <option value="Judaism">Judaism</option>
                                <option value="Secular">Secular</option>
                                <option value="Other">Other</option>
                          </select>
                        </div>

                        <div class="col">
                          <label>Caste<span class="red-star"> </span></label>
                          <select name="stcaste" id="stcaste" class="form-control">
                          <option value="" selected>Select Caste</option>
                                <option value="Brahmin">Brahmin</option>
                                <option value="Thakur">Thakur</option>
                                <option value="Jaat">Jaat</option>
                                <option value="Jatav">Jatav</option>
                                <option value="Lodhi Rajput">Lodhi Rajput</option>
                                <option value="Gadariya">Gadariya</option>
                                <option value="Vaishy">Vaishy</option>
                                <option value="Baniya">Baniya</option>
                                <option value="Dhobi">Dhobi</option>
                                <option value="Lodhi">Lodhi</option>
                                <option value="Goswami">Goswami</option>
                                <option value="Saraswat">Saraswat</option>
                                <option value="Baghel">Baghel</option>
                                <option value="Prajapati">Prajapati </option>
                                <option value="Kushwaha">Kushwaha</option>
                                <option value="Balmik">Balmik</option>
                                <option value="Kayasth">Kayasth</option>
                                <option value="Khatik">Khatik</option>
                                <option value="Dhimar">Dhimar</option>
                                <option value="Aheer">Aheer</option>
                                <option value="Mali">Mali</option>
                                <option value="Sunar">Sunar </option>
                                <option value="Kashyap">Kashyap</option>
                                <option value="Nai">Nai</option>
                                <option value="Savita">Savita</option>
                                <option value="Kadhere">Kadhere</option>
                                <option value="Teli">Teli</option>
                                <option value="Other">Other</option>
                                
                          </select>
                        </div>
                        <div class="col">
                          <label>Category<span class="red-star"> </span></label>
                          <select name="stcat" id="stcat" class="form-control">
                          <option value="" selected>Select Category</option>
                          <option value="Gen">Gen</option>
                          <option value="OBC">OBC</option>
                          <option value="SC">SC</option>
                          <option value="ST">ST</option>
                          <option value="MINORITY">MINORITY</option>
                          </select>
                        </div>
               </div>
               <div class="row">
                
                        <div class="col">
                          <label>Yearly Income<span class="red-star"> </span></label>
                          <input type="text" id="yinc" name="yinc" class="form-control" >
                        </div>
                        
                        <div class="col">
                          <label>Mobile N0<span class="red-star"> </span></label>
                          <input type="text" id="mob1" name="mob1" class="form-control">
                        </div>
 
                        <div class="col">
                          <label>WhatsApp N0<span class="red-star"> </span></label>
                          <input type="text" id="mob2" name="mob2" class="form-control" >
                        </div>
                   
                        <div class="col">
                          <label>Email Id<span class="red-star"> </span></label>
                          <input type="email" id="emailid" name="emailid" class="form-control" >
                        </div>


                        
                  </div>


                  <div class="row"> 
                        
                  <div class="col">
                          <label>Examination<span class="red-star"> </span></label>
                          <select name="exam1" id="exam1" class="form-control">
                          <option value=""selected>Select Exam</option>
                          <option value="High School">High School</option>
                          <option value="Intermediate">Intermediate</option>
                          <option value="Any Other Exam">Any Other Exam</option>
                          </select>
                        </div>
 
                        <div class="col">
                          <label>Board<span class="red-star"> </span></label>
                          <input type="text" id="board1" name="board1" class="form-control" placeholder="">
                        </div>
                   
                        <div class="col">
                          <label>Year<span class="red-star"> </span></label>
                          <input type="text" id="year1" name="year1" class="form-control" placeholder="">
                        </div>


                        <div class="col">
                          <label>To.Marks/Ob.Marks<span class="red-star"> </span></label>
                          <input type="text" id="marks1" name="marks1" class="form-control" placeholder="">
                        </div>

                        <div class="col">
                          <label>Subject<span class="red-star"> </span></label>
                          <input type="text" id="sub1" name="sub1" class="form-control" placeholder="">
                        </div>

                  </div>
                  <div class="row"> 
                        
                  <div class="col">
                          
                          <select name="exam2" id="exam2" class="form-control">
                          <option value=""selected>Select Exam</option>
                          <option value="High School">High School</option>
                          <option value="Intermediate">Intermediate</option>
                          <option value="Any Other Exam">Any Other Exam</option>
                          </select>
                        </div>
 
                        <div class="col">
                          
                          <input type="text" id="board2" name="board2" class="form-control" placeholder="">
                        </div>
                   
                        <div class="col">
                          
                          <input type="text" id="year2" name="year2" class="form-control" placeholder="">
                        </div>


                        <div class="col">
                          
                          <input type="text" id="marks2" name="marks2" class="form-control" placeholder="">
                        </div>

                        <div class="col">
                          
                          <input type="text" id="sub2" name="sub2" class="form-control" placeholder="">
                        </div>

                  </div>
                  <div class="row"> 
                        
                  <div class="col">
                          
                          <select name="exam3" id="exam3" class="form-control">
                          <option value=""selected>Select Exam</option>
                          <option value="High School">High School</option>
                          <option value="Intermediate">Intermediate</option>
                          <option value="Any Other Exam">Any Other Exam</option>
                          </select>
                        </div>
 
                        <div class="col">
                          
                          <input type="text" id="board3" name="board3" class="form-control" placeholder="">
                        </div>
                   
                        <div class="col">
                          
                          <input type="text" id="year3" name="year3" class="form-control" placeholder="">
                        </div>


                        <div class="col">

                          <input type="text" id="marks3" name="marks3" class="form-control" placeholder="">
                        </div>

                        <div class="col">
                           <input type="text" id="sub3" name="sub3" class="form-control" placeholder="">
                        </div>

                  </div>
               

                        
                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="addstu" class="btn btn-primary">Save</button>
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
      <div class="modal fade" id="viewStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student Profile</h5>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Student</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   </div>
                  <form action="addstudent.php" method="POST">
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
                <h5 style="color:blue" class="m-0">Student Registration</h5> 
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Registration</li>
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
                <h3 class="card-title">Student data Table</h3>
                 <a href="#" data-toggle="modal" data-target="#addStudent" class="btn btn-primary float-right" >Add Student </a>
               </div>
                 <!-- /.card-header -->
               <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                              <th>AdmsId</th>
                              <th>RegisId</th>
                              <th>StName</th>
                              <th>Course</th>
                              <th>Father</th>
                              <th>Mobile</th>
                              <th>Fee</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                    <tbody>


                    <?php
                                $get_data = "SELECT * FROM student_data";
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
                                <td><?php echo $row['st_adm_no']; ?></td>
                                <td><?php echo $row['st_name']; ?></td>
                                <td><?php echo $row['cl_cd']; ?></td>
                                <td><?php echo $row['st_fath']; ?></td>
                                <td><?php echo $row['mob1']; ?></td>
                                <td><?php echo $row['st_fee']; ?></td>
                               
                                <td> 
                                
                                <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-info btn-sm viewbtn">View</button>
                                <a href ="editstudent.php?sid=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-info btn-sm">Edit</a>
                                <a href="javascript:void(0)" onclick="delete_confir('<?php echo $row['id'];?>','addstudent.php')"class="btn btn-danger btn-sm">Delete</a>
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
                    function getImagePreview(event)
                    {
                      var image=URL.createObjectURL(event.target.files[0]);
                      var imagediv= document.getElementById('preview');
                      var newimg=document.createElement('img');
                      imagediv.innerHTML='';
                      newimg.src=image;
                      newimg.width="100";
                      imagediv.appendChild(newimg);
                    }
                  </script>

                <script>
                    function getImagePreview2(event)
                    {
                      var image2=URL.createObjectURL(event.target.files[0]);
                      var imagediv= document.getElementById('preview2');
                      var newimg=document.createElement('img');
                      imagediv.innerHTML='';
                      newimg.src=image2;
                      newimg.width="100";
                      imagediv.appendChild(newimg);
                    }
                  </script>


    <script>

       


     $(document).ready(function () {
      $('.deletebtn').click(function (e) { 
        e.preventDefault();
        var stu_id = $(this).val();
        //console.log(stu_id);
         $('.delet_stu_id').val(stu_id);
         
        $('#DeletSt').modal('show');
        getRow(stu_id);
      });



     // $(document).on('click','.delete',function(e){
     //   e.preventDefault();
     //   $('#delete').modal('show');
     //   var id = $(this).data('id');
     //   getRow(id);




      
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
