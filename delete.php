<?php
include('config.php');
$id = $_GET['id'];
$delete = "DELETE FROM student_data WHERE id = $id";
$run_data = mysqli_query($con,$delete);

if($run_data){
	header('location:updatestudent.php');
}else{
	echo "Donot Delete";
}


?>