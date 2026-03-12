<?php
include "layout/header.php";
include "db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['sell'])){

$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$seller_id = $_SESSION['user_id'];

$sql = "INSERT INTO products (title, description, price, seller_id)
VALUES ('$title','$description','$price','$seller_id')";

if($conn->query($sql) === TRUE){
    echo "Item listed successfully";
} else {
    echo "Error: " . $conn->error;
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

<button type="submit" name="sell">List Item</button>

</form>

<?php include "layout/footer.php"; ?>