<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style type="text/css">
		.login-panel {
			margin-top: 150px;
			text-align: center;
		}
	</style>
</head>

<body>
	<div class="container ">
		<div class="row justify-content-center">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">Sign In</h3>
					</div>
					<div class="panel-body">
						<form method="post" action="login.php" id="loginForm">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="UserName" type="text" name="user_name" autofocus>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Password" type="password" name="user_password">
								</div>
								<input class="btn btn-lg btn-success btn-block" type="submit" name="login" value="Login">
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
	<script src="validation.js"></script>
</body>

</html>
<?php
include 'connection.php';
if (isset($_POST['login'])) {
	$user_name = $_POST['user_name'];
	$user_password = $_POST['user_password'];

	$check_user = "select * from user WHERE user_name='$user_name' AND user_password = '$user_password'";
	$exec = mysqli_query($connect, $check_user);
	if (mysqli_num_rows($exec)) {
		echo "<script>window.open('welcome.php','_self')</script>";
		$_SESSION['user_name'] = $user_name;
	} else {
		echo "<script>alert('Username Or Password is incorrect!')</script>";
	}
}
?>