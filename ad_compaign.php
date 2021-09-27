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

    <title>Bharat Contacts - Compaign</title>

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
	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	
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
<?php
$aDaysArr = [
    'Mon' => 'Mon',
	'Tue' => 'Tue',
	'Wed' => 'Wed',
	'Thu' => 'Thu',
	'Fri' => 'Fri',
	'Sat' => 'Sat',
	'Sun' => 'Sun',
];

$aUploadSizeArr = array("330 x 250","300 x 250","160 x 520","580 x 160","760 x 160","250 x 250");
?>
<body>

	<?php include("header.php");?>

	<!-- Content -->
    <div class="container" id="middle_section">
		<form method="post" id="form-data" enctype="multipart/form-data">
			<h2>Ad Campaign</h2>
			<!--<p>Please fill in this form to create an account!</p>-->
			<hr>
			<div id="alertData"></div>
			<div class="form-group">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<input type="text" class="form-control required" name="vProductName" placeholder="Product Name *">
					</div>
					<div class="col-lg-3 col-xs-12">
						<select class="form-control select2 required" id="iCustType" name="iCustType">
							<option value="">Select Customer Type</option>
							<option value="1">B2B</option>
							<option value="2">B2C</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<input name="dStartDate" id="dStartDate" class="form-control required datepicker" value="" placeholder="Start Date" />
					</div>
					<div class="col-lg-3 col-xs-12">
						<input name="tStartTime" id="tStartTime" class="form-control required timepicker" value="" placeholder="Start Time"/>
					</div>
					<div class="col-lg-3 col-xs-12">
						
						<?php
							foreach($aDaysArr as $key => $Days){ ?>
							<div class="radio-inline">
								<input type="radio" class="form-check-input required " name="iDay" id="iDay_<?php echo $key;?>" value="<?php echo $key;?>" />
								<label for="iDay_<?php echo $key;?>" class="form-check-label"><?php echo $Days;?></label>
							</div>
						<?php
							}
						?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<input name="dEndDate" id="dEndDate" class="form-control required datepicker" value="" placeholder="End Date" />
					</div>
					<div class="col-lg-3 col-xs-12">
						<input name="tEndTime" id="tEndTime" class="form-control required timepicker" value="" placeholder="End Time"/>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<select class="form-control select2 required" id="iAdType" name="iAdType">
							<option value="">Select Ad. Type</option>
							<option value="text">Text</option>
							<option value="image">Image</option>
							<option value="video">Video</option>
						</select>
					</div>
					<div class="col-lg-3 col-xs-12 textDiv" style="display: none;">
						<input type="text" name="vTitle" id="vTitle" class="form-control required" value="" placeholder="Title" />
					</div>
					<div class="col-lg-3 col-xs-12 textDiv" style="display: none;">
						<textarea name="vDescription" id="vDescription" class="form-control required" rows="5" placeholder="Description" ></textarea>
					</div>
					<div class="col-lg-3 col-xs-12 fileDiv" style="display: none;">
						<input type="file" name="vFileName" id="vFileName" class="form-control required" value="" placeholder="" />
					</div>

				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<select class="form-control select2 required" id="iAdSize" name="iAdSize">
							<option value="">Select Ad. Size</option>
							<?php 
								foreach($aUploadSizeArr as $key => $options){
									echo '<option value="'.$key.'">'.$options.'</option>';
								}
							?>
						</select>
					</div>
					<div class="col-lg-3 col-xs-12">
						<div class="bs-example">
							<input type="text" class="form-control token-example-field required" name="vCitys" placeholder="City">
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-lg-3 col-xs-12">
						<input type="text" class="form-control required" name="dAmount" placeholder="Amount">
					</div>
				</div>
			</div>
			
			<button type="button" class="btn btn-primary btn-lg" name="btnSubmit" onclick="frmSubmit()" id="btn_sub">Add Campaign</button>
		</form>
	</div>
    <!-- /.container -->
	<?php include("footer.php") ?>
		
	<script>
		$(document).ready(function() {
			$(".token-example-field").tokenfield();
			$(".select2").select2();
			
			$("#form-data").validate({
			   ignore: ":hidden",
			   errorPlacement: function(error, element) {
					if (element.is(":input")) {
						error.insertAfter(element);
					}else
					if (element.attr("type") == "radio") {
						error.insertAfter(element);
					} else {
						error.insertAfter(element);
					}
				}
			});

			$('.datepicker').datetimepicker({
				format: 'DD/MM/YYYY'
			});

			$('.timepicker').datetimepicker({
				format:"LT"
			});
		});
		
		$(document).on('change', '#iAdType', function(ev) {
			var iAdType = $(this).val();
			if(iAdType == "text"){
				$("#vTitle").addClass("required");
				$("#vDescription").addClass("required");
				$(".textDiv").show();
				$(".fileDiv").hide();
				$("#vFileName").removeClass("required");
			}else{
				$(".fileDiv").show();
				$(".textDiv").hide();
				$("#vFileName").addClass("required");
				$("#vTitle").removeClass("required");
				$("#vDescription").removeClass("required");
			}
		});
		
		function frmSubmit(){
			if($('#form-data').valid()){
				$('#btn_sub').attr('disabled',true);
				var formData = new FormData($("#form-data")[0]);
				$.ajax({
					type: 'POST',
					url: 'process/save_compaign_data.php',
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
