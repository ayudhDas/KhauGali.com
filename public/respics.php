<!DOCTYPE html>
<html>
	<head>
		<title>Khaugali home</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="../css/bootstrap.css" />
		<link rel="stylesheet" href="../css/common.css" />
		<style>
			#content {
				padding-left: 30px;
				overflow-y: scroll;
			}
			#innerContent {
				padding-top: 15px;
				padding-bottom: 15px;
			}
		</style>
	</head>
	<body>
		<div id="header" class="row-fluid">
			<h2 id="logo" class="span6">KhauGali.com</h2>
			<div id="auth" class="span6" style="padding-left: 20%;padding-top: 25px;">
				<i class="icon-user"></i>
				Username
				<button class="btn "><i class="icon-arrow-down"></i></button>
			</div>
		</div>
		<hr class="head"/>
		<div id="content" class="row-fluid">
			<div class="span8">
				<h3>Restaurant 1</h3>
				<p>Locality,city</p>
			</div>
			<div class="span4">
				Average user rating :
				<div class="rating">
					<i class="icon-star"></i>
					<i class="icon-star"></i>
					<i class="icon-star"></i>
					<i class="icon-star-empty"></i>
					<i class="icon-star-empty"></i>
				</div>
				<br />
				Your Rating :
				<div class="rating">
					<i class="icon-star-empty"></i>
					<i class="icon-star-empty"></i>
					<i class="icon-star-empty"></i>
					<i class="icon-star-empty"></i>
					<i class="icon-star-empty"></i>
				</div>
			</div>
			<div class="btn-group" data-toggle="buttons-radio">
				<button type="button" class="btn ">Information</button>
				<button type="button" class="btn ">Menu</button>
				<button type="button" class="btn ">Photos</button>
				<button type="button" class="btn ">Reviews</button>
			</div>
			<!-- sub content begins from here -->
			<!--=================================================================================-->
			<div id="innerContent">
				<ul class="thumbnails">
					<li class="span4">
						<a href="#" class="thumbnail">
							<img src="img/pic1.jpg" alt="">
						</a>
					</li>
					<li class="span4">
						<a href="#" class="thumbnail">
							<img src="img/pic2.jpg" alt="">
						</a>
					</li>
					<li class="span4">
						<a href="#" class="thumbnail">
							<img src="img/pic3.jpg" alt="">
						</a>
					</li>
					<li class="span4">
						<a href="#" class="thumbnail">
							<img src="img/pic4.jpg" alt="" height="241" width="300" />
						</a>
					</li>
					<li class="span4">
						<a href="#" class="thumbnail">
							<img src="img/pic6.jpg" alt="" height="241" width="300" />
						</a>
					</li>
				</ul>
			</div>
		</div>
		<?php
			require_once 'footer.php';
