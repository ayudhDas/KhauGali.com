<?php
	require_once 'session.php';
	require_once '../include/db_functions.php';
	require_once '../include/util_functions.php';
	if(!chkLogin()){
		redirectTo("home.php");
	}
	$username = $_SESSION['username'];
	$connection = dbConnect();
	if(isset($_POST['changePass'])){
		$prevPassHash = sha1($_POST['currpass']);
		$newpass = $_POST['newpass'];
		$query = "select hashed_password from user where username='$username'";
		$result = mysql_query($query, $connection);
		confirmQuery($result);
		while($row = mysql_fetch_array($result)){
			$hashpass = $row['hashed_password'];
			if($hashpass == $prevPassHash){
				$newpassHash = sha1($newpass);
				$query = "update user set hashed_password='$newpassHash' where username='$username'";
				$update = mysql_query($query, $connection);
				confirmQuery($update);
				if($update){
					$info = 'password changed successfully';
					redirectTo('changePassword.php?info='.  urlencode($info));
				}
				else{
					$error = 'something went wrong';
					redirectTo('changePassword.php?error='.  urlencode($error));
				}
			}
			else{
				$error = 'current password incorrect';
				redirectTo('changePassword.php?error='.  urlencode($error));
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
		#content {
        padding-top: 30px;
        padding-bottom: 30px;
      }

      .form-signin {
        max-width: 400px;
        padding: 10px 20px 20px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
	  
	  #social {
		  margin-top: 40px;
	  }
	</style>
	</head>
	<body>
		<div id="header" class="row-fluid">
			<a href="home.php"><h2 id="logo" class="span6">KhauGali.com</h2></a>
		</div>
		<hr class="head"/>
		<div id="content" class="container">
			<?php 
			if(isset($_GET['error'])){
				echo '<div class="alert alert-error" id="warnings">'; 
				echo '<strong>'.  urldecode($_GET['error']).'</strong>';
				echo '</div>';
			}
			if(isset($_GET['info'])){
				echo '<div class="alert alert-success" id="warnings">'; 
				echo '<strong>'.  urldecode($_GET['info']).'</strong>';
				echo '<a href="profile.php"><p>Back to profile</p></a>';
				echo '</div>';
			}
			?>
			<form class="form-signin" action="changePassword.php" method="post">
			<h3 class="form-signin-heading">Change password</h3>
			<div class="control-group">
				<div class="controls">
				<input type="password" class="input-block-level" placeholder="enter your current password" required name="currpass">
				<p class="help-block"></p>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
				<input type="password" class="input-block-level" placeholder="new password" required name="newpass">
				<p class="help-block"></p>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
				<input type="password" class="input-block-level" placeholder="confirm password"
					   data-validation-matches-match="newpass"
					   data-validation-matches-message="passwords don't match"
					   required name="confpass">
				<p class="help-block"></p>
				</div>
			</div>
			<input class="btn btn-large btn-primary" type="submit" value="Change" name="changePass" />
			<a href="profile.php"><p class="btn btn-large btn-primary">Cancel</p></a>
      </form>
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
			$('document').ready(function(){
				$("input").not("[type=submit]").jqBootstrapValidation();
				
			});
		</script>
	</body>
</html>
<?php
connectionClose($connection);
?>