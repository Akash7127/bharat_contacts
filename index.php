<?php
include("conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="services" content="Provides contacts of businesses in Bharat, find business contacts in Bharat, Contacts directory of Bharat, Business directory, Business Listing services, Leading Language Training Centres+, car driving classes in+, vehicle driving training in+, Schools in+,International school in+, colleges in+, Yoga classes in+,Tours and Travels in+,Painters in+,Tutions in+,Classes in+,Realestate agents in+,Home deliver in+,Jewelry shop in+,Dance classes in+, music classes in+, Ashram in+, Couriers in+, Cloth shop in+, Gyms and fitness centers in+, Interior designers in+, Pathology labs in+, Wedding Halls in+" />
	<meta name="cities" content="Bangalore, Chennai,Delhi,Hyderabad,Kolkata,Mumbai,Ahmedabad,Pune,Agra,Ajmer,Aligarh,Amravati,Amritsar,Asansol,Aurangabad,Bareilly,Belgaum,Bhavnagar,Bhiwandi,Bhopal,Bhubaneswar,Bikaner,Bokaro Steel City,Chandigarh,Nagpur,Cuttack,Dehradun,Dhanbad,Bhilai,Durgapur,Erode,Faridabad,Firozabad,Ghaziabad,Gorakhpur,Gulbarga,Guntur,Gwalior,Gurgaon,Guwahati,Hubli–Dharwad, Haridwar,
Indore,Jabalpur,Jaipur,Jalandhar,Jammu,Jamnagar,Jamshedpur,Jhansi,Jodhpur,Kakinada,Kannur,Kanpur,Kochi,Kottayam,Kolhapur,Kollam,Kota,Kozhikode,Kurnool,Ludhiana,Lucknow,Madurai,Malappuram,Mathura,Goa,Mangalore,Meerut,Moradabad,Mysore,Nanded,Nashik,Nellore,Noida,Palakkad,Patna,Pondicherry,Allahabad,Raipur,Rajkot,Rajahmundry,Ranchi,Rishikesh,Rourkela,Salem,Sangli,Siliguri,Solapur,Srinagar,
Thiruvananthapuram,Thrissur,Tiruchirappalli,Tirupati,Tirunelveli,Tiruppur,Tiruvannamalai,Ujjain,Bijapur,Vadodara,Varanasi,Vasai-Virar City,Vijayawada,Vellore,Warangal,Bilaspur,Hamirpur,Perinthalmanna,Purulia,Shimla,Tirur,Surat,Vishakhapatnam," />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>BharatContacts-Find business contacts in Bharat</title>
	<!--<script src="js/jquery-1.11.3.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<link href="css/select2.min.css" rel="stylesheet" />

	<!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
	<link href="css/custom.css" rel="stylesheet">
	<link href="css/login.css" rel="stylesheet">


	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></sccopyript>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<style>
		footer {
			position: fixed;
		}
	</style>
</head>

<body>

	<!-- Content -->
	<div class="container" id="middle_section">
		<div class="div-center">
			<div class="content">
				<h3>Login</h3>
				<hr />
				<div id="alertData"></div>
				<form id="form-details" method="post">
					<input type="hidden" name="action" value="login" />
					<div class="form-group">
						<label for="vUserName">User name</label>
						<input type="text" class="form-control" id="vUserName" name="vUserName" placeholder="User name">
					</div>
					<div class="form-group">
						<label for="vPassword">Password</label>
						<input type="password" class="form-control" id="vPassword" name="vPassword" placeholder="Password">
					</div>
					<button type="button" id="btnLogin" onclick="return userLogin()" class="btn btn-primary">Login</button>
					<hr />
				</form>
			</div>
			</span>
		</div>
	</div>
	<!-- /.container -->

	<footer>

		<div class="footer-blurb">
			<div class="container">
				<div class="row">
					<p>Copyright &copy; BharatContacts.com 2007-2021. <a href="http://www.softwaresathi.com" target="_blank">www.softwaresathi.com</a> | Softwaresathi Solutions LLP. Contact us @ 7028396339.</p>
				</div>
			</div>
	</footer>

	<!-- jQuery -->

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

	<!-- Placeholder Images -->
	<script src="js/holder.min.js"></script>
	<script src="js/select2.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>

	<script>
		$(document).ready(function() {
			$("#form-details").validate({
				ignore: ":hidden"
			});

		});

		function userLogin() {
			$('#alertData').html('');
			if ($('#form-details').valid()) {
				
				var formData = new FormData($("#form-details")[0]);
				$.ajax({
					type: 'POST',
					url: 'process/loginAction.php',
					data: formData,
					async: false,
					dataType: "json",
					success: function(data) {
						$('#btn_sub').attr('disabled', false);
						if (data.status == 200) {
							window.location.href = "home.php";
						} else {
							$('#alertData').html('<div class="alert alert-danger no-border"><button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button><span class="text-semibold">' + data.msg + '</a></div>');
						}
					},
					cache: false,
					contentType: false,
					processData: false
				});
			}
		}
	</script>
	
</body>

</html>