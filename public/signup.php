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
		<link rel="stylesheet" href="../common.css" />
		<style>
		#content {
        padding-top: 30px;
        padding-bottom: 30px;
		height: 600px;
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
	  .form-signin input[type="email"],
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
<!--			<div id="auth" class="span6">
				<button class="pull-right btn btn-success btnauth">sign up</button>
				<button class="pull-right btn btn-success btnauth">log in</button>
			</div>-->
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
			<h3 class="form-signin-heading">Join the food lovers' community by Signing Up</h3>
			<div class="control-group">
				<div class="controls">
				<input type="text" class="input-block-level" required placeholder="Name" name="name" />
				<p class="help-block"></p>
				</div>
			</div>
<!--			<div class="control-group">
					<label class="control-label" for="email">Email address</label>
					<div class="controls">
						<input type="email" name="email" id="email" required>
						<p class="help-block">Email address we can contact you on</p>
					</div>
				</div>-->
			<div class="control-group">
				<div class="controls">
				<input type="email" required data-validation-email-message="invalid email" class="input-block-level" placeholder="Email" name="email" />
				<p class="help-block"></p>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
				<input type="text" required class="input-block-level" placeholder="Username"
					   name="uname"
					   data-validation-ajax-ajax="ajaxHandlers/signupValidator.php" />
				<p class="help-block"></p>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
				<input type="password" required class="input-block-level" id="pass" placeholder="Password" name="pass" />
				<p class="help-block"></p>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
				<input type="password" data-validation-matches-match="pass"
					   data-validation-matches-message="passwords don't match"
					   required class="input-block-level" placeholder="Confirm Password" name="cpass" />
				<p class="help-block"></p>
				</div>
			</div>
			<input class="btn btn-large btn-primary pull-right" value="Sign up" type="submit" name="signup" />
			<!--<a href="">Forgot password?</a>-->
			<div id="social">
				Or Sign Up using: 
				<img src="../img/fb.png" alt="fb" />
				<img src="../img/tw.png" alt="tw" />
				<img src="../img/go.png" alt="go" />
			</div>
			&nbsp;
			<p>Already on KhauGali?</p>
			<a href="login.php"><div class="btn btn-large btn-primary">Log in</div></a>
      </form>
		</div>
		<?php
			include_once 'footer.php';
