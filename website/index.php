<?php include "layout/header.php"; ?>

<h1>Welcome to the C2C Marketplace</h1>

<p>Buy and sell items directly with other users.</p>

<h2>Latest Listings</h2>

<?php
include "db.php";

$sql = "SELECT * FROM products ORDER BY created_at DESC LIMIT 5";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

echo "<h3><a href='product.php?id=".$row['product_id']."'>".$row['title']."</a></h3>";
echo "<p>Price: R".$row['price']."</p>";
echo "<hr>";

}
?>

<?php include "layout/footer.php"; ?>