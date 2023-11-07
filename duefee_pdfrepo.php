<?php
include('config.php');
require('vendor/vendor/autoload.php');
    if(isset($_POST['corsid'])){
     $corsid=$_POST['corsid'];
     }

     if($corsid!==''){
        $cours="$corsid";
        $sub_sql=" student_data.cl_cd='$corsid'";
    }


    if(isset($_POST['stid'])){
        $stid=$_POST['stid'];
        }
   
        if($stid!==''){
            $cours="$stid";
           $sub_sql=" student_data.cl_name='$stid'";
       }
      
   //	$sub_sql=" and party.id=$party_id ";
            //$con=mysqli_connect('localhost','root','','smart_school');
            //$res=mysqli_query($con,"select student_data.*,class_data.class_id as cid,class_data.class_name as cname from student_data,class_data where student_data.cid=class_data.cd $sub_sql order by student_data.st_adm_no");
            $res=mysqli_query($con," SELECT student_data.*,fee_data.adm_no as sid, SUM(fee_data.paid_fee) as pfee FROM fee_data RIGHT JOIN student_data ON student_data.id=fee_data.adm_no WHERE $sub_sql GROUP BY student_data.id");
            $res1=mysqli_query($con,"select * from institute");
            if(mysqli_num_rows($res1)>0){
                         
                         while($row1=mysqli_fetch_assoc($res1)){
                           // $imagePath="" .$row1['img']. "";
                            $html1="<h2 style='text-align:center'>" .$row1['inst_name']. "</h2>";
                            $html2.="<h5 style='text-align:center'>" .$row1['addr1'].', '.$row1['addr2'].', '.$row1['addr3'].'- '.$row1['addr4']."</h5>";
                            $html2.="<h5 style='text-align:left'>Student Due-Fee Report- " .$row1['sese']." ( Course - " .$cours." )"."</h5>";
                            //$html3.="<h4 style='text-align:right'>" .$row1['addr2']."</h4>";

                }
            }              

            if(mysqli_num_rows($res)>0){
                        $html='<table border="1" width="50%" font-size="20px" cellpading="8" cellspacing="0">';
                        $html.='<thead><tr><th>Sn.</th><th>AdmId</th><th>RegId</th><th>StName</th><th>FtName</th><th>Mob.No1.</th><th>Mob.No2.</th><th>CCode</th><th>CoFee</th><th>PaidFee</th><th>DueFee</th><th>Admis.By</th></tr></thead>';
                        $count=0;
                         while($row=mysqli_fetch_assoc($res)){
                             $duefee=$row['st_fee']-$row['pfee'];
                $html.='<tr><td>'.++$count.'</td><td>'.$row['id'].'</td><td>'.$row['st_adm_no'].'</td><td>'.$row['st_name'].'</td><td>'.$row['st_fath'].'</td><td>'.$row['mob1'].'</td><td>'.$row['mob2'].'</td><td>'.$row['cl_cd'].'</td><td>'.$row['st_fee'].'</td><td>'.$row['pfee'].'</td><td>'.$duefee.'</td><td>'.$row['install_fee'].'</td></tr>';
                }
               // $html.='<tr><th></th><th></th><th></th><th></th><th></th><th></th><th>Total</th><th>'.$final_price.'</th></tr>';
                 
    $html.='</table>';
   // echo $html;
   
                 
} else{
    $html.='No data found';
    }
$mpdf=new \Mpdf\Mpdf();
$mpdf->SetHTMLHeader($html1);
$mpdf->WriteHTML($html2);
$mpdf->WriteHTML($html);
$mpdf->SetHTMLFooter("<p style='text-align:center'>{PAGENO}</p>");
$file='media/'.time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S

?>            
                  
                  
                  
                  
        
                        
                       
                     
               