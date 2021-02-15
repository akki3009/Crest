<?php
session_start();
require 'connection.php';
try
{
	if(isset($_GET["category_id"]))
	{
		$select="SELECT category_image FROM category WHERE category_id='".$_GET['category_id']."'";
		$query=mysqli_query($connect,$select);
		while($row=mysqli_fetch_assoc($query)){
			$file='uploads/category/'.$row['category_image'];
		}
		$sql="DELETE FROM category WHERE category_id= '".$_GET['category_id']."'";
		unlink($file);
		$query=mysqli_query($connect,$sql);
		$msg="Success";
		header("Location:http://localhost/CREST/Project/category_display.php");
	}
	else{
		header("Location:http://localhost/CREST/Project/category_display.php");
	}
}
catch(PDOException $e){
	header("Location:http://localhost/CREST/Project/category_display.php");
}
?>