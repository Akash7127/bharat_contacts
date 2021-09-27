<?php
	include "conn.php";
	include "functions.php";
	
	require 'send_smtp_mail/class.phpmailer.php';
	require 'send_smtp_mail/class.smtp.php';

	$sql_query = mysqli_query($con,"SELECT iRegisterId,vEmail1,CONCAT(vFirstName,' ',vLastName) as vFullName FROM registrations WHERE iThisWeekCount > 0");
	while($rowSe = mysqli_fetch_assoc($sql_query)){
		$iRegisterId = $rowSe['iRegisterId'];
		$vSendMailId = $rowSe['vEmail1'];
		$vFullName = $rowSe['vFullName'];
		
		$body = '';
		$aHisIds = array();
		$sqlHis = mysqli_query($con,"
			SELECT
				vih.iVisitId,
				reg.vBusinessName,
				CONCAT(vFirstName,' ',vLastName) as vContactPerson,
				CONCAT(ct.name,' ',st.name) as vAddress,
				CONCAT(reg.vPhone1,', ',reg.vPhone2,', ',reg.vPhone3) as vPhoneNo,
				CONCAT(reg.vEmail1,', ',reg.vEmail2,', ',reg.vEmail3) as vEmails,
				reg.tWebsiteLink,
				vih.dCreatedDate
			FROM
				visit_history as vih
				LEFT JOIN registrations as reg ON reg.iRegisterId = vih.iFromUserId
				LEFT JOIN cities as ct ON ct.id = reg.iCityId
				LEFT JOIN states as st ON st.id = reg.iStateId
			WHERE
				vih.iToUserId = '".$iRegisterId."' AND iIsMailsSent = 0
			GROUP BY vih.iFromUserId
		");
		while($rowHis = mysqli_fetch_assoc($sqlHis)){
			$iVisitId = $rowHis['iVisitId'];
			$dCreatedDate = datetimeToDis($rowHis["dCreatedDate"]);
			$body .= '
				<div style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;color:#000;line-height:14px;text-align: justify; padding:5px 20px 0 20px">
					<p>Business Name: '.$rowHis["vBusinessName"].'</p>
					<p>Contact Person : '.$rowHis["vContactPerson"].'</p>
					<p>City/State: '.$rowHis["vAddress"].'</p>
					<p>Phone Number : '.$rowHis["vPhoneNo"].'</p>
					<p>Emails : '.$rowHis["vEmails"].'</p>
					<p>Website : '.$rowHis["tWebsiteLink"].'</p>
					<p>View Time : '.$dCreatedDate.'</p>
					<br/>
				<hr/>
				<br/>
				</div>
				
			';
			array_push($aHisIds,$iVisitId);
		}
		
		$message = '
		<!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
					<title>Bharat Contacts</title>
				</head>
			<body>
			<table width="100%">
			<tbody>
				<tr>
					<td style="padding:5px 20px 0 20px" valign="top">
						<br>
						<span style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;color:#000;vertical-align:left;line-height:14px">
						<strong>Dear '.$vFullName.',</strong> your profile viewer in last week at <a target="_blank" href="http://bharatcontacts.com/"><strong>Bharat Contacts</strong></a> </span>
						
						'.$body.'
		
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
		
		$mail = new PHPMailer();
		try {
			//Server settings
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPDebug = 0;
			$mail->SMTPAuth = true;
			//$mail->SMTPSecure = 'ssl';
			//$mail->Host = "smtp.gmail.com";
			$mail->Host = "mail.bharatcontacts.com";
			$mail->Port = 26;
			$mail->IsHTML(true);
			$mail->Username = "info@bharatcontacts.com";
			$mail->Password = "tK2xq[KGbGEz";
			
			$mail->Subject = "Profile Viwers - Bharat Contacts";
			$mail->Body = $message;
			
			//Recipients
			$mail->setFrom('info@bharatcontacts.com', 'Bharat Contacts');
			$mail->addAddress($vSendMailId, '');
			$mail->addReplyTo('info@bharatcontacts.com', 'Bharat Contacts');
			
			//Attachments
			/* $mail->addAttachment('/var/tmp/file.tar.gz');
			$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); */

			if($mail->send()){
				$vHisIds = implode(',',$aHisIds);
				mysqli_query($con,"UPDATE visit_history SET iIsMailsSent = '1' WHERE iVisitId IN(".$vHisIds.") ");
				mysqli_query($con,"UPDATE registrations SET iThisWeekCount = '0' WHERE iRegisterId = ".$iRegisterId." ");
			}
			
		} catch (Exception $e) {
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
	}
?>