<?php
include('config.php');
//include('includes/header.php');
//include('includes/topbar.php');
//include('includes/sidebar.php');
//include('includes/functions.php');
//checkUser();
//userArea();
$classfee='';
$sub_sql1='';
$sub_sql='';
$from='';
$to='';


if(isset($_POST["corsid"])){
    $corsid=$_POST["corsid"];
    }

    if($corsid!==""){
       $sub_sql=" student_data.cl_cd='$corsid'";
   }


   if(isset($_POST["stid"])){
       $stid=$_POST["stid"];
       }
  
       if($stid!==""){
          $sub_sql=" student_data.cl_name='$stid'";
      }
      if(isset($_POST["adid"])){
        $adid=$_POST["adid"];
        }
   
        if($adid!==""){
           $sub_sql=" student_data.st_adm_no='$adid'";
       }






?>

<!DOCTYPE html>
<html>
<body onload="window.print();">
<head>

    <title>Dynamic Student ID Cards</title>

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
        <style>
        span.b {
        display: inline-block;
        font-size: 13px;
        text-align: centre;
        margin-top: 20px;
        margin-bottom: 20px;
        margin-left: 30px;
        width: 170.08px;
        height: 264.57px;
        padding: 10px;
        border: 1px solid skyblue;    
        background-color: rgba(182,221,200,255); 
        }       
        </style>
<style>
h3 {text-align: center;}
h4 {text-align: center;}
h5 {text-align: left;}
h6 {text-align: center;}

.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  
}

div {
  margin: 20px;
}

</style>

</head>

    <?php
                    $get_data = "SELECT student_data.*,institute.inst_name as iname,institute.addr1 as add1,institute.addr2 as add2,institute.addr3 as add3,institute.mob1 as mo1,institute.mob2 as mo2
                    FROM student_data,institute where $sub_sql";
                     $run_data = mysqli_query($con,$get_data);
                                            
    // Define an array of students with their details
                    
    if (is_array($run_data) || is_object($run_data)) {                
    // Loop through the students array and create ID cards dynamically
    foreach ($run_data as $student) {
        $inname = $student['iname'];

       // .$row1['addr1'].''.$row1['addr2'].''.$row1['addr3'].''.$row1['addr4'].
        $inad = $student['add1'].''.$student['add2'];
        $mobe = $student['mo1'].' , '.$student['mo2'];
        $inname = $student['iname'];
        $stid = $student['st_adm_no'];
        $class = $student['cl_name'].' ('.$student['cl_cd'].')';
        //$class = $student['cl_name'];
        if (file_exists($student['st_ph_id'])) {
            #shows image with given width and height
        // list($width, $height) = getimagesize($info["stphoto"]);
             $image = $student['st_ph_id'];
        } else {
            // Handle the error when image file is not found
            $image ='images/default-avatar.jpg';
            
        }
        $stname = $student['st_name'];
        $stfath = $student['st_fath'];
        $mob = $student['mob1'];
        $add = $student['addr1'];
        $sign ='images/sign.jpeg';
        

        // Output the student ID card
        echo '<span class="b" >';
        echo '<span style="color:yellow;font-weight:bold;text-align: center;margin-top: 20px; font-size:14px; ">ATTANDENCE CARD</span>'.'</n>'; 
        echo '<span style="color:red;font-weight:bold;text-decoration:underline;text-align: center; font-size:14px; "> '. $inname .'</span>'.'</n>'; 
        echo '<span style="color:green; font-weight:bold;font-size:7px; text-align:centre;"> '. $inad .'</span><br>';
        echo '<span style="color:blue; font-weight:bold;font-size:8px; text-align:centre;">Contact No.  :  '. $mobe .'</span><br>';
        echo '<span style="color:blue; font-weight:bold;font-size:8px; text-align:centre;"><img src=' . $image . ' width="60" height="60"  alt="Snow" class="center"></span>'.'</n>'; 
        echo '<span style="color:blue; font-weight:bold;text-decoration:underline; font-size:10px; text-align:centre;">COURSE :'  . $class . '</span><br>'; 
        echo '<span style="color:blue; font-weight:normal;font-size:9px; text-align:centre;">S.NAME :'  . $stname . '</span><br>'; 
        echo '<span style="color:blue; font-weight:normal;font-size:9px; text-align:centre;">F.NAME :'  . $stfath . '</span><br>';
        echo '<span style="color:blue; font-weight:normal;font-size:9px; text-align:centre;">ENROLL :'  . $stid . '</span><br>';
        echo '<span style="color:blue; font-weight:normal;font-size:9px; text-align:centre;">MOBILE :' . $mob . '</span><br>';
        echo '<span style="color:blue; font-weight:normal;font-size:9px; text-align:centre;">ADDRESS:' . $add . '</span>';
        echo '<span style="color:blue; font-weight:normal;font-size:9px; text-align:centre;"><img src=' . $sign . ' width="170" height="35"  alt="Snow" class="center"></span>';
        echo  '</h5></span>';
    }
}else{
    echo'No data found';
    }
    ?>
        


</body>
</html>
