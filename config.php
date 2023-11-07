<?php
session_start();
$host="localhost";
$username="root";
$password="";
$database="smart_spscollege";
//connection
$con=mysqli_connect("$host","$username","$password","$database");
//check connection
if(!$con)
{
    header("Location: ../errors/db.php");
    die();
    //die(mysqli_connect_errno($con));
}
    
//else{
  //  echo "Database Connected.!";
//}
?>
