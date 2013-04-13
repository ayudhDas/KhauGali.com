<?php
	require_once 'session.php';
	require_once '../include/util_functions.php';
	require_once '../include/db_functions.php';
	if(!chkLogin()){
		redirectTo("home.php");
	}
	$connection = dbConnect();
	$username = $_SESSION['username'];
	$query = "select * from user where username='$username'";
	$result = mysql_query($query, $connection);
	confirmQuery($result);
	while($row = mysql_fetch_array($result)){
		$email = $row['email'];
		$name = $row['name'];
		$profilePic = $row['profile_picture'];
		$phoneNo = $row['phone_number'];
		$joined = $row['joined'];
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
			#content {
				padding-left: 30px;
				overflow-y: scroll;
			}
			#userdp {
				border: 1px solid black;
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
			<div class="container-fluid">
				<div class="row-fluid">
					<div id="userdp" class="span2">
						<img src=" <?php echo $profilePic; ?> " alt="user" height="180" width="180" style="text-align: center;"/>
					</div>
					<div class="span10">
						<h3><?php echo $name; ?></h3>
						<table class="table">
							<tr>
								<td>From : <?php ?></td>
								<td>Joined : <?php echo $joined; ?></td>
							</tr>
							<tr>
								<td>Email : <?php echo $email; ?></td>
								<td>Contact : <?php echo $phoneNo; ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			&nbsp;
			<div>
				<div class="btn-group" data-toggle="buttons-radio">
					<button type="button" class="btn ">My List</button>
					<button type="button" class="btn ">My Reviews</button>
				</div>
				<div>
					<h5><i class="icon-bookmark"></i>Been to:</h5>
					<table class="table">
						<tr>
							<td><ul><li>Restaurant 1</li></ul></td>
							<td>
								<div class="rating">
									<i class="icon-star"></i>
									<i class="icon-star"></i>
									<i class="icon-star"></i>
									<i class="icon-star"></i>
									<i class="icon-star-empty"></i>
								</div>
							</td>
						</tr>
						<tr>
							<td><ul><li>Restaurant 2</li></ul></td>
							<td>
								<div class="rating">
									<i class="icon-star"></i>
									<i class="icon-star"></i>
									<i class="icon-star"></i>
									<i class="icon-star-empty"></i>
									<i class="icon-star-empty"></i>
								</div>
							</td>
						</tr>
						<tr>
							<td><ul><li>Restaurant 3</li></ul></td>
							<td>
								<div class="rating">
									<i class="icon-star"></i>
									<i class="icon-star"></i>
									<i class="icon-star"></i>
									<i class="icon-star"></i>
									<i class="icon-star-empty"></i>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div>
					<h5><i class="icon-bookmark"></i>Favourites:</h5>
					<table class="table">
						<tr>
							<td><ul><li>Restaurant 2</li></ul></td>
						</tr>
						<tr>
							<td><ul><li>Restaurant 3</li></ul></td>
						</tr>
					</table>
				</div>
				<div>
					<h5><i class="icon-bookmark"></i>Wishlist:</h5>
					<table class="table">
						<tr>
							<td><ul><li>Restaurant 4</li></ul></td>
						</tr>
						<tr>
							<td><ul><li>Restaurant 5</li></ul></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<?php include_once 'footer.php'; ?>
<?php
connectionClose($connection);
?>