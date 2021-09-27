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

    <title>Bharat Contacts</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<link href="css/select2.min.css" rel="stylesheet" />
	
    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    <link href="css/custom.css" rel="stylesheet">
	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<style>
		/* footer{
			position: absolute;
		} */
	</style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Logo and responsive toggle -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">
					<a href="<?=$url?>index.php"><img src="<?=$url?>./BharatContactsLogo.png" alt="logo"></a>
				</a>
				<form class="navbar-form navbar-right">
					<div class="form-group">
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
					<div class="form-group">
						<select class="form-control select2" id="iSubCategoryId" name="iSubCategoryId">
							<option value="">Select Sub Category</option>
						</select>
					</div>
					
					<div class="form-group">
						<input type="text" class="form-control" id="searchTxt" />
					</div>
					<button type="button" class="btn btn-default" id="searchBtn">Search</button>
				</form>
				</div>
<!--                <a class="navbar-brand" href="./">
                	<span class="glyphicon glyphicon-phone"></span> 
                	BharatContacts
                </a>-->
                
                <ul class="nav navbar-nav navbar-right">
                    
                    <li>
                        <a href="./" >Home</a>
                    </li>
                    <li>
                        <a href="./pricing.html">Pricing</a>
                    </li>
                    <li>
                        <a href="register.php">Register</a>
                    </li>
                </ul>
            </div>
            <!-- Navbar links -->
           
        </div>
        <!-- /.container 1-->
        <!-- /.container 2-->
    </nav>
	
	<!--
	<div class="jumbotron feature">
		<div class="container">
			<h1>Dramatically Engage</h1>
			<p>Objectively innovate empowered manufactured products whereas parallel platforms.</p>
			<p><a class="btn btn-primary" href="#">Engage Now</a></p>
		</div>
	</div>
	-->
	<br/>
	<br/>
	<br/>
    <!-- Content -->
    <div class="container">
		<table class="table table-bordered table-striped">
		  <tr>
			  <th>Sr. No.</th>
			  <th>Name</th>
			  <th>Business Name</th>
			  <th>Category</th>
			  <th>City</th>
			  <th>State</th>
			  <th>Contacts</th>
		  </tr>
		  <tbody id="dData">
		  <?php
			$i=0;
			$sql_query = mysqli_query($con,"
				SELECT
					rg.iRegisterId,
					CONCAT(vFirstName, ' ', vLastName) as vFullName,
					rg.vBusinessName,
					ct.name as vCityName,
					st.name as vStateName,
					cm.name as vMainCategory,
					cs.name as vSubCategory
				FROM
					registrations as rg
					LEFT JOIN cities as ct ON ct.id = rg.iCityId
					LEFT JOIN states as st ON st.id = rg.iStateId
					LEFT JOIN category_main as cm ON cm.id = rg.iCategoryId
					LEFT JOIN category_sub as cs ON cs.id = rg.iSubCategoryId
				WHERE
					rg.eStatus = 'Approved'
				ORDER BY iRegisterId DESC
				LIMIT 10
			");
			
			
			
			
			while($row = mysqli_fetch_assoc($sql_query)){ $i++;
		  ?>
		  <tr>
			  <td><?=$i?></td>
			  <td><?=$row['vFullName']?></td>
			  <td><?=$row['vBusinessName']?></td>
			  <th><?=$row['vMainCategory']?> - <?=$row['vSubCategory']?></th>
			  <td><?=$row['vCityName']?></td>
			  <td><?=$row['vStateName']?></td>
			  <td><a href="javascript:(0)" class="get_data" data-id="<?=$row['iRegisterId']?>">View</a></td>
		  </tr>
		  <?php } ?>
		  </tbody>
		</table>


        <!-- Page Intro 
        <div class="row page-intro">
            <div class="col-lg-12">
                <h1>Superior Collaboration
                    <small>Visualize Quality</small>
                </h1>
                <p>Proactively envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior collaboration and idea-sharing. Holistically pontificate installed base portals after maintainable products.</p>
            </div>
        </div>
        <!-- /.row -->

        <!-- Feature Row 
        <div class="row">
            <article class="col-md-4 article-intro">
                <a href="#">
                    <img class="img-responsive img-rounded" src="holder.js/700x300" alt="">
                </a>
                <h3>
                    <a href="#">Efficiently Unleash</a>
                </h3>
                <p>Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.</p>
            </article>
            <article class="col-md-4 article-intro">
                <a href="#">
                    <img class="img-responsive img-rounded" src="holder.js/700x300" alt="">
                </a>
                <h3>
                    <a href="#">Completely Synergize</a>
                </h3>
                <p>Dramatically maintain clicks-and-mortar solutions without functional solutions. Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas.</p>
            </article>

            <article class="col-md-4 article-intro">
                <a href="#">
                    <img class="img-responsive img-rounded" src="holder.js/700x300" alt="">
                </a>
                <h3>
                    <a href="#">Dynamically Procrastinate</a>
                </h3>
                <p>Professionally cultivate one-to-one customer service with robust ideas. Completely synergize resource taxing relationships via premier niche markets. Dynamically innovate resource-leveling customer service for state of the art customer service.</p>
            </article>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
	
	<footer>
		
		<div class="footer-blurb">
			<div class="container">
				<div class="row">
					<!--
					<div class="col-sm-4 footer-blurb-item">
						<img class="img-circle" src="holder.js/100x100" alt="" width="100" height="100">
						<h3>Dynamically Procrastinate</h3>
						<p>Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.</p>
						<p><a class="btn btn-default" href="#">Procrastinate</a></p>
					</div>
					<div class="col-sm-4 footer-blurb-item">
						<img class="img-circle" src="holder.js/100x100" alt="" width="100" height="100">
						<h3>Efficiently Unleash</h3>
						<p>Dramatically maintain clicks-and-mortar solutions without functional solutions. Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. </p>
						<p><a class="btn btn-default" href="#">Unleash</a></p>
					</div>
					<div class="col-sm-4 footer-blurb-item">
						<img class="img-circle" src="holder.js/100x100" alt="" width="100" height="100">
						<h3>Completely Synergize</h3>
						<p>Professionally cultivate one-to-one customer service with robust ideas. Completely synergize resource taxing relationships via premier niche markets. Dynamically innovate resource-leveling customer service for state of the art customer service.</p>
						<p><a class="btn btn-default" href="#">Synergize</a></p>
					</div>
				</div>
				<!-- /.row -->	
				<p>Copyright &copy; bharatcontacts.com 2019 </p>
			</div>
        </div>
		
		<div id="dataModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3>View Contact Details</h3>
						<a class="close" data-dismiss="modal">×</a>
						
					</div>
					<form id="form-details" name="form-details">
						<input type="hidden" id="iId" name="iId">
						<div class="modal-body">
							<div id="alertData"></div>
							<div class="form-group">
								<div class="row" id="contactDiv">
									<div class="col-lg-6 col-xs-12">
										<label>Enter your registered Phone Number</label>
										<input type="text" class="form-control required" name="InputPhoneNumber" id="InputPhoneNumber"/>
									</div>
								</div>
								<div id="displayDiv">
									<div class="form-group">
										<div class="row">
											<div class="col-lg-8 col-xs-12">
												<label>Business Name</label>
												<input type="text" class="form-control" id="vBusinessName" readonly />
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-lg-8 col-xs-12">
												<label>Contact Person</label>
												<input type="text" class="form-control" id="vFullName" readonly />
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-lg-4 col-xs-12">
												<label>State</label>
												<input type="text" class="form-control" id="vState" readonly />
											</div>
											<div class="col-lg-4 col-xs-12">
												<label>City</label>
												<input type="text" class="form-control" id="vCity" readonly />
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-lg-4 col-xs-12">
												<label>Phone 1</label>
												<input type="text" class="form-control" id="vPhone1" readonly />
											</div>
											<div class="col-lg-4 col-xs-12">
												<label>Phone 2</label>
												<input type="text" class="form-control" id="vPhone2" readonly />
											</div>
											<div class="col-lg-4 col-xs-12">
												<label>Phone 3</label>
												<input type="text" class="form-control" id="vPhone3" readonly />
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-lg-4 col-xs-12">
												<label>Email 1</label>
												<input type="text" class="form-control" id="vEmail1" readonly />
											</div>
											<div class="col-lg-4 col-xs-12">
												<label>Email 2</label>
												<input type="text" class="form-control" id="vEmail2" readonly />
											</div>
											<div class="col-lg-4 col-xs-12">
												<label>Email 3</label>
												<input type="text" class="form-control" id="vEmail3" readonly />
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label>Website Link</label>
										<input type="text" class="form-control" id="tWebsiteLink" readonly />
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">					
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<input type="button" class="btn btn-success" id="btn_sub" value="Submit" onclick="frmSubmit()">
						</div>
					</form>
				</div>
			</div>
		</div>

    </footer>
	
	
    <!-- jQuery -->
    <script src="js/jquery-1.11.3.min.js"></script>

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
			})
			
			//$('#dataModal').modal('show');
			
			$('#displayDiv').hide();
			
			$(".select2").select2();
		});
		
		$(document).on('click', '.get_data', function(ev) {
			var iRegisterId = $(this).attr('data-id');
			$('#iId').val(iRegisterId);
			$('#dataModal').modal('show');
			$('#InputPhoneNumber').val('');
			$('#contactDiv').show();
			$('#btn_sub').show();
			$('#displayDiv').hide();
		});
		function frmSubmit(){
			$('#alertData').html('');
			if($('#form-details').valid()){
				$('#btn_sub').attr('disabled',true);
				var formData = new FormData($("#form-details")[0]);
				$.ajax({
					type: 'POST',
					url: 'process/get_form_data.php',
					data: formData,
					async: false,
					dataType: "json",
					success: function (data) {
						$('#btn_sub').attr('disabled',false);
						if(data.status == 200){
							$('#contactDiv').hide();
							$('#btn_sub').hide();
							$('#displayDiv').show();
							$('#vBusinessName').val(data.data.vBusinessName);
							$('#vFullName').val(data.data.vFullName);
							$('#vState').val(data.data.vState);
							$('#vCity').val(data.data.vCity);
							$('#vPhone1').val(data.data.vPhone1);
							$('#vPhone2').val(data.data.vPhone2);
							$('#vPhone3').val(data.data.vPhone3);
							$('#vEmail1').val(data.data.vEmail1);
							$('#vEmail2').val(data.data.vEmail2);
							$('#vEmail3').val(data.data.vEmail3);
							$('#tWebsiteLink').val(data.data.tWebsiteLink);
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
		
		$(document).on('change', '#iCategoryId', function(ev) {
			var iCategoryId = $(this).val();
			
			$('#iSubCategoryId').html('<option value="">Select Sub Category</option>').select2();
			
			$.ajax({
				type: 'POST',
				url: 'process/get_sub_category.php',
				data: {"iCategoryId":iCategoryId},
				//async: false,
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
				
		$(document).on('change', '#iCategoryId', function(ev) {
			filterData();
		});
		
		$(document).on('change', '#iSubCategoryId', function(ev) {
			if($(this).val() != ''){
				filterData();
			}
		});
		
		$(document).on('keyup', '#searchTxt', function(ev) {
			filterData();
		});
		
		function filterData(){
			var iCategoryId = $('#iCategoryId').val();
			var iSubCategoryId = $('#iSubCategoryId').val();
			var searchStr = $('#searchTxt').val();
			$.ajax({
				type: 'POST',
				url: 'process/get_search_data.php',
				data: {"iCategoryId":iCategoryId,"iSubCategoryId":iSubCategoryId,"searchStr":searchStr},
				//async: false,
				//dataType: "json",
				success: function (data) {
					$('#dData').html(data);
				},
				//cache: false,
			});
		}
	</script>
</body>

</html>
