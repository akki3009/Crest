<?php
include 'connection.php';
include 'function.php';
session_start();
if (!$_SESSION['user_name']) {
    header("Location:login.php");
    exit;
}
if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $category_name = $_POST['category_name'];
    $price = $_POST['price'];
    $sale_price = $_POST['sale_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_order = $_POST['product_order'];
    $product_status = $_POST['product_status'];
    $product_code = bin2hex(random_bytes(16));

    $file_size = $_FILES['image_name']['size'];
    $filetype = $_FILES['image_name']['type'];
    $folder = "uploads/product/";

    $productQuery = "insert into product (product_name,category_id,product_code,price,sale_price,product_quantity,product_order,product_status) values ('" . $product_name . "','" . $category_name . "','" . $product_code . "','" . $price . "','" . $sale_price . "','" . $product_quantity . "','" . $product_order . "','" . $product_status . "')";

    $productResult = mysqli_query($connect, $productQuery);
    $last_id = mysqli_insert_id($connect);

    $allowed = array('image/jpeg', 'image/png', 'image/jpg');
    if (in_array($filetype, $allowed)) {
        echo "<script>alert('pls select jpeg or png');window.location.href=product.php;</script>";
    } else {
        foreach ($images = $_FILES['image_name']['name'] as $key => $value) {
            if ($images != '') {
                $images = $_FILES['image_name']['name'][$key];
                $images = time() . '-' . rand() . '-' . $images;

                $fdir = $folder . $images;
                $tempFile = $_FILES['image_name']['tmp_name'][$key];

                productImage($images);
                createProductThumb($images);

                if ($original_width > 1024 or $original_height > 720) {
                    productImage($images);
                    cropProductImage($images);
                    $insertQrySplit[] = "('$images')";
                } else {
                    if (move_uploaded_file($_FILES['image_name']['tmp_name'][$key], $fdir)) {
                        $insertQrySplit[] = "('$images')";
                    } else {
                        echo "not uploaded";
                    }
                }
            }
            if (!empty($insertQrySplit)) {
                // print_r($insertQrySplit);
                // die();
                $query = implode($insertQrySplit);
                $imageQuery = "insert into image(product_id,image_name) values('" . $last_id . "','" . $images . "')";
                $imageResult = mysqli_query($connect, $imageQuery);
                header("location:product_display.php");
            }
        }
        $last_id = mysqli_insert_id($connect);
        $update = "update image set image_marked=1 where image_id='$last_id'";
        $result = mysqli_query($connect, $update);
    }
}
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    // print_r($product_id);die;
    // for Unlink image from Folder
    //-------------------------------
    $query = "SELECT * FROM image LEFT JOIN product ON image.product_id=product.product_id WHERE 
    image.product_id='" .$product_id. "'";
    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_array($result)) {
        $file = $row['image_name'];
        unlink("uploads/product/thumbnail/$file");
        unlink("uploads/product/$file");
    }

    $deleteProduct = "DELETE image.*, product.* FROM image INNER JOIN product ON image.product_id=product.product_id 
    WHERE image.product_id='".$product_id."'";
    // print_r($deleteProduct);die;
    $deleteResult = mysqli_query($connect, $deleteProduct);
    header("location:product_display.php");
}
if (isset($_GET['image_id'])) {
    $image_id = $_GET['image_id'];
    // $product_id = $_GET['product_id'];
    // for Unlink image from Folder
    //-------------------------------
    $query = "select * from image where image_id='$image_id'";
    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_array($result)) {
        $file = $row['image_name'];
        unlink("uploads/product/thumbnail/$file");
        unlink("uploads/product/$file");
    }

    $deleteProduct = "DELETE FROM image where image_id='$image_id'";

    $deleteResult = mysqli_query($connect, $deleteProduct);
    header("location:product_display.php");
}
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $category_name = $_POST['category_name'];
    $price = $_POST['price'];
    $sale_price = $_POST['sale_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_order = $_POST['product_order'];
    $product_status = $_POST['product_status'];
    $image_id = $_POST['image'];
    // print_r($image_id);die;

    $filetype = $_FILES['image_name']['type'];
    $folder = "uploads/product/";

    $productUpdate = "update product set product_name='" . $product_name . "',category_id='" . $category_name . "',
    price='" . $price . "',sale_price='" . $sale_price . "',product_quantity='" . $product_quantity . "',product_order='
    " . $product_order . "',product_status	='" . $product_status . "' where product_id='" . $product_id . "'";

    $productResult = mysqli_query($connect, $productUpdate);
    // print_r($productResult);
    // die;
    $allowed = array('image/jpeg', 'image/png', 'image/jpg');
    if (in_array($filetype, $allowed)) {
        echo "<script>alert('pls select jpeg or png');window.location.href=product.php;</script>";
    } else {
        if($images = $_FILES['image_name']['name']){
        foreach ($images as $key => $value) {
            if ($images != '') {
                $images = $_FILES['image_name']['name'][$key];
                $images = time() . '-' . rand() . '-' . $images;
                $fdir = $folder . $images;
                $tempFile = $_FILES['image_name']['tmp_name'][$key];
                if ($images == '') {
                    $updateImage = "UPDATE image SET image_marked=0 where product_id= $product_id";
                    $upateResult = mysqli_query($connect, $updateImage);

                    $updateImage2 = "UPDATE image SET image_marked=1 where image_id=  $image_id AND product_id = $product_id";
                    // print_r($updateImage2);die;
                    $updateResult2 = mysqli_query($connect, $updateImage2);

                    header("location:product_display.php");
                }
                productImage($images);
                createProductThumb($images);

                if ($original_width > 1024 or $original_height > 720) {
                    productImage($images);
                    cropProductImage($images);
                    $insertQrySplit[] = "('$images')";
                } else {
                    if (move_uploaded_file($_FILES['image_name']['tmp_name'][$key], $fdir)) {
                        $success[] = "uploaded";
                        $insertQrySplit[] = "('$images')";
                    } else {
                        echo "not uploaded";
                    }
                }
            }
            if (!empty($insertQrySplit)) {
                $query = implode($insertQrySplit);
                // $imageQuery = "update image set image_name='" . $images . "',image_marked='" . $marked . "' where product_id='$product_id' ";
                $imageQuery = "insert into image (image_name,product_id) value('" . $images . "','" . $product_id . "') ";

                $imageResult = mysqli_query($connect, $imageQuery);
                header("location:product_display.php");
            }
        }
    }
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product </title>
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
    <?php
    include 'header.html';
    ?>
    <div>
        <h2 id="head">Add product</h2>
    </div>
    <div class="container prod">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" id="productForm">
            <div class="form-group">
                <label class="control-label col-sm-2" for="product_name">Product Name</label>
                <div class="col-sm-10">
                    <input type="text" name="product_name" class="form-control" placeholder="Enter product name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="image_name">Product Image</label>
                <div class="col-sm-10">
                    <input type="file" name="image_name[]" class="form-control" multiple required/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="category_name">Category</label>
                <div class="col-sm-10">
                    <select class="form-control" name="category_name" id="category_name" required>
                        <option disabled selected>Category</option>
                        <?php
                        include 'connection.php';
                        $query = mysqli_query($connect, "SELECT * FROM category");
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="price">Price</label>
                <div class="col-sm-10">
                    <input type="text" name="price" class="form-control" placeholder="Enter product price" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="sale_price">Sale Price</label>
                <div class="col-sm-10">
                    <input type="text" name="sale_price" class="form-control" placeholder="Enter Sale price" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="product_quantity">Product Quantity</label>
                <div class="col-sm-10">
                    <input type="text" name="product_quantity" class="form-control" placeholder="Enter product quantity" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="product_order" >Product Order</label>
                <div class="col-sm-10">
                    <input type="text" name="product_order" class="form-control" placeholder="Enter Product Order">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="product_status">Product Status</label>
                <div class="col-sm-10">
                    <input type="text" name="product_status" class="form-control" placeholder="Enter Product Status">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-2">
                    <button type="submit" name="submit" class="btn btn-success btn-block">Add Product</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
    <script src="validation.js"></script>
</body>
</html>