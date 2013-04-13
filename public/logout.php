<?php
	require_once 'session.php';
	require_once '../include/util_functions.php';
	$_SESSION = array();
	
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(), '', time()-4200, '/');
	}
	
	session_destroy();
?>
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
	  p.btn {
		  text-align: center;
		  margin-left: 30%;
	  }
	  
	</style>
	</head>
	<body>
		<div id="header" class="row-fluid">
			<a href="home.php"><h2 id="logo" class="span6">KhauGali.com</h2></a>
		</div>
		<hr class="head"/>
		<div id="content" class="container">
			<form class="form-signin">
			<h3 class="form-signin-heading">Successfully Logged out</h3>
			<a href="home.php"><p class="btn btn-large btn-primary">Home</p></a><br/><br/>
			<a href="login.php"><p class="btn btn-large btn-primary">Log in</p></a><br/><br/>
			<a href="signup.php"><p class="btn btn-large btn-primary">Sign up</p></a><br/><br/>
      </form>
		</div>
		<?php
		include_once 'footer.php';
		?>