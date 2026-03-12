<?php
include "layout/header.php";
include "db.php";
?>

<h2>Your Cart</h2>

<?php

if(empty($_SESSION['cart'])){
    echo "<p>Cart is empty</p>";
} 
else {

$total = 0;

foreach($_SESSION['cart'] as $product_id){

$sql = "SELECT * FROM products WHERE product_id=$product_id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

echo "<div class='product-card'>";
echo "<h3>".$product['title']."</h3>";
echo "<p class='price'>R".$product['price']."</p>";
echo "</div>";

$total += $product['price'];

}

echo "<h3>Total: R".$total."</h3>";

}

if(isset($_POST['checkout'])){

if(!isset($_SESSION['user_id'])){
echo "<p>You must login before checkout.</p>";
} 
else {

$buyer_id = $_SESSION['user_id'];

foreach($_SESSION['cart'] as $product_id){

$sql = "INSERT INTO orders (buyer_id, product_id)
VALUES ('$buyer_id','$product_id')";

$conn->query($sql);

}

unset($_SESSION['cart']);

echo "<p>Order placed successfully!</p>";

}

}
?>

<form method="POST">
<button type="submit" name="checkout">Checkout</button>
</form>

<?php include "layout/footer.php"; ?>