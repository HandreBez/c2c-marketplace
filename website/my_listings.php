<?php
include "layout/header.php";
include "db.php";

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM products WHERE seller_id = $user_id";
$result = $conn->query($sql);
?>

<h2>My Listings</h2>

<?php

if($result->num_rows == 0){

echo "<p>You have not listed any products yet.</p>";

}else{

echo "<table class='cart-table'>";

echo "<tr>
<th>Title</th>
<th>Price</th>
<th>Stock</th>
<th>Actions</th>
</tr>";

while($row = $result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row['title']."</td>";
echo "<td>R".number_format($row['price'],2)."</td>";
echo "<td>".$row['stock']."</td>";

echo "<td>
<a href='edit_listing.php?id=".$row['product_id']."'>Edit</a> |
<a href='delete_listing.php?id=".$row['product_id']."' onclick=\"return confirm('Delete this item?')\">Delete</a>
</td>";

echo "</tr>";

}

echo "</table>";

}

include "layout/footer.php";
?>