<?php
session_start();
require 'connection.php';

try{
	if(isset($_POST['category'])){
		$category_name=$_POST['category_name'];
		$category_image=$_FILES['category_image']['name'];
		$category_order=$_POST['category_order'];
		$category_status=$_POST['category_status'];

		//File Upload Code
		$target_dir="uploads/category/";
		$target_file=$target_dir.basename($_FILES["category_image"]["name"]);
		$uplodok=1;
		$imageType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		if($_FILES['category_image']['size'] > 500000){
			echo "Sorrry File is to large <br>";
			$uplodok = 0;
		}
		if($imageType != 'jpeg' && $imageType != 'png' && $imageType !='jpg'){
			echo "Sorry Only JPEG , JPG , PNG file is uploaded";
			$uplodok=0;
		}
		if($uplodok == 0){
			echo "Sorry file is not";
		}
		else{
			if(move_uploaded_file($_FILES["category_image"]['tmp_name'], $target_file)){
				echo "File".basename($_FILES['category_image']['name'])."Uploaded";
				$uplodok=1;
			}
			else{
				echo "Sorry File is not uploaded";
				$uplodok = 0;
			}
		}
		$sql="INSERT INTO category (category_name,category_image,category_order,category_status) VALUES('$category_name','$category_image','$category_order','$category_status')";
		$exec=mysqli_query($connect,$sql);
		$msg="Success";
		header("Location:http://localhost/CREST/Project/category_display.php");
	}
	else{
		echo "Not Success";
		header("Location:http://localhost/CREST/Project/category_display.php");
	}
}catch(PDOException $e)
{
	echo "Error :".$e->getMessage();
}
?>