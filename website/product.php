<?php
include "layout/header.php";
include "db.php";

if(!isset($_GET['id'])){
die("Product not found");
}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT products.*, users.name AS seller, categories.category_name
FROM products
JOIN users ON products.seller_id = users.user_id
JOIN categories ON products.category_id = categories.category_id
WHERE product_id=?");

$stmt->bind_param("i",$id);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows === 0){
die("Product not found");
}

$product = $result->fetch_assoc();

$isSeller = isset($_SESSION['user_id']) && $_SESSION['user_id'] == $product['seller_id'];
?>

<div class="product-page">

<div class="product-left">

<?php
if($product['image']){
echo "<img src='uploads/".$product['image']."' class='product-img-large'>";
}else{
echo "<img src='https://via.placeholder.com/400x300?text=No+Image' class='product-img-large'>";
}
?>

</div>

<div class="product-right">

<h2><?php echo htmlspecialchars($product['title']); ?></h2>

<p><strong>Seller:</strong> <?php echo htmlspecialchars($product['seller']); ?></p>

<p><strong>Category:</strong> <?php echo htmlspecialchars($product['category_name']); ?></p>

<p><?php echo htmlspecialchars($product['description']); ?></p>

<p class="price">R<?php echo number_format($product['price'],2); ?></p>

<p>Stock: <?php echo $product['stock']; ?></p>

<?php if($product['stock'] > 0 && !$isSeller): ?>

<form method="POST" action="cart.php">

<input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

<label>Quantity:</label>

<input type="number" name="qty" value="1" min="1" max="<?php echo $product['stock']; ?>">

<br><br>

<button type="submit" name="add">Add to Cart</button>

</form>

<?php elseif($isSeller): ?>

<p style="color:#dc2626;font-weight:bold;">
You cannot buy your own product.
</p>

<?php else: ?>

<p style="color:red;font-weight:bold;">Out of Stock</p>

<?php endif; ?>

</div>

</div>

<?php include "layout/footer.php"; ?>