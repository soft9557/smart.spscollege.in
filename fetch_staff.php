<?php
    include('config.php');
    include('functions.php');
    $k = $_POST['x'];
    $k = trim($k);
    
    //$sql = "select * from student_data where st_adm_no = '{$k}'";
    $sql = "SELECT * FROM staff WHERE s_name='{$k}'";
    $result = mysqli_query($con, $sql);
    while($rows = mysqli_fetch_array($result)){
        $data['stcodes'] = $rows["s_code"];
        $data['stjobs'] = $rows["s_job"];
        $data['stcats'] = $rows["s_cat"];
        
        
    }

echo json_encode($data);

?>