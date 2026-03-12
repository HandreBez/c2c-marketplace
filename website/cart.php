<?php
include "layout/header.php";
include "db.php";

?>

<h2>Your Cart</h2>

<?php

if(empty($_SESSION['cart'])){
    echo "Cart is empty";
} else {

foreach($_SESSION['cart'] as $product_id){

$sql = "SELECT * FROM products WHERE product_id=$product_id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

echo "<h3>".$product['title']."</h3>";
echo "<p>Price: R".$product['price']."</p>";
echo "<hr>";

}

}

if(isset($_POST['checkout'])){

$buyer_id = $_SESSION['user_id'];

foreach($_SESSION['cart'] as $product_id){

$sql = "INSERT INTO orders (buyer_id, product_id)
VALUES ('$buyer_id','$product_id')";

$conn->query($sql);

}

unset($_SESSION['cart']);

echo "Order placed successfully";

}
?>

<form method="POST">
<button type="submit" name="checkout">Checkout</button>
</form>

<?php include "layout/footer.php"; ?>