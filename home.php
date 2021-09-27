<?php
	include("conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="services" content="Provides contacts of businesses in Bharat, find business contacts in Bharat, Contacts directory of Bharat, Business directory, Business Listing services, Leading Language Training Centres+, car driving classes in+, vehicle driving training in+, Schools in+,International school in+, colleges in+, Yoga classes in+,Tours and Travels in+,Painters in+,Tutions in+,Classes in+,Realestate agents in+,Home deliver in+,Jewelry shop in+,Dance classes in+, music classes in+, Ashram in+, Couriers in+, Cloth shop in+, Gyms and fitness centers in+, Interior designers in+, Pathology labs in+, Wedding Halls in+"/>
    <meta name="cities" content="Bangalore, Chennai,Delhi,Hyderabad,Kolkata,Mumbai,Ahmedabad,Pune,Agra,Ajmer,Aligarh,Amravati,Amritsar,Asansol,Aurangabad,Bareilly,Belgaum,Bhavnagar,Bhiwandi,Bhopal,Bhubaneswar,Bikaner,Bokaro Steel City,Chandigarh,Nagpur,Cuttack,Dehradun,Dhanbad,Bhilai,Durgapur,Erode,Faridabad,Firozabad,Ghaziabad,Gorakhpur,Gulbarga,Guntur,Gwalior,Gurgaon,Guwahati,Hubli–Dharwad, Haridwar,
Indore,Jabalpur,Jaipur,Jalandhar,Jammu,Jamnagar,Jamshedpur,Jhansi,Jodhpur,Kakinada,Kannur,Kanpur,Kochi,Kottayam,Kolhapur,Kollam,Kota,Kozhikode,Kurnool,Ludhiana,Lucknow,Madurai,Malappuram,Mathura,Goa,Mangalore,Meerut,Moradabad,Mysore,Nanded,Nashik,Nellore,Noida,Palakkad,Patna,Pondicherry,Allahabad,Raipur,Rajkot,Rajahmundry,Ranchi,Rishikesh,Rourkela,Salem,Sangli,Siliguri,Solapur,Srinagar,
Thiruvananthapuram,Thrissur,Tiruchirappalli,Tirupati,Tirunelveli,Tiruppur,Tiruvannamalai,Ujjain,Bijapur,Vadodara,Varanasi,Vasai-Virar City,Vijayawada,Vellore,Warangal,Bilaspur,Hamirpur,Perinthalmanna,Purulia,Shimla,Tirur,Surat,Vishakhapatnam,"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>BharatContacts-Find business contacts in Bharat</title>
    <!--<script src="js/jquery-1.11.3.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<link href="css/select2.min.css" rel="stylesheet" />
	
    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    <link href="css/custom.css" rel="stylesheet">
	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></sccopyript>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<style>
		footer{
			position: fixed;
		} 
	</style>
</head>

<body>
    <?php include("header.php");?>
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
    <!-- Content -->
    <div class="container">
		<div class="col-lg-9 col-xs-12">
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
				<td><a class="get_data" data-id="<?=$row['iRegisterId']?>">View</a></td>
			</tr>
			<?php } ?>
			</tbody>
			</table>
		</div>
		<div class="col-lg-3 col-xs-12" style="overflow-x:hidden;overflow-y: auto;height: 520px; width:25%">
		
		<?php
		$selB2cAds = mysqli_query($con,"SELECT * FROM compaign WHERE iCustType = 2 AND eStatus='y'");
		if(mysqli_num_rows($selB2cAds)>0){
			while($rowB2C = mysqli_fetch_array($selB2cAds)){ ?>
				<div class="card" style="width:500px; ">
					<?php 
					if(in_array($rowB2C['iAdType'],array("image","video"))){ ?>
					<!-- Card image -->
					<div class="view overlay">
						<?php 
						if($rowB2C['iAdType'] == "image"){ ?>
						<img class="card-img-top" width="220" height="180" src="upload/<?php echo $rowB2C['vFileName'] ?>" alt="Card image">
						<?php }else if($rowB2C['iAdType'] == "video"){ ?>
							<!-- autoplay -->
							<video width="220" height="180" controls>
								<source src="upload/<?php echo $rowB2C['vFileName'] ?>" type="video/mp4">
							Sorry, your browser doesn't support the video element.
							</video>
						<?php } ?>
						<a href="#!">
						<div class="mask rgba-white-slight"></div>
						</a>
					</div>
					<?php } ?>
					<div class="clear"></div>
					<div class="card-body">
						<h4 class="card-title"><?php echo $rowB2C['vTitle'] ?></h4>
						<p class="card-text"><?php echo $rowB2C['vDescription'] ?></p>
						<!-- <a href="#" class="btn btn-primary">View Details</a> -->
					</div>
				</div>
				<hr/>
			<?php
			}
		}
		?>
		</div>
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
	
	<?php include("footer.php") ?>
	
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
	<div id="dataModal" class="modal fade" role="dialog">
			<div class="modal-dialog" style="width:1000px;">
				<div class="modal-content">
					<div class="modal-header">
						<h3>Contact Details</h3>
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
									<!-- <div class="form-group"> -->
										<div class="row">
											<div class="col-lg-6 col-xs-12">
												<div class="row">
													<div class="form-group">
														<div class="col-lg-12 col-xs-12">
															<label>Business Name</label>
															<input type="text" class="form-control" id="vBusinessName" readonly />
														</div>
													</div>
												</div>
												<div class="clear"></div>
												<div class="row">
													<div class="form-group">
														<div class="col-lg-12 col-xs-12">
															<label>Contact Person</label>
															<input type="text" class="form-control" id="vFullName" readonly />
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
														<div class="col-lg-6 col-xs-12">
															<label>State</label>
															<input type="text" class="form-control" id="vState" readonly />
														</div>
														<div class="col-lg-6 col-xs-12">
															<label>City</label>
															<input type="text" class="form-control" id="vCity" readonly />
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group">
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
												
												<div class="row">
													<div class="form-group">
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
												<div class="row">
													<div class="form-group">
														<div class="col-lg-12 col-xs-12">
															<label>Website Link</label>
															<input type="text" class="form-control" id="tWebsiteLink" readonly />
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-6 col-xs-12" style="overflow-x:hidden;overflow-y: auto;height: 520px;">
											<?php
												$selB2BAds = mysqli_query($con,"SELECT * FROM compaign WHERE iCustType = 1 AND eStatus='y'");
												if(mysqli_num_rows($selB2BAds)>0){
													while($rowB2C = mysqli_fetch_array($selB2BAds)){ ?>
														<div class="card" style="width:500px; ">
														<?php 
															if(in_array($rowB2C['iAdType'],array("image","video"))){ ?>
																<!-- Card image -->
																<div class="view overlay">
																	<?php 
																	if($rowB2C['iAdType'] == "image"){ ?>
																	<img class="card-img-top" width="320" height="240" src="upload/<?php echo $rowB2C['vFileName'] ?>" alt="Card image">
																	<?php }else if($rowB2C['iAdType'] == "video"){ ?>
																		<!-- autoplay -->
																		<video width="320" height="240" controls >
																			<source src="upload/<?php echo $rowB2C['vFileName'] ?>" type="video/mp4">
																		Sorry, your browser doesn't support the video element.
																		</video>
																	<?php } ?>
																	<a href="#!">
																	<div class="mask rgba-white-slight"></div>
																	</a>
																</div>
													  <?php } ?>
															<div class="clear"></div>
															<div class="card-body">
																<h4 class="card-title"><?php echo $rowB2C['vTitle'] ?></h4>
																<p class="card-text"><?php echo $rowB2C['vDescription'] ?></p>
																<!-- <a href="#" class="btn btn-primary">View Details</a> -->
															</div>
														</div>
														<hr />
													<?php
													}
												}
											?>
											</div>
										</div>
									<!-- </div> -->
									
									
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
</body>

</html>
