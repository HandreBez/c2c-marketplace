<?php
include "db.php";
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

if(!isset($_GET['id'])){
exit("No product selected");
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$sql = "DELETE FROM products WHERE product_id = $id AND seller_id = $user_id";

$conn->query($sql);

header("Location: my_listings.php");
exit();
?>