<?php
	include "../conn.php";

	$iStateId = $_REQUEST['iStateId'];
	
	$json = array();
	$sql_query = mysqli_query($con,"select id, name from cities WHERE state_id = '".$iStateId."' order by name asc");
	while($row = mysqli_fetch_assoc($sql_query)){
		$json['data'][] = $row;
	}
	echo json_encode($json);
	mysqli_close($con);
?>