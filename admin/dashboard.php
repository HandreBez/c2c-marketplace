<?php
include "admin_header.php";

/* COUNTS */

$users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$products = $conn->query("SELECT COUNT(*) as total FROM products")->fetch_assoc()['total'];
$orders = $conn->query("SELECT COUNT(*) as total FROM orders")->fetch_assoc()['total'];

$revenue = $conn->query("
SELECT SUM(products.price) as total
FROM orders
JOIN products ON orders.product_id = products.product_id
")->fetch_assoc()['total'];

/* RECENT ORDERS */

$recent_orders = $conn->query("
SELECT orders.order_id, users.name AS buyer, products.title, orders.status, orders.order_date
FROM orders
JOIN users ON orders.buyer_id = users.user_id
JOIN products ON orders.product_id = products.product_id
ORDER BY order_date DESC
LIMIT 5
");

?>

<h1 class="admin-title">Dashboard</h1>

<div class="card-grid">

<div class="stat-card users-card">
<h3><?php echo $users; ?></h3>
<p>Total Users</p>
</div>

<div class="stat-card products-card">
<h3><?php echo $products; ?></h3>
<p>Total Products</p>
</div>

<div class="stat-card orders-card">
<h3><?php echo $orders; ?></h3>
<p>Total Orders</p>
</div>

<div class="stat-card revenue-card">
<h3>R<?php echo number_format($revenue,2); ?></h3>
<p>Total Revenue</p>
</div>

</div>


<h2>Recent Orders</h2>

<table class="cart-table">

<tr>
<th>Order ID</th>
<th>Buyer</th>
<th>Product</th>
<th>Status</th>
<th>Date</th>
</tr>

<?php

while($order = $recent_orders->fetch_assoc()){

echo "<tr>";

echo "<td>".$order['order_id']."</td>";
echo "<td>".$order['buyer']."</td>";
echo "<td>".$order['title']."</td>";
echo "<td>".$order['status']."</td>";
echo "<td>".$order['order_date']."</td>";

echo "</tr>";

}

?>

</table>

<?php include "admin_footer.php"; ?>

