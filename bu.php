<?php
include('config.php');
//include('includes/header.php');
//include('includes/topbar.php');
//include('includes/sidebar.php');
//include('includes/functions.php');
//checkUser();
//userArea();
include_once('Mysqldump/Mysqldump.php');
include('smtp/PHPMailerAutoload.php');

          $res1=mysqli_query($con,"select * from institute");
            if(mysqli_num_rows($res1)>0){
                         
                         while($row1=mysqli_fetch_assoc($res1)){
                           $iname=$row1['inst_name'];
                           $imail=$row1['ins_email'];
                       }
            }        


$dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname=smart_school', 'root', '');
$f=date('d-m-Y');
$dump->start("sql_dump/$f.sql");

//echo smtp_mailer('softlabtech.it@gmail.com','SmartInstitute Backup','Backup',"sql_dump/$f.sql");
//function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	//$mail->SMTPDebug = 2; 
	$mail->Username = "softlabtech.it@gmail.com";
  $mail->Password="ahwkrfquumcvxgmf";
	//$mail->Password = "password";
	$mail->SetFrom("softlabtech.it@gmail.com");
	//$mail->Subject = $subject;
  $mail->Subject = $iname ."Backup".$f;
	//$mail->Body =$msg;
  $mail->Body ="Please find the attachment of College backup File";
  $mail->AddAttachment("sql_dump/$f.sql");
	//$mail->AddAddress($to);
  $mail->AddAddress("softlabtech.it@gmail.com");
  $mail->AddAddress($imail);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		//return 'Sent';
	}

  if($mail)
  {
      $_SESSION['status'] = "Backup Over & Send to Registered Email ID.....";
        header("Location: backupover.php");
    }else{
      $_SESSION['status'] = "Database not backup send";
      header("Location: backupover.php");
    }

//}
?>
<?php include('includes/script.php'); ?>
 <?php include('includes/footer.php'); ?>
</body>
</html>


