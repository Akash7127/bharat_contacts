<?php   
include("../conn.php");
        $second = "softwaresathi@gmail.com";
	
    	$sql_listing = mysqli_query($con,"select * from registrations where iRegisterId = '$userid'");
    	$row_listing = mysqli_fetch_array($sql_listing);
    	
    	
    	$sql_cat = mysqli_query($con,"select * from category_main where id = '".$row_listing['iCategoryId ']."'");
    	$row_cat = mysqli_fetch_array($sql_cat);
    	
    // 	$sql_cat_sub = mysqli_query($con,"select * from category_sub where id = '".$row_listing['subcategories']."'");
    // 	$row_cat_sub = mysqli_fetch_array($sql_cat_sub);
    	
    	$sql_state = mysqli_query($con,"select * from states where id = '".$row_listing['iStateId']."'");
    	$row_state = mysqli_fetch_array($sql_state);
    	
    	$sql_city = mysqli_query($con,"select * from cities where id = '".$row_listing['iCityId']."'");
    	$row_city = mysqli_fetch_array($sql_city);

    	
    	$category = $row_cat['name'];
    // 	$subcategory = $row_cat_sub['name'];
    	$state = $row_state['name'];
    	$city = $row_city['name'];
    // 	echo "<pre>";
    // 	print_r($row_listing);die;
    	
    	$message = '
    		<!DOCTYPE html>
    			<html>
    				<head>
    					<meta charset="utf-8">
    					<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    					<title>Inquiry : Bharat Contacts</title>
    				</head>
    			<body>
    				<table width="100%">
    					<tbody>
    						<tr>
    							<td style="padding:5px 20px 0 20px" valign="top">
    								<br>
    								<strong><span style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;color:#000;vertical-align:left;line-height:14px">
    								Dear admin </span></strong>
    								<br/>
    								<br/>
    								<span style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;color:#000;vertical-align:left;line-height:14px;text-align: justify;">
    									<p>ID: '.$row_listing["iRegisterId"].'</p>
    									<p>Full Name: '.$row_listing["vFirstName"].$row_listing["vLastName"].'</p>
    									<p>Category : '.$category.'</p>
    									<p>State : '.$state.'</p>
    									<p>City : '.$city.'</p>
    									<p>Email : '.$row_listing["vEmail1"].'</p>
    									<p>Phone : '.$row_listing["vPhone1"].'</p>
    									<p>Website : '.$row_listing["tWebsiteLink"].'</p>
    								
    									<p>Reference (No) : '.$row_listing["vTransactionNo"].'</p>
    									<p>Executive Name : '.$row_listing["vExecutiveName"].'</p>
    								</span>
    								<br/>
    								<span style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;color:#000;vertical-align:left;line-height:14px">
    									<span class="il">System Mail</span><br/>
    									<span class="il">Bharat Contacts</span>
    								</span>
    							</td>
    						</tr>
    					</tbody>
    				</table>
    			</body>
    			</html>
    		';
    		//<p>Main Image : <br/><img src="http://www.bharatads.com/uploaded/'.$row_listing["image_main"].'" style="height:200px"></p>
    		//<p>Extra Images : <br/>'.$extraimg.'</p>
    		
    		$email = $row_listing["vEmail1"];
    // 		echo $message;
    		
    		include '../send_smtp_mail/class.smtp.php';
        	include '../send_smtp_mail/class.phpmailer.php';
        	
        	$mail = new PHPMailer();
        	$mail->IsSMTP(); // telling the class to use SMTP
        	$mail->SMTPDebug  = 0;
        	$mail->SMTPAuth   = false;
        	$mail->Host       = "mail.bharatads.com";
        	$mail->Port       = 26;
        	//$mail->SMTPSecure = "ssl";
        	$mail->Username   = "info@bharatads.com";
        	$mail->Password   = "wRu+Gn5lEf9+";
        	  
        	$mail->setFrom("info@bharatads.com","Bharat Cnts");
        	$mail->AddAddress($email);
        	$mail->AddAddress($second);
        	
        	
        	$mail->IsHTML(true);  
        	  
        	$mail->Subject = 'Inquiry : Bharat Cnts';
            $mail->Body = $message;
            $aReturnArr = array();
        	if(!$mail->Send()){
        		echo 0;
        	}

?>