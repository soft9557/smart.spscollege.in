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
    $sql="select * from student_data";
    $result=mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<!--=== Coding by SoftLabTech | www.softlabtech.com === -->
<html lang="en">
<head>
    <script src="school.js"></script>
    <script src="jq.js"></script>

    <script>
        function feetot(){
        var balfee = document.getElementById("balan").value;
        var subfee = document.getElementById("subfee").value;
        var stfee = parseFloat(balfee)-parseFloat(subfee);
        document.getElementById("nextfee").value = stfee; 
         }
    </script>
</head>
<body>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Student Add Modal -->
              <div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-lg">
                  <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Student Fee Collection</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                        </div>
                    <form action="submitfee.php" method="POST" enctype="multipart/form-data">
                   <div class="modal-body">

                <div class="row"> 

                          <div class="col">
                            <label>Student ID</label>
                            <select name="sid" id="sid" value="<?php echo $st_id?>" class="form-control" onchange="fetchst()">
                            <option value=""> Select Student ID </option>
                            <?php
                                while($rows = mysqli_fetch_array($result)){
                                    $c = $rows['id'];
                                    $d = $rows['st_name'];
                                    $e = $c.'-'.$d;
                                    echo'<option value ="'.$c.'">'.$e.'</option>';
                                }
                            ?>
                            </select>
                        </div>
                        <div class="col">
                          <label>Registration No.<span class="red-star">*</span></label>
                          <input type="text" id="regn" name="regn" class="form-control" readonly>
                        </div>
                        <div class="col">
                          <label>Course Code<span class="red-star"> </span></label>
                          <input type="text" id="cors" name="cors" class="form-control" readonly>
                        </div>
                        <div class="col">
                          <label>Course Name<span class="red-star"> </span></label>
                          <input type="text" id="coname" name="coname" class="form-control" readonly>
                        </div>
                        <div class="col">
                          <label>Session<span class="red-star"> </span></label>
                          <input type="text" id="ses" name="ses" class="form-control" readonly>
                        </div>
                 </div>
                 <div class="row"> 
                        <div class="col">
                          <label>Student Name<span class="red-star"> </span></label>
                          <input type="text" id="stname" name="stname" class="form-control" readonly>
                        </div>
                        <div class="col">
                          <label>Father Name<span class="red-star"> </span></label>
                          <input type="text" id="stfath" name="stfath" class="form-control" readonly>
                        </div>
                   
                        <div class="col">
                          <label>Course Fee<span class="red-star"> </span></label>
                          <input type="text" id="stmoth" name="stmoth" class="form-control" readonly>
                        </div>
                  </div>
              
                   <div class="row">
                        <div class="col">
                          <label>Balance Fee<span class="red-star"> </span></label>
                          <input type="text" id="balan" name="balan" class="form-control" readonly>
                        </div>    
                        <div class="col">
                          <label>Mobile N0<span class="red-star"> </span></label>
                          <input type="text" id="mobil" name="mobil" class="form-control" readonly>
                        </div>
                         <div class="col">
                          <label>Address<span class="red-star"> </span></label>
                          <input type="text" id="addrs1" name="addrs1" class="form-control" readonly>
                        </div>
                  </div>

                   <div class="row"> 
                       <div class="col">
                          <label>Submit Fees<span id="words" > </span></label>
                          <input type="number" id="subfee" name="subfee" class="form-control" onchange="feetot();" placeholder="Enter Submit Fee" required>
                        </div>
                        <div class="col">
                          <label>Next Fees<span class="red-star"> </span></label>
                          <input type="number" id="nextfee" name="nextfee" class="form-control" readonly >
                        </div>
                        <div class="col">
                          <label>Fee Head<span class="red-star"> </span></label>
                          <select name="fhead" id="fhead" class="form-control" required>
                          <option>Admission Fee</option>
                          <option>Education Fee</option>
                          <option>Practical Fee</option>
                          <option>ReExam Fee</option>
                          <option>Exam Fee</option>
                          <option selected>Composite Fee</option>
                          <option>Old Balance Fee</option>
                          </select>
                        </div>
                        <div class="col">
                          <label>Paymet Type<span class="red-star"> </span></label>
                          <select name="ptype" id="ptype" class="form-control" required>
                          <option selected>Cash</option>
                          <option>On-Line</option>
                          </select>
                        </div>
                        <div class="col">
                          <label>Date<span class="red-star"> </span></label>
                          <input type="date" id="fdate" name="fdate" min="1970-01-01" max="2030-01-01" class="form-control" required>
                        </div>
               </div>

                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                    <button type="submit" name="feesubmit" onclick="return confirm('Are you sure?')"  class="btn btn-primary">Submit</button>
                </div>
          </div>
            </form>
          </div>
        </div>
      </div>
      <!----End modal--------->
     
      <!-- Student Edit Modal -->
      <div class="modal fade" id="editStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-xl">
                  <div class="modal-content">
                        <div class="modal-header">
                          <h5 style="background-color:powderblue;" class="modal-title" id="exampleModalLabel">Edit Student Data</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                        </div>
                    <form action="addstudent.php" method="POST" enctype="multipart/form-data">
                     <div class="modal-body">
                     <div class="row"> 

                   <?php
                      if (isset($_GET['id']))
                      {
                      $sid = $_GET['id'];
                      $query = " SELECT * FROM student_data WHERE id='$sid' LIMIT 1";
                      $query_run = mysqli_query($con,$query);
                      if(mysqli_num_rows($query_run) > 0)
                      {
                        foreach($query_run as $row)
                       {
                      ?>

                   
                        <div class="col">
                          <label>Admsn No<span class="red-star">*</span></label>
                          <input type="text" id="eadmn" name="admn" value="<?php echo $row['st_adm_no']?>" class="form-control" placeholder="Enter email" >
                        </div>
                        
                        <div class="col">
                          <label>Admsn.Date<span class="red-star">*</span></label>
                          <input type="date" id="eadmdate" name="admdate" value="<?php echo $row['adm_date']?>" placeholder="dd/mm/yyyy" class="form-control">
                        </div>

                        <div class="col">
                          <label>SR Number<span class="red-star"> </span></label>
                          <input type="text" id="esrnum" name="srnum" value="<?php echo $row['reg_no']?>" class="form-control" placeholder="Enter SR">
                        </div>
                                          
                        <div class="col">
                          <label>New Admission</label>
                          <select name="nadm" id="enadm" class="form-control">
                          <option selected>Select Type</option>
                          <option>Yes</option>
                          <option>No</option>
                          </select>
                        </div>

              </div>
              <div class="row"> 
                        <div class="col">
                          <label>Class Code<span class="red-star"> </span></label>
                          <input type="text" id="eclcd" name="clcd" class="form-control" placeholder="Enter SR">
                        </div>
                   
                        <div class="col">
                          <label>Class Name<span class="red-star"> </span></label>
                          <input type="text" id="eclname" name="clname" class="form-control" placeholder="Enter SR">
                        </div>

                        <div class="col">
                          <label>Section<span class="red-star"> </span></label>
                          <input type="text" id="esec" name="sec" class="form-control" placeholder="Enter SR">
                        </div>
                        
                        <div class="col">
                          <label>Class Fees<span class="red-star"> </span></label>
                          <input type="text" id="estfee" name="stfee" class="form-control" placeholder="Enter SR">
                        </div>
              </div>
              <div class="row"> 
                        <div class="col">
                          <label>Roll No.<span class="red-star"> </span></label>
                          <input type="text" id="eroll" name="roll" class="form-control" placeholder="Enter SR">
                        </div>
                   
                        <div class="col">
                          <label>Student Name<span class="red-star"> </span></label>
                          <input type="text" id="estname" name="stname" class="form-control" placeholder="Enter SR">
                        </div>

                        <div class="col">
                          <label>Gender<span class="red-star"> </span></label>
                          <select name="stsex" id="estsex" class="form-control">
                          <option selected>Select Gender</option>
                          <option>Male</option>
                          <option>Female</option>
                          </select>
                        </div>
                        <div class="col">
                          <label>Date of Birth<span class="red-star"> </span></label>
                          <input type="date" id="estdob" name="stdob" placeholder="dd/mm/yyyy" class="form-control">
                        </div>
              </div>
              <div class="row"> 
                        <div class="col">
                          <label>Student Aadhar No<span class="red-star"> </span></label>
                          <input type="text" id="estadh" name="stadh" class="form-control" placeholder="Enter SR">
                        </div>
                   
                        <div class="col">
                          <label>Religion<span class="red-star"> </span></label>
                          <select name="strel" id="estrel" class="form-control">
                          <option selected>Select Gender</option>
                                <option>Hindu</option>
                                <option>Muslim</option>
                                <option>Shikh</option>
                                <option>Christian</option>
                                <option>Buddhism</option>
                                <option>Jain</option>
                          </select>
                        </div>

                        <div class="col">
                          <label>Caste<span class="red-star"> </span></label>
                          <select name="stcaste" id="estcaste" class="form-control">
                          <option selected>Select Caste</option>
                                <option>Brahmin</option>
                                <option>Thakur</option>
                                <option>Jaat</option>
                                <option>Baniya</option>
                                <option>Dhobi</option>
                                <option>Lodhi</option>
                                <option>Baghel</option>
                                
                          </select>
                        </div>
                        <div class="col">
                          <label>Category<span class="red-star"> </span></label>
                          <select name="stcat" id="estcat" class="form-control">
                          <option selected>Select Category</option>
                          <option>Gen</option>
                          <option>OBC</option>
                          <option>SC</option>
                          <option>ST</option>
                          <option>MINORITY</option>
                          </select>
                        </div>
               </div>
               <div class="row"> 
                        <div class="col">
                          <label>Father Name<span class="red-star"> </span></label>
                          <input type="text" id="estfath" name="stfath" class="form-control" placeholder="Enter SR">
                        </div>
                   
                        <div class="col">
                          <label>Father Ocupation<span class="red-star"> </span></label>
                          <input type="text" id="efathocc" name="fathocc" class="form-control" placeholder="Enter SR">
                        </div>

                        <div class="col">
                          <label>Mother Name<span class="red-star"> </span></label>
                          <input type="text" id="estmoth" name="stmoth" class="form-control" placeholder="Enter SR">
                        </div>
                        <div class="col">
                          <label>Mobile N0<span class="red-star"> </span></label>
                          <input type="text" id="emob1" name="mob1" class="form-control" placeholder="Enter SR">
                        </div>
               </div>
               <div class="row"> 
                        <div class="col">
                          <label>WhatsApp N0<span class="red-star"> </span></label>
                          <input type="text" id="emob2" name="mob2" class="form-control" placeholder="Enter SR">
                        </div>
                   
                        <div class="col">
                          <label>Address-1<span class="red-star"> </span></label>
                          <input type="text" id="eaddr1" name="addr1" class="form-control" placeholder="Enter SR">
                        </div>

                        <div class="col">
                          <label>Address-2<span class="red-star"> </span></label>
                          <input type="text" id="eaddr2" name="addr2" class="form-control" placeholder="Enter SR">
                        </div>
                        <div class="col">
                          <label>SR Number<span class="red-star"> </span></label>
                          <input type="text" id="etxtSrNum" name="txtSrNum" class="form-control" placeholder="Enter SR">
                        </div>

                        </div>
               <div class="row"> 
               <br></br>
                        <div class="col">
                            <label>Student Photo(Less Than 100KB-.jpeg)</label>
                            <!-- Preview-->
                            <div id="preview"></div>
                            <input type="file" name="image" id="eimage" value="" accept="image/*" id="image" style="float:left" onchange="getImagePreview(event)">
                         </div>

                         <div class="col">
                            <label>Family Photo(Less Than 100KB-.jpeg)</label>
                            <!-- Preview-->
                            <div id="preview2"></div>
                            <input type="file" name="image2" id="eimage2" value="" accept="image/*" id="image2" style="float:left" onchange="getImagePreview2(event)">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="updatestu" class="btn btn-primary">Update</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Student Fee</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   </div>
                  <form action="submitfee.php" method="POST">
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
                <h5 style="color:blue" class="m-0">Student Fee Collection</h5> 
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Fee Collection</li>
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
                <h3 class="card-title">Student Fee Collection</h3>
                 <a href="#" data-toggle="modal" data-target="#addStudent" class="btn btn-primary float-right" >Fee Collect</a>
               </div>
                 <!-- /.card-header -->
               <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>SlId</th>
                              <th>AdmId</th>
                              <th>RegisId</th>
                              <th>StName</th>
                              <th>Father</th>
                              <th>Course</th>
                              <th>PaidFee</th>
                              <th>FeeHead</th>
                              <th>Date</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                    <tbody>

                    
                    <?php
                                $get_data = "SELECT fee_data.*,date_format(paid_date,'%d-%m-%Y') as date FROM fee_data ORDER BY paid_fee DESC";
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
                                <td><?php echo $row['regno']; ?></td>
                                <td><?php echo $row['st_name']; ?></td>
                                <td><?php echo $row['st_fath']; ?></td>
                                <td><?php echo $row['course']; ?></td>
                                <td><?php echo $row['paid_fee']; ?></td>
                                <td><?php echo $row['fee_head']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td>
                                <a href ="studentfeepdfc.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a>   
                                <a href ="editfee.php?sid=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-info btn-sm">Edit</a>
                                <a href="javascript:void(0)" onclick="delete_confir('<?php echo $row['id'];?>','submitfee.php')"class="btn btn-danger btn-sm">Delete</a>


                                
                                                       
                               
                            
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
