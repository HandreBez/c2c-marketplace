
<?php
include "../website/db.php";
include "admin_check.php";
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Panel</title>
<link rel="stylesheet" href="../website/css/style.css">

<style>

/* ADMIN LAYOUT */

.admin-layout{
display:flex;
min-height:100vh;
}

/* SIDEBAR */

.admin-sidebar{
width:220px;
background:#111827;
color:white;
padding:25px;
}

.admin-sidebar h2{
margin-bottom:25px;
}

.admin-sidebar a{
display:block;
color:white;
text-decoration:none;
margin-bottom:12px;
padding:8px;
border-radius:4px;
}

.admin-sidebar a:hover{
background:#2563eb;
}

/* CONTENT */

.admin-content{
flex:1;
padding:30px;
background:#f3f4f6;
}

.admin-title{
margin-bottom:20px;
}

/* DASHBOARD GRID */

.card-grid{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
margin-bottom:30px;
}

/* DASHBOARD CARDS */

.stat-card{
background:white;
padding:25px;
border-radius:10px;
box-shadow:0 4px 12px rgba(0,0,0,0.08);
display:flex;
flex-direction:column;
gap:6px;
}

.stat-card h3{
font-size:28px;
margin:0;
}

.stat-card p{
color:#6b7280;
font-size:14px;
margin:0;
}

/* COLORS */

.users-card{
border-left:6px solid #2563eb;
}

.products-card{
border-left:6px solid #16a34a;
}

.orders-card{
border-left:6px solid #f59e0b;
}

.revenue-card{
border-left:6px solid #dc2626;
}

</style>

</head>

<body>

<div class="admin-layout">

<div class="admin-sidebar">

<h2>Admin Panel</h2>

<a href="dashboard.php">Dashboard</a>
<a href="users.php">Users</a>
<a href="products.php">Products</a>
<a href="orders.php">Orders</a>
<a href="categories.php">Categories</a>

<br>

<a href="../website/index.php">Back to Site</a>

</div>

<div class="admin-content">

