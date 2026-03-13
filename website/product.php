<?php
include "layout/header.php";
include "db.php";

if(!isset($_GET['id'])){
echo "No product selected";
exit();
}

$id = $_GET['id'];

$sql = "SELECT products.*, categories.category_name, users.name AS seller
FROM products
JOIN categories ON products.category_id = categories.category_id
JOIN users ON products.seller_id = users.user_id
WHERE product_id = $id";

$result = $conn->query($sql);

if($result->num_rows == 0){
echo "Product not found";
exit();
}

$product = $result->fetch_assoc();

if(isset($_POST['add_to_cart'])){

$qty = $_POST['quantity'];

if(!isset($_SESSION['cart'])){
$_SESSION['cart'] = [];
}

if(!isset($_SESSION['cart'][$id])){
$_SESSION['cart'][$id] = 0;
}

$_SESSION['cart'][$id] += $qty;

echo "<div class='success'>Item added to cart!</div>";
}
?>

<h2><?php echo $product['title']; ?></h2>

<p class="seller">Seller: <?php echo $product['seller']; ?></p>

<p><strong>Category:</strong> <?php echo $product['category_name']; ?></p>

<p><?php echo $product['description']; ?></p>

<p class="price">Price: R<?php echo $product['price']; ?></p>

<p><strong>Stock Available:</strong> <?php echo $product['stock']; ?></p>

<?php

if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $product['seller_id']){

echo "<p style='color:red;font-weight:bold;'>You cannot buy your own item.</p>";

}elseif($product['stock'] <= 0){

echo "<p style='color:red;font-weight:bold;'>Out of Stock</p>";

}else{

?>

<form method="POST">

Quantity:<br>

<input type="number"
name="quantity"
min="1"
max="<?php echo $product['stock']; ?>"
value="1">

<br><br>

<button type="submit" name="add_to_cart">
Add to Cart
</button>

</form>

<?php
}
?>

<?php include "layout/footer.php"; ?>

