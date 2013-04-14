<?php
	require_once 'session.php';
	require_once '../include/util_functions.php';
	require_once '../include/db_functions.php';
	$connection = dbConnect();
	if(isset($_POST['suggest'])){
		$resName = trim($_POST['resName']);
		$city = trim($_POST['city']);
		$locality = trim($_POST['locality']);
		$address = trim($_POST['address']);
		$phone = trim($_POST['phone']);
		if($phone==''){
			$query = "insert into suggested_restaurants(sres_name, address, status) values('$resName', '$address', 0)";
		}
		else{
			$query = "insert into suggested_restaurants(sres_name, address, status, phone_number) values('$resName', '$address', 0, $phone)";
		}
		$res = mysql_query($query, $connection);
		confirmQuery($res);
		if(mysql_affected_rows()== 1){
			$message = 'success';
		}
		else{
			$message = 'failure';
		}
	}
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
			<a href="home.php"><h2 id="logo" class="span6">KhauGali.com</h2></a>
			<?php
				include_once 'publicFunction.php';
				showAuth();
			?>
		</div>
		<hr class="head"/>
		<div id="content">
			<div class="alert">
				<?php if(isset($message))echo $message; ?>
			</div>
			<form class="form-signin" action="suggest.php" method="post">
				<h3 class="form-signin-heading">Know an awesome place to eat out? Tell us</h3>
				<div class="control-group">
					<div class="controls">
					<strong class="lbl span3">Name of restaurant<sup>*</sup> :</strong>
					<input type="text" placeholder="Restaurant name" required name="resName" />
					<p class="help-block"></p>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
					<strong class="lbl span3">City<sup>*</sup> :</strong>
					<select name="city" id="sug-city">
						<?php
							$query = "select * from city";
							$result = mysql_query($query, $connection);
							confirmQuery($result);
							$htm = '';
							while ($row = mysql_fetch_array($result)) {
								$htm = $htm . '<option>'.$row['city_name'].'</option>';
							}
							echo $htm;
						?>
					</select>
					<p class="help-block"></p>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
					<strong class="lbl span3">Locality<sup>*</sup> :</strong>
					<select name="locality" id="sug-location">
					</select>
					<p class="help-block"></p>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
					<strong class="lbl span3">Address<sup>*</sup> :</strong>
					<textarea class="span6" rows="5" placeholder="Address" required name="address"></textarea>
					<p class="help-block"></p>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
					<strong class="lbl span3">Phone number :</strong>
					<input type="number"
						   maxlength="10" 
							minlength="10"
							data-validation-minlength-message ="exact 10 digits required"
							data-validation-minlength-message ="exact 10 digits required"
						   name="phone" />
					<p class="help-block"></p>
					</div>
				</div>
				<button type="submit" class="btn btn-primary btn-large" style="margin-left: 50px" name="suggest">Done</button>
			</form>
		</div>
		<hr class="foot" />
			<div id="footer" class="row-fluid">
				<div class="span8" id="links">
					<a href="home.php">Home</a> &VerticalBar;
					<a href="">About Khaugali.com</a> &VerticalBar;
					<a href="suggest.php">Suggest a Restaurant</a> &VerticalBar;
					<a href="">Contact us</a> &VerticalBar;
					<a href="">Privacy</a> &VerticalBar;
					<a href="">Site map</a> 
				</div>
				<div class="span4" id="company">
					<p class="pull-right">&copy; MAD productions</p>
				</div>
			</div>
			<script src="../js/jquery-1.9.1.js"></script>
			<script src="../js/bootstrap.js"></script>
			<script src="../js/jqBootstrapValidation.js"></script>
			<script>
				function init(){
					var city = $('#sug-city').val().toLowerCase();
					if(city == 'all cities'){
						$('#sug-location').html('<option>All locations</option>');
					}
					else{
						$.get('ajaxHandlers/dummy.php?city_name='+city, {}, function(data){
							var locs = jQuery.parseJSON(data).localities;
							var htm = '';
							for (i=0; i < locs.length; i++){
								htm = htm + '<option>'+locs[i]+'</option>'
							}
							$('#sug-location').html(htm);
						});	
					}
				}
				$('document').ready(function(){
					$("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
					init();
					$('#sug-city').change(function(){
						init();
					});
					$('.dropdown-toggle').dropdown();

				});
			</script>
		</body>
	</html>
	<?php
		 connectionClose($connection);