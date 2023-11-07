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

    <script src="school.js"></script>
    <script src="jq.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

 <!-- Content Header (Page header) -->
 <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                <h5 style="color:blue" class="m-0">Student Updation</h5> 
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Update Student</li>
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
               <h3 class="card-title">Edit Student data </h3>
                <a href="updatestudent.php" class="btn btn-primary float-right" >Back </a>
             </div>
                 <!-- /.card-header -->
            <div class="card-body">

                  <form action="addstudent.php" method="POST" enctype="multipart/form-data">
                   <div class="modal-body">
                   <?php
                      if (isset($_GET['sid']))
                      {
                      $sid = $_GET['sid'];
                      $query = " SELECT * FROM student_data WHERE id='$sid' LIMIT 1";
                      $query_run = mysqli_query($con,$query);
                      if(mysqli_num_rows($query_run) > 0)
                      {
                        foreach($query_run as $row)
                       {
                      ?>
                    <div class="row"> 

                       <div class="col">
                          <label>Session<span class="red-star">*</span></label>
                           <input type="text" id="ses" value="<?php echo $row['ses'] ?>" name="ses" class="form-control" required>
                        </div>

                        <input type="hidden" id="sid" name="sid" value="<?php echo $row['id'] ?>" class="form-control" placeholder="" readonly>
                      
                          <div class="col">
                            <label>Course Code<span class="red-star">*</span></label>
                            <select name="cors" id="cors" value="<?php echo $class_id?>" class="form-control" onchange="fetchco()" required>
                            <option selected><?php echo $row['cl_cd'] ?></option>
                            <option value=""> Select course/Trade </option>
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
                           <input type="text" id="coname" value="<?php echo $row['cl_name'] ?>" name="coname" class="form-control" readonly>
                        </div>
                        
                        <div class="col">
                            <label>Student Photo(100KB-.jpeg/png)</label>
                            <!-- Preview-->
                            <div id="preview"></div>
                            <img src = '<?php echo $row['st_ph_id'] ?>' style='width:50px; height:50px'>
                            <input type="file" name="image" id="image" value="" accept=".jpg" id="image" style="float:left" onchange="getImagePreview(event)">

                         </div>

                         <div class="col">
                            <label>Student Sign(100KB-.jpeg/png)</label>
                            <!-- Preview-->
                            <div id="preview2"></div>
                            <img src = '<?php echo $row['gr_ph_id'] ?>' style='width:50px; height:50px'>
                            <input type="file" name="image2" id="image2" value="" accept=".jpg" id="image2" style="float:left" onchange="getImagePreview2(event)">
                         </div>         
                        </div>
                        <div class="row"> 
                       <div class="col">
                          <label>Course Fees<span class="red-star"> </span></label>
                          <input type="number" id="cofee" name="cofee" value="<?php echo $row['st_fee'] ?>" class="form-control" placeholder="Enter Course Fee">
                        </div>
                        <div class="col">
                          <label>Subject<span class="red-star"></span></label>
                           <input type="text" id="sub" name="sub" value="<?php echo $row['subject'] ?>" size="35"  >
                        </div>

                        <div class="col">
                        <label>Admiss.Time Fee<span class="red-star"> </span></label>
                          <input type="number" id="adt_fee" name="adt_fee" value="<?php echo $row['add_time_fee'] ?>" class="form-control" placeholder="Enter Admision Time Fee">
                        </div>
                                               
                        <div class="col">
                          <label>Paymet Type<span class="red-star"> </span></label>
                          <select name="ptype" id="ptype" class="form-control">
                          <option selected><?php echo $row['pay_type'] ?></option>
                          <option>Select Pay Type</option>
                          <option>Cash</option>
                          <option>On-Line</option>
                          </select>
                        </div>
                        <div class="col">
                          <label>Date<span class="red-star"> </span></label>
                          <input type="date" id="fdate" name="fdate" value="<?php echo $row['fee_date'] ?>" placeholder="dd/mm/yyyy" class="form-control">
                        </div>

                        <div class="col">
                          <label>Admission By<span class="red-star"> </span></label>
                          <input type="text" id="ismfee" name="ismfee" value="<?php echo $row['install_fee'] ?>" class="form-control" placeholder="">
                        </div>
                
                  </div>
                   <div class="row"> 
                        <div class="col">
                          <label>Registration No.<span class="red-star">*</span></label>
                          <input type="text" id="admn" name="admn" value="<?php echo $row['st_adm_no'] ?>" class="form-control" placeholder="Enter Registration No." required>
                        </div>
                        
                        <div class="col">
                          <label>Reg.Date<span class="red-star">*</span></label>
                          <input type="date" id="admdate" name="admdate" value="<?php echo $row['adm_date'] ?>" min="1970-01-01" max="2030-01-01" class="form-control" required>
                        </div>

                        <div class="col">
                          <label>Student Aadhar No<span class="red-star"> </span></label>
                          <input type="text" id="stadh" name="stadh" value="<?php echo $row['st_adh'] ?>" class="form-control" >
                        </div>

                        <div class="col">
                          <label>Scholarshio Reg. No.<span class="red-star"> </span></label>
                          <input type="text" id="scrgn" name="scrgn" value="<?php echo $row['reg_no'] ?>" class="form-control" >
                        </div>
                                        
                        

              </div>
              <div class="row"> 
                        <div class="col">
                          <label>Student Name<span class="red-star">*</span></label>
                          <input type="text" id="stname" name="stname" value="<?php echo $row['st_name'] ?>" class="form-control"  required>
                        </div>
                        <div class="col">
                          <label>Father Name<span class="red-star"> </span></label>
                          <input type="text" id="stfath" name="stfath" value="<?php echo $row['st_fath'] ?>" class="form-control">
                        </div>
                   
                        <div class="col">
                          <label>Father Ocupation<span class="red-star"> </span></label>
                          <input type="text" id="fathocc" name="fathocc" value="<?php echo $row['fath_occ'] ?>" class="form-control" >
                        </div>

                        <div class="col">
                          <label>Mother Name<span class="red-star"> </span></label>
                          <input type="text" id="stmoth" name="stmoth" value="<?php echo $row['st_moth'] ?>" class="form-control" >
                        </div>
                        
              </div>
              <div class="row"> 
              <div class="col">
                          <label>Complete Address : <span class="red-star"> </span></label>
                          <input type="text" id="addr1" name="addr1" value="<?php echo $row['addr1'] ?>" class="form-control" >
                        </div>
                   
                        <div class="col">
                          <label>City<span class="red-star"> </span></label>
                          <input type="text" id="addr2" name="addr2" value="<?php echo $row['addr2'] ?>" class="form-control" >
                        </div>


                        <div class="col">
                          <label>Pincode<span class="red-star"> </span></label>
                          <input type="text" id="addr3" name="addr3" value="<?php echo $row['addr3'] ?>" class="form-control" >
                        </div>

                        <div class="col">
                          <label>State<span class="red-star"> </span></label>
                          <input type="text" id="addr4" name="addr4" value="<?php echo $row['addr4'] ?>" class="form-control" >
                        </div>
                                              
              </div>
              <div class="row">
              <div class="col">
                          <label>Gender<span class="red-star">*</span></label>
                          <select name="stsex" id="stsex" class="form-control">
                          <option selected><?php echo $row['st_sex'] ?></option>
                          <option>Male</option>
                          <option>Female</option>
                          <option>Transgender</option> 
                          </select>
                        </div>
                        <div class="col">
                          <label>Date of Birth<span class="red-star"> </span></label>
                          <input type="date" id="stdob" name="stdob" value="<?php echo $row['st_dob'] ?>" min="1970-01-01" max="2030-01-01" class="form-control">
                        </div>
                        
                        
                   
                        <div class="col">
                          <label>Religion<span class="red-star"> </span></label>
                          <select name="strel" id="strel" class="form-control">
                          <option selected><?php echo $row['st_rel'] ?></option>
                                <option>Hindu</option>
                                <option>Muslim</option>
                                <option>Sikhism</option>
                                <option>Christianity</option>
                                <option>Buddhism</option>
                                <option>Jainism</option>
                                <option>Islam</option>
                                <option>Judaism</option>
                                <option>Secular</option>
                                <option>Other</option>
                          </select>
                        </div>

                        <div class="col">
                          <label>Caste<span class="red-star"> </span></label>
                          <select name="stcaste" id="stcaste" class="form-control">
                          <option selected><?php echo $row['st_caste'] ?></option>
                                <option>Brahmin</option>
                                <option>Thakur</option>
                                <option>Jaat</option>
                                <option>Baniya</option>
                                <option>Dhobi</option>
                                <option>Lodhi</option>
                                <option>Baghel</option>
                                <option>Prajapati </option>
                                <option>Kushwaha</option>
                                <option>Balmik</option>
                                <option>Kayasth</option>
                                <option>Khatik</option>
                                <option>Dhimar</option>
                                <option>Aheer</option>
                                <option>Mali</option>
                                <option>Sunar </option>
                                <option>Kashyap</option>
                                <option>Nai</option>
                                <option>Savita</option>
                                <option>Kadhere</option>
                                <option>Teli</option>
                                <option>Other</option>
                                
                                
                          </select>
                        </div>
                        <div class="col">
                          <label>Category<span class="red-star"> </span></label>
                          <select name="stcat" id="stcat" class="form-control">
                          <option selected><?php echo $row['st_cat'] ?></option>
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
                          <label>Yearly Income<span class="red-star"> </span></label>
                          <input type="text" id="yinc" name="yinc" value="<?php echo $row['yearly_inc'] ?>" class="form-control" placeholder="">
                        </div>
                        
                        <div class="col">
                          <label>Mobile N0<span class="red-star"> </span></label>
                          <input type="text" id="mob1" name="mob1" value="<?php echo $row['mob1'] ?>" class="form-control" placeholder="">
                        </div>
 
                        <div class="col">
                          <label>WhatsApp N0<span class="red-star"> </span></label>
                          <input type="text" id="mob2" name="mob2" value="<?php echo $row['mob2'] ?>" class="form-control" placeholder="">
                        </div>
                   
                        <div class="col">
                          <label>Email Id<span class="red-star"> </span></label>
                          <input type="email" id="emailid" name="emailid" value="<?php echo $row['email'] ?>" class="form-control" placeholder="">
                        </div>


                        
                  </div>


                  <div class="row"> 
                        
                  <div class="col">
                          <label>Examination<span class="red-star"> </span></label>
                          <select name="exam1" id="exam1" class="form-control">
                          <option selected><?php echo $row['exam1'] ?></option>
                          <option>High School</option>
                          <option>Intermediate</option>
                          <option>Any Other Exam</option>
                          </select>
                        </div>
 
                        <div class="col">
                          <label>Board<span class="red-star"> </span></label>
                          <input type="text" id="board1" name="board1" value="<?php echo $row['board1'] ?>" class="form-control" placeholder="">
                        </div>
                   
                        <div class="col">
                          <label>Year<span class="red-star"> </span></label>
                          <input type="text" id="year1" name="year1" value="<?php echo $row['year1'] ?>" class="form-control" placeholder="">
                        </div>


                        <div class="col">
                          <label>To.Marks/Ob.Marks<span class="red-star"> </span></label>
                          <input type="text" id="marks1" name="marks1" value="<?php echo $row['marks1'] ?>" class="form-control" placeholder="">
                        </div>

                        <div class="col">
                          <label>Subject<span class="red-star"> </span></label>
                          <input type="text" id="sub1" name="sub1" value="<?php echo $row['sub1'] ?>" class="form-control" placeholder="">
                        </div>

                  </div>
                  <div class="row"> 
                        
                         <div class="col">
                          <select name="exam2" id="exam2" class="form-control">
                          <option selected><?php echo $row['exam2'] ?></option>
                          <option>High School</option>
                          <option>Intermediate</option>
                          <option>Any Other Exam</option>
                          </select>
                        </div>
 
                        <div class="col">
                          
                          <input type="text" id="board2" name="board2" value="<?php echo $row['board2'] ?>" class="form-control" placeholder="">
                        </div>
                   
                        <div class="col">
                          
                          <input type="text" id="year2" name="year2" value="<?php echo $row['year2'] ?>" class="form-control" placeholder="">
                        </div>


                        <div class="col">
                          
                          <input type="text" id="marks2" name="marks2" value="<?php echo $row['marks2'] ?>" class="form-control" placeholder="">
                        </div>

                        <div class="col">
                          
                          <input type="text" id="sub2" name="sub2" value="<?php echo $row['sub2'] ?>" class="form-control" placeholder="">
                        </div>

                  </div>
                  <div class="row"> 
                        
                  <div class="col">
                          
                          <select name="exam3" id="exam3" class="form-control">
                          <option selected><?php echo $row['exam3'] ?></option>
                          <option >High School</option>
                          <option>Intermediate</option>
                          <option>Any Other Exam</option>
                          </select>
                        </div>
 
                        <div class="col">
                          
                          <input type="text" id="board3" name="board3" value="<?php echo $row['board3'] ?>" class="form-control" placeholder="">
                        </div>
                   
                        <div class="col">
                          
                          <input type="text" id="year3" name="year3" value="<?php echo $row['year3'] ?>" class="form-control" placeholder="">
                        </div>


                        <div class="col">

                          <input type="text" id="marks3" name="marks3" value="<?php echo $row['marks3'] ?>" class="form-control" placeholder="">
                        </div>

                        <div class="col">
                           <input type="text" id="sub3" name="sub3" value="<?php echo $row['sub3'] ?>" class="form-control" placeholder="">
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
                     <button type="submit" name="editstu" class="btn btn-info">Edit Data</button>
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
