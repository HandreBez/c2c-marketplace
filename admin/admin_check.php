<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../website/login.php");
    exit();
}

if($_SESSION['role'] != 'admin'){
    echo "Access denied.";
    exit();
}

?>