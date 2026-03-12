<?php
include "layout/header.php";
include "db.php";

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<h2>Marketplace</h2>

<?php

if($result->num_rows > 0){

while($row = $result->fetch_assoc()){

echo "<div>";

echo "<h3><a href='product.php?id=".$row['product_id']."'>".$row['title']."</a></h3>";
echo "<p>".$row['description']."</p>";
echo "<p>Price: R".$row['price']."</p>";

echo "</div>";
echo "<hr>";

}

} else {

echo "No products available";

}

?>

<?php include "layout/footer.php"; ?>