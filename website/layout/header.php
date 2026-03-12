<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>

<title>C2C Marketplace</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<nav>

<span class="site-title">C2C Marketplace</span>

<div class="nav-links">
<a href="index.php">Home</a>
<a href="browse.php">Browse</a>
<a href="sell_item.php">Sell</a>
<a href="cart.php">Cart</a>

<?php if(isset($_SESSION['user_id'])): ?>

<a href="logout.php">Logout</a>

<?php else: ?>

<a href="login.php">Login</a>
<a href="register.php">Register</a>

<?php endif; ?>

</div>

</nav>

<div class="container">