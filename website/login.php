<?php
include "layout/header.php";
include "db.php";

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
$_SESSION['role'] = $user['role'];

/* SEND ADMIN TO DASHBOARD */

if($user['role'] == 'admin'){
    header("Location: ../admin/dashboard.php");
} else {
    header("Location: index.php");
}

exit();

} else {

echo "Incorrect password";

}

} else {

echo "User not found";

}

}
?>

<h2>Login</h2>

<form method="POST">

Email:<br>
<input type="email" name="email" required><br><br>

Password:<br>
<input type="password" name="password" required><br><br>

<button type="submit" name="login">Login</button>

</form>

<?php include "layout/footer.php"; ?>