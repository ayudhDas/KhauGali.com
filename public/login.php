<?php
	require_once 'session.php';
	require_once '../include/util_functions.php';
	if(chkLogin()){
		redirectTo("home.php");
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
			?>
			<form class="form-signin" action="home.php" method="post">
			<h3 class="form-signin-heading">Start exploring all the great food out there, log in</h3>
			<div class="control-group">
				<div class="controls">
				<input type="text" class="input-block-level" placeholder="username or email" required name="handle">
				<p class="help-block"></p>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
				<input type="password" class="input-block-level" placeholder="Password" required name="pass">
				<p class="help-block"></p>
				</div>
			</div>
			<label class="checkbox">
				<input type="checkbox" value="remember-me"> Remember me
			</label>
			<input class="btn btn-large btn-primary pull-right" type="submit" value="Sign in" name="login" />
			<a href="">Forgot password?</a>
			<div id="social">
				Or log on using: 
				<img src="../img/fb.png" alt="fb" />
				<img src="../img/tw.png" alt="tw" />
				<img src="../img/go.png" alt="go" />
			</div>
			&nbsp;
			<p>Not on khauGali yet? </p>
			<a href="signup.php"><p class="btn btn-large btn-primary">Sign up</p></a>
      </form>
		</div>
		<?php include_once 'footer.php';?>
