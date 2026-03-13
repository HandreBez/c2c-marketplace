<?php
include "layout/header.php";
include "db.php";

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT orders.order_id, orders.order_date, orders.status,
products.title, products.price
FROM orders
JOIN products ON orders.product_id = products.product_id
WHERE orders.buyer_id = $user_id
ORDER BY orders.order_date DESC";

$result = $conn->query($sql);
?>

<h2>My Orders</h2>

<?php

if($result->num_rows == 0){

echo "<p>You have not placed any orders yet.</p>";

}else{

echo "<table class='cart-table'>";

echo "<tr>
<th>Order ID</th>
<th>Product</th>
<th>Price</th>
<th>Status</th>
<th>Date</th>
</tr>";

while($row = $result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row['order_id']."</td>";
echo "<td>".$row['title']."</td>";
echo "<td>R".number_format($row['price'],2)."</td>";
echo "<td>".$row['status']."</td>";
echo "<td>".$row['order_date']."</td>";

echo "</tr>";

}

echo "</table>";

}

include "layout/footer.php";
?>