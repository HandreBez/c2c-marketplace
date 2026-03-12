<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>C2C Marketplace</title>

<style>

body{
font-family: Arial;
margin:0;
background:#f4f4f4;
}

nav{
background:#222;
padding:15px;
}

nav a{
color:white;
margin-right:20px;
text-decoration:none;
font-weight:bold;
}

nav a:hover{
color:#00bcd4;
}

.container{
width:900px;
margin:auto;
background:white;
padding:20px;
margin-top:20px;
}

</style>

</head>

<body>

<nav>

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

</nav>

<div class="container">