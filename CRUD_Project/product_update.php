<?php
require 'connection.php';
session_start();
if (!$_SESSION['user_name']) {
	header("Location:login.php");
	exit;
}
$product_id = $_GET['product_id'];
$result = "SELECT * FROM product LEFT JOIN image ON product.product_id =image.product_id WHERE product.product_id = '$product_id'";
$productResult = mysqli_query($connect, $result);
$productRow = mysqli_fetch_assoc($productResult);
$img = $productRow['image_name'];
$folder = "uploads/product/thumbnail/";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Data</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<script>
		function deleteRow(image_id) {
			// alert(image_id);
			window.location.href = 'product.php?image_id=' + image_id + '';
		}
	</script>
</head>
<body>
	<?php
	include 'header.html';
	?>
	<div>
		<h2 id="head">Update Product</h2>
	</div>
	<div class="container prod">
		<form class="form-horizontal" method="post" enctype="multipart/form-data" id="productForm1" action="product.php">
			<input type="hidden" name="product_id" value="<?php echo $productRow['product_id']; ?>">
			<input type="hidden" id="image_id" name="image_id" value="<?php echo $productRow['image_id']; ?>">
			<div class="form-group">
				<label class="control-label col-sm-2" for="image_name">Product Image</label>
				<div class="col-sm-10">
					<input type="file" id="image_name" name="image_name" class="form-control" multiple />
					<div class="d-flex my-2">
						<?php
						$query = "select * from image where product_id='$product_id'";
						$result = mysqli_query($connect, $query);
						
						while ($row = mysqli_fetch_array($result)) {
							$image_name = $folder . $row['image_name'];
							$marked = $row['image_marked'];
						?>
							<div class="d-flex flex-wrap">
								<img src='<?php echo $image_name; ?>' name="image2" id="image2">
								<div class="d-flex justify-content-between align-items-center mt-2">
									<input type="radio" name="image" value="<?php echo $row['image_id'] ?>" <?php if ($row['image_marked'] == '1') { echo "checked";} ?>>
									<input type="button" class='btn btn-primary btn-sm mx-3' name="myradio" id="radio1" onclick="deleteRow(<?php echo $row['image_id']; ?>);" value="Delete">
								</div>
							</div>
						<?php
						} ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="product_name">Product Name</label>
				<div class="col-sm-10">
					<input type="text" name="product_name" class="form-control" value="<?php echo $productRow['product_name']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="category_name">category</label>
				<div class="col-sm-10">
					<select class="form-control" name="category_name" id="category_name">
						<?php
						$query = mysqli_query($connect, "SELECT * FROM category");
						while ($row = mysqli_fetch_array($query)) {
							echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
						}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="price">Price</label>
				<div class="col-sm-10">
					<input type="text" name="price" class="form-control" value="<?php echo $productRow['price']; ?>" >
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="sale_price">Sale Price</label>
				<div class="col-sm-10">
					<input type="text" name="sale_price" class="form-control" value="<?php echo $productRow['sale_price']; ?>" >
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="product_code">Product Code</label>
				<div class="col-sm-10">
					<input type="text" name="product_code" disabled class="form-control" style="color:lightslategray;" value="<?php echo $productRow['product_code']; ?>" >
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="product_quantity">Product Quantity</label>
				<div class="col-sm-10">
					<input type="text" name="product_quantity" class="form-control" value="<?php echo $productRow['product_quantity']; ?>" >
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="product_order">ProductOrder</label>
				<div class="col-sm-10">
					<input type="text" name="product_order" class="form-control" value="<?php echo $productRow['product_order']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="product_status">Product Status</label>
				<div class="col-sm-10">
					<input type="text" name="product_status" class="form-control" value="<?php echo $productRow['product_status']; ?>">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-2">
					<button type="submit" name="update" id="update" class="btn btn-success btn-block">Update</button>
				</div>
			</div>
		</form>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
	<script src="validation.js"></script>
</body>
</html>