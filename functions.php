<?php
function prx($data){
	echo '<pre>';
	print_r($data);
	die();
}

function get_safe_value($data){
	global $con;
	if($data){
		return mysqli_real_escape_string($con,$data);
	}
}

function redirect($link){
	?>
	<script>
	window.location.href="<?php echo $link?>";
	</script>
	<?php
}

function checkUser(){
	if(isset($_SESSION['UID']) && $_SESSION['UID']!=''){
		
	}else{
		redirect('index.php');
	}
}


function getCategory($category_id='',$page=''){
	global $con;
	$res=mysqli_query($con,"select * from category order by name asc");
	$fun="required";
	if($page=='vreports'){
		//$fun="onchange=change_cat()";
		$fun="";
	}
	$html='<select $fun name="category_id" id="category_id"  class="form-control">';
		$html.='<option value="">Select Vehical</option>';
		
		while($row=mysqli_fetch_assoc($res)){
			if($category_id>0 && $category_id==$row['id']){
				$html.='<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
			}else{
				$html.='<option value="'.$row['id'].'">'.$row['name'].'</option>';	
			}
			
		}
		
	$html.='</select>';
	return $html;
	
}

function getDriver($driver_id='',$page=''){
	global $con;
	$res=mysqli_query($con,"select * from driver order by name asc");
	$fun="required";
	if($page=='dreports'){
		//$fun="onchange=change_cat()";
		$fun="";
	}
	$html='<select $fun name="driver_id" id="driver_id"  class="form-control">';
		$html.='<option value="">Select Driver</option>';
		
		while($row=mysqli_fetch_assoc($res)){
			if($driver_id>0 && $driver_id==$row['id']){
				$html.='<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
			}else{
				$html.='<option value="'.$row['id'].'">'.$row['name'].'</option>';	
			}
			
		}
		
	$html.='</select>';
	return $html;
	
}

function getParty($party_id='',$page=''){
	global $con;
	$res=mysqli_query($con,"select * from party order by name asc");
	$fun="required";
	if($page=='preports'){
		//$fun="onchange=change_cat()";
		$fun="";
	}
	$html='<select $fun name="party_id" id="party_id"  class="form-control">';
		$html.='<option value="">Select Party</option>';
		
		while($row=mysqli_fetch_assoc($res)){
			if($party_id>0 && $party_id==$row['id']){
				$html.='<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
			}else{
				$html.='<option value="'.$row['id'].'">'.$row['name'].'</option>';	
			}
			
		}
		
	$html.='</select>';
	return $html;
	
}

function getClass($classfee="",$page=''){
	global $con;
	$res=mysqli_query($con,"select * from class_data order by class_id asc");
	$fun="required";
	if($page=='studentreport.php'){
		//$fun="onchange=change_cat()";
		$fun="";
	}
	$html='<select $fun name="class_id" id="class_id"  class="form-control">';
		$html.='<option value="">Select Class</option>';
		
		while($row=mysqli_fetch_assoc($res)){
			if($classfee>0 && $classfee==$row['cd']){
				$html.='<option value="'.$row['cd'].'" selected>'.$row['class_id'].'</option>';
			}else{
				$html.='<option value="'.$row['cd'].'">'.$row['class_id'].'</option>';	
			}
			
		}
		
	$html.='</select>';
	return $html;
	
}


function adm_search(){




}









function getDashboardExpense($type){
	global $con;
	$today=date('Y-m-d');
	if($type=='today'){
		$sub_sql=" and expense_date='$today'";
		$from=$today;
		$to=$today;
	}
	elseif($type=='yesterday'){
		$yesterday=date('Y-m-d',strtotime('yesterday'));
		$sub_sql=" and expense_date='$yesterday'";
		$from=$yesterday;
		$to=$yesterday;
	}elseif($type=='week' || $type=='month' || $type=='year'){
		$from=date('Y-m-d',strtotime("-1 $type"));
		$sub_sql=" and expense_date between '$from' and '$today'";
		$to=$today;
	}else{
		$sub_sql=" ";
		$from='';
		$to='';
	}
	
	$res=mysqli_query($con,"select sum(totalexp) as totalexp from expense where added_by='".$_SESSION['UID']."' $sub_sql");
	
	$row=mysqli_fetch_assoc($res);
	$p=0;
	$link="";
	if($row['totalexp']>0){
		$p=$row['totalexp'];
		$link="&nbsp;<a href='dashboard_report.php?from=".$from."&to=".$to."' target='_blank' class='detail_link'>Details</a>";
	}
	
	return $p.$link;	
}


function getDashboardIncome($type){
	global $con;
	$today=date('Y-m-d');
	if($type=='today'){
		$sub_sql=" and income_date='$today'";
		$from=$today;
		$to=$today;
	}
	elseif($type=='yesterday'){
		$yesterday=date('Y-m-d',strtotime('yesterday'));
		$sub_sql=" and income_date='$yesterday'";
		$from=$yesterday;
		$to=$yesterday;
	}elseif($type=='week' || $type=='month' || $type=='year'){
		$from=date('Y-m-d',strtotime("-1 $type"));
		$sub_sql=" and income_date between '$from' and '$today'";
		$to=$today;
	}else{
		$sub_sql=" ";
		$from='';
		$to='';
	}
	
	$res=mysqli_query($con,"select sum(totalinc) as totalinc from income where added_by='".$_SESSION['UID']."' $sub_sql");
	
	$row=mysqli_fetch_assoc($res);
	$p=0;
	$link="";
	if($row['totalinc']>0){
		$p=$row['totalinc'];
		$link="&nbsp;<a href='dasboard_income.php?from=".$from."&to=".$to."' target='_blank' class='detail_link'>Details</a>";
	}
	
	return $p.$link;	
}


function adminArea(){
	if($_SESSION['UROLE']!='Admin'){
		redirect('index.php');
	}
}

function managerArea(){
	if($_SESSION['UROLE']!='Manager'){
		redirect('index.php');
	}
}

function userArea(){
	if($_SESSION['UROLE']!='User' ){
		redirect('index.php');
	}
}


function deniedArea(){
	if($_SESSION['UROLE']!='Manager'){
		redirect('accessdenied.php');
	}
}

?>