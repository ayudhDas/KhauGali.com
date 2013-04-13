<?php
	require_once 'session.php';
	require_once '../include/util_functions.php';
	require_once '../include/db_functions.php';
	require_once 'publicFunction.php';
	if(!isset($_GET['resid'])){
		redirectTo('home.php');
	}
	$resid = $_GET['resid'];
	$connection = dbConnect();
	$query = "select * from restaurant where res_id=$resid";
	$resultset = mysql_query($query, $connection);
	confirmQuery($resultset);
	if(mysql_num_rows($resultset) == 0){
		echo '<h3>invalid restaurant id<h3>';
		echo '<a href="home.php">back to home</a>';
		exit();
	}
	else{
		while($row = mysql_fetch_array($resultset)){
			$restaurantName = $row['restaurant_name'];
		}
		$query = "select rest_id,city.city_id,city_name,locality_name
			from city, located_in
			where city.city_id=located_in.city_id and rest_id=$resid";
		$resultset = mysql_query($query, $connection);
		confirmQuery($resultset);
		while($row = mysql_fetch_array($resultset)){
			$city = $row['city_name'];
			$locality = $row['locality_name'];
		}
		$avgRating = getAvgRating($resid, $connection);
		
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
			#innerContent {
				padding-top: 15px;
				padding-bottom: 15px;
				width: 100%;
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
			<div class="span8">
				<h3><?php echo $restaurantName;?></h3>
				<p><?php echo $locality.' ,'.$city; ?></p>
			</div>
			<div class="span4">
					Average user rating : <?php echo $avgRating .'/'. 5; ?>
					<div class="rating">
						<?php
							for($i = 0;$i < $avgRating; $i++){
						?>
						<i class="icon-star"></i>
						<?php
							}
							for($i = 0; $i< 5-$avgRating;$i++){
						?>
						<i class="icon-star-empty"></i>
						<?php
							}
						?>
					</div>
				<br />
				<?php if(chkLogin()){
					$userRating = getUserAvgRating($_SESSION['username'], $resid, $connection)
				?>
					Your Rating :<?php echo $userRating .'/'. 5; ?>
					<div class="rating">
						<?php
							for($i = 0;$i < $userRating; $i++){
						?>
						<i class="icon-star"></i>
						<?php
							}
							for($i = 0; $i< 5-$userRating;$i++){
						?>
						<i class="icon-star-empty"></i>
						<?php
							}
						?>
					</div>
				<?php }
				else {
					echo '<br /><br />';
				}
				?>
			</div>
			<br/>
			<div class="btn-group" >
				<a href="resinfo.php?resid=<?php echo $resid;?>"><div class="btn ">Information</div></a>
				<a><div class="btn ">Menu</div></a>
				<a><div class="btn ">Photos</div></a>
				<a href="resreview.php?resid=<?php echo $resid;?>"><div class="btn ">Reviews</div></a>
			</div>
			<!-- sub content begins from here -->
			<!--=================================================================================-->
			<div id="innerContent">
				<br/>
				<br/>
				<?php
					$query = "select * from reviews where rest_id=$resid";
					$resultset = mysql_query($query,$connection);
					confirmQuery($resultset);
					while($row = mysql_fetch_array($resultset)){
				?>
					<div class="row">
						<hr />
						<div class="span8" style="padding-left: 50px">
							<i class="icon-user"></i>
							<?php echo $row['username']; ?>
						</div>
						<div class="span6">
						<?php $userRating = getUserAvgRating($row['username'], $resid, $connection);?>
						<div class="rating">
						<?php
							for($i = 0;$i < $userRating; $i++){
						?>
						<i class="icon-star"></i>
						<?php
							}
							for($i = 0; $i< 5-$userRating;$i++){
						?>
						<i class="icon-star-empty"></i>
						<?php
							}
						?>
						</div>
					</div>
						<br />
					<div>
						<?php echo '<pre>'.$row['review'].'</pre>'; ?>
					</div>
					<hr />
				<?php		
					}
				?>
				<?php if(chkLogin()){ ?>
				<hr/>
				<form>
					<strong>Write a review:</strong>
					<br/>
					<textarea rows="6" name="review"></textarea>
					<br />
					<button type="submit" class="btn" name="rev-submit">Submit</button>
				</form>
				<?php } ?>
			</div>
		</div>
		<?php
		include_once 'footer.php';
		connectionClose($connection);