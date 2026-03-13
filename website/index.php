<?php include "layout/header.php"; ?>

<h1>Welcome to the C2C Marketplace</h1>

<p>
Buy and sell items directly with other users.
Browse the marketplace or list your own products for sale.
</p>

<a href="browse.php">
<button>Browse Marketplace</button>
</a>

<h2>Latest Listings</h2>

<?php
include "db.php";

$sql = "SELECT * FROM products ORDER BY created_at DESC LIMIT 6";
$result = $conn->query($sql);
?>

<div class="product-grid">

<?php

while($row = $result->fetch_assoc()){

echo "<div class='product-card'>";

if($row['image']){
echo "<img src='uploads/".$row['image']."' class='product-img'>";
}

echo "<h3><a href='product.php?id=".$row['product_id']."'>".$row['title']."</a></h3>";

echo "<p>".substr($row['description'],0,60)."...</p>";

echo "<p class='price'>R".$row['price']."</p>";

echo "</div>";

}

?>

</div>

<?php include "layout/footer.php"; ?>