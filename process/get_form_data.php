<?php
	include "../conn.php";
	include "../functions.php";
	
	extract($_POST);
	foreach($_POST as $key=>$val){
		$val = mysqli_real_escape_string($con, $val);
		$_POST[$key] = $val;
	}
	
	/* $vCategoryName = $_POST['vCategoryName'];
	$vInitial = $_POST['vInitial'];
	$tDescription = $_POST['tDescription']; */
	$dCreatedDate = getdatetime();
	
	
	$returnArr = array();
	
	$check_avai = "SELECT iRegisterId FROM registrations WHERE vPhone1 = '".$InputPhoneNumber."' OR vPhone2 = '".$InputPhoneNumber."' OR vPhone3 = '".$InputPhoneNumber."'";
	$sqlCurr = mysqli_query($con,$check_avai);
	$rowCurr = mysqli_fetch_assoc($sqlCurr);
	$iRegisterIdCurr = $rowCurr['iRegisterId'];
	if(mysqli_affected_rows($con) == 0){
		$returnArr['flg'] = 412;
		$returnArr['msg'] = 'Your mobile number not found. Kindly register!';
		echo json_encode($returnArr);
		exit;
	}
	
	$sql_query = mysqli_query($con,"
		SELECT
			CONCAT(vFirstName, ' ', vLastName) as vFullName,
			vBusinessName,
			ct.name as vState,
			st.name as vCity,
			rg.vPhone1,
			rg.vPhone2,
			rg.vPhone3,
			rg.vEmail1,
			rg.vEmail2,
			rg.vEmail3,
			rg.tWebsiteLink
		FROM
			registrations as rg
			LEFT JOIN cities as ct ON ct.id = rg.iCityId
			LEFT JOIN states as st ON st.id = rg.iStateId
		WHERE
			iRegisterId = '".$iId."'
	");
	$row = mysqli_fetch_assoc($sql_query);
	
	mysqli_query($con,"UPDATE registrations SET iThisWeekCount = iThisWeekCount + 1 WHERE iRegisterId = '".$iId."'");
	
	$error = mysqli_error($con);
	$returnArr['status'] = 200;
	$returnArr['data'] = $row;
	
	mysqli_query($con,"INSERT INTO visit_history(iFromUserId,iToUserId,dCreatedDate) VALUES('$iRegisterIdCurr','$iId','$dCreatedDate')");
	
	echo json_encode($returnArr);
	
?>