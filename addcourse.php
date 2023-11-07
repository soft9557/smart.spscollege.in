<?php
//database connection
include('config.php');

//adding data to the database
      if(isset($_POST['corsubmit'])){
        $ccode = $_POST['ccode'];
        $cname = $_POST['cname'];
        $cfeeol = $_POST['cfeeol'];
        $cfeenw = $_POST['cfeenw'];
        $cftype = $_POST['cftype'];
        $subject = $_POST['subject'];


    $rec=mysqli_query($con,"select * from class_data where class_id='$ccode'");
    if(mysqli_num_rows($rec)>0){

          $_SESSION['status'] = "Course already exists";
          header("Location: manage_course.php");
     
     }else{
        
  	$insert_data="INSERT INTO class_data(class_id,class_name,class_fee,new_fee,class_fee_type,subject,added_on)
    VALUES('$ccode','$cname','$cfeeol','$cfeenw','$cftype',' $subject',NOW())";
  	$run_data = mysqli_query($con,$insert_data);
  }    
   
     if($run_data)
      {
          $_SESSION['status'] = "Course Data Inserted";
            header("Location: manage_course.php");
        }else{
          $_SESSION['status'] = "Course already exists";
          header("Location: manage_course.php");
        }

    }

   // Delete data to the database 
if (isset($_POST['Deletstubtn'])){
    $stu_id = $_POST['delete_cid'];
    $query = "DELETE FROM class_data WHERE id='$stu_id'";
    $query_run = mysqli_query($con,$query); 

    if($query_run)
      {
          $_SESSION['status'] = "Course Data Deleted.";
            header("Location: manage_course.php");
        }else{
          $_SESSION['status'] = "Course Data Deleted Failed.";
          header("Location: manage_course.php");
        }

}

//View data 

if(isset($_POST['checking_viewbtn']))
{
  $s_id = $_POST['student_id'];
  //echo $_return = $s_id;

  $get_data = "SELECT fee_data.*,student_data.st_adm_no as stid,student_data.st_ph_id as phid FROM fee_data,student_data WHERE student_data.st_adm_no=fee_data.adm_no AND fee_data.id='$s_id'";
  $run_data = mysqli_query($con,$get_data);
  //$i = 0; 
  if (mysqli_num_rows($run_data) > 0)
  {
    foreach($run_data as $row)
    {
      echo "<div class='row'>";
           echo "<div class='col-sm-4 col-md-4'>";
              echo $_return='
              <img src='.$row['phid'].'
              ';
              echo "<img src='upload_images/" . $row['phid'] . "' alt='' style='width: 140px; height: 140px;'>";      
              echo $_return='
              <h6>Reg#. : '.$row['adm_no'].'</h6>
              ';
           echo "</div>";
              
           echo"<div class='col-sm-4 col-md-8'>";
                    echo $_return='
                    <h5 style="background-color:powderblue;" class="modal-title">'.$row['st_name'].'</h5>
                    <h6>Course : ITI-'.$row['course'].' '.$row['sess'].'</h6>
                    <h6>S/o : '.$row['st_fath'].'</h6> 
                    <h6>Mob. : '.$row['mob'].'</h6>
                    <h6>Address : '.$row['addr1'].'</h6>
                    <h5>Fee Submit : '.$row['paid_fee'].' '.$row['pay_type'].' </h5>
                    <h5>Date :'.$row['paid_date'].'</h5>
                    
                    ';
           echo "</div>";
      echo "</div>";
     

    }
  }
  else
  {
   echo $_return ="<f5>No Record Found</f5>";
  }  
}

/////  Edit Data

if(isset($_POST['editclass'])){
  $ccode = $_POST['ccode'];
  $cname = $_POST['cname'];
  $cfeeol = $_POST['cfeeol'];
  $cfeenw = $_POST['cfeenw'];
  $cftype = $_POST['cftype'];
  $subject = $_POST['subject'];
  $sid = $_POST['sid'];

    $edit_data = "UPDATE class_data SET class_id='$ccode',class_name='$cname',class_fee='$cfeeol',new_fee='$cfeenw',class_fee_type='$cftype',subject='$subject' WHERE id='$sid'";
  	$run_data = mysqli_query($con,$edit_data);
     
     if($run_data)
      {
          $_SESSION['status'] = "Course Data Inserted";
            header("Location: manage_course.php");
        }else{
          $_SESSION['status'] = "Course not Inserted";
          header("Location: manage_course.php");
        }

    }



?>







