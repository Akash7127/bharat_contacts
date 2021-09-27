<?php
   $pageName = str_replace(".php", "", basename($_SERVER["SCRIPT_NAME"]));

?>
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
					<a href="./home.php"><img src="<?=$url?>images/BharatContactsLogo.png" alt="logo"></a>
				</a>
            </div>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-center">
                    <li>
                        <a href="./home.php">Home</a>
                    </li>
                    <li>
                        <a href="./pricing.html">Pricing</a>
                    </li>
                    <li>
                        <a href="register.php">Register</a>
                    </li>
					<?php
					if($_SESSION['Admin_UserID']){ ?>
					<li>
                        <a href="ad_compaign.php">Ad Campaign</a>
                    </li>
					<?php } ?>
				</ul>
				<!-- Search -->
				<div style="text-align: right;">
					<button class="btn btn-primary" onclick="return userLogOut()">Log Out</button>
				</div>
                <?php if($pageName == 'home'){ ?>
				<div class="clearfix"></div>
				<div class="searchform">
					<form class="navbar-form">
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
				<!--
				<li>
					<a href="#">Products</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="about-us">
						<li><a href="#">Engage</a></li>
						<li><a href="#">Pontificate</a></li>
						<li><a href="#">Synergize</a></li>
					</ul>
				</li>
				-->
                <?php } ?>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>