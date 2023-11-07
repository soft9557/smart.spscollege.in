<?php
    include('config.php');
    include('functions.php');
    $k = $_POST['x'];
    $k = trim($k);
    $sql = "select * from class_data where class_id = '{$k}'";
    $result = mysqli_query($con, $sql);
    while($rows = mysqli_fetch_array($result)){
        $data['fee'] = $rows["class_fee"];
        $data['name'] = $rows["class_name"];
        $data['sub'] = $rows["subject"];
    }

echo json_encode($data);

?>