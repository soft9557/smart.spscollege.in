<?php
//database connection
include('config.php');

//adding data to the database
      if(isset($_POST['recsubmit'])){
       // $recvn = $_POST['recvn'];
        $recfrom = $_POST['recfrom'];
        $recfor = $_POST['recfor'];
        $recamt = $_POST['recamt'];
        $nar = $_POST['nar'];
        $rtype = $_POST['rtype'];
        $rdate = $_POST['rdate'];

   
  	$insert_data = "INSERT INTO received(rece_from, rece_for, rece_amt, rece_type, rece_date, rece_nar, added_on)
    VALUES('$recfrom','$recfor','$recamt','$rtype','$rdate','$nar',NOW())";
     
    $run_data = mysqli_query($con,$insert_data);
     if($run_data)
      {
          $_SESSION['status'] = "Receipt Data Inserted";
            header("Location: received_bro.php");
        }else{
          $_SESSION['status'] = "Receipt Voucher No. already exists";
          header("Location: received_bro.php");
        }

    }

/////  Delete Data

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']) && $_GET['id']>0){
  //if (isset($_POST['Deletstubtn'])){
    ///$stu_id = $_POST['delete_sid'];
   $id=$_GET['id'];
//if (isset($_POST['Deletstubtn'])){
    //$stu_id = $_POST['delete_sid'];
    $query = "DELETE FROM received WHERE id='$id'";
    $query_run = mysqli_query($con,$query); 

    if($query_run)
      {
          $_SESSION['status'] = "Receipt Data Deleted.";
            header("Location: received_bro.php");
        }else{
          $_SESSION['status'] = "Receipt Data Deleted Failed.";
          header("Location: received_bro.php");
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
if(isset($_POST['editrec'])){
  $sid = $_POST['sid'];
  $recfrom = $_POST['recfrom'];
  $recfor = $_POST['recfor'];
  $recamt = $_POST['recamt'];
  $nar = $_POST['nar'];
  $rtype = $_POST['rtype'];
  $rdate = $_POST['rdate'];

  	$edit_data = "UPDATE received SET rece_from='$recfrom',rece_for='$recfor',rece_type='$rtype',rece_amt='$recamt',
    rece_date='$rdate',rece_nar='$nar' WHERE id='$sid'";
  	$run_data = mysqli_query($con,$edit_data);

      if($run_data)
      {
          $_SESSION['status'] = "Data Updated";
            header("Location: received_bro.php");
        }else{
          $_SESSION['status'] = "Data not Updated";
          header("Location: received_bro.php");
        }

}

?>





