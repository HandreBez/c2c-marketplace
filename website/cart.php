<?php
include "layout/header.php";
include "db.php";

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

/* UPDATE QUANTITY */

if(isset($_POST['update'])){

    foreach($_POST['qty'] as $product_id => $qty){

        if($qty <= 0){
            unset($_SESSION['cart'][$product_id]);
        } else {
            $_SESSION['cart'][$product_id] = $qty;
        }

    }

}

/* REMOVE ITEM */

if(isset($_GET['remove'])){

    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);

}

?>

<h2>Your Cart</h2>

<?php

if(empty($_SESSION['cart'])){

    echo "<p>Your cart is empty.</p>";

}else{

$total = 0;

echo "<form method='POST'>";

echo "<table class='cart-table'>";

echo "<tr>
<th>Product</th>
<th>Price</th>
<th>Stock</th>
<th>Quantity</th>
<th>Subtotal</th>
<th>Action</th>
</tr>";

foreach($_SESSION['cart'] as $product_id => $qty){

$sql = "SELECT * FROM products WHERE product_id=$product_id";
$result = $conn->query($sql);

$product = $result->fetch_assoc();

/* IF PRODUCT WAS DELETED */

if(!$product){
unset($_SESSION['cart'][$product_id]);
continue;
}

$price = $product['price'];
$stock = $product['stock'];

/* PREVENT BUYING MORE THAN STOCK */

if($qty > $stock){
$qty = $stock;
$_SESSION['cart'][$product_id] = $stock;
}

$subtotal = $price * $qty;

echo "<tr>";

echo "<td>".$product['title']."</td>";

echo "<td>R".number_format($price,2)."</td>";

echo "<td>".$stock."</td>";

echo "<td>
<input type='number'
name='qty[$product_id]'
value='$qty'
min='0'
max='$stock'>
</td>";

echo "<td>R".number_format($subtotal,2)."</td>";

echo "<td>
<a href='cart.php?remove=".$product_id."' class='remove-btn'>Remove</a>
</td>";

echo "</tr>";

$total += $subtotal;

}

echo "</table>";

echo "<br>";

echo "<button type='submit' name='update'>Update Cart</button>";

echo "</form>";

echo "<h3>Total: R".number_format($total,2)."</h3>";

}

/* CHECKOUT */

if(isset($_POST['checkout'])){

if(!isset($_SESSION['user_id'])){
echo "<div class='alert'>Please login before checkout.</div>";
}else{

$buyer_id = $_SESSION['user_id'];

foreach($_SESSION['cart'] as $product_id => $qty){

$sql = "SELECT stock FROM products WHERE product_id=$product_id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if(!$product) continue;

$current_stock = $product['stock'];

if($qty > $current_stock){
echo "<div class='alert'>Not enough stock for product ID $product_id</div>";
continue;
}

/* INSERT ORDERS */

for($i=0; $i<$qty; $i++){

$sql = "INSERT INTO orders (buyer_id, product_id)
VALUES ('$buyer_id','$product_id')";

$conn->query($sql);

}

/* UPDATE STOCK */

$new_stock = $current_stock - $qty;

$sql = "UPDATE products
SET stock = $new_stock
WHERE product_id = $product_id";

$conn->query($sql);

}

unset($_SESSION['cart']);

echo "<div class='success'>Order placed successfully!</div>";

}

}

?>

<form method="POST">
<button type="submit" name="checkout">Checkout</button>
</form>

<?php include "layout/footer.php"; ?>