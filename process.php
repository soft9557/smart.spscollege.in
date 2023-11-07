<?php
//database connection
include('config.php');

/////  Edit Data

if(isset($_POST['process'])){
  $ccode = $_POST['chsid'];
  $cfee = $_POST['chfee'];
  $cses = $_POST['chses'];
  $sid = $_POST['sid'];

    $edit_data = "UPDATE student_data SET cl_cd='$ccode',st_fee='$cfee',ses='$cses' WHERE cl_cd='$sid'";
  	$run_data = mysqli_query($con,$edit_data);
     
     if($run_data)
      {
          $_SESSION['status'] = " Data Process Done.";
            header("Location: dataprocessing.php");
        }else{
          $_SESSION['status'] = "Data not Process";
          header("Location: dataprocessing.php");
        }

    }

?>







