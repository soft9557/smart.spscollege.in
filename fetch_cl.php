<?php
    include('config.php');
    include('functions.php');
    $k = $_POST['x'];
    $k = trim($k);
    //$ss = 
    $sql = "select ses,st_fee,count(id)as idd from student_data where cl_cd = '{$k}'";
    //$sql = "SELECT DISTINCT cl_cd FROM student_data ORDER BY cl_cd ASC ";
    $result = mysqli_query($con, $sql);
    while($rows = mysqli_fetch_array($result)){
             $data['ses'] = $rows["ses"];
             $data['stfee'] = $rows["st_fee"];
             $data['cid'] = $rows["idd"];
          }

echo json_encode($data);

?>