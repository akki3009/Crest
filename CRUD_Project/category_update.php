<?php
require 'connection.php';
session_start();
if (!$_SESSION['user_name']) {
	header("Location:login.php");
	exit;
}
$category_id = $_GET['category_id'];
$result = "select * from category where category_id='$category_id'";
$updateResult = mysqli_query($connect, $result);
$row = mysqli_fetch_assoc($updateResult);
$img = $row['category_image'];
$folder = "uploads/category/thumbnail/" . $img;
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update Data</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
		#head {
			height: 50px;
			padding: 10px 0;
			background: lightblue;
			text-align: center;
		}
	</style>
</head>

<body>
	<div>
		<h2 id="head">Update Category</h2>
	</div>
	<div class="container cat">
		<form class="form-horizontal" method="post" id="categoryForm1" enctype="multipart/form-data" action="category.php">
			<div class="form-group">
				<input type="hidden" name="category_id" value="<?php echo $row['category_id']; ?>">
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="category_name">CategoryName</label>
				<div class="col-sm-10">
					<input type="text" name="category_name" class="form-control" value="<?php echo $row['category_name'] ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="category_image">CategoryImage</label>
				<div class="col-sm-10">
					<input type="file" name="category_image" class="form-control" value="<?php echo $folder; ?>">
					<img src="<?php echo $folder; ?>" height="100" width="100">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="category_order">Category Order</label>
				<div class="col-sm-10">
					<input type="text" name="category_order" class="form-control" value="<?php echo $row['category_order']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="category_status">Category Status</label>
				<div class="col-sm-10">
					<input type="text" name="category_status" class="form-control" value="<?php echo $row['category_status']; ?>">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-2">
					<button type="submit" name="submit" class="btn btn-success btn-block">Update</button>
				</div>
			</div>
		</form>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
	<script src="validation.js"></script>
</body>

</html>