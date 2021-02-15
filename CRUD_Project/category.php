<?php
session_start();
if (!$_SESSION['user_name']) {
    header("Location:login.php");
    exit;
}
include 'connection.php';
include 'function.php';
if (isset($_POST['category'])) {
    $category_name = $_POST['category_name'];
    $category_order = $_POST['category_order'];
    $category_status = $_POST['category_status'];

    $images = $_FILES['category_image']['name'];
    $file_size = $_FILES['category_image']['size'];
    $file_type = $_FILES['category_image']['type'];
    $tempname = $_FILES['category_image']['tmp_name'];
    $folder = "uploads/category/";

    $thumbnail = "uploads/category/thumbnail/";
    $allowed = array("image/jpeg", "image/jpg", "image/png");
    if (!in_array($file_type, $allowed)) {
        echo "<script>alert('pls Select Only jpeg/jpg/png');window.location.href='category.php';</script>";
    } else {
        if ($images != '') {
            createImage($images);
            createCategoryThumb($images);
            if ($original_width > 1024 or $original_height > 720) {
                createImage($images);
                cropCategoryImage($images);
            } else {
                move_uploaded_file($tempname, $directory);
            }
        }
        if ($category_name != '') {
            $checkCategoryName = "select category_name from category where category_name='" . $category_name . "'";
            $checkResult = mysqli_query($connect, $checkCategoryName);
            $checkRow = mysqli_num_rows($checkResult);
            if ($checkRow >= 1) {
                echo "<script>alert('Name Already Exists');window.location.href='category.php';</script>";
            } else {
                $categoryQuery = "insert into category(category_image,category_name,category_order,category_status) values('" . $images . "','" . $category_name . "','" . $category_order . "','" . $category_status . "')";
                print_r($categoryQuery);

                $categoryResult = mysqli_query($connect, $categoryQuery);

                if ($categoryResult) {
                    header("location:category_display.php");
                } else {
                    echo "unsuccess";
                }
            }
        }
    }
}

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $query = "select * from category where category_id='" . $category_id . "'";
    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_array($result)) {
        $file = $row['category_image'];
        unlink("uploads/category/thumbnail/$file");
        unlink("uploads/category/$file");
    }
    $deleteCategory = "delete from category where category_id='$category_id'";
    $delteResult = mysqli_query($connect, $deleteCategory);
    header("location:category_display.php");
}
if (isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    $category_order = $_POST['category_order'];
    $category_status = $_POST['category_status'];

    $file_size = $_FILES['category_image']['size'];
    $file_type = $_FILES['category_image']['type'];

    $images = $_FILES['category_image']['name'];
    $tempname = $_FILES['category_image']['tmp_name'];
    // $folder = "images/";
    $allowed = array("image/jpeg", "image/jpg", "image/png");
    if ($categoryName !== '') {
        $checkCategoryName = "select category_name from category where category_name='" . $category_name . "' AND category_id!='" . $category_id . "'";
        $checkResult = mysqli_query($connect, $checkCategoryName);
        $checkRow = mysqli_num_rows($checkResult);
        if ($checkRow >= 1) {
            echo "<script>alert('Name Already Exists');window.location.href='category_display.php';</script>";
        } else {
            if ($images == '') {
                $updateCategory = "UPDATE `category` SET `category_name`='" . $category_name . "',`category_order`='" . $category_order . "',`category_status`='" . $category_status . "' WHERE category_id='" . $category_id . "'";
            } else {
                if (!in_array($file_type, $allowed)) {
                    echo "<script>alert('pls Select Only jpeg/jpg/png');window.location.href='category_display.php';</script>";
                } else {
                    createImage($images);
                    createCategoryThumb($images);
                    if ($original_width > 1024 or $original_height > 720) {
                        createImage($images);
                        cropCategoryImage($images);
                    } else {
                        move_uploaded_file($tempname, $directory);
                    }
                }
                $query = "select * from category where category_id='" . $category_id . "'";
                $result = mysqli_query($connect, $query);
                while ($row = mysqli_fetch_array($result)) {
                    $file = $row['category_image'];
                    unlink("uploads/category/thumbnail/$file");
                    unlink("uploads/category/$file");
                }

                $updateCategory = "UPDATE `category` SET `category_image`='" . $images . "',`category_name`='" . $category_name . "',`category_order`='" . $category_order . "',`category_status`='" . $category_status . "' WHERE category_id='" . $category_id . "'";
            }
            $updateResult = mysqli_query($connect, $updateCategory);
            if ($updateResult) {
                header("location:category_display.php");
            } else {
                echo "unsuccessfull";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Category </title>
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
        <h2 id="head">Add Category</h2>
    </div>
    <div class="container cat">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" id="categoryForm">
            <div class="form-group">
                <label class="control-label col-sm-2" for="category_name">CategoryName</label>
                <div class="col-sm-10">
                    <input type="text" name="category_name" class="form-control" placeholder="Enter category name" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="category_image">category_image</label>
                <div class="col-sm-10">
                    <input type="file" name="category_image" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="category_order" >Category Order</label>
                <div class="col-sm-10">
                    <input type="text" name="category_order" class="form-control" placeholder="Enter Category Order">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="category_status" >Category Status</label>
                <div class="col-sm-10">
                    <input type="text" name="category_status" class="form-control" placeholder="Enter Category Status">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-2">
                    <button type="submit" id="category" name="category" class="btn btn-success btn-block">Add Category</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
    <script src="validation.js"></script>
</body>

</html>