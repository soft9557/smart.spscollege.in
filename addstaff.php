<?php
//database connection
include('config.php');

//adding data to the database
      if(isset($_POST['staffsubmit'])){
        $scode = $_POST['scode'];
        $sname = $_POST['sname'];
        $scat = $_POST['scat'];
        $sjob = $_POST['sjob'];

         $rec=mysqli_query($con,"select * from staff where s_code='$scode' and s_name='$sname' ");
         if(mysqli_num_rows($rec)>0){

          $_SESSION['status'] = "Staff already exists";
          header("Location: manage_staff.php");
     
        }else{
    
        
        
      $insert_data="INSERT INTO staff(s_code,s_name,s_job,s_cat)
      VALUES('$scode','$sname','$sjob','$scat')";
      $run_data = mysqli_query($con,$insert_data);
     }
     if($run_data)
      {
          $_SESSION['status'] = "Staff Data Inserted";
            header("Location: manage_staff.php");
        }else{
          $_SESSION['status'] = "Staff already exists";
          header("Location: manage_staff.php");
        }

    }

   // Delete data to the database 
if (isset($_POST['Deletstubtn'])){
    $stf_id = $_POST['delete_cid'];
    $query = "DELETE FROM staff WHERE id='$stf_id'";
    $query_run = mysqli_query($con,$query); 

    if($query_run)
      {
          $_SESSION['status'] = "Staff Data Deleted.";
            header("Location: manage_staff.php");
        }else{
          $_SESSION['status'] = "Staff Data Deleted Failed.";
          header("Location: manage_staff.php");
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

if(isset($_POST['editstaff'])){
  $scode = $_POST['scode'];
  $sname = $_POST['sname'];
  $sjob = $_POST['sjob'];
  $scat = $_POST['scat'];
  $sid = $_POST['sid'];

   

    $edit_data = "UPDATE staff SET s_code='$scode',s_name='$sname',s_job='$sjob',s_cat='$scat' WHERE id='$sid'";
  	$run_data = mysqli_query($con,$edit_data);
  
     if($run_data)
      {
          $_SESSION['status'] = "Staff Data Updated";
            header("Location: manage_staff.php");
        }else{
          $_SESSION['status'] = "Staff not Updated >already exists";
          header("Location: manage_staff.php");
        }

    }



?>







