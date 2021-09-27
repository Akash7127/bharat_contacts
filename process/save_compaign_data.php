<?php
	include "../conn.php";
	include "../functions.php";
	
	extract($_POST);
// 	echo "<pre>";
	// print_r($_POST);
	foreach($_POST as $key=>$val){
		$val = mysqli_real_escape_string($con, $val);
		$_POST[$key] = $val;
	}

    $dStartDate = str_replace('/','-',$dStartDate);
    $dEndDate = str_replace('/','-',$dEndDate);

    $dStartDate = date("Y-m-d",strtotime($dStartDate));
    $tStartTime = date("h:i:s",strtotime($tStartTime));
    $dEndDate = date("Y-m-d",strtotime($dEndDate));
    $tEndTime = date("h:i:s",strtotime($tEndTime));

    if($_FILES['vFileName']['name']!=""){
        $vFileName = time().$_FILES['vFileName']['name'];
        $file_tmp =$_FILES['vFileName']['tmp_name'];

        move_uploaded_file($file_tmp,"../upload/".$vFileName);
    }
	
	$dCreatedDate = getdatetime();
	
	$returnArr = array();
	
	
	$sql_string = "INSERT INTO compaign(
		vProductName, iCustType,dStartDate,tStartTime, vDay, dEndDate, tEndTime, iAdType, vTitle,
		vDescription, vFileName, iAdSize, vCitys, dAmount, dCreatedDate)
	VALUES (
		'$vProductName', '$iCustType','$dStartDate','$tStartTime', '$vDay', '$dEndDate', '$tEndTime', '$iAdType', '$vTitle',
		'$vDescription', '$vFileName', '$iAdSize', '$vCitys', '$dAmount', '$dCreatedDate'
	)";

    // echo $sql_string;
    // exit;
	$sql_res = mysqli_query($con,$sql_string);

	if($sql_res){
	   
        $returnArr['status'] = 200;
		$returnArr['msg'] = 'Compaign has been insert sucessfully.';

	}else{
		$error = mysqli_error($con);
		$returnArr['status'] = 412;
		$returnArr['msg'] = $error;
	}
	echo json_encode($returnArr);
	
	
?>