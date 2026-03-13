<?php
include "layout/header.php";
include "db.php";

/* SEARCH */
$search = "";
if(isset($_GET['search'])){
$search = $_GET['search'];
}

/* FILTER */
$where = [];

if($search != ""){
$where[] = "products.title LIKE '%$search%'";
}

if(isset($_GET['category'])){
$ids = implode(",", $_GET['category']);
$where[] = "products.category_id IN ($ids)";
}

$where_sql = "";

if(!empty($where)){
$where_sql = "WHERE " . implode(" AND ", $where);
}

/* PRODUCTS QUERY */

$sql = "SELECT products.*, categories.category_name, users.name AS seller
FROM products
JOIN categories ON products.category_id = categories.category_id
JOIN users ON products.seller_id = users.user_id
$where_sql";

$result = $conn->query($sql);

/* GET CATEGORIES */
$categories = $conn->query("SELECT * FROM categories");
?>

<h2>Marketplace</h2>

<form method="GET">

<div class="search-bar">

<input type="text" name="search" placeholder="Search products..."
value="<?php echo htmlspecialchars($search); ?>">

<button type="submit">Search</button>

</div>

<div class="marketplace">

<!-- SIDEBAR -->

<div class="sidebar">

<h3>Filter by Category</h3>

<?php
$categories->data_seek(0);

while($cat = $categories->fetch_assoc()){

$checked = "";

if(isset($_GET['category']) && in_array($cat['category_id'], $_GET['category'])){
$checked = "checked";
}

echo "<label class='filter-item'>";
echo "<input type='checkbox' name='category[]' value='".$cat['category_id']."' $checked>";
echo $cat['category_name'];
echo "</label>";

}
?>

<button type="submit" class="filter-btn">Apply Filter</button>

</div>

</form>

<!-- PRODUCTS -->

<div class="products">

<div class="product-grid">

<?php

if($result->num_rows > 0){

while($row = $result->fetch_assoc()){

echo "<div class='product-card'>";

echo "<h3><a href='product.php?id=".$row['product_id']."'>".$row['title']."</a></h3>";

echo "<p class='seller'>Seller: ".$row['seller']."</p>";

echo "<p>".substr($row['description'],0,70)."...</p>";

echo "<p class='category'>".$row['category_name']."</p>";

echo "<p class='price'>R".$row['price']."</p>";

if($row['stock'] > 0){
echo "<p style='color:green;font-weight:bold;'>In Stock</p>";
}else{
echo "<p style='color:red;font-weight:bold;'>Out of Stock</p>";
}

echo "</div>";

}

}else{

echo "<div class='alert'>No products found.</div>";

}

?>

</div>

</div>

</div>

<?php include "layout/footer.php"; ?>

