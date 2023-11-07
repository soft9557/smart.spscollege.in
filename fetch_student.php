<?php
    include('config.php');
    include('functions.php');
    $k = $_POST['x'];
    $k = trim($k);
    //$ss = 
    //$sql = "select * from student_data where st_adm_no = '{$k}'";
    $sql = "SELECT student_data.*,fee_data.adm_no as sid, (SELECT SUM(fee_data.paid_fee) FROM fee_data WHERE fee_data.sess='2024-25')as pfee
    FROM fee_data RIGHT JOIN student_data ON student_data.id=fee_data.adm_no 
    WHERE student_data.id='{$k}' GROUP BY student_data.id";
    $result = mysqli_query($con, $sql);
    while($rows = mysqli_fetch_array($result)){
        $data['regno'] = $rows["st_adm_no"];
        $data['stname'] = $rows["st_name"];
        $data['stfath'] = $rows["st_fath"];
        $data['stmoth'] = $rows["st_fee"];
        $data['classid'] = $rows["cl_cd"];
        $data['classname'] = $rows["cl_name"];
        $data['ses'] = $rows["ses"];
        $data['balance'] = $rows["st_fee"]-$rows["pfee"];
        $data['mob'] = $rows["mob1"];
        $data['address'] = $rows["addr1"].','.$rows["addr2"].','.$rows["addr3"];
        
    }

echo json_encode($data);

?>