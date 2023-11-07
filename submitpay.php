<?php

include('config.php');

//adding data to the database
      if(isset($_POST['paysubmit'])){
       // $payvn = $_POST['payvn'];
        $payto = $_POST['payto'];
        $payfor = $_POST['payfor'];
        $payment = $_POST['payment'];
        $nar = $_POST['nar'];
        $ptype = $_POST['ptype'];
        $pdate = $_POST['pdate'];
        
        
        
    
    
  	$insert_data = "INSERT INTO payment(pay_to,pay_for,pay_nar,pay_amt,pay_type,pay_date,added_on)VALUES('$payto','$payfor','$nar','$payment','$ptype','$pdate',NOW())";
    $run_data = mysqli_query($con,$insert_data);
     
      
     if($run_data)
      {
          $_SESSION['status'] = "payment Data Inserted";
            header("Location: payment_bro.php");
        }else{
          $_SESSION['status'] = "Payment Voucher No. already exists";
          header("Location: payment_bro.php");
        }

    }

/////  Delete Data

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']) && $_GET['id']>0){
  //if (isset($_POST['Deletstubtn'])){
    ///$stu_id = $_POST['delete_sid'];
   $id=$_GET['id'];
    $query = "DELETE FROM payment WHERE id='$id'";
    $query_run = mysqli_query($con,$query); 

    if($query_run)
      {
          $_SESSION['status'] = "Payment Data Deleted.";
            header("Location: payment_bro.php");
        }else{
          $_SESSION['status'] = "Payment Data Deleted Failed.";
          header("Location: payment_bro.php");
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
if(isset($_POST['editpay'])){
        $sid = $_POST['sid'];
        $payvn = $_POST['payvn'];
        $payto = $_POST['payto'];
        $payfor = $_POST['payfor'];
        $payment = $_POST['payment'];
        $nar = $_POST['nar'];
        $ptype = $_POST['ptype'];
        $pdate = $_POST['pdate'];
      
  	  $edit_data = "UPDATE payment SET pay_to='$payto',pay_for='$payfor', pay_nar='$nar', pay_amt='$payment', pay_type='$ptype', pay_date='$pdate' WHERE id='$sid'";
  	  $run_data = mysqli_query($con,$edit_data);
     
  	        
    
      if($run_data)
      {
          $_SESSION['status'] = "Data Updated";
            header("Location: payment_bro.php");
        }else{
          $_SESSION['status'] = "Payment Voucher No. already exists";
          header("Location: payment_bro.php");
        }

}



?>





