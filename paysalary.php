<?php
//database connection
include('config.php');

//adding data to the database
      if(isset($_POST['salarysubmit'])){
        $sid = $_POST['sid'];
        $stcode = $_POST['stcode'];
        $stjob = $_POST['stjob'];
        $stcat = $_POST['stcat'];
        $monthof = $_POST['monthof'];
        $wday = $_POST['wday'];
        $sal = $_POST['sal'];
        $ledger = "Salary";
        $ptype = $_POST['ptype'];
        $pdate = $_POST['pdate'];
               
       
  	$insert_data = "INSERT INTO salary(stf_code,stf_name,stf_job,stf_cat,monthof,wo_day,sal_paid,ledger,pay_type,paid_date)VALUES('$stcode','$sid' ,'$stjob','$stcat','$monthof','$wday','$sal','$ledger','$ptype','$pdate')";
  	$run_data = mysqli_query($con,$insert_data);
    if($run_data)
      {
          $_SESSION['status'] = "Salary Data Inserted";
            header("Location: staffsalary.php");
        }else{
          $_SESSION['status'] = "Salary not Inserted";
          header("Location: staffsalary.php");
        }

    }


/////  Delete Data

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']) && $_GET['id']>0){
  $id=$_GET['id'];
  //if (isset($_POST['Deletstubtn'])){
   // $stu_id = $_POST['delete_sid'];
    $query = "DELETE FROM salary WHERE id='$id'";
    $query_run = mysqli_query($con,$query); 

    if($query_run)
      {
          $_SESSION['status'] = "Salary Data Deleted.";
            header("Location: staffsalary.php");
        }else{
          $_SESSION['status'] = "Salary Data Deleted Failed.";
          header("Location: staffsalary.php");
        }

}

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
                    <h6>Course : '.$row['course'].' ,Year-'.$row['sess'].'</h6>
                    <h6>S/o : '.$row['st_fath'].'</h6> 
                    <h6>Mob. : '.$row['mob'].'</h6>
                    <h6>Address : '.$row['addr1'].'</h6>
                    <h6>Fee Slip#: '.$row['id'].' , Paid-'.$row['paid_fee'].' '.$row['pay_type'].' </h6>
                    <h6>Date :'.$row['paid_date'].'</h6>
                    
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
if(isset($_POST['paysubmit'])){
  $slid = $_POST['slid'];
  $monthof = $_POST['monthof'];
  $wday = $_POST['wday'];
  $sal = $_POST['sal'];
  $ptype = $_POST['ptype'];
  $pdate = $_POST['pdate'];

  	$edit_data = "UPDATE salary SET monthof='$monthof',wo_day='$wday',sal_paid='$sal',pay_type='$ptype',paid_date='$pdate' WHERE id='$slid'";
  	$run_data = mysqli_query($con,$edit_data);
  
      if($run_data)
      {
          $_SESSION['status'] = "Salary Data Updated";
            header("Location: staffsalary.php");
        }else{
          $_SESSION['status'] = "Salary Data not Updated";
          header("Location: staffsalary.php");
        }

        if($run_stdata)
      {
          $_SESSION['status'] = "Salary Data Updated";
            header("Location: staffsalary.php");
        }else{
          $_SESSION['status'] = "Salary Data not Updated";
          header("Location: staffsalary.php");
        }

}



?>





