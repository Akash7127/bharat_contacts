<?php
	error_reporting(E_ERROR);
	
	$con = mysqli_connect("localhost","tabletsg_bhaCont","EUkfEyx88P~}","tabletsg_bharatcontacts");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	mysqli_query ($con,"set character_set_results='utf8'");
	mysqli_query($con,"SET NAMES utf8");
	date_default_timezone_set('Asia/Kolkata');
	
	define('SITE_URL','http://khodaldesign.com/stock/');
?>