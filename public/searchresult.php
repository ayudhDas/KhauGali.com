<?php
	require_once 'session.php';
	require_once '../include/util_functions.php';
	require_once '../include/db_functions.php';
	require_once 'publicFunction.php';
	if(!(isset($_GET['location'])
			&& isset($_GET['city'])
			&& isset($_GET['search_key'])
			&& isset($_GET['submit']))){
		redirectTo('home.php');
	}
	$connection = dbConnect();
	$location = $_GET['location'];
	$city =	$_GET['city'];
	$searchKey= trim($_GET['search_key']);
	$initDat = array();
	if($searchKey == ''){
		if($city == 'All cities'){
			//echo 'all cities and all locations';
			$query = "select * from restaurant";
			$resultset = mysql_query($query,$connection);
			confirmQuery($resultset);
			if(mysql_num_rows($resultset) == 0){
					$message = 'Nothing found!';
			}
			while ($row = mysql_fetch_array($resultset)) {
				$resid = $row['res_id'];
				$resName = $row['restaurant_name'];
				$address = $row['address'];
				$phone = $row['phone_number'];
				$menu = $row['menu_card'];
				$costForTwo = $row['cost_for_two'];
				$vnv = $row['veg_non_veg'];
				$payment = $row['payment_options'];
				$buffet = $row['buffet_availability'];
				$dineInTa = $row['dinein_take_away'];
				$homeDelivery = $row['home_delivery'];
				$cuisine = array();
				$avgRating = getAvgRating($resid, $connection);
				
				$q2 = "SELECT cuisine_name 
					FROM cuisines JOIN (SELECT cuisine_id FROM serves WHERE rest_id=$resid) as cid 
						on cuisines.cuisine_id=cid.cuisine_id";
				$res = mysql_query($q2, $connection);
				confirmQuery($res);
				while($r = mysql_fetch_array($res)){
					$cuisine[] = $r['cuisine_name'];
				}
				$q2 = "SELECT locality_name, city_name 
					FROM city JOIN (SELECT * FROM located_in WHERE rest_id=$resid) as cityid
						on city.city_id=cityid.city_id";
				$res = mysql_query($q2, $connection);
				confirmQuery($res);
				while($r = mysql_fetch_array($res)){
					$res_city = $r['city_name'];
					$res_loc = $r['locality_name'];
				}
				
				$initDat[] = array(
					'resid'=>$resid,
					'resname'=>$resName,
					'rescity'=>$res_city,
					'resloc'=>$res_loc,
					'rescuisine'=>$cuisine,
					'resaddress'=>$address,
					'resphone'=>$phone,
					'resmenu'=>$menu,
					'rescost'=>$costForTwo,
					'resvnv'=>$vnv,
					'respayment'=>$payment,
					'resbuffet'=>$buffet,
					'resdineta'=>$dineInTa,
					'reshomedel'=>$homeDelivery,
					'resavgrat' =>$avgRating
					);
			}
			//var_dump(json_encode(array('searchResult'=>$initDat)));
		}
		else{
			if($location == 'All locations'){
				//echo 'city + all locs';
				$query = "select * from restaurant join 
					(select rest_id from located_in join 
					(select city_id from city where city_name='$city') as r1 
						where r1.city_id=located_in.city_id) as r2
						where restaurant.res_id=r2.rest_id";
				$resultset = mysql_query($query,$connection);
				confirmQuery($resultset);
				if(mysql_num_rows($resultset) == 0){
					$message = 'Nothing found!';
				}
				while ($row = mysql_fetch_array($resultset)) {
					$resid = $row['res_id'];
					$resName = $row['restaurant_name'];
					$address = $row['address'];
					$phone = $row['phone_number'];
					$menu = $row['menu_card'];
					$costForTwo = $row['cost_for_two'];
					$vnv = $row['veg_non_veg'];
					$payment = $row['payment_options'];
					$buffet = $row['buffet_availability'];
					$dineInTa = $row['dinein_take_away'];
					$homeDelivery = $row['home_delivery'];
					$cuisine = array();
					$avgRating = getAvgRating($resid, $connection);

					$q2 = "SELECT cuisine_name 
						FROM cuisines JOIN (SELECT cuisine_id FROM serves WHERE rest_id=$resid) as cid 
							on cuisines.cuisine_id=cid.cuisine_id";
					$res = mysql_query($q2, $connection);
					confirmQuery($res);
					while($r = mysql_fetch_array($res)){
						$cuisine[] = $r['cuisine_name'];
					}
					$q2 = "SELECT locality_name, city_name 
						FROM city JOIN (SELECT * FROM located_in WHERE rest_id=$resid) as cityid
							on city.city_id=cityid.city_id";
					$res = mysql_query($q2, $connection);
					confirmQuery($res);
					while($r = mysql_fetch_array($res)){
						$res_city = $r['city_name'];
						$res_loc = $r['locality_name'];
					}

					$initDat[] = array(
						'resid'=>$resid,
						'resname'=>$resName,
						'rescity'=>$res_city,
						'resloc'=>$res_loc,
						'rescuisine'=>$cuisine,
						'resaddress'=>$address,
						'resphone'=>$phone,
						'resmenu'=>$menu,
						'rescost'=>$costForTwo,
						'resvnv'=>$vnv,
						'respayment'=>$payment,
						'resbuffet'=>$buffet,
						'resdineta'=>$dineInTa,
						'reshomedel'=>$homeDelivery,
						'resavgrat' =>$avgRating
						);
				}
				//var_dump(json_encode(array('searchResult'=>$initDat)));
				
			}
			else{
				//echo 'city + particular loc';
				$query = "select * from restaurant join 
					(select rest_id from located_in join 
					(select city_id from city where city_name='$city') as r1 
					where located_in.city_id=r1.city_id and located_in.locality_name='$location') as r2 
					where restaurant.res_id = r2.rest_id";
				$resultset = mysql_query($query,$connection);
				confirmQuery($resultset);
				if(mysql_num_rows($resultset) == 0){
					$message = 'Nothing found!';
				}
				while ($row = mysql_fetch_array($resultset)) {
					$resid = $row['res_id'];
					$resName = $row['restaurant_name'];
					$address = $row['address'];
					$phone = $row['phone_number'];
					$menu = $row['menu_card'];
					$costForTwo = $row['cost_for_two'];
					$vnv = $row['veg_non_veg'];
					$payment = $row['payment_options'];
					$buffet = $row['buffet_availability'];
					$dineInTa = $row['dinein_take_away'];
					$homeDelivery = $row['home_delivery'];
					$cuisine = array();
					$avgRating = getAvgRating($resid, $connection);

					$q2 = "SELECT cuisine_name 
						FROM cuisines JOIN (SELECT cuisine_id FROM serves WHERE rest_id=$resid) as cid 
							on cuisines.cuisine_id=cid.cuisine_id";
					$res = mysql_query($q2, $connection);
					confirmQuery($res);
					while($r = mysql_fetch_array($res)){
						$cuisine[] = $r['cuisine_name'];
					}
					$q2 = "SELECT locality_name, city_name 
						FROM city JOIN (SELECT * FROM located_in WHERE rest_id=$resid) as cityid
							on city.city_id=cityid.city_id";
					$res = mysql_query($q2, $connection);
					confirmQuery($res);
					while($r = mysql_fetch_array($res)){
						$res_city = $r['city_name'];
						$res_loc = $r['locality_name'];
					}

					$initDat[] = array(
						'resid'=>$resid,
						'resname'=>$resName,
						'rescity'=>$res_city,
						'resloc'=>$res_loc,
						'rescuisine'=>$cuisine,
						'resaddress'=>$address,
						'resphone'=>$phone,
						'resmenu'=>$menu,
						'rescost'=>$costForTwo,
						'resvnv'=>$vnv,
						'respayment'=>$payment,
						'resbuffet'=>$buffet,
						'resdineta'=>$dineInTa,
						'reshomedel'=>$homeDelivery,
						'resavgrat' =>$avgRating
						);
				}
				//var_dump(json_encode(array('searchResult'=>$initDat)));
				
			}
		}
	}
	else{
		if($city == 'All cities'){
			//echo 'all cities and all locations';
			$query = "select * from restaurant where restaurant_name='$searchKey'";
			$resultset = mysql_query($query,$connection);
			confirmQuery($resultset);
			if(mysql_num_rows($resultset) == 0){
					$message = 'Nothing found!';
			}
			while ($row = mysql_fetch_array($resultset)) {
				$resid = $row['res_id'];
				$resName = $row['restaurant_name'];
				$address = $row['address'];
				$phone = $row['phone_number'];
				$menu = $row['menu_card'];
				$costForTwo = $row['cost_for_two'];
				$vnv = $row['veg_non_veg'];
				$payment = $row['payment_options'];
				$buffet = $row['buffet_availability'];
				$dineInTa = $row['dinein_take_away'];
				$homeDelivery = $row['home_delivery'];
				$cuisine = array();
				$avgRating = getAvgRating($resid, $connection);
				
				$q2 = "SELECT cuisine_name 
					FROM cuisines JOIN (SELECT cuisine_id FROM serves WHERE rest_id=$resid) as cid 
						on cuisines.cuisine_id=cid.cuisine_id";
				$res = mysql_query($q2, $connection);
				confirmQuery($res);
				while($r = mysql_fetch_array($res)){
					$cuisine[] = $r['cuisine_name'];
				}
				$q2 = "SELECT locality_name, city_name 
					FROM city JOIN (SELECT * FROM located_in WHERE rest_id=$resid) as cityid
						on city.city_id=cityid.city_id";
				$res = mysql_query($q2, $connection);
				confirmQuery($res);
				while($r = mysql_fetch_array($res)){
					$res_city = $r['city_name'];
					$res_loc = $r['locality_name'];
				}
				
				$initDat[] = array(
					'resid'=>$resid,
					'resname'=>$resName,
					'rescity'=>$res_city,
					'resloc'=>$res_loc,
					'rescuisine'=>$cuisine,
					'resaddress'=>$address,
					'resphone'=>$phone,
					'resmenu'=>$menu,
					'rescost'=>$costForTwo,
					'resvnv'=>$vnv,
					'respayment'=>$payment,
					'resbuffet'=>$buffet,
					'resdineta'=>$dineInTa,
					'reshomedel'=>$homeDelivery,
					'resavgrat' =>$avgRating
					);
			}
			//var_dump(json_encode(array('searchResult'=>$initDat)));
		}
		else{
			if($location == 'All locations'){
				//echo 'city + all locs';
				$query = "select * from restaurant join 
					(select rest_id from located_in join 
					(select city_id from city where city_name='$city') as r1 
						where r1.city_id=located_in.city_id) as r2
						where restaurant.res_id=r2.rest_id and restaurant_name='$searchKey'";
				$resultset = mysql_query($query,$connection);
				confirmQuery($resultset);
				if(mysql_num_rows($resultset) == 0){
					$message = 'Nothing found!';
				}
				while ($row = mysql_fetch_array($resultset)) {
					$resid = $row['res_id'];
					$resName = $row['restaurant_name'];
					$address = $row['address'];
					$phone = $row['phone_number'];
					$menu = $row['menu_card'];
					$costForTwo = $row['cost_for_two'];
					$vnv = $row['veg_non_veg'];
					$payment = $row['payment_options'];
					$buffet = $row['buffet_availability'];
					$dineInTa = $row['dinein_take_away'];
					$homeDelivery = $row['home_delivery'];
					$cuisine = array();
					$avgRating = getAvgRating($resid, $connection);

					$q2 = "SELECT cuisine_name 
						FROM cuisines JOIN (SELECT cuisine_id FROM serves WHERE rest_id=$resid) as cid 
							on cuisines.cuisine_id=cid.cuisine_id";
					$res = mysql_query($q2, $connection);
					confirmQuery($res);
					while($r = mysql_fetch_array($res)){
						$cuisine[] = $r['cuisine_name'];
					}
					$q2 = "SELECT locality_name, city_name 
						FROM city JOIN (SELECT * FROM located_in WHERE rest_id=$resid) as cityid
							on city.city_id=cityid.city_id";
					$res = mysql_query($q2, $connection);
					confirmQuery($res);
					while($r = mysql_fetch_array($res)){
						$res_city = $r['city_name'];
						$res_loc = $r['locality_name'];
					}

					$initDat[] = array(
						'resid'=>$resid,
						'resname'=>$resName,
						'rescity'=>$res_city,
						'resloc'=>$res_loc,
						'rescuisine'=>$cuisine,
						'resaddress'=>$address,
						'resphone'=>$phone,
						'resmenu'=>$menu,
						'rescost'=>$costForTwo,
						'resvnv'=>$vnv,
						'respayment'=>$payment,
						'resbuffet'=>$buffet,
						'resdineta'=>$dineInTa,
						'reshomedel'=>$homeDelivery,
						'resavgrat' =>$avgRating
						);
				}
				//var_dump(json_encode(array('searchResult'=>$initDat)));
				
			}
			else{
				//echo 'city + particular loc';
				$query = "select * from restaurant join 
					(select rest_id from located_in join 
					(select city_id from city where city_name='$city') as r1 
					where located_in.city_id=r1.city_id and located_in.locality_name='$location') as r2 
					where restaurant.res_id = r2.rest_id and restaurant_name='$searchKey'";
				$resultset = mysql_query($query,$connection);
				confirmQuery($resultset);
				if(mysql_num_rows($resultset) == 0){
					$message = 'Nothing found!';
				}
				while ($row = mysql_fetch_array($resultset)) {
					$resid = $row['res_id'];
					$resName = $row['restaurant_name'];
					$address = $row['address'];
					$phone = $row['phone_number'];
					$menu = $row['menu_card'];
					$costForTwo = $row['cost_for_two'];
					$vnv = $row['veg_non_veg'];
					$payment = $row['payment_options'];
					$buffet = $row['buffet_availability'];
					$dineInTa = $row['dinein_take_away'];
					$homeDelivery = $row['home_delivery'];
					$cuisine = array();
					$avgRating = getAvgRating($resid, $connection);

					$q2 = "SELECT cuisine_name 
						FROM cuisines JOIN (SELECT cuisine_id FROM serves WHERE rest_id=$resid) as cid 
							on cuisines.cuisine_id=cid.cuisine_id";
					$res = mysql_query($q2, $connection);
					confirmQuery($res);
					while($r = mysql_fetch_array($res)){
						$cuisine[] = $r['cuisine_name'];
					}
					$q2 = "SELECT locality_name, city_name 
						FROM city JOIN (SELECT * FROM located_in WHERE rest_id=$resid) as cityid
							on city.city_id=cityid.city_id";
					$res = mysql_query($q2, $connection);
					confirmQuery($res);
					while($r = mysql_fetch_array($res)){
						$res_city = $r['city_name'];
						$res_loc = $r['locality_name'];
					}

					$initDat[] = array(
						'resid'=>$resid,
						'resname'=>$resName,
						'rescity'=>$res_city,
						'resloc'=>$res_loc,
						'rescuisine'=>$cuisine,
						'resaddress'=>$address,
						'resphone'=>$phone,
						'resmenu'=>$menu,
						'rescost'=>$costForTwo,
						'resvnv'=>$vnv,
						'respayment'=>$payment,
						'resbuffet'=>$buffet,
						'resdineta'=>$dineInTa,
						'reshomedel'=>$homeDelivery,
						'resavgrat' =>$avgRating
						);
				}
				//var_dump(json_encode(array('searchResult'=>$initDat)));
				
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
		<link rel="stylesheet" href="../css/bootstrap-responsive.css" />
		<link rel="stylesheet" href="../css/common.css" />
		<style>
		#content {
			/*margin-right: 250px;*/
			/*max-width: 70%;*/
			overflow-y: scroll;
		}
		#sidebar {
			border-right: 1px solid black;
		}
		
		.rightCol {
			text-align: right;
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
			<div class="span12">
				<form style="margin-left:35%;"
					  action="searchresult.php"
					  method="get">
					<input type="text" style="visibility: hidden; width: 0px" name="location" value="<?php echo $location; ?>" />
					<input type="text" style="visibility: hidden; width: 0px" name="city" value="<?php echo $city; ?>" />
					<input type="text" name="search_key" id ="search_key" placeholder="Search by restaurant"
					   class="input-large search-query"/> <input type="submit" value="GO" name="submit" class="btn span1"/>
				</form>
			</div>
			<div class="container-fluid" >
			  <div class="row-fluid" >
				  <div class="span2" id="sidebar">
				  <!--Sidebar content-->
				  Filters <a href="">Reset All</a>
				  &nbsp;
				  <div id="cuisine">
					  <h5>cuisine</h5>
					  <label class="checkbox">
						  <input type="checkbox" value="1"> All 
					  </label>
					  <label class="checkbox">
							<input type="checkbox" value="2"> North Indian
							</label>
					  <label class="checkbox">
							<input type="checkbox" value="3"> South Indian
							</label>
					  <label class="checkbox">
							<input type="checkbox" value="4"> Gujarati
							</label>
					  <label class="checkbox">
							<input type="checkbox" value="5"> Chinese 
					</label>
					  <hr />
				  </div>
				  <div id="cost">
					  <h5>Cost For Two</h5>
					  <label class="checkbox">
						<input type="checkbox" value=""> Less than 300
					</label> 
					  <label class="checkbox">
						<input type="checkbox" value=""> 300-500
						</label>
					  <label class="checkbox">
						<input type="checkbox" value=""> 500-1000
						</label>
					  <label class="checkbox">
						<input type="checkbox" value=""> 1000-2000
					</label>
					  <label class="checkbox">
						<input type="checkbox" value=""> More than 2000
					</label>
					  <hr />
				  </div>
				  <div id="veg">
					  <label class="checkbox">
						<input type="checkbox" value=""> Veg
					</label>
					  <label class="checkbox">
						<input type="checkbox" value=""> Non-Veg
					</label>
					  <label class="checkbox">
						<input type="checkbox" value=""> Egg
					</label>
					  <hr />
				  </div>
				  <div id="pay">
					  <h5>Payment options</h5>
					  <label class="checkbox">
						<input type="checkbox" value=""> Cash
					</label>
					  <label class="checkbox">
						<input type="checkbox" value=""> Credit card
					</label>
					  <hr />
				  </div>
				  <div id="misc">
					  <label class="checkbox">
						<input type="checkbox" value=""> Buffet
					</label>
					  <label class="checkbox">
						<input type="checkbox" value=""> Take-away
					</label>
					  <label class="checkbox">
						<input type="checkbox" value=""> Home delivery
					</label>
				  </div>
				  <a href="">Reset All</a>
				</div>
				<div class="span10" id="searchres">
				  <!--Body content-->
				  <h3 class="form-signin-heading">
				  <?php
					if($city == 'All cities'){
						echo 'All restaurants';
					}
					else{
						if($location == 'All locations'){
							echo 'All restaurants in '. $city;
						}
						else{
							echo 'All restaurants in '. $location . ', '. $city;
						}
					}
				  ?>
				  </h3>
<!--			Future enhancement maybe.	
				<div class="btn-group" data-toggle="buttons-radio">
					<button type="button" class="btn btn-primary">Dine In</button>
					<button type="button" class="btn btn-primary">Take Away</button>
					<button type="button" class="btn btn-primary">All</button>
				</div>-->
				  <div class="pull-right">
					  Sorted by:
				<div class="btn-group" data-toggle="buttons-radio">
					<button type="button" class="btn btn-primary">Rating</button>
					<button type="button" class="btn btn-primary">Cost</button>
				</div>
				  </div>
				  <br />
				  <br />
				  <div id="notFound"><?php
//						if(isset($message)){
//							echo '<strong>'.$message.'</strong>';
//						}
					  ?></div>
				  <table class="table" id="search-content">
				  </table>
				</div>
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
		<script src="../js/jquery-1.9.1.js"></script>
		<script src="../js/bootstrap.js"></script>
		<script src="../js/jqBootstrapValidation.js"></script>
		<script>
			var initDat = '<?php echo json_encode(array('searchResult'=>$initDat)); ?>';
			$('document').ready(function(){
				var dat = initDat;
				dat = jQuery.parseJSON(dat);
				//dat = JSON.parse(dat);
				if(dat.searchResult.length == 0){
					$('#notFound').addClass("alert alert-error");
					$('#notFound').html('<strong>Not Found!</strong>');
				}
				else{
					var htm = '';
					for(var i=0; i< dat.searchResult.length; i++){
						var currRes = dat.searchResult[i];
						htm = htm + '<tr>';
						htm = htm + '<td>';
						htm = htm + '<h4><a href="resinfo.php?resid='+currRes.resid +'">' + currRes.resname + '</a></h4>';
						htm = htm + '<p><strong>Location:</strong> '+ currRes.resloc + ', '+ currRes.rescity +'</p>';
						htm = htm + '<p><strong>Cuisines available:</strong> </p>';
						htm = htm + '<ul>';
						for(var j=0; j< currRes.rescuisine.length; j++){
							htm = htm + '<li>'+currRes.rescuisine[j]+'</li>';
						}
						htm = htm + '</ul>';
						htm = htm + '<p><strong>Address</strong>: '+ currRes.resaddress + '</p>';
						htm = htm + '<p><strong>Contact number:</strong> '+ currRes.resphone + '</p>';
						htm = htm + '</td>';
						htm = htm + '<td class="rightCol">';
						//rating logic here
						htm = htm + '<div class="rating">';
						for(var k=0; k < parseInt(currRes.resavgrat); k++){
							htm = htm + '<i class="icon-star"></i>';
						}
						for(var k=0; k < 5-parseInt(currRes.resavgrat); k++){
							htm = htm + '<i class="icon-star-empty"></i>';
						}
						htm = htm + '</div>';
						htm = htm + '&nbsp;';
						htm = htm + '<p><strong>Cost for two:</strong> &#x20B9;'+ currRes.rescost +'</p>';
						htm = htm + '<p><strong>Home Delivery:</strong> '+ (parseInt(currRes.reshomedel)==1?'Yes':'No') + '</p>';
						htm = htm + '<ul>';
						htm = htm + '<li><a href="">Menu card</a></li>';
						htm = htm + '</ul>';
						htm = htm + '</td>';
						htm = htm + '</tr>';
					}
				}
				$('#search-content').html(htm);
			});
		</script>
	</body>
</html>
		<?php
			connectionClose($connection);
