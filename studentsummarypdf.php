<?php
include('config.php');
require('vendor/vendor/autoload.php');
   
            $res=mysqli_query($con,"SELECT cl_name,cl_cd,COUNT(*) AS counting,
            SUM(CASE WHEN st_sex='Male' THEN 1 ELSE 0 END) AS male,
            SUM(CASE WHEN st_sex='Female' THEN 1 ELSE 0 END) AS female,
            SUM(CASE WHEN st_cat='Gen' THEN 1 ELSE 0 END) AS gen,
            SUM(CASE WHEN st_cat='OBC' THEN 1 ELSE 0 END) AS obc,
            SUM(CASE WHEN st_cat='SC' THEN 1 ELSE 0 END) AS sc,
            SUM(CASE WHEN st_cat='ST' THEN 1 ELSE 0 END) AS st,
            SUM(CASE WHEN st_cat='MINORITY' THEN 1 ELSE 0 END) AS mino
            FROM student_data
            GROUP BY cl_cd");
            $res1=mysqli_query($con,"select * from institute");
            if(mysqli_num_rows($res1)>0){
                         
                         while($row1=mysqli_fetch_assoc($res1)){
                           // $imagePath="" .$row1['img']. "";
                            $html1="<h2 style='text-align:center'>" .$row1['inst_name']. "</h2>";
                            $html2.="<h5 style='text-align:center'>" .$row1['addr1'].', '.$row1['addr2'].', '.$row1['addr3'].'- '.$row1['addr4']."</h5>";
                            $html2.="<h5 style='text-align:left'>Student Summary Report-" .$row1['sese']."</h5>";
                            //$html3.="<h4 style='text-align:right'>" .$row1['addr2']."</h4>";

                }
            }              

            if(mysqli_num_rows($res)>0){
                $html='<table border="1" width="100%" cellpading="10" cellspacing="0">';
                        
                        $html.='<thead><tr><th>Sn.</th><th>Course</th><th>Course Code</th><th>Male</th><th>Female</th><th>GEN</th><th>OBC</th><th>SC</th><th>ST</th><th>MINO.</th><th>Total</th></tr></thead>';
                        $count=0;
                         while($row=mysqli_fetch_assoc($res)){
                             $tot=$tot+$row['counting'];
                             $mal=$mal+$row['male'];
                             $femal=$femal+$row['female'];
                             $gen=$gen+$row['gen'];
                             $obc=$obc+$row['obc'];
                             $sc=$sc+$row['sc'];
                             // $st=$st+$row['st'];
                            //$mino=$mino+$row['mino'];
                       
                $html.='<tr><td>'.++$count.'</td><td>'.$row['cl_name'].'</td><td>'.$row['cl_cd'].'</td><td>'.$row['male'].'</td><td>'.$row['female'].'</td><td>'.$row['gen'].'</td><td>'.$row['obc'].'</td><td>'.$row['sc'].'</td><td>'.$row['st'].'</td><td>'.$row['mino'].'</td><td>'.$row['counting'].'</td></tr>';
            }
               $html.='<tr><th></th><th></th><th>G.Total:</th><th>'.$mal.'</th><th>'.$femal.'</th><th>'.$gen.'</th><th>'.$obc.'</th><th>'.$sc.'</th><th></th><th></th><th>'.$tot.'</th></tr>';
                
             
    $html.='</table>';
                  
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
                  
                  
                  
                  
        
                        
                       
                     
               