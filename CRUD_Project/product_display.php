<?php
require 'connection.php';
session_start();
if(!$_SESSION['user_name'])
{
	header("Location:login.php");
	exit;
}
$sql = "SELECT ps.*,im.*,ct.category_name FROM image im LEFT JOIN product ps ON im.product_id = ps.product_id LEFT JOIN category ct ON ps.category_id  = ct.category_id WHERE image_marked=1";
	$productResult=mysqli_query($connect,$sql);
	$folder = "uploads/product/thumbnail/";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Product Display </title>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"/>
	 <link rel="stylesheet" type="text/css" href="style.css">
	  <style>
		#head {
			height: 50px;
			padding: 10px 0;
			background: lightblue;
			text-align: center;
		}
	</style>
  	<script type="text/javascript">
  		function deleteRow(product_id)
  		{
  			var result=confirm("Are you sure you want to delete record")
            if(result)
            {
              window.location.href='product.php?product_id=' + product_id + '';
            }
      }
      function updateRow(product_id)
      {
        window.location.href='product_update.php?product_id='+product_id+'';
      }
  	</script>
</head>
<body>
	<?php
		include 'header.html';
	?>
	<div class="form-group">
		<div><h2 id="head">Product List</h2></div>
		<a href="product.php" class="btn btn-success button float-right">Add Product</a>
	</div>
	<div class="container-fluid prod">
		<table class="table table-bordered table-striped" id="example">
		<div class="col-md-8">
			<label style="color:blue;">Price Range&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="start_price" id="start_price" placeholder="Starting Price">
				<input type="text" name="end_price" id="end_price" placeholder="Ending Price">
        		<!-- <input type="submit" class="btn btn-primary btn-sm" id="search" name="search" value="search"> -->
    		</label>
    		<div class="">
    			<label style="color:blue;">Qunatity Range
    				<input type="text" name="qunatity_from" id="qunatity_from" placeholder="qunatity From">
    				<input type="text" name="qunatity_to" id="qunatity_to" placeholder="qunatity To">
    				<!-- <input type="submit" class="btn btn-primary btn-sm" id="search" name="search" value="search"> -->
    			</label>
    		</div>
        </div>
		<!-- <input type='hidden' id='sort' value='asc'> -->
			
				<thead>
					<tr>
						<th></th>
		                <th><input type="text" id="name" name="name" style="width:100px" autocomplete="off"></th>
		                <th></th>
		                <th><input type="text" id="category_name" style="width:100px" autocomplete="off"></th>
		                <th><input type="text" id="price" style="width:80px" autocomplete="off"></th>
		                <th><input type="text" id="qunatity" style="width:80px" autocomplete="off"></th>
		                <th></th>
		                <th></th>
		                <th></th>
		                <th></th>
		                <th></th>
		            </tr>
		            <tr>
		                <th>Image</th>
		                <th>ProductName</th>
		                <th>ProductCode</th>
		                <th>Category Name</th>
		                <th>Price/Sale Price</th>
		                <th>Quantity</th>
		                <th>Order</th>
		                <th>Status</th>
		                <th>Added Date</th>
		                <th>Modified Date</th>
		                <th>Update</th>

		            </tr>
				</thead>
				<tbody>
				<?php 
				if($productResult){
					while ($row=mysqli_fetch_assoc($productResult)){
						echo "<tr>";
						echo "<td ><img src=". $folder . $row['image_name'] ."></td>";
						echo "<td>". $row['product_name']."</td>";
						echo "<td>". $row['product_code']."</td>";
						echo "<td >" . $row['category_name'] . "</td>";
						echo "<td >" . $row['price'] . "/" . $row['sale_price'] . "</td>";
						echo "<td>". $row['product_quantity']."</td>";
						echo "<td>". $row['product_order']."</td>";
						echo "<td>". $row['product_status']."</td>";
						echo "<td>". $row['added_date']."</td>";
						echo "<td>". $row['modified_date']."</td>";
						echo "<td><input type='button' class='btn btn-success float-right' onClick='updateRow($row[product_id])' value='Update'>
						<input type='button' class='btn btn-danger float-right' onClick='deleteRow($row[product_id])' value=' Delete'></td>";
						echo "</tr>";
					}
				}
					?>
			</tbody>
			</table>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#example').DataTable({
				"paging": true,
				"info": false,
				"processing": true,
				"serverSide": false,
			});
			$('#name,#price,#qunatity,#category_name').keyup(function(){
				var name=$('#name').val();
				var price=$('#price').val();
				var qunatity=$('#qunatity').val();
				var category_name=$('#category_name').val();
				$.ajax({
					url:"fetch_details.php",
					method:"POST",
					data:{name:name,price:price,qunatity:qunatity,category_name:category_name},
					success:function(data){
						$('tbody').html(data);	
					}	
				});
			});

			$('#start_price , #end_price').keyup(function(){
				var start_price = $('#start_price').val();
				var end_price = $('#end_price').val();
				$.ajax({
					url:"fetch_details.php",
					method:"POST",
					data:{start_price:start_price,end_price:end_price},
					success:function(data){
						$('tbody').html(data);	
					}	
				});
			});

			$('#qunatity_from , #qunatity_to').keyup(function(){
				var qunatity_from = $('#qunatity_from').val();
				var qunatity_to = $('#qunatity_to').val();
				$.ajax({
					url:"fetch_details.php",
					method:"POST",
					data:{qunatity_from:qunatity_from,qunatity_to:qunatity_to},
					success:function(data){
						$('tbody').html(data);	
					}	
				});
			});
		});
	</script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="jquery.dataTables.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
</body>
</html>