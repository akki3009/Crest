<?php
require 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Product </title>
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
	<div><h2 id="head">Add product</h2></div>
	<div class="container prod">
		<form class="form-horizontal" method="post" enctype="multipart/form-data" action="product_upload.php">
			<div class="form-group">
				<label class="control-label col-sm-2" for="product_name">Product Name</label>
				<div class="col-sm-10">
					<input type="text" name="product_name" class="form-control" placeholder="Enter product name" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="product_image">Product Image</label>
				<div class="col-sm-10">
					<input type="file" name="product_image" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="category_id">CategoryId</label>
				<div class="col-sm-10">
					<select class="form-control" name="category_id">
						<option disabled selected>Category Id</option>
						<?php
							include 'connection.php';
							$query = mysqli_query($connect,"SELECT category_id FROM category");
							while($row=mysqli_fetch_assoc($query)){
								echo "<option value='".$row['category_id']."'>".$row['category_id']."</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="product_code">Product Code</label>
				<div class="col-sm-10">
					<input type="text" name="product_code" class="form-control" placeholder="Enter product code" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="price">Price</label>
				<div class="col-sm-10">
					<input type="text" name="price" class="form-control" placeholder="Enter product price" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="sale_price">Sale Price</label>
				<div class="col-sm-10">
					<input type="text" name="sale_price" class="form-control" placeholder="Enter Sale price" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="product_quantity">Product Quantity</label>
				<div class="col-sm-10">
					<input type="text" name="product_quantity" class="form-control" placeholder="Enter product quantity" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="product_order" required>Product Order</label>
				<div class="col-sm-10">
					<input type="text" name="product_order" class="form-control" placeholder="Enter Product Order">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="product_status" required>Product Status</label>
				<div class="col-sm-10">
					<input type="text" name="product_status" class="form-control" placeholder="Enter Product Status">
				</div>
			</div>
			<div class="form-group">        
				<div class="col-sm-offset-2 col-sm-2">
					<button type="submit" name="product" class="btn btn-success btn-block">Add Product</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>