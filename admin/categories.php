<?php
include "admin_header.php";

/* ADD CATEGORY */

if(isset($_POST['add'])){

$name = $_POST['name'];

$conn->query("INSERT INTO categories (category_name) VALUES ('$name')");

}

/* DELETE CATEGORY */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

$conn->query("DELETE FROM categories WHERE category_id = $id");

}

/* GET CATEGORIES */

$result = $conn->query("SELECT * FROM categories");

?>

<h1 class="admin-title">Manage Categories</h1>

<h3>Add Category</h3>

<form method="POST">

<input type="text" name="name" required>

<button type="submit" name="add">Add</button>

</form>

<br>

<table class="cart-table">

<tr>
<th>ID</th>
<th>Name</th>
<th>Action</th>
</tr>

<?php

while($cat = $result->fetch_assoc()){

echo "<tr>";

echo "<td>".$cat['category_id']."</td>";
echo "<td>".$cat['category_name']."</td>";

echo "<td>";

echo "<a class='action-btn delete-btn' 
href='categories.php?delete=".$cat['category_id']."' 
onclick=\"return confirmDelete('Delete this category?')\">
Delete
</a>";

echo "</td>";

echo "</tr>";

}

?>

</table>

<?php include "admin_footer.php"; ?>



