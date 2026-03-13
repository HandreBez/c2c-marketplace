<?php
include "layout/header.php";
include "db.php";

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$categories = $conn->query("SELECT * FROM categories");

if(isset($_POST['sell'])){

$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$category_id = $_POST['category'];
$stock = $_POST['stock'];
$seller_id = $_SESSION['user_id'];

$sql = "INSERT INTO products (title, description, price, seller_id, category_id, stock)
VALUES ('$title','$description','$price','$seller_id','$category_id','$stock')";

if($conn->query($sql)){
echo "<div class='success'>Item listed successfully!</div>";
}
}
?>

<h2>Sell an Item</h2>

<form method="POST">

Title:<br>
<input type="text" name="title" required><br><br>

Description:<br>
<textarea name="description" required></textarea><br><br>

Price:<br>
<input type="number" step="0.01" name="price" required><br><br>

Stock Quantity:<br>
<input type="number" name="stock" min="1" value="1" required><br><br>

Category:<br>

<select name="category">

<?php
while($cat = $categories->fetch_assoc()){
echo "<option value='".$cat['category_id']."'>".$cat['category_name']."</option>";
}
?>

</select>

<br><br>

<button type="submit" name="sell">List Item</button>

</form>

<?php include "layout/footer.php"; ?>