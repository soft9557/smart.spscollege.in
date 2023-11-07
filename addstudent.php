<?php
//database connection
include('config.php');

//adding data to the database
if(isset($_POST['addstu'])){
  $ses = $_POST['ses'];
  $cors = $_POST['cors'];
  $coname = $_POST['coname'];
  $subject = $_POST['sub'];

  $st_adm_no = $_POST['admn'];
  $adm_date = $_POST['admdate'];
	$scrgn = $_POST['scrgn'];
  $st_adh = $_POST['stadh'];
	
  $st_name = $_POST['stname'];
	$st_fath = $_POST['stfath'];
	$fath_occ = $_POST['fathocc'];
	$st_moth = $_POST['stmoth'];
	
  $addr1 = $_POST['addr1'];
	$addr2 = $_POST['addr2'];
  $addr3 = $_POST['addr3'];
	$addr4 = $_POST['addr4'];

  $st_sex = $_POST['stsex'];
	$st_dob = $_POST['stdob'];
	$st_rel = $_POST['strel'];
	$st_caste = $_POST['stcaste'];
  $st_cat = $_POST['stcat'];
	
  $yinc = $_POST['yinc'];
  $mob1 = $_POST['mob1'];
	$mob2 = $_POST['mob2'];
  $emailid = $_POST['emailid'];
	  
	$exam1 = $_POST['exam1'];
  $board1 = $_POST['board1'];
  $year1 = $_POST['year1'];
  $marks1 = $_POST['marks1'];
  $sub1 = $_POST['sub1'];

  $exam2 = $_POST['exam2'];
  $board2 = $_POST['board2'];
  $year2 = $_POST['year2'];
  $marks2 = $_POST['marks2'];
  $sub2 = $_POST['sub2'];

  $exam3 = $_POST['exam3'];
  $board3 = $_POST['board3'];
  $year3 = $_POST['year3'];
  $marks3 = $_POST['marks3'];
  $sub3 = $_POST['sub3'];

  $st_fee = $_POST['cofee'];
  $adt_fee = $_POST['adt_fee'];
  $ismfee = $_POST['ismfee'];
  $ptype = $_POST['ptype'];
  $fdate = $_POST['fdate'];




   // STUDENT image upload
    $filename=$_FILES['image']['name'];
    $tempname=$_FILES['image']['tmp_name'];
    
    $extension=pathinfo($filename,PATHINFO_EXTENSION);
    $randomno=rand(0,10000);
    $rename='ST'.date('Ymd').$randomno;
    $newname=$rename.'.'.$extension;
    $folder='upload_images/'.$newname; 
    


    //FAMILY image upload
    $filename1=$_FILES['image2']['name'];
    $tempname1=$_FILES['image2']['tmp_name'];
    
    $extension1=pathinfo($filename1,PATHINFO_EXTENSION);
    $randomno1=rand(0,10000);
    $rename1='FM'.date('Ymd').$randomno1;
    $newname1=$rename1.'.'.$extension1;
    $folder1='upload_images/'.$newname1;

        move_uploaded_file($tempname,$folder);
        move_uploaded_file($tempname1,$folder1);

          
        
   // $rec=mysqli_query($con,"select * from student_data where st_adm_no='$st_adm_no'");
        // if(mysqli_num_rows($rec)>0){

          //$_SESSION['status'] = "Student already exists";
          //header("Location: updatestudent.php");
     
//     }else{
    
  	$insert_data = "INSERT INTO student_data(ses,cl_cd,cl_name,subject,st_adm_no,reg_no,adm_date,st_adh,st_name,st_fath,fath_occ,st_moth,addr1,addr2,addr3,addr4,st_sex,st_dob,st_rel,st_caste,st_cat,yearly_inc,mob1,mob2,email,exam1,board1,year1,marks1,sub1,exam2,board2,year2,marks2,sub2,exam3,board3,year3,marks3,sub3,st_fee,bal_fee,add_time_fee,install_fee,pay_type,fee_date,st_ph_id,gr_ph_id,added_on)VALUES('$ses','$cors','$coname','$subject','$st_adm_no','$scrgn','$adm_date','$st_adh','$st_name','$st_fath','$fath_occ','$st_moth','$addr1','$addr2','$addr3','$addr4','$st_sex','$st_dob','$st_rel','$st_caste','$st_cat','$yinc','$mob1','$mob2','$emailid','$exam1','$board1','$year1','$marks1','$sub1','$exam2','$board2','$year2','$marks2','$sub2','$exam3','$board3','$year3','$marks3','$sub3','$st_fee','$st_fee','$adt_fee','$ismfee','$ptype','$fdate','$folder','$folder1',NOW())";
  	$run_data = mysqli_query($con,$insert_data);

  //   }     
    
      if($run_data)
      {
          $_SESSION['status'] = "Data Inserted";
            header("Location: updatestudent.php");
        }else{
          $_SESSION['status'] = "Student already exists";
          header("Location: updatestudent.php");
        }

}


/////  Delete Data

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']) && $_GET['id']>0){
//if (isset($_POST['delstu'])){
   // $stu_id = $_POST['ssid'];
    $id=$_GET['id'];
    //$stu_id = $_POST['delete_sid'];
    $query = "DELETE FROM student_data WHERE id='$id'";
    $query_run = mysqli_query($con,$query); 

    if($query_run)
      {
          $_SESSION['status'] = "Student Data Deleted.";
            header("Location: updatestudent.php");
        }else{
          $_SESSION['status'] = "Student Data Deleted Failed.";
          header("Location: updatestudent.php");
        }

}






/////  View Data

if(isset($_POST['checking_viewbtn']))
{
  $s_id = $_POST['student_id'];
  //echo $_return = $s_id;

  $get_data = "SELECT * FROM student_data WHERE id='$s_id'";
  $run_data = mysqli_query($con,$get_data);
  //$i = 0; 
  if (mysqli_num_rows($run_data) > 0)
  {
    foreach($run_data as $row)
    {
      echo "<div class='row'>";
           echo "<div class='col-sm-4 col-md-4'>";
           echo $_return='
              <img src='.$row['st_ph_id'].'
              ';
              echo "<img src='upload_images/" . $row['st_ph_id'] . "' alt='' style='width: 140px; height: 140px;'>";      
              echo $_return='
              <h6>Reg#. : '.$row['st_adm_no'].'</h6>
              ';
           echo "</div>";
              
           echo"<div class='col-sm-4 col-md-8'>";
                    echo $_return='
                    <h5 style="background-color:powderblue;" class="modal-title">'.$row['st_name'].'</h5>
                    <h6>Course : '.$row['cl_name'].' Year-'.$row['ses'].'</h6>
                    <h6>S/o : '.$row['st_fath'].'</h6> 
                    <h6>Mob. : '.$row['mob1'].' ,'.$row['mob2'].' </h6>
                    <h6>Address : '.$row['addr1'].','.$row['addr2'].','.$row['addr3'].','.$row['addr4'].'</h6>
                    
                    
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
if(isset($_POST['editstu'])){
  $sid = $_POST['sid'];
  $ses = $_POST['ses'];
  $cors = $_POST['cors'];
  $coname = $_POST['coname'];
  $subject = $_POST['sub'];

  $st_adm_no = $_POST['admn'];
  $adm_date = $_POST['admdate'];
	$scrgn = $_POST['scrgn'];
  $st_adh = $_POST['stadh'];
	
  $st_name = $_POST['stname'];
	$st_fath = $_POST['stfath'];
	$fath_occ = $_POST['fathocc'];
	$st_moth = $_POST['stmoth'];
	
  $addr1 = $_POST['addr1'];
	$addr2 = $_POST['addr2'];
  $addr3 = $_POST['addr3'];
	$addr4 = $_POST['addr4'];

  $st_sex = $_POST['stsex'];
	$st_dob = $_POST['stdob'];
	$st_rel = $_POST['strel'];
	$st_caste = $_POST['stcaste'];
  $st_cat = $_POST['stcat'];
	
  $yinc = $_POST['yinc'];
  $mob1 = $_POST['mob1'];
	$mob2 = $_POST['mob2'];
  $emailid = $_POST['emailid'];
	  
	$exam1 = $_POST['exam1'];
  $board1 = $_POST['board1'];
  $year1 = $_POST['year1'];
  $marks1 = $_POST['marks1'];
  $sub1 = $_POST['sub1'];

  $exam2 = $_POST['exam2'];
  $board2 = $_POST['board2'];
  $year2 = $_POST['year2'];
  $marks2 = $_POST['marks2'];
  $sub2 = $_POST['sub2'];

  $exam3 = $_POST['exam3'];
  $board3 = $_POST['board3'];
  $year3 = $_POST['year3'];
  $marks3 = $_POST['marks3'];
  $sub3 = $_POST['sub3'];

  $st_fee = $_POST['cofee'];
  $adt_fee = $_POST['adt_fee'];
  $ismfee = $_POST['ismfee'];
  $ptype = $_POST['ptype'];
  $fdate = $_POST['fdate'];
   // STUDENT image upload
    $filename=$_FILES['image']['name'];
    $tempname=$_FILES['image']['tmp_name'];
    
    $extension=pathinfo($filename,PATHINFO_EXTENSION);
    $randomno=rand(0,10000);
    $rename='ST'.date('Ymd').$randomno;
    $newname=$rename.'.'.$extension;
    $folder='upload_images/'.$newname; 
    


    //FAMILY image upload
    $filename1=$_FILES['image2']['name'];
    $tempname1=$_FILES['image2']['tmp_name'];
    
    $extension1=pathinfo($filename1,PATHINFO_EXTENSION);
    $randomno1=rand(0,10000);
    $rename1='FM'.date('Ymd').$randomno1;
    $newname1=$rename1.'.'.$extension1;
    $folder1='upload_images/'.$newname1;

        move_uploaded_file($tempname,$folder);
        move_uploaded_file($tempname1,$folder1);

  	$edit_data = "UPDATE student_data SET ses='$ses',cl_cd='$cors',cl_name='$coname',subject='$subject',st_adm_no='$st_adm_no',
    reg_no='$scrgn',st_adh='$st_adh',adm_date='$adm_date',st_name='$st_name',st_fath='$st_fath',
    fath_occ='$fath_occ',st_moth='$st_moth',addr1='$addr1',addr2='$addr2',addr3='$addr3',addr4='$addr4',
    st_sex='$st_sex',st_dob='$st_dob',st_rel='$st_rel',st_caste='$st_caste',st_cat='$st_cat',yearly_inc='$yinc',
    mob1='$mob1',mob2='$mob2',email='$emailid',exam1='$exam1',board1='$board1',year1='$year1',marks1='$marks1',
    sub1='$sub1',exam2='$exam2',board2='$board2',year2='$year2',marks2='$marks2',sub2='$sub2',exam3='$exam3',
    board3='$board3',year3='$year3',marks3='$marks3',sub3='$sub3',st_fee='$st_fee',add_time_fee='$adt_fee',
    install_fee='$ismfee',pay_type='$ptype',fee_date='$fdate',st_ph_id='$folder',gr_ph_id='$folder1' WHERE id='$sid'";
  	$run_data = mysqli_query($con,$edit_data);

  	        
    
      if($run_data)
      {
          $_SESSION['status'] = "Data Updated";
            header("Location: updatestudent.php");
        }else{
          $_SESSION['status'] = "Data not Updated";
          header("Location: updatestudent.php");
        }

}



?>





