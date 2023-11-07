<?php
include('config.php');
require('vendor/vendor/autoload.php');
    if(isset($_POST['from'])){
        $from=$_POST['from'];
        $f=date("d-m-Y", strtotime($from));
    }
    if(isset($_POST['to'])){
        $to=$_POST['to'];
        $t=date("d-m-Y", strtotime($to)); 
    }
    
    if($from!=='' && $to!=''){
        $sub_sql1=" paid_date between '$from' and '$to' ";
        $sub_sql2=" rece_date between '$from' and '$to' ";
        $sub_sql3=" pay_date between '$from' and '$to' ";
        $sub_sql4=" paid_date between '$from' and '$to' ";
    }
      
   //	$sub_sql=" and party.id=$party_id ";
            //$con=mysqli_connect('localhost','root','','smart_school');
            //$res=mysqli_query($con,"select student_data.*,class_data.class_id as cid,class_data.class_name as cname from student_data,class_data where student_data.cid=class_data.cd $sub_sql order by student_data.st_adm_no");
            //$res=mysqli_query($con,"select * from fee_data where $sub_sql order by id");
           
            $res=mysqli_query($con,"SELECT date_format(paid_date,'%d-%m-%Y') as date,fee_from as ledger,st_name as narr,id as slip,paid_fee as credit,pay_amt as debit FROM fee_data where $sub_sql1 
            UNION SELECT date_format(rece_date,'%d-%m-%Y') as date,rece_from as ledger,rece_nar as narr,id as slip,rece_amt as credit,pay_amt as debit FROM received where $sub_sql2
            UNION SELECT date_format(pay_date,'%d-%m-%Y') as date,pay_to as ledger,pay_nar as narr,id as slip,rec_amt as credit,pay_amt as debit  FROM payment where $sub_sql3
            UNION SELECT date_format(paid_date,'%d-%m-%Y') as date,ledger as ledger,stf_name as narr,id as slip,sal_rec as credit,sal_paid as debit  FROM salary where $sub_sql4 ");
           
           
            $res1=mysqli_query($con,"select * from institute");
            if(mysqli_num_rows($res1)>0){
                         
                         while($row1=mysqli_fetch_assoc($res1)){
                           // $imagePath="" .$row1['img']. "";
                            $html1="<h2 style='text-align:center'>" .$row1['inst_name']. "</h2>";
                            $html2.="<h5 style='text-align:center'>" .$row1['addr1'].', '.$row1['addr2'].', '.$row1['addr3'].'- '.$row1['addr4']."</h5>";
                            $html2.="<h6 style='text-align:center'>DayBook- " .$row1['sese']."( Date From - " .$f." To - " .$t.")"."</h5>";
                            //$html3.="<h4 style='text-align:right'>" .$row1['addr2']."</h4>";

                }
            }              

            if(mysqli_num_rows($res)>0){
                $html='<table border="1" width="100%" cellpading="8" cellspacing="0">';
                        
                        $html.='<thead><tr><th>Sn.</th><th>Date</th><th>Ledger</th><th>Narration</th><th>Vou/Slip No.</th><th>Credit</th><th>Debit</th></tr></thead>';
                        $count=0;
                         while($row=mysqli_fetch_assoc($res)){
                             $debit=$debit+$row['debit'];
                             $credit=$credit+$row['credit'];
                $html.='<tr><td>'.++$count.'</td><td>'.$row['date'].'</td><td>'.$row['ledger'].'</td><td>'.$row['narr'].'</td><td>'.$row['slip'].'</td><td>'.$row['credit'].'</td><td>'.$row['debit'].'</td></tr>';
                }
                $html.='<tr><th></th><th></th><th></th><th></th><th>Total</th><th>'.$credit.'</th><th>'.$debit.'</th></tr>';
                 
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
                  
                  
                  
                  
        
                        
                       
                     
               