<?php
include "layout/header.php";
include "db.php";

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<h2>Marketplace</h2>

<div class="product-grid">

<?php

if($result->num_rows > 0){

while($row = $result->fetch_assoc()){

echo "<div class='product-card'>";

echo "<h3><a href='product.php?id=".$row['product_id']."'>".$row['title']."</a></h3>";

echo "<p>".$row['description']."</p>";

echo "<p class='price'>R".$row['price']."</p>";

echo "</div>";

}

} else {

echo "No products available";

}

?>

</div>

<?php include "layout/footer.php"; ?>