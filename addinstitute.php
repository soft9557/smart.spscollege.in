<?php
//database connection
include('config.php');

//adding data to the database
if(isset($_POST['addinst'])){
  $ses = $_POST['ses'];
  $insname = $_POST['insname'];
  $inscode = $_POST['inscode'];
  $prin = $_POST['prin'];
  $hdcl = $_POST['hdcl'];
	$addr1 = $_POST['addr1'];
  $addr2 = $_POST['addr2'];
	$addr3 = $_POST['addr3'];
  $addr4 = $_POST['addr4'];
	$mob1 = $_POST['mob1'];
	$mob2 = $_POST['mob2'];
	$emailid = $_POST['emailid'];
	$webs = $_POST['webs'];

  // Institute logo upload
  $filename=$_FILES['image']['name'];
  $tempname=$_FILES['image']['tmp_name'];
  
  $extension=pathinfo($filename,PATHINFO_EXTENSION);
  $randomno=rand(0,10000);
  $rename='ST'.date('Ymd').$randomno;
  $newname=$rename.'.'.$extension;
  $folder='upload_images/'.$newname; 
  


  //Institute image upload
  $filename1=$_FILES['image2']['name'];
  $tempname1=$_FILES['image2']['tmp_name'];
  
  $extension1=pathinfo($filename1,PATHINFO_EXTENSION);
  $randomno1=rand(0,10000);
  $rename1='FM'.date('Ymd').$randomno1;
  $newname1=$rename1.'.'.$extension1;
  $folder1='upload_images/'.$newname1;

      move_uploaded_file($tempname,$folder);
      move_uploaded_file($tempname1,$folder1);
   
  	$insert_data = "INSERT INTO institute(inst_code,inst_name,sese,addr1,addr2,addr3,addr4,prin,clr,mob1,mob2,ins_email,website,img,head_img)
    VALUES('$inscode','$insname','$ses','$addr1','$addr2','$addr3','$addr4','$prin','$hdcl','$mob1','$mob2','$emailid','$webs','$folder','$folder1')";
  	$run_data = mysqli_query($con,$insert_data);

    if($run_data)
      {
          $_SESSION['status'] = "Data Inserted";
            header("Location: institute.php");
        }else{
          $_SESSION['status'] = "Data not Inserted";
          header("Location: institute.php");
        }

}

if (isset($_POST['Deletstubtn'])){
    $stu_id = $_POST['delete_sid'];
    $query = "DELETE FROM institute WHERE id='$stu_id'";
    $query_run = mysqli_query($con,$query); 

    if($query_run)
      {
          $_SESSION['status'] = "Data Deleted.";
            header("Location: institute.php");
        }else{
          $_SESSION['status'] = "Data Deleted Failed.";
          header("Location: institute.php");
        }

}

/////  View Data

if(isset($_POST['checking_viewbtn']))
{
  $s_id = $_POST['student_id'];
  //echo $_return = $s_id;

  $get_data = "SELECT * FROM institute WHERE id='$s_id'";
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
                    <h6>Mob. : '.$row['mob1'].' ,'.$row['mob1'].' </h6>
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
if(isset($_POST['editinst'])){
  $sid = $_POST['sid'];
  $ses = $_POST['ses'];
  $insname = $_POST['insname'];
  $inscode = $_POST['inscode'];

  $prin = $_POST['prin'];
  $hdcl = $_POST['hdcl'];
	$addr1 = $_POST['addr1'];
  $addr2 = $_POST['addr2'];
	$addr3 = $_POST['addr3'];
  $addr4 = $_POST['addr4'];
	
	$mob1 = $_POST['mob1'];
	$mob2 = $_POST['mob2'];
	
  $emailid = $_POST['emailid'];
	$webs = $_POST['webs'];

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


   // $insert_data = "INSERT INTO institute(inst_code,inst_name,sese,addr1,addr2,addr3,addr4,prin,clr,mob1,mob2,ins_email,website,img,head_img)
   // VALUES('$inscode','$insname','$ses','$addr1','$addr2','$addr3','$addr4','$prin','$hdcl','$mob1','$mob2','$emailid','$webs','$folder','$folder1')";

  	$edit_data = "UPDATE institute SET inst_code='$inscode',inst_name='$insname',sese='$ses',
    addr1='$addr1',addr2='$addr2',addr3='$addr3',addr4='$addr4',prin='$prin',clr='$hdcl',
    mob1='$mob1',mob2='$mob2',ins_email='$emailid',website='$webs',img='$folder',head_img='$folder1' WHERE id='$sid'";
  	$run_data = mysqli_query($con,$edit_data);

  	        
    
      if($run_data)
      {
          $_SESSION['status'] = "Data Updated";
            header("Location: institute.php");
        }else{
          $_SESSION['status'] = "Data not Updated";
          header("Location: institute.php");
        }

}

/////  Edit Session Data
if(isset($_POST['edityear'])){
  $sid = $_POST['sid'];
  $ses = $_POST['ses'];
  
  $edit_data = "UPDATE institute SET sese='$ses'WHERE id='$sid'";
  $run_data = mysqli_query($con,$edit_data);
 
      if($run_data)
      {
          $_SESSION['status'] = "Data Updated";
            header("Location: institute_year.php");
        }else{
          $_SESSION['status'] = "Data not Updated";
          header("Location: institute_year.php");
        }
}


?>





