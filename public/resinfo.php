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
			$phoneNo = $row['phone_number'];
			$email = $row['email'];
			$address = $row['address'];
			$vegnv = $row['veg_non_veg'];
			$homeDelivery = $row['home_delivery'];
			$dineInTa = $row['dinein_take_away'];
			$costForTwo = $row['cost_for_two'];
			$timing = $row['timing'];
			$buffet = $row['buffet_availability'];
			$menu = $row['menu_card'];
			$payment = $row['payment_options'];
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
		$cuisine = array();
				
		$q2 = "SELECT cuisine_name 
			FROM cuisines JOIN (SELECT cuisine_id FROM serves WHERE rest_id=$resid) as cid 
				on cuisines.cuisine_id=cid.cuisine_id";
		$res = mysql_query($q2, $connection);
		confirmQuery($res);
		while($r = mysql_fetch_array($res)){
			$cuisine[] = $r['cuisine_name'];
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
		<link rel="stylesheet" href="../common.css" />
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
				<table class="table">
					<tr>
						<td><strong>Address:</strong> </td>
						<td><?php echo $address;?></td>
					</tr>
					<tr>
						<td><strong>Contact:</strong> 
							<ul>
								<li><strong>phone :</strong> <?php echo $phoneNo;?></li>
								<li><strong>email :</strong> <?php echo $email;?></li>
							</ul>
						</td>
					</tr>
					<tr>
						<td><strong>Cuisine:</strong> </td>
						<td>
							<ul>
							<?php
							foreach ($cuisine as $value) {
								echo '<li>'.$value.'</li>';
							}
							?>
							</ul>
						</td>
					</tr>
					<tr>
						<td><strong>Dine-in / Takeaway</strong> </td>
						<td><?php
							switch ($dineInTa){
								case 0: echo 'Dine in';
									break;
								case 1: echo 'Take away';
									break;
								case 2: echo 'Both';
									break;
								default : echo 'Undefined';
									break;
							}
						?></td>
					</tr>
					<tr>
						<td><strong>Buffet availability</strong> </td>
						<td><?php
							switch ($buffet){
								case 0: echo 'Not available';
									break;
								case 1: echo 'Available';
									break;
								default : echo 'Undefined';
									break;
							}
						?></td>
					</tr>
					<tr>
						<td><strong>Timing:</strong> </td>
						<td><?php  echo $timing;?></td>
					</tr>
					<tr>
						<td><strong>Cost for two:</strong> </td>
						<td><?php echo '&#x20B9;'.$costForTwo;?></td>
					</tr>
					<tr>
						<td><strong>Veg/Non-Veg</strong></td>
						<td><?php  
							switch ($vegnv){
								case 0: echo 'Veg';
									break;
								case 1: echo 'Non Veg';
									break;
								case 2: echo 'Egg';
									break;
								default : echo 'Undefined';
									break;
							}
						?></td>
					</tr>
					<tr>
						<td><strong>Payment option:</strong>  </td>
						<td><?php echo $payment;?></td>
					</tr>
					<tr>
						<td><strong>Home delivery:</strong> </td>
						<td><?php switch($homeDelivery){
							case 0:
								echo 'Not available';
								break;
							case 1:
								echo 'Available';
								break;
							default:
								echo 'Unknown';
								break;
						}
						?></td>
					</tr>
				</table>
				&nbsp;
				<hr />
				<?php if(chkLogin()){ ?>
				<strong>Rate:</strong>
				<form>
					ambience : <input type="number" name="taste" /><br />
					ambience : <input type="number" name="ambience" /><br />
					ambience : <input type="number" name="value_for_money" /><br />
					ambience : <input type="number" name="service" /><br />
					ambience : <input type="number" name="hygiene" /> <br />
					<input type="submit" class="btn" value="rate" name="rate" />
				</form>
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
