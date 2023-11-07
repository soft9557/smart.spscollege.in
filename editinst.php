<?php
include('config.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/script.php');
include('includes/functions.php');
checkUser();
adminArea();
?>

<?php
    $sql="select * from institute";
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
                <h5 style="color:blue" class="m-0">Edit Institute Registration</h5> 
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Update Institute</li>
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
               <h3 class="card-title">Edit Institute data </h3>
                <a href="institute.php" class="btn btn-primary float-right" >Back </a>
             </div>
                 <!-- /.card-header -->
            <div class="card-body">

            <form action="addinstitute.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                   <?php
                      if (isset($_GET['sid']))
                      {
                      $sid = $_GET['sid'];
                      $query = " SELECT * FROM institute WHERE id='$sid' LIMIT 1";
                      $query_run = mysqli_query($con,$query);
                      if(mysqli_num_rows($query_run) > 0)
                      {
                        foreach($query_run as $row)
                       {
                      ?>
                   <div class="row"> 
                  
                        <div class="col">
                          <label>Session<span class="red-star"></span></label>
                           <input type="text" id="ses" name="ses" value="<?php echo $row['sese'] ?>" class="form-control" placeholder="Enter Session: 2023-24" required>
                        </div>
                   
                        <input type="hidden" id="sid" name="sid" value="<?php echo $row['id'] ?>" class="form-control" placeholder="" readonly>

                        <div class="col">
                          <label>Institute Name<span class="red-star"></span></label>
                           <input type="text" id="insname" name="insname" value="<?php echo $row['inst_name'] ?>" class="form-control" placeholder="Institute Name" required>
                        </div>

                        
                        <div class="col">
                            <label>Institute Logo(100KB-.jpeg)</label>
                            <!-- Preview-->
                            <div id="preview"></div>
                            <input type="file" name="image" id="image" value="" accept="image/*" id="image" style="float:left" onchange="getImagePreview(event)">
                         </div>
                        
                                              
                        </div>
                   <div class="row"> 
                   <div class="col">
                            <label>Institute Code</label>
                            <input type="text" id="inscode" name="inscode" value="<?php echo $row['inst_code'] ?>" class="form-control" placeholder="Institute Code" required>
                        </div>
                        <div class="col">
                          <label>Principal<span class="red-star"> </span></label>
                          <input type="text" id="prin" name="prin" value="<?php echo $row['prin'] ?>" class="form-control" placeholder="Enter Principal Name">
                        </div>
                        <div class="col">
                          <label>Head Clerk<span class="red-star"> </span></label>
                          <input type="text" id="hdcl" name="hdcl" value="<?php echo $row['clr'] ?>" class="form-control" placeholder="Enter Head Clerk Name">
                        </div>
                                           
              </div>
              <div class="row"> 
              <div class="col">
                          <label>Address-1 : <span class="red-star"> </span></label>
                          <input type="text" id="addr1" name="addr1" value="<?php echo $row['addr1'] ?>" class="form-control" placeholder="Enter Institute Addres">
                        </div>
                   
                        <div class="col">
                          <label>Address-1<span class="red-star"> </span></label>
                          <input type="text" id="addr2" name="addr2" value="<?php echo $row['addr2'] ?>" class="form-control" placeholder="Enter Institute Addres">
                        </div>


                        <div class="col">
                          <label>Pincode<span class="red-star"> </span></label>
                          <input type="text" id="addr3" name="addr3" value="<?php echo $row['addr3'] ?>" class="form-control" placeholder="Pincode#">
                        </div>

                        <div class="col">
                          <label>State<span class="red-star"> </span></label>
                          <input type="text" id="addr4" name="addr4" value="<?php echo $row['addr4'] ?>" class="form-control" placeholder="State">
                        </div>
                                              
              </div>
              
               <div class="row">
                       <div class="col">
                          <label>Mobile N0<span class="red-star"> </span></label>
                          <input type="text" id="mob1" name="mob1" value="<?php echo $row['mob1'] ?>" class="form-control" placeholder="Enter Institute Mobile#">
                        </div>
 
                        <div class="col">
                          <label>WhatsApp N0<span class="red-star"> </span></label>
                          <input type="text" id="mob2" name="mob2" value="<?php echo $row['mob2'] ?>" class="form-control" placeholder="Enter Institute Whatsapp#">
                        </div>
                   
                        <div class="col">
                          <label>Email Id<span class="red-star"> </span></label>
                          <input type="email" id="emailid" name="emailid" value="<?php echo $row['ins_email'] ?>" class="form-control" placeholder="Enter Institute EmailID">
                        </div>
                        <div class="col">
                          <label>Website<span class="red-star"> </span></label>
                          <input type="text" id="webs" name="webs" value="<?php echo $row['website'] ?>" class="form-control" placeholder="Enter Institute website">
                        </div>
                       
                  </div>
                  <div class="row">
                         <div class="col">
                            <label>Institute Header(100KB-.jpeg)</label>
                            <!-- Preview-->
                            <div id="preview2"></div>
                            <input type="file" name="image2" id="image2" value="" accept="image/*" id="image2" style="float:left" onchange="getImagePreview2(event)">
                         </div>
                         
                         <div class="col">
                            <label>Institute Footer(100KB-.jpeg)</label>
                            <!-- Preview-->
                            <div id="preview3"></div>
                            <input type="file" name="image3" id="image3" value="" accept="image/*" id="image3" style="float:left" onchange="getImagePreview3(event)">
                         </div>

                         <div class="col">
                            <label>Principal Sign(100KB-.jpeg)</label>
                            <!-- Preview-->
                            <div id="preview4"></div>
                            <input type="file" name="image4" id="image4" value="" accept="image/*" id="image4" style="float:left" onchange="getImagePreview4(event)">
                         </div>
                        
                         <div class="col">
                            <label>Head Clerk Sign(100KB-.jpeg)</label>
                            <!-- Preview-->
                            <div id="preview5"></div>
                            <input type="file" name="image5" id="image5" value="" accept="image/*" id="image5" style="float:left" onchange="getImagePreview5(event)">
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
                     <button type="submit" name="editinst" class="btn btn-info">Edit Data</button>
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
