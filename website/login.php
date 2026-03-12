<?php
include "db.php";
session_start();

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if($result->num_rows > 0){

$user = $result->fetch_assoc();

if(password_verify($password, $user['password'])){

$_SESSION['user_id'] = $user['user_id'];
$_SESSION['name'] = $user['name'];

echo "Login successful";

} else {

echo "Incorrect password";

}

} else {

echo "User not found";

}

}
?>

<?php
include "db.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>

<body>

<h2>Login</h2>

<form method="POST">

Email:<br>
<input type="email" name="email" required><br><br>

Password:<br>
<input type="password" name="password" required><br><br>

<button type="submit" name="login">Login</button>

</form>

</body>
</html>