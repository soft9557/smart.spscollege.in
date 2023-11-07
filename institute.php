<?php
include('config.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/functions.php');
checkUser();
adminArea();
?>

<?php
    $sql="select * from class_data";
    $result=mysqli_query($con, $sql);

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
  <!-- Institute Add Modal -->
              <div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-xl">
                  <div class="modal-content">
                        <div class="modal-header">
                          <h5 style="" class="modal-title" id="exampleModalLabel">Institute Registration</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                        </div>
                    <form action="addinstitute.php" method="POST" enctype="multipart/form-data">
                   <div class="modal-body">

                   <div class="row"> 
                        
                        <div class="col">
                          <label>Session<span class="red-star"></span></label>
                           <input type="text" id="ses" name="ses" class="form-control" placeholder="Enter Session: 2023-24" required>
                        </div>
                   
                        <div class="col">
                          <label>Institute Name<span class="red-star"></span></label>
                           <input type="text" id="insname" name="insname" class="form-control" placeholder="Institute Name" required>
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
                            <input type="text" id="inscode" name="inscode" class="form-control" placeholder="Institute Code" required>
                        </div>
                        <div class="col">
                          <label>Principal<span class="red-star"> </span></label>
                          <input type="text" id="prin" name="prin" class="form-control" placeholder="Enter Principal Name">
                        </div>
                        <div class="col">
                          <label>Head Clerk<span class="red-star"> </span></label>
                          <input type="text" id="hdcl" name="hdcl" class="form-control" placeholder="Enter Head Clerk Name">
                        </div>
                                           
              </div>
              <div class="row"> 
              <div class="col">
                          <label>Address-1 : <span class="red-star"> </span></label>
                          <input type="text" id="addr1" name="addr1" class="form-control" placeholder="Enter Institute Addres">
                        </div>
                   
                        <div class="col">
                          <label>Address-1<span class="red-star"> </span></label>
                          <input type="text" id="addr2" name="addr2" class="form-control" placeholder="Enter Institute Addres">
                        </div>


                        <div class="col">
                          <label>Pincode<span class="red-star"> </span></label>
                          <input type="text" id="addr3" name="addr3" class="form-control" placeholder="Pincode#">
                        </div>

                        <div class="col">
                          <label>State<span class="red-star"> </span></label>
                          <input type="text" id="addr4" name="addr4" class="form-control" placeholder="State">
                        </div>
                                              
              </div>
              
               <div class="row">
                       <div class="col">
                          <label>Mobile N0<span class="red-star"> </span></label>
                          <input type="text" id="mob1" name="mob1" class="form-control" placeholder="Enter Institute Mobile#">
                        </div>
 
                        <div class="col">
                          <label>WhatsApp N0<span class="red-star"> </span></label>
                          <input type="text" id="mob2" name="mob2" class="form-control" placeholder="Enter Institute Whatsapp#">
                        </div>
                   
                        <div class="col">
                          <label>Email Id<span class="red-star"> </span></label>
                          <input type="email" id="emailid" name="emailid" class="form-control" placeholder="Enter Institute EmailID">
                        </div>
                        <div class="col">
                          <label>Website<span class="red-star"> </span></label>
                          <input type="text" id="webs" name="webs" class="form-control" placeholder="Enter Institute website">
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
                    </div>
                       
                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="addinst" class="btn btn-primary">Save</button>
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
                  <form action="addinstitute.php" method="POST">
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
                <h5 style="color:blue" class="m-0">Institute Registration</h5> 
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
                <h3 class="card-title">Institute data Table</h3>
                 <a href="#" data-toggle="modal" data-target="#addStudent" class="btn btn-primary float-right" >Add Institute </a>
               </div>
                 <!-- /.card-header -->
               <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                              <th>ID</th>
                              <th>Institute Code</th>
                              <th>Institute Name</th>
                              <th>Session</th>
                              <th>Address</th>
                              <th>Email</th>
                              <th>Website</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                    <tbody>


                    <?php
                                $get_data = "SELECT * FROM institute";
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
                                <td><?php echo $row['inst_code']; ?></td>
                                <td><?php echo $row['inst_name']; ?></td>
                                <td><?php echo $row['sese']; ?></td>
                                <td><?php echo $row['addr1']; ?></td>
                                <td><?php echo $row['ins_email']; ?></td>
                                <td><?php echo $row['website']; ?></td>
                               
                                <td>                            
                                <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-info btn-sm viewbtn">View</button>
                                <a href ="editinst.php?sid=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a> 
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
                    function getImagePreview3(event)
                    {
                      var image3=URL.createObjectURL(event.target.files[0]);
                      var imagediv= document.getElementById('preview3');
                      var newimg=document.createElement('img');
                      imagediv.innerHTML='';
                      newimg.src=image3;
                      newimg.width="100";
                      imagediv.appendChild(newimg);
                    }
                  </script>
                  <script>
                    function getImagePreview4(event)
                    {
                      var image4=URL.createObjectURL(event.target.files[0]);
                      var imagediv= document.getElementById('preview4');
                      var newimg=document.createElement('img');
                      imagediv.innerHTML='';
                      newimg.src=image4;
                      newimg.width="100";
                      imagediv.appendChild(newimg);
                    }
                  </script>
                  <script>
                    function getImagePreview5(event)
                    {
                      var image5=URL.createObjectURL(event.target.files[0]);
                      var imagediv= document.getElementById('preview5');
                      var newimg=document.createElement('img');
                      imagediv.innerHTML='';
                      newimg.src=image5;
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
