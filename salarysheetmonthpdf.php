<?php
include('config.php');
require('vendor/vendor/autoload.php');
    if(isset($_POST['monthof'])){
     $corsid=$_POST['monthof'];
     }

     if($corsid!==''){
        $sub_sql=" monthof='$corsid'";
    }


    if(isset($_POST['emp'])){
        $stid=$_POST['emp'];
        }
   
        if($stid!==''){
           $sub_sql=" stf_name='$stid'";
       }
      
   //	$sub_sql=" and party.id=$party_id "; date_format(rece_date,'%d-%m-%Y') as date
            //$con=mysqli_connect('localhost','root','','smart_school');
            //$res=mysqli_query($con,"select student_data.*,class_data.class_id as cid,class_data.class_name as cname from student_data,class_data where student_data.cid=class_data.cd $sub_sql order by student_data.st_adm_no");
            $res=mysqli_query($con,"select salary.*,date_format(paid_date,'%d-%m-%Y') as date from salary where $sub_sql order by monthof");
            $res1=mysqli_query($con,"select * from institute");
            if(mysqli_num_rows($res1)>0){
                         
                         while($row1=mysqli_fetch_assoc($res1)){
                           // $imagePath="" .$row1['img']. "";
                            $html1="<h2 style='text-align:center'>" .$row1['inst_name']. "</h2>";
                            $html2.="<h5 style='text-align:center'>" .$row1['addr1'].','.$row1['addr2'].','.$row1['addr3'].'-'.$row1['addr4']."</h5>";
                            $html2.="<h5 style='text-align:left'>Employee Salary Sheet</h5>";
                            //$html3.="<h4 style='text-align:right'>" .$row1['addr2']."</h4>";

                }
            }              

            if(mysqli_num_rows($res)>0){
                $html='<table border="1" width="100%" cellpading="10" cellspacing="0">';
                        
                        $html.='<thead><tr><th>Sn.</th><th>EmpId</th><th>EmpName</th><th>Designation</th><th>Month</th><th>W.Days</th><th>PayType</th><th>Salary</th><th>Date</th></tr></thead>';
                        $count=0;
                         while($row=mysqli_fetch_assoc($res)){
                             $final_price=$final_price+$row['sal_paid'];
                $html.='<tr><td>'.++$count.'</td><td>'.$row['stf_code'].'</td><td>'.$row['stf_name'].'</td><td>'.$row['stf_cat'].'</td><td>'.$row['monthof'].'</td><td>'.$row['wo_day'].'</td><td>'.$row['pay_type'].'</td><td>'.$row['sal_paid'].'</td><td>'.$row['date'].'</td></tr>';
                }
                $html.='<tr><th></th><th></th><th></th><th></th><th></th><th></th><th>Total Paid :</th><th>'.$final_price.'</th></tr>';
                
                 
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
                  
                  
                  
                  
        
                        
                       
                     
               