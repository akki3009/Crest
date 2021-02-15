<?php
session_start();
include "connection.php";
if (!$_SESSION['user_name']) {
    header("Location:login.php");
    exit;
}
$query = "SELECT * FROM image im LEFT JOIN product ps ON im.product_id=ps.product_id LEFT JOIN category ct ON 
ps.category_id=ct.category_id where image_marked=1 ";

if (isset($_POST['name']) && !empty($_POST['name'])) {
    $name = $_POST['name'];
    $query .= "AND product_name LIKE '%$name%'";
} else if (isset($_POST['category_name']) && !empty($_POST['category_name'])) {
    $category_name = $_POST['category_name'];
    $query .= "AND category_name LIKE '%$category_name%'";
} else if (isset($_POST['price']) && !empty($_POST['price'])) {
    $price = $_POST['price'];
    $query .= "AND price LIKE '%$price%'";
} else if (isset($_POST['qunatity']) && !empty($_POST['qunatity'])) {
    $qunatity = $_POST['qunatity'];
    $query .= "AND product_quantity LIKE '%$qunatity%'";
} else if (isset($_POST['start_price']) && !empty($_POST['start_price']) or (isset($_POST['end_price']) && !empty($_POST['end_price']))) {
    $start_price = $_POST['start_price'];
    $end_price = $_POST['end_price'];
    if (isset($_POST['start_price']) && !empty($_POST['start_price'])) {
        $query .= "AND ps.price >= $start_price ";
    }
    if (isset($_POST['end_price']) && !empty($_POST['end_price'])) {
        $query .= "AND ps.price <= $end_price ";
    }
    if (isset($_POST['start_price']) && !empty($_POST['start_price']) and (isset($_POST['end_price']) && !empty($_POST['end_price']))) {
        $query .= "AND ps.price BETWEEN $start_price AND $end_price";
    }
} else if (isset($_POST['qunatity_from']) && !empty($_POST['qunatity_from']) or (isset($_POST['qunatity_to']) && !empty($_POST['qunatity_to']))) {
    $qunatity_from = $_POST['qunatity_from'];
    $qunatity_to = $_POST['qunatity_to'];
    if (isset($_POST['qunatity_from']) && !empty($_POST['qunatity_from'])) {
        $query .= "AND ps.product_quantity >= $qunatity_from ";
    }
    if (isset($_POST['qunatity_to']) && !empty($_POST['qunatity_to'])) {
        $query .= "AND ps.product_quantity <= $qunatity_to ";
    }
    if (isset($_POST['qunatity_from']) && !empty($_POST['qunatity_from']) and (isset($_POST['qunatity_to']) && !empty($_POST['qunatity_to']))) {
        $query .= "AND ps.product_quantity BETWEEN $qunatity_from AND $qunatity_to";
    }
}

$folder = "uploads/product/thumbnail/";
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td ><img src=" . $folder . $row['image_name'] . " width=70 height=70 ></td>";
        echo "<td >" . $row['product_name'] . "</td>";
        echo "<td >" . $row['product_code'] . "</td>";
        echo "<td >" . $row['category_name'] . "</td>";
        echo "<td >" . $row['price'] . "/" . $row['sale_price'] . "</td>";
        echo "<td >" . $row['product_quantity'] . "</td>";
        echo "<td >" . $row['product_order'] . "</td>";
        echo "<td >" . $row['product_status'] . "</td>";
        echo "<td >" . $row['added_date'] . "</td>";
        echo "<td >" . $row['modified_date'] . "</td>";
        echo "<td><input type='button' class='btn btn-success float-right' onClick='updateRow($row[product_id])' 
        value='Update'></td>";
        // <input type='button' class='btn btn-danger float-right' onClick='deleteRow($row[product_id])' value=' Delete'></td>";
        echo "</tr>";
    }
}