<?php
	require_once 'session.php';
	require_once '../include/db_functions.php';
	require_once '../include/util_functions.php';
	$connection = dbConnect();
	if(isset($_POST['signup'])){
		// signup code goes here
		$name = trim($_POST['name']);
		$username = trim($_POST['uname']);
		$password = trim($_POST['pass']);
		$email = trim($_POST['email']);
		if($name != '' && $username != ''){
			$redCheckQuery = "select username from user where username='$username'";
			$redCheck = mysql_query($redCheckQuery,$connection);
			confirmQuery($redCheck);
			if(mysql_num_rows($redCheck) != 0){
				$error = "username already taken, try a new one";
				redirectTo('signup.php?error='.urlencode($error));
			}
			$redCheckQuery = "select email from user where email='$email'";
			$redCheck = mysql_query($redCheckQuery,$connection);
			confirmQuery($redCheck);
			if(mysql_num_rows($redCheck) != 0){
				$error = "email already taken, try a new one";
				redirectTo('signup.php?error='.urlencode($error));
			}
			$profilePic = 'profilePic/default.png';
			$password = sha1($password);
			$joined = date("Y/m/d");
			$query = "insert into user(username, name, profile_picture, email, hashed_password, joined)
						values('$username', '$name', '$profilePic', '$email', '$password', '$joined')";
			$insert = mysql_query($query,$connection);
			confirmQuery($insert);
			if(mysql_affected_rows()== 1){
				$_SESSION['username'] = $username;
			}
		}
	}
	if(isset($_POST['login'])){
		//code to log user in
		$handle = trim($_POST['handle']);
		$password = trim($_POST['pass']);
		if($handle != '' && $password != ''){
			$query = "select * from user where email='$handle'";
			$res = mysql_query($query, $connection);
			confirmQuery($res);
			if(mysql_num_rows($res)==1){
				//email entered
				while($row=  mysql_fetch_array($res)){
					if(sha1($password) == $row['hashed_password']){
						//success
						$_SESSION['username'] = $row['username'];
					}
					else{
						//failure
						$error = "wrong password for email";
						redirectTo('login.php?error='.urlencode($error));
					}
				}
			}
			else{
				$query = "select * from user where username='$handle'";
				$res = mysql_query($query, $connection);
				confirmQuery($res);
				if(mysql_num_rows($res)==1){
					//username entered
					while($row=  mysql_fetch_array($res)){
						if(sha1($password) == $row['hashed_password']){
							//success
							$_SESSION['username'] = $row['username'];
						}
						else{
							//failure
							$error = "wrong password for username";
							redirectTo('login.php?error='.urlencode($error));
						}
					}
				}
				else{
					$error = "email or username invalid";
					redirectTo('login.php?error='.urlencode($error));
				}
			}
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
		#home_search {
			/*margin-right: 250px;*/
			/*max-width: 70%;*/
			padding-left: 25%;
			padding-top: 10%;
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
		<div id="content" class="row-fluid">
			<form id="home_search" action="searchresult.php" method="GET" >
				Search for great food in: 
				<select name="location" id="search-location">
				</select> ,
				<select name="city" id="search-city">
<!--					<option>All cities</option>
					<option>Surat</option>
					<option>Ahmedabad</option>
					<option>Gandhinagar</option>-->
<?php
					echo '<option>All cities</option>';
	$resultset = getAllCities($connection);
	while($row = mysql_fetch_array($resultset)){
		echo '<option>'.$row['city_name'].'</option>';
	}
?>
				</select> <br />
				<input type="text" name="search_key" id ="search_key" placeholder="Search by restaurant"
					   class="input-xxlarge search-query"/> <input type="submit" value="GO" name="submit" class="btn span1"/>
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
		<script>
		function init(){
			var city = $('#search-city').val().toLowerCase();
			if(city == 'all cities'){
				$('#search-location').html('<option>All locations</option>');
			}
			else{
				$.get('ajaxHandlers/dummy.php?city_name='+city, {}, function(data){
					var locs = jQuery.parseJSON(data).localities;
					var htm = '<option>All locations</option>';
					for (i=0; i < locs.length; i++){
						htm = htm + '<option>'+locs[i]+'</option>'
					}
					$('#search-location').html(htm);
				});	
			}
		}

		$('document').ready(function(){
			init();
			$('#search-city').change(function(){
				init();
			});
			$('.dropdown-toggle').dropdown();
		});
		</script>
	</body>
</html>
<?php
connectionClose($connection);
?>