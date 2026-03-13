<?php
include "admin_header.php";

/* UPDATE ORDER STATUS */

if(isset($_GET['status'])){

$order_id = $_GET['id'];
$status = $_GET['status'];

$conn->query("UPDATE orders SET status='$status' WHERE order_id=$order_id");

}

/* GET ORDERS */

$sql = "SELECT orders.*, users.name AS buyer, products.title
FROM orders
JOIN users ON orders.buyer_id = users.user_id
JOIN products ON orders.product_id = products.product_id
ORDER BY order_date DESC";

$result = $conn->query($sql);

?>

<h1 class="admin-title">Manage Orders</h1>

<table class="cart-table">

<tr>
<th>ID</th>
<th>Buyer</th>
<th>Product</th>
<th>Status</th>
<th>Date</th>
<th>Actions</th>
</tr>

<?php

while($order = $result->fetch_assoc()){

echo "<tr>";

echo "<td>".$order['order_id']."</td>";
echo "<td>".$order['buyer']."</td>";
echo "<td>".$order['title']."</td>";
echo "<td>".$order['status']."</td>";
echo "<td>".$order['order_date']."</td>";

echo "<td>

<a class='action-btn' href='orders.php?id=".$order['order_id']."&status=pending'>Pending</a>

<a class='action-btn' href='orders.php?id=".$order['order_id']."&status=shipped'>Shipped</a>

<a class='action-btn' href='orders.php?id=".$order['order_id']."&status=completed'>Completed</a>

</td>";

echo "</tr>";

}

?>

</table>

<?php include "admin_footer.php"; ?>

