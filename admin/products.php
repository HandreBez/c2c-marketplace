<?php
include "admin_header.php";

/* DELETE PRODUCT */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

/* delete related orders */

$conn->query("DELETE FROM orders WHERE product_id = $id");

/* delete product */

$conn->query("DELETE FROM products WHERE product_id = $id");

}

/* GET PRODUCTS */

$sql = "SELECT products.*, users.name AS seller, categories.category_name
FROM products
JOIN users ON products.seller_id = users.user_id
JOIN categories ON products.category_id = categories.category_id
ORDER BY created_at DESC";

$result = $conn->query($sql);

?>

<h1 class="admin-title">Manage Products</h1>

<table class="cart-table">

<tr>
<th>ID</th>
<th>Title</th>
<th>Seller</th>
<th>Category</th>
<th>Price</th>
<th>Stock</th>
<th>Created</th>
<th>Action</th>
</tr>

<?php

while($product = $result->fetch_assoc()){

echo "<tr>";

echo "<td>".$product['product_id']."</td>";
echo "<td>".$product['title']."</td>";
echo "<td>".$product['seller']."</td>";
echo "<td>".$product['category_name']."</td>";
echo "<td>R".number_format($product['price'],2)."</td>";
echo "<td>".$product['stock']."</td>";
echo "<td>".$product['created_at']."</td>";

echo "<td>
<a class='action-btn delete-btn'
href='products.php?delete=".$product['product_id']."'
onclick=\"return confirm('Delete this product?')\">Delete</a>
</td>";

echo "</tr>";

}

?>

</table>

<?php include "admin_footer.php"; ?>

