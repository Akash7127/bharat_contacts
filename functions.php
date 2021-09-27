<?php
	function getdatetime(){
		$dateTime = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
		$mysqldate = $dateTime->format("Y-m-d H:i:s");
		return $mysqldate;
	}
	
	function get_date(){
		$dateTime = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
		$mysqldate = $dateTime->format("Y-m-d");
		return $mysqldate;
	}
	
	
	
	function datetimeToDis($dateTime){
		if($dateTime != '0000-00-00 00:00:00'){
			return date('d/m/Y h:i A',strtotime($dateTime));
		}
		return '';
	}

	
?>