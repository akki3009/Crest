<?php

require 'connection.php';
session_start();
if (!$_SESSION['user_name']) {
	header("Location:login.php");
	exit;
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Category Display </title>
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
		function deleteRow(category_id) {
			var result = confirm("Are you sure you want to delete record")
			if (result) {
				window.location.href = 'category.php?category_id=' + category_id + '';
			} else {
				window.location.href = 'category_display.php';
			}

		}

		function updateRow(category_id) {
			window.location.href = 'category_update.php?category_id=' + category_id + '';
		}
	</script>
</head>

<body>
	<?php
	require 'header.html';
	?>
	<div class="form-group">
		<div>
			<h2 id="head">Category List</h2>
		</div>
		<a href="category.php" class="btn btn-success button float-right">Add Category</a>
	</div>
	<div class="container-fluid cat">
		<input type="text" id="searched" placeholder="Search for names.." title="Type in a name">
		<div class="row">
			<div class="col-md-4">
				<select class="form-control" id="status">
					<option selected>All</option>
					<option>Active</option>
					<option>Inactive</option>
				</select>
			</div>
		</div>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th scope="col">CategoryImage</th>
					<th scope="col">CategoryName</th>
					<th scope="col">CategoryOrder</th>
					<!-- <th scope="col">No Of Products</th> -->
					<th scope="col">CategoryStatus</th>
					<th scope="col">AddedDate</th>
					<th scope="col">ModifiedDate</th>
					<th colspan="2" scope="col" style="text-align: center;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				include 'connection.php';
				$categoryList = "select ct.* from category ct left join product ps on ct.category_id=ps.category_id GROUP BY ct.category_id ;";
				$listResult = mysqli_query($connect, $categoryList);
				$folder = "uploads/category/thumbnail/";
				if ($listResult) {
					while ($row = mysqli_fetch_array($listResult)) {
						echo "<tr>";
						echo "<td ><img src=" . $folder . $row['category_image'] . " width=70 height=70 ></td>";
						echo "<td>" . $row['category_name'] . "</td>";
						echo "<td>" . $row['category_order'] . "</td>";
						// echo "<td >" . $row['totalproduct'] . "</td>";
						echo "<td>" . $row['category_status'] . "</td>";
						echo "<td>" . $row['added_date'] . "</td>";
						echo "<td>" . $row['modified_date'] . "</td>";
						echo "<td><input type='button' class='btn btn-success float-right' onClick='updateRow($row[category_id])' value='Update'></td>";
						echo "<td><input type='button' class='btn btn-danger float-right' onClick='deleteRow($row[category_id])' value=' Delete'></td>";
						echo "</tr>";
					}
				}
				?>
			</tbody>
		</table>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#searched").on("keyup", function() {
				var search = $('#searched').val();
				$.ajax({
					url: "search.php",
					method: "POST",
					data: {
						search: search
					},
					success: function(data) {
						$('tbody').html(data);
					}
				});
			});
		});
		$(document).ready(function() {
			$('#status').change(function() {
				var statuses = $('#status').val();
				$.ajax({
					url: "search.php",
					method: "POST",
					data: {
						statuses: statuses
					},
					success: function(data) {
						$("tbody").html(data);
					}
				});
			});
		});
	</script>
</body>

</html>