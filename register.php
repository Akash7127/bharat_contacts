<?php
	include("conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Bharat Contacts - Register</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    
	<link href="css/register.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<link href="css/tag_input/tokenfield-typeahead.css" type="text/css" rel="stylesheet">
    <link href="css/tag_input/bootstrap-tokenfield.css" type="text/css" rel="stylesheet">
	
	<link href="css/select2.min.css" rel="stylesheet" />
	
	<link href="css/custom.css" rel="stylesheet">
	<style>
		footer{
			position: fixed;
		} 
	</style>
</head>

<body>

	<?php include("header.php");?>

	<!-- Content -->
    <div class="container" id="middle_section">
		<form method="post" id="form-data">
			<h2>Register</h2>
			<!--<p>Please fill in this form to create an account!</p>-->
			<hr>
			<div id="alertData"></div>
			<div class="form-group">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<input type="text" class="form-control required" name="vFirstName" placeholder="First Name *">
					</div>
					<div class="col-lg-3 col-xs-12">
						<input type="text" class="form-control required" name="vLastName" placeholder="Last Name *">
					</div>
					<div class="col-lg-3 col-xs-12">
						<input type="text" class="form-control required" name="vUserName" placeholder="User Name *">
					</div>
					<div class="col-lg-3 col-xs-12">
						<input type="password" class="form-control required" name="vPassword" placeholder="Password *">
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<input type="text" class="form-control" name="vBusinessName" placeholder="Business Name">
					</div>
					<div class="col-lg-3 col-xs-12">
						<select class="form-control select2" id="iCategoryId" name="iCategoryId">
							<option value="">Select Category</option>
							<?php
								$sqlCat = mysqli_query($con,"SELECT id,name FROM category_main ORDER BY name asc");
								while($rowCat = mysqli_fetch_array($sqlCat)){
								?>
								<option value="<?=$rowCat['id']?>"><?=$rowCat['name']?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-lg-3 col-xs-12">
						<select class="form-control select2" id="iSubCategoryId" name="iSubCategoryId">
							<option value="">Select Sub Category</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<select class="form-control select2" id="iStateId" name="iStateId">
							<option value="">Select State</option>
							<?php
								$sqlSt = mysqli_query($con,"SELECT id,name FROM states WHERE country_id = 101 ORDER BY name asc");
								while($rowSt = mysqli_fetch_array($sqlSt)){
								?>
								<option value="<?=$rowSt['id']?>"><?=$rowSt['name']?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-lg-3 col-xs-12">
						<select class="form-control select2" id="iCityId" name="iCityId">
							<option value="">Select City</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<input type="text" class="form-control" name="vPhone1" placeholder="Phone Number 1">
					</div>
					<div class="col-lg-3 col-xs-12">
						<input type="text" class="form-control" name="vPhone2" placeholder="Phone Number 2">
					</div>
					<div class="col-lg-3 col-xs-12">
						<input type="text" class="form-control" name="vPhone3" placeholder="Phone Number 3">
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<input type="email" required class="form-control email" name="vEmail1" placeholder="Email 1">
					</div>
					<div class="col-lg-3 col-xs-12">
						<input type="email" class="form-control email" name="vEmail2" placeholder="Email 2">
					</div>
					<div class="col-lg-3 col-xs-12">
						<input type="email" class="form-control email" name="vEmail3" placeholder="Email 3">
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<input type="text" class="form-control" name="tWebsiteLink" placeholder="Webiste Link">
			</div>
			
			<div class="form-group">
				<div class="bs-example">
					<input type="text" class="form-control token-example-field" placeholder="Keywords : Write text and press enter key" value="" name="vKeywords" />
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<input type="text" class="form-control" name="vExecutiveName" placeholder="Executive Name"><br/>
						<a><img alt="Qries" src="./images/softwaresathiqrcode.png" width="229" height="304"></a><br/><br/>
						<input type="text" required class="form-control" name="vTransactionNo" placeholder="Transaction no.">
					</div>
				</div>
			</div>
			<button type="button" class="btn btn-primary btn-lg" onclick="frmSubmit()" id="btn_sub">Sign Up</button>
		</form>
	</div>
    <!-- /.container -->
	
	<?php include("footer.php") ?>
	<script>
		$(document).ready(function() {
			$(".token-example-field").tokenfield();
			$(".select2").select2();
			
			$("#form-data").validate({
			   ignore: ":hidden"
			})
		});
		
		$(document).on('change', '#iCategoryId', function(ev) {
			var iCategoryId = $(this).val();
			
			$('#iSubCategoryId').html('<option value="">Select Sub Category</option>').select2();
			
			$.ajax({
				type: 'POST',
				url: 'process/get_sub_category.php',
				data: {"iCategoryId":iCategoryId},
				async: false,
				dataType: "json",
				success: function (data) {
					$.each(data.data, function(i, item) {
						$("#iSubCategoryId").append("<option value='"+item.id+"'>"+item.name+"</option>");
					});
					
					$('#iSubCategoryId').trigger('change');
				},
				cache: false,
			});
		});
		$(document).on('change', '#iCategoryId_a', function(ev) {
			var iCategoryId = $(this).val();
			
			$('#iSubCategoryId_a').html('<option value="">Select Sub Category</option>').select2();
			
			$.ajax({
				type: 'POST',
				url: 'process/get_sub_category.php',
				data: {"iCategoryId":iCategoryId},
				async: false,
				dataType: "json",
				success: function (data) {
					$.each(data.data, function(i, item) {
						$("#iSubCategoryId_a").append("<option value='"+item.id+"'>"+item.name+"</option>");
					});
					
					$('#iSubCategoryId_a').trigger('change');
				},
				cache: false,
			});
		});
		
		
		$(document).on('change', '#iStateId', function(ev) {
			var iStateId = $(this).val();
			
			$('#iCityId').html('<option value="">Select City</option>').select2();
			
			$.ajax({
				type: 'POST',
				url: 'process/get_city.php',
				data: {"iStateId":iStateId},
				async: false,
				dataType: "json",
				success: function (data) {
					$.each(data.data, function(i, item) {
						$("#iCityId").append("<option value='"+item.id+"'>"+item.name+"</option>");
					});
					
					$('#iCityId').trigger('change');
				},
				cache: false,
			});
		});
		
		function frmSubmit(){
			if($('#form-data').valid()){
				$('#btn_sub').attr('disabled',true);
				var formData = new FormData($("#form-data")[0]);
				$.ajax({
					type: 'POST',
					url: 'process/save_form_data.php',
					data: formData,
					async: false,
					dataType: "json",
					success: function (data) {
						$('#btn_sub').attr('disabled',false);
						if(data.status == 200){
							$('#form-data')[0].reset();
							$('#alertData').html('<div class="alert alert-success no-border"><button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button><span class="text-semibold">'+data.msg+'</a></div>');
							window.location.href = "home.php";
						}else{
							$('#alertData').html('<div class="alert alert-danger no-border"><button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button><span class="text-semibold">'+data.msg+'</a></div>');
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
