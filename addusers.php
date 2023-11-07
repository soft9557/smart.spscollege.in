<?php
//database connection
include('config.php');

//adding User to the database
$msg="";
$username="";
$password="";
//$label="Add";
if(isset($_GET['id']) && $_GET['id']>0){
  $label="Edit";
  $id=get_safe_value($_GET['id']);
  $res=mysqli_query($con,"select * from users where id=$id");
  if(mysqli_num_rows($res)==0){
    redirect('manage_users.php');
    die();
  }
  $row=mysqli_fetch_assoc($res);
  $username=$row['username'];
  $password=$row['password'];
}

if(isset($_POST['usersubmit'])){
  $username=$_POST['uname'];
  $password=$_POST['upass'];
  $role=$_POST['urole'];
  $type="add";
  $sub_sql="";
  if(isset($_GET['id']) && $_GET['id']>0){
    $type="edit";
    $sub_sql="and id!=$id";
  }
  
  $res=mysqli_query($con,"select * from users where username='$username' $sub_sql");
  if(mysqli_num_rows($res)>0){
    $msg="Username already exists";
  }else{
    
    $password=password_hash($password,PASSWORD_DEFAULT);
    
    $sql="insert into users(username,password,role) values('$username','$password','$role')";
    if(isset($_GET['id']) && $_GET['id']>0){
      $sql="update users set username='$username',password='$password' where id=$id";
    }
    $run_data=mysqli_query($con,$sql);
    //redirect('users.php');
  }
  if($run_data)
  {
      $_SESSION['status'] = "Users Data Inserted";
        header("Location: manage_users.php");
    }else{
      $_SESSION['status'] = "Users not Inserted";
      header("Location: manage_users.php");
    }


}

   // Delete data to the database 
if (isset($_POST['Deletstubtn'])){
    $stu_id = $_POST['delete_cid'];
    $query = "DELETE FROM users WHERE id='$stu_id'";
    $query_run = mysqli_query($con,$query); 

    if($query_run)
      {
          $_SESSION['status'] = "User Data Deleted.";
            header("Location: manage_users.php");
        }else{
          $_SESSION['status'] = "User Data Deleted Failed.";
          header("Location: manage_users.php");
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

if(isset($_POST['editusers'])){
  $username=$_POST['uname'];
  $password=$_POST['upass'];
  $role=$_POST['urole'];
  //$type="add";
  //$sub_sql="";
  $sid = $_POST['sid'];
  $password=password_hash($password,PASSWORD_DEFAULT);

    $edit_data = "UPDATE  users set username='$username',password='$password', role='$role' where id=$sid";
  	$run_data = mysqli_query($con,$edit_data);
     
     if($run_data)
      {
          $_SESSION['status'] = "Users Data Updated";
            header("Location: manage_users.php");
        }else{
          $_SESSION['status'] = "Users not Updated";
          header("Location: manage_users.php");
        }

    }



?>







