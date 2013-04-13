<?php
	require_once 'session.php';
	require_once '../include/util_functions.php';
	require_once '../include/db_functions.php';
	if(!chkLogin()){
		redirectTo("home.php");
	}
	$connection = dbConnect();
	$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Khaugali home</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="../css/bootstrap.css" />
		<link rel="stylesheet" href="../css/common.css" />
		<style>
			form.form-signin {
				margin-left: 100px;
			}
			sup {
				color: #ff0000;
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
		<div id="content">
			<form class="form-signin">
				<h3 class="form-signin-heading">Know an awesome place to eat out? Tell us</h3>
				<p>
					<strong class="lbl span3">Name of restaurant<sup>*</sup> :</strong> 
					<input class="span6" type="text" placeholder="Name of the restaurant">
				</p>
				<p>
					<strong class="lbl span3">City<sup>*</sup> :</strong>
					<select class="span6">
						<option>City 1</option>
						<option>City 2</option>
						<option>City 3</option>
					</select>
				</p>
				<p>
					<strong class="lbl span3">Locality<sup>*</sup> :</strong>
					<select class="span6">
						<option>Locality 1</option>
						<option>Locality 2</option>
						<option>Locality 3</option>
					</select>
				</p>
				<p>
					<strong class="lbl span3">Address<sup>*</sup> :</strong>
					<textarea class="span6" rows="5" placeholder="Address"></textarea>
				</p>
				<p>
					<strong class="lbl span3">Phone number :</strong>
					<input class="span6" type="text" placeholder="Phone Number">
				</p>
				<button type="submit" class="btn btn-primary btn-large" style="margin-left: 50px">Done</button>
			</form>
		</div>
		<?php
		 include_once 'footer.php';
		 connectionClose($connection);