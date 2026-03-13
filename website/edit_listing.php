<?php
include "layout/header.php";
include "db.php";

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

if(!isset($_GET['id'])){
echo "No product selected";
exit();
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM products WHERE product_id = $id AND seller_id = $user_id";
$result = $conn->query($sql);

if($result->num_rows == 0){
echo "Product not found";
exit();
}

$product = $result->fetch_assoc();

if(isset($_POST['update'])){

$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$stock = $_POST['stock'];

$sql = "UPDATE products
SET title='$title',
description='$description',
price='$price',
stock='$stock'
WHERE product_id = $id";

$conn->query($sql);

echo "<div class='success'>Listing updated!</div>";

}
?>

<h2>Edit Listing</h2>

<form method="POST">

Title:<br>
<input type="text" name="title" value="<?php echo $product['title']; ?>" required><br><br>

Description:<br>
<textarea name="description"><?php echo $product['description']; ?></textarea><br><br>

Price:<br>
<input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>"><br><br>

Stock:<br>
<input type="number" name="stock" value="<?php echo $product['stock']; ?>"><br><br>

<button type="submit" name="update">Update Listing</button>

</form>

<?php include "layout/footer.php"; ?>