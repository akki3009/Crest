<?php
session_start();
if (!$_SESSION['user_name']) {
	header("Location:login.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<title>Welcome </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		h1 {
			margin-top: 200px;
			text-align: center;
		}
	</style>
</head>

<body>
	<?php
	include 'header.html';
	echo '<h1>Welcome To Home Page '.ucfirst($_SESSION['user_name']).'</h1>';
	?>
</body>

</html>