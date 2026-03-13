<?php
include "layout/header.php";
include "db.php";

if(isset($_POST['login'])){

$email = trim($_POST['email']);
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows === 1){

$user = $result->fetch_assoc();

if(password_verify($password,$user['password'])){

$_SESSION['user_id'] = $user['user_id'];
$_SESSION['name'] = $user['name'];
$_SESSION['role'] = $user['role'];

if($user['role'] == "admin"){
header("Location: ../admin/dashboard.php");
} else {
header("Location: index.php");
}

exit();

}else{

$error = "Invalid email or password.";

}

}else{

$error = "Invalid email or password.";

}

}
?>

<h2>Login</h2>

<?php
if(isset($error)){
echo "<p style='color:red;'>$error</p>";
}
?>

<form method="POST">

Email:<br>
<input type="email" name="email" required><br><br>

Password:<br>
<input type="password" name="password" required><br><br>

<button type="submit" name="login">Login</button>

</form>

<?php include "layout/footer.php"; ?>