<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="feedlook.css">
</head>
<body>

	<div class="header">
		<h2>Login</h2>
	</div>
	
	<form class = "login" method="post" action="login.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>E-mail</label>
			<input type="text" name="email" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_user">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
	</form>


</body>
</html>