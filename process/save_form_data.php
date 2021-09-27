<?php
	include "../conn.php";
	include "../functions.php";
	
	extract($_POST);
// 	echo "<pre>";
// 	print_r($_POST);die;
	foreach($_POST as $key=>$val){
		$val = mysqli_real_escape_string($con, $val);
		$_POST[$key] = $val;
	}
	
	/* $vCategoryName = $_POST['vCategoryName'];
	$vInitial = $_POST['vInitial'];
	$tDescription = $_POST['tDescription']; */
	$dCreatedDate = get_date();
	
	
	$returnArr = array();
	
	/* $check_dup = "SELECT iCategoryId FROM category_model WHERE vCategoryName = '".$vCategoryName."'";
	mysqli_query($con,$check_dup);
	if(mysqli_affected_rows($con) > 0){
		$returnArr['flg'] = 0;
		$returnArr['msg'] = 'data name already exist.';
		echo json_encode($returnArr);
		exit;
	} */
	$vPassword = md5($vPassword);
	
	$sql_string = "INSERT INTO registrations(
		vFirstName, vLastName,vUserName,vPassword, vBusinessName, iCategoryId, iSubCategoryId, iStateId, iCityId,
		vPhone1, vPhone2, vPhone3, vEmail1, vEmail2, vEmail3, tWebsiteLink, vKeywords, vExecutiveName, vTransactionNo, dCreatedDate,eStatus)
	VALUES (
		'$vFirstName', '$vLastName','$vUserName','$vPassword', '$vBusinessName', '$iCategoryId', '$iSubCategoryId', '$iStateId', '$iCityId',
		'$vPhone1', '$vPhone2', '$vPhone3', '$vEmail1', '$vEmail2', '$vEmail3', '$tWebsiteLink', '$vKeywords', '$vExecutiveName' , '$vTransactionNo', '$dCreatedDate','Approved'
	)"; 
	$sql_res = mysqli_query($con,$sql_string);
	$userid = mysqli_insert_id($con);

	if($sql_res){
	    // include("send_mail.php");
	   
        $returnArr['status'] = 200;
		$returnArr['msg'] = 'Your registration successfully done.oidjfhoijxfoig';
		
		$vCategoryTypeArr = explode(',',$vCategoryType);
		foreach($vCategoryTypeArr as $vCategoryType){
			mysqli_query($con,"INSERT INTO category_type (category_type) values('".$vCategoryType."')");
		}

	}else{
		$error = mysqli_error($con);
		$returnArr['status'] = 412;
		$returnArr['msg'] = $error;
	}
	echo json_encode($returnArr);
	
	
?>