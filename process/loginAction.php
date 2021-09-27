<?php
    include "../conn.php";
	include "../functions.php";

    extract($_POST);
	foreach($_POST as $key=>$val){
		$val = mysqli_real_escape_string($con, $val);
		$_POST[$key] = $val;
	}

    if($_POST['action'] == "login"){

        $rtnArr = array();
        $selUser = mysqli_query($con,"SELECT iRegisterId,vFirstName,vLastName FROM registrations WHERE vUserName = '".$vUserName."' AND vPassword = '".md5($vPassword)."' AND eStatus = 'Approved'");
        
        if(mysqli_num_rows($selUser) > 0){
            $rowUser = mysqli_fetch_assoc($selUser);
            $_SESSION['Admin_UserID'] = $rowUser['iRegisterId'];
            $_SESSION['Cur_fname'] = $rowUser['vFirstName'];
            $_SESSION['Cur_Lastname'] = $rowUser['vLastName'];
            $rtnArr = array("status"=>200,"msg"=>"Login Successfully.");
        }else{
            $rtnArr = array("status"=>412,"msg"=>"Invalid Username & Password.");
        }
        // print_r($rowUser);
        echo json_encode($rtnArr);
        exit;
    }else if($_REQUEST['action'] == "logOut"){
        session_destroy();
        $rtnArr = array("status"=>200,"msg"=>"Log out Successfully.");
        echo json_encode($rtnArr);
        exit;
    }
?>