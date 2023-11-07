<html>
<head>
<style>
p.inline {display: inline-block;}
span { font-size: 13px;}
</style>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */

    }
</style>
</head>
<body onload="window.print();">
	<div style="margin-left: 5%">
		<?php
		include('config.php');
		$get_data = "SELECT * FROM student_data";
		$run_data = mysqli_query($con,$get_data);


		//foreach ($run_data as $student) {
		//	$name = $student['st_adm_no'];
		//	$rollNumber = $student['reg_no'];
		//	$class = $student['cl_name'];
			//$photo = $student['st_ph_id'];
//
		//}



		include 'barcode128.php';
		$product = $student['st_adm_no'];
		$product_id = $student['reg_no'];
		$rate = $student['cl_name'];

		for($i=1;$i<=$_POST['print_qty'];$i++){
			echo "<p class='inline'><span ><b>Item: $product</b></span>".bar128(stripcslashes($student['reg_no']))."<span ><b>Price: ".$rate." </b><span></p>&nbsp&nbsp&nbsp&nbsp";
		}

		?>
	</div>
</body>
</html>