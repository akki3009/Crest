<!DOCTYPE html>
<html>
<head>
	<title>Category </title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
	include 'welcome.php';
	?>
	<div><h2 id="head">Add Category</h2></div>
	<div class="container cat">
		<form class="form-horizontal" method="post" enctype="multipart/form-data" action="category_upload.php">
			<div class="form-group">
				<label class="control-label col-sm-2" for="category_name">CategoryName</label>
				<div class="col-sm-10">
					<input type="text" name="category_name" class="form-control" placeholder="Enter category name" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="category_image">CategoryImage</label>
				<div class="col-sm-10">
						<input type="file" name="category_image" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="category_order" required>Category Order</label>
				<div class="col-sm-10">
					<input type="text" name="category_order" class="form-control" placeholder="Enter Category Order">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="category_status" required>Category Status</label>
				<div class="col-sm-10">
					<input type="text" name="category_status" class="form-control" placeholder="Enter Category Status">
				</div>
			</div>
			<div class="form-group">        
				<div class="col-sm-offset-2 col-sm-2">
					<button type="submit" name="category" class="btn btn-success btn-block">Add Category</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>