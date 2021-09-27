<?php
	include "../conn.php";

	$iCategoryId = $_REQUEST['iCategoryId'];
	
	$json = array();
	$sql_query = mysqli_query($con,"select id, name from category_sub WHERE categoryid = '".$iCategoryId."' order by name asc");
	while($row = mysqli_fetch_assoc($sql_query)){
		$json['data'][] = $row;
	}
	echo json_encode($json);
	mysqli_close($con);
?>