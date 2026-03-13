
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

$image_name = NULL;

/* HANDLE IMAGE UPLOAD */

if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

$target_dir = "uploads/";
$image_name = time() . "_" . basename($_FILES["image"]["name"]);
$target_file = $target_dir . $image_name;

move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

}

$sql = "INSERT INTO products
(title, description, price, seller_id, category_id, stock, image)
VALUES
('$title','$description','$price','$seller_id','$category_id','$stock','$image_name')";

if($conn->query($sql)){
echo "<div class='success'>Item listed successfully!</div>";
}

}
?>

<h2>Sell an Item</h2>

<form method="POST" enctype="multipart/form-data">

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

Product Image:<br>

<input type="file"
name="image"
accept="image/*"
onchange="previewImage(event)">

<br><br>

<img id="image-preview"
style="max-width:200px;display:none;border-radius:6px;margin-top:10px;">

<br><br>

<button type="submit" name="sell">List Item</button>

</form>

<script src="js/main.js"></script>

<?php include "layout/footer.php"; ?>

