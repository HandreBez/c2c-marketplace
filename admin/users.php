<?php
include "admin_header.php";

/* DELETE USER */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

/* prevent deleting yourself */

if($id != $_SESSION['user_id']){

/* delete user's orders */

$conn->query("DELETE FROM orders WHERE buyer_id = $id");

/* delete user's products */

$conn->query("DELETE FROM products WHERE seller_id = $id");

/* delete user */

$conn->query("DELETE FROM users WHERE user_id = $id");

}

}

/* PROMOTE USER */

if(isset($_GET['promote'])){

$id = $_GET['promote'];

$conn->query("UPDATE users SET role='admin' WHERE user_id=$id");

}

/* GET USERS */

$result = $conn->query("SELECT * FROM users");

?>

<h1 class="admin-title">Manage Users</h1>

<table class="cart-table">

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Created</th>
<th>Actions</th>
</tr>

<?php

while($user = $result->fetch_assoc()){

echo "<tr>";

echo "<td>".$user['user_id']."</td>";
echo "<td>".$user['name']."</td>";
echo "<td>".$user['email']."</td>";
echo "<td>".$user['role']."</td>";
echo "<td>".$user['created_at']."</td>";

echo "<td>";

/* promote button */

if($user['role'] != 'admin'){

echo "<a class='action-btn' 
href='users.php?promote=".$user['user_id']."'>
Promote
</a> ";

}

/* delete button */

if($user['user_id'] != $_SESSION['user_id']){

echo "<a class='action-btn delete-btn'
href='users.php?delete=".$user['user_id']."'
onclick=\"return confirmDelete('Delete this user?')\">
Delete
</a>";

}

echo "</td>";

echo "</tr>";

}

?>

</table>

<?php include "admin_footer.php"; ?>

