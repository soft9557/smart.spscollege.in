<?php
include('config.php');
require('vendor/vendor/autoload.php');
    if(isset($_POST['corsid'])){
     $corsid=$_POST['corsid'];
     }

     if($corsid!==''){
        $sub_sql=" cl_cd='$corsid'";
    }


    if(isset($_POST['stid'])){
        $stid=$_POST['stid'];
        }
   
        if($stid!==''){
           $sub_sql=" cl_name='$stid'";
       }
      
   //	$sub_sql=" and party.id=$party_id ";
            //$con=mysqli_connect('localhost','root','','smart_school');
            //$res=mysqli_query($con,"select student_data.*,class_data.class_id as cid,class_data.class_name as cname from student_data,class_data where student_data.cid=class_data.cd $sub_sql order by student_data.st_adm_no");
            $res=mysqli_query($con,"select student_data.*, date_format(st_dob,'%d-%m-%Y') as dob,date_format(adm_date,'%d-%m-%Y') as admdt from student_data where $sub_sql order by id");
            $res1=mysqli_query($con,"select * from institute");
            if(mysqli_num_rows($res1)>0){
                         
                         while($row1=mysqli_fetch_assoc($res1)){
                           // $imagePath="" .$row1['img']. "";
                            $html1="<h2 style='text-align:center'>" .$row1['inst_name']. "</h2>";
                            $html2.="<h5 style='text-align:center'>" .$row1['addr1'].','.$row1['addr2'].','.$row1['addr3'].'-'.$row1['addr4']."</h5>";
                            $html2.="<h5 style='text-align:left'>Student Course with Subject Report-" .$row1['sese']."</h5>";
                            //$html3.="<h4 style='text-align:right'>" .$row1['addr2']."</h4>";

                }
            }              
    

            if(mysqli_num_rows($res)>0){
                
                $html.="<br>";   
                $html='<table border="1" width="100%" cellpading="15" cellspacing="0">';
                
                       // $html.='<tr><th>' .$row1['inst_name']. '</th></tr>';
                        $html.='<thead><tr><th>Sn.</th><th>AdmId</th><th>Reg.No</th><th>RegDate</th><th>CCode</th><th>StName</th>
                        <th>FtName.</th><th>MtName</th><th>Mobile1</th><th>Mobile2</th><th>Subject</th><th>CFee</th></tr></thead>';
                        $count=0;
                         while($row=mysqli_fetch_assoc($res)){
                             //$final_price=$final_price+$row['price'];
                                  
                $html.='<tr><td>'.++$count.'</td>
                <td>'.$row['id'].'</td><td>'.$row['st_adm_no'].'</td><td>'.$row['admdt'].'</td><td>'.$row['cl_cd'].'</td><td>'.$row['st_name'].'</td><td>'.$row['st_fath'].'</td>
                <td>'.$row['st_moth'].'</td>
                <td>'.$row['mob1'].'</td>><td>'.$row['mob2'].'</td><td>'.$row['subject'].'</td><td>'.$row['st_fee'].'</td></tr>';
                }
               // $html.='<tr><th></th><th></th><th></th><th></th><th></th><th></th><th>Total</th><th>'.$final_price.'</th></tr>';
                 
    $html.='</table>';
   // echo $html;
                 
} else{
    $html.='No data found';
    }
$mpdf=new \Mpdf\Mpdf(['format'=>'A4-L']);
$mpdf->SetHTMLHeader($html1);
$mpdf->WriteHTML($html2);
//$mpdf->WriteHTML('<img src="' . $imagePath . '" alt="Student Image">');
$mpdf->WriteHTML($html);
$mpdf->SetHTMLFooter("<p style='text-align:center'>{PAGENO}</p>");
$file='media/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S

?>            
                  
                  
                  
                  
        
                        
                       
                     
               