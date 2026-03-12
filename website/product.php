<?php
include "layout/header.php";
include "db.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!isset($_GET['id'])){
    echo "No product selected";
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM products WHERE product_id = $id";
$result = $conn->query($sql);

if($result->num_rows == 0){
    echo "Product not found";
    exit();
}

$product = $result->fetch_assoc();

if(isset($_POST['add_to_cart'])){

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

$_SESSION['cart'][] = $id;

echo "Item added to cart";

}
?>

<h2><?php echo $product['title']; ?></h2>

<p><?php echo $product['description']; ?></p>

<p>Price: R<?php echo $product['price']; ?></p>

<form method="POST">
<button type="submit" name="add_to_cart">Add to Cart</button>
</form>

<?php include "layout/footer.php"; ?>