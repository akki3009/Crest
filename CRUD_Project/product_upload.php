<?php
session_start();
require 'connection.php';
try{
	if(isset($_POST['product'])){
		$product_name=$_POST['product_name'];
		$product_image=$_FILES['product_image']['name'];
		$category_id = $_POST['category_id'];
		$product_code=$_POST['product_code'];
		$price=$_POST['price'];
		$sale_price=$_POST['sale_price'];
		$product_quantity=$_POST['product_quantity'];
		$product_order=$_POST['product_order'];
		$product_status=$_POST['product_status'];

		//File Upload Code
		$target_dir="uploads/product/";
		$target_file=$target_dir.basename($_FILES["product_image"]["name"]);
		$uplodok=1;
		$imageType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		if($_FILES['product_image']['size'] > 500000){
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
			if(move_uploaded_file($_FILES["product_image"]['tmp_name'], $target_file)){
				echo "File".basename($_FILES['product_image']['name'])."Uploaded";
				$uplodok=1;
			}
			else{
				echo "Sorry File is not uploaded";
				$uplodok = 0;
			}
		}
		$sql="INSERT INTO product (product_name,product_image,category_id,product_code,price,sale_price,product_quantity,product_order,product_status) VALUES('$product_name','$product_image','$category_id','$product_code','$price','$sale_price','$product_quantity','$product_order','$product_status')";
		$exec=mysqli_query($connect,$sql);
		// $msg="Success";
		echo "Inserted succesfully";
		header("Location:http://localhost/CREST/Project/product_display.php");
	}
	else{
		echo "Not Success";
		header("Location:http://localhost/CREST/Project/product_display.php");
	}
}catch(PDOException $e){
	echo "Error :".$e->getMessage();
}
?>