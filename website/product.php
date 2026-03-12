<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db.php";

$id = $_GET['id'];

$sql = "SELECT * FROM products WHERE product_id = $id";
$result = $conn->query($sql);

$product = $result->fetch_assoc();
?>

<?php
include "db.php";

$id = $_GET['id'];

$sql = "SELECT * FROM products WHERE product_id = $id";
$result = $conn->query($sql);

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Product</title>
</head>

<body>

<h2><?php echo $product['title']; ?></h2>

<p><?php echo $product['description']; ?></p>

<p>Price: R<?php echo $product['price']; ?></p>

</body>
</html>