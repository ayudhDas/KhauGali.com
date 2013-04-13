<!DOCTYPE html>
<html>
	<head>
		<title>Khaugali home</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="css/bootstrap.css" />
		<link rel="stylesheet" href="common.css" />
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
			<div id="innerContent" class="row">
				<img style="padding-left: 20%;text-align: center;" src="img/menu.jpg" alt="menu" class="span6" />
				<div class="span6">
				<div class="pagination">
					<ul>
					<li><a href="#">Prev</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">Next</a></li>
				  </ul>
				</div>
				<p><strong>(last updated on dd/mm/yyyy. Subject to change)</strong></p>
				</div>
			</div>
		</div>
		<hr class="foot" />
		<div id="footer" class="row-fluid">
			<div class="span8" id="links">
				<a href="">Home</a> &VerticalBar;
				<a href="">About Khaugali.com</a> &VerticalBar;
				<a href="">Suggest a Restaurant</a> &VerticalBar;
				<a href="">Contact us</a> &VerticalBar;
				<a href="">Privacy</a> &VerticalBar;
				<a href="">Site map</a> 
			</div>
			<div class="span4" id="company">
				<p class="pull-right">&copy; MAD productions</p>
			</div>
		</div>
		<script src="js/bootstrap.js"></script>
		<script src="js/jquery-1.9.1.js"></script>
	</body>
</html>
