<?php
//database connection
include('config.php');

//adding data to the database
      if(isset($_POST['feesubmit'])){
        $ses = $_POST['ses'];
        $stfee = "Student Fee";
        $cors = $_POST['cors'];
        $coname = $_POST['coname'];
        $corsfee = $_POST['stmoth'];
        $stadm = $_POST['sid'];
        $stregno = $_POST['regn'];
        $stname = $_POST['stname'];
        $stfath = $_POST['stfath'];
        $subfee = $_POST['subfee'];
        $amtword = $_POST['amtword'];
        $nextfee = $_POST['nextfee'];
        $balance = $_POST['balan'];
        $addr1 = $_POST['addrs1'];
        $mob1 = $_POST['mobil'];
        $fhead = $_POST['fhead'];
        $ptype = $_POST['ptype'];
        $pdate = $_POST['fdate'];

        
       
  	$insert_data = "INSERT INTO fee_data(sess,fee_from,course,cl_name,course_fee,adm_no,regno,st_name,st_fath,paid_fee,amtword,next_fee,balance,addr1,mob,pay_type,fee_head,paid_date,added_on)
    VALUES('$ses','$stfee','$cors','$coname','$corsfee','$stadm','$stregno','$stname','$stfath','$subfee','$amtword','$nextfee','$balance','$addr1','$mob1','$ptype','$fhead','$pdate',NOW())";
  	$feeupdate="update student_data set bal_fee='$nextfee' where st_adm_no=$stadm";
    $run_data = mysqli_query($con,$insert_data);
    $run_data = mysqli_query($con,$feeupdate);
     if($run_data)
      {
          $_SESSION['status'] = "Fee Data Inserted";
            header("Location: feecollection.php");
        }else{
          $_SESSION['status'] = "Fee not Inserted";
          header("Location: feecollection.php");
        }

    }

/////  Delete Data

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']) && $_GET['id']>0){
   //if (isset($_POST['Deletstubtn'])){
   // $stu_id = $_POST['delete_sid'];
   $id=$_GET['id'];
    $query = "DELETE FROM fee_data WHERE id='$id'";
    $query_run = mysqli_query($con,$query); 

    if($query_run)
      {
          $_SESSION['status'] = "Fee Data Deleted.";
            header("Location: feecollection.php");
        }else{
          $_SESSION['status'] = "Fee Data Deleted Failed.";
          header("Location: feecollection.php");
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
if(isset($_POST['editfee'])){
       $fid = $_POST['fid'];
       $ses = $_POST['ses'];
        $cors = $_POST['cors'];
        $coname = $_POST['coname'];
        $stadm = $_POST['stid'];
        $stregno = $_POST['regn'];
        $stname = $_POST['stname'];
        $stfath = $_POST['stfath'];
        $subfee = $_POST['subfee'];
        $amtword = $_POST['amtword'];
        $nextfee = $_POST['nextfee'];
        $balance = $_POST['balan'];
        $addr1 = $_POST['addrs1'];
        $mob1 = $_POST['mobil'];
        $fhead = $_POST['fhead'];
        $ptype = $_POST['ptype'];
        $pdate = $_POST['fdate'];

  	$edit_data = "UPDATE fee_data SET sess='$ses',course='$cors',cl_name='$coname',adm_no='$stadm',st_name='$stname',st_fath='$stfath',paid_fee='$subfee',next_fee='$nextfee',balance='$balance',addr1='$addr1',mob='$mob1',fee_head='$fhead',pay_type='$ptype',paid_date='$pdate' WHERE id='$fid'";
  	$run_data = mysqli_query($con,$edit_data);

    $edit_stdata = "UPDATE student_data SET bal_fee='$nextfee' WHERE st_adm_no='$stadm'";
  	$run_stdata = mysqli_query($con,$edit_stdata);

  	        
    
      if($run_data)
      {
          $_SESSION['status'] = "Fee Data Updated";
            header("Location: feecollection.php");
        }else{
          $_SESSION['status'] = "Fee Data not Updated";
          header("Location: feecollection.php");
        }

        if($run_stdata)
      {
          $_SESSION['status'] = "Fee Data Updated";
            header("Location: feecollection.php");
        }else{
          $_SESSION['status'] = "Fee Data not Updated";
          header("Location: feecollection.php");
        }

}



?>





