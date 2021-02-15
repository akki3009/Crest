<?php
session_start();
require 'connection.php';
if (!$_SESSION['user_name']) {
    header("Location:login.php");
    exit;
}
$query = "SELECT * FROM  category";
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = $_POST['search'];
    // $query = "SELECT ct.*,COUNT(ps.category_id) AS totalproduct FROM category ct LEFT JOIN product ps ON 
    // ct.category_id=ps.category_id WHERE ct.category_name LIKE '%$search%' OR ct.category_order LIKE '%$search%'
    // OR ct.category_status LIKE '%$search%' OR ct.added_date LIKE '%$search%'";
    $query .= " WHERE category_name LIKE '%$search%' OR category_order LIKE '%$search%' OR category_status LIKE '%$search%' OR added_date LIKE '%$search%'";
    // print_r($query).die;
}
if ($_POST['statuses'] == "Active") {
    $status = $_POST['statuses'];
    $query .= " WHERE category_status ='".$status."'";
}
if ($_POST['statuses'] == "Inactive") {
    $status = $_POST['statuses'];
    $query .= " WHERE category_status ='".$status."'";
}
$folder = "uploads/category/thumbnail/";
$result = mysqli_query($connect, $query);
// print_r($result);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td ><img src=" . $folder . $row['category_image'] . " width=70 height=70 ></td>";
        echo "<td >" . $row['category_name'] . "</td>";
        echo "<td >" . $row['category_order'] . "</td>";
        // echo "<td >" . $row['totalproduct'] . "</td>";
        echo "<td >" . $row['category_status'] . "</td>";
        echo "<td >" . $row['added_date'] . "</td>";
        echo "<td >" . $row['modified_date'] . "</td>";
        echo "<td><input type='button' class='btn btn-success float-right' onClick='updateRow($row[category_id])' value='Update'></td>";
        echo "<td><input type='button' class='btn btn-danger float-right' onClick='deleteRow($row[category_id])' value=' Delete'></td>";
        echo "</tr>";
    }
}
