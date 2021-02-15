<?php
session_start();
require 'connection.php';
try
{
	if(isset($_GET["product_id"]))
	{
		$select="SELECT product_image FROM product WHERE product_id='".$_GET['product_id']."'";
		$query=mysqli_query($connect,$select);
		while($row=mysqli_fetch_assoc($query)){
			$file='uploads/product/'.$row['product_image'];
		}
		$sql="DELETE FROM product WHERE product_id= '".$_GET['product_id']."'";
		unlink($file);
		$query=mysqli_query($connect,$sql);
		$msg="Success";
		header("Location:http://localhost/CREST/Project/product_display.php");
	}
	else{
		header("Location:http://localhost/CREST/Project/product_display.php");
	}
}
catch(PDOException $e){
	header("Location:http://localhost/CREST/Project/product_display.php");
}
?>